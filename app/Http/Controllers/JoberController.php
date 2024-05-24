<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Benefit;
use App\Models\Bid;
use App\Models\Job_kind;
use App\Models\Job;
use App\Models\Job_pr;
use App\Models\Job_working_place;
use App\Models\Jober_profile;
use App\Models\PushNotification;
use App\Models\User;
use App\Models\Working_place;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class JoberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function get_jober_id()
    {
        $id =  Auth::user()->id;
        return $id;
    }

    public function index()
    {
        $jober_id = $this->get_jober_id();
        $jobs = Job::where('jober_id', $jober_id)->whereIn('post_status', [0, 1, 2])->orderBy('updated_at', 'DESC')->paginate(10);
        $working_place = Job_working_place::where('jober_id', $jober_id)->get();
        foreach ($jobs as $job) {
            $working_places = [];
            foreach ($working_place as $key => $place) {
                if ($job->id === $place->job_id) {
                    $working_places[$key]['area_name'] = $place->ken_name . $place->city_name;
                    $working_places[$key]['area_id'] = $place->city_id ?? $place->ken_id;
                    $job->working_place = $working_places;
                }
            }
        }
        return view('jober.jober_dashboard')->with(compact('jobs', 'jober_id'));
    }

    public function jober_profile()
    {
        $jober_id = $this->get_jober_id();
        $profile = Jober_profile::where('jober_id', $jober_id)->first();
        return view('jober.jober_profile')->with(compact('jober_id', 'profile'));
    }

    public function jober_profile_db(Request $request)
    {
        $this->validate($request, [
            'company_name' => 'required',
        ]);

        $jober_id = $this->get_jober_id();

        if ($request->hasfile('new_company_img')) {
            $name = time() . '-' . $request->file('new_company_img')->getClientOriginalName();
            $request->file('new_company_img')->move(public_path() . '/images/jober_profile/', $name);
            $company_img = $name;
        } else {
            $company_img = 'person.png';
        }
        if ($request->old_company_img) {
            $company_img = $request->old_company_img;
        }

        $profile = Jober_profile::where('jober_id', $jober_id)->first();
        $profile->company_name = $request->company_name;
        $profile->company_postal_code = $request->company_postal_code;
        $profile->company_province = $request->company_province;
        $profile->company_address = $request->company_address;
        $profile->company_leader = $request->company_leader;
        $profile->company_task_manager = $request->company_task_manager;
        $profile->company_phone = $request->company_phone;
        $profile->company_email = $request->company_email;
        $profile->company_url = $request->company_url;
        $profile->company_img = $company_img;
        $profile->company_business_content = $request->company_business_content;
        $profile->company_establish_date = $request->company_establish_date;
        $profile->company_employee = $request->company_employee;
        $profile->save();
        if ($profile != null) {
            return redirect()->back()->with(session()->flash('alert-success', '新規求人情報登録されました。'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'エラーが発生しました。'));
        }
    }

    public function job_register()
    {
        $jober_id = $this->get_jober_id();
        $jobs = Job::where('jober_id', $jober_id)->whereIn('post_status', [0, 1, 2])->orderBy('updated_at', 'DESC')->get();
        $category =  Job_kind::all();
        $receptions = Benefit::where('category', 1)->where('is_delete', 0)->get();
        $treatments = Benefit::where('category', 2)->where('is_delete', 0)->get();
        $working_times = Benefit::where('category', 3)->where('is_delete', 0)->get();
        $prefecture = Address::select('ken_id', 'ken_name')->where('addresses.delete_flg', 0)->groupBy('ken_id', 'ken_name')->orderBy('ken_id')->get();

        return view('jober.jober_job_register')->with(compact('jober_id', 'category', 'prefecture', 'receptions', 'treatments', 'jobs', 'working_times'));
    }

    public function job_register_db(Request $request)
    {
        if (isset($request->is_copy) && $request->is_copy) {
            $this->validate($request, [
                'post_title' => 'required',
                'post_category' => 'required',
                'post_contract_type' => 'required',
                'post_benefit' => 'required',
                'post_other' => 'required',
                'prefecture.0' => 'required',
                'post_payment_text' => 'required',
                'post_revenue' => 'required',
                'post_payment' => 'required',
                'post_rental_car' => 'required',
            ]);
            $img = $this->get_img($request);
        } else {
            $request->validate([
                'post_title' => 'required',
                'post_img' => 'required',
                'post_category' => 'required',
                'post_contract_type' => 'required',
                'post_benefit' => 'required',
                'post_other' => 'required',
                'prefecture.0' => 'required',
                'post_payment_text' => 'required',
                'post_revenue' => 'required',
                'post_payment' => 'required',
                'post_rental_car' => 'required',
            ]);
            $img = [];
            if ($request->hasfile('post_img')) {
                foreach ($request->file('post_img') as $image) {
                    $name = time() . '-' . $image->getClientOriginalName();
                    $image->move(public_path() . '/images/jobs/', $name);
                    $img[] = $name;
                }
            }
        }

        $jober_id = $this->get_jober_id();
        $post_expired = Carbon::now()->addDay(7)->format('Y-m-d');
        $job = new Job();
        $this->saveJob($job, $request, $img, $jober_id, $post_expired);
        if ($job != null) {
            $this->save_pr_type($request, $job->id);
            $this->save_job_working_place($request, $job->jober_id, $job->id);
        }
        $profile = Jober_profile::where('jober_id', $jober_id)->first();
        $data['job_id'] = $job->id;
        $data['job_company_name'] = $profile->company_name;
        $data['job_title'] = $job->post_title;
        MailController::sendJobRegisterMail($data);
        if ($job != null) {
            return redirect()->route('jober.dashboard')->with(session()->flash('alert-success', '新規求人情報を登録しました。'));
        } else {
            return redirect()->route('jober.job_register')->with(session()->flash('alert-danger', 'エラーが発生しました。'));
        }
    }

    public function job_update($id)
    {
        $job_id = $id;
        $category =  Job_kind::all();
        $prefecture = Address::select('ken_id', 'ken_name')->where('addresses.delete_flg', 0)->groupBy('ken_id', 'ken_name')->orderBy('ken_id')->get();
        $job = Job::where('id', $job_id)->first();
        $job_pr = Job_pr::where('job_id', $job_id)->get()->all();
        $job_working_place = Job_working_place::where('job_id', $job_id)->get()->all();
        $receptions = Benefit::where('category', 1)->where('is_delete', 0)->get();
        $treatments = Benefit::where('category', 2)->where('is_delete', 0)->get();
        $working_times = Benefit::where('category', 3)->where('is_delete', 0)->get();
        $is_copy = false;
        return view('jober.jober_job_update')->with(compact('job', 'category', 'prefecture', 'job_id', 'job_working_place', 'receptions', 'treatments', 'job_pr', 'working_times', 'is_copy'));
    }

    public function job_update_copy(Request $request)
    {
        $job_id = $request->job_id;
        $category =  Job_kind::all();
        $prefecture = Address::select('ken_id', 'ken_name')->where('addresses.delete_flg', 0)->groupBy('ken_id', 'ken_name')->get();
        $job = Job::where('id', $job_id)->first();
        $jober_id = $this->get_jober_id();
        $job_pr = Job_pr::where('job_id', $job_id)->get();
        $job_working_place = Job_working_place::where('job_id', $job_id)->get()->all();
        $receptions = Benefit::where('category', 1)->where('is_delete', 0)->get();
        $treatments = Benefit::where('category', 2)->where('is_delete', 0)->get();
        $working_times = Benefit::where('category', 3)->where('is_delete', 0)->get();
        $is_copy = true;
        $jobs = Job::where('jober_id', $jober_id)->whereIn('post_status', [0, 1, 2])->orderBy('updated_at', 'DESC')->get();
        return view('jober.jober_job_update')->with(compact('job', 'category', 'prefecture', 'job_id', 'job_working_place', 'receptions', 'treatments', 'job_pr', 'working_times', 'is_copy', 'jobs'));
    }

    public function job_update_db(Request $request)
    {
        $this->validate($request, [
            'post_title' => 'required',
            'post_category' => 'required',
            'post_contract_type' => 'required',
            'post_benefit' => 'required',
            'post_other' => 'required',
            'prefecture.0' => 'required',
            'post_payment_text' => 'required',
            'post_revenue' => 'required',
            'post_payment' => 'required',
            'post_rental_car' => 'required',
        ]);

        $job_id = $request->job_id;
        $img = $this->get_img($request);
        $job = Job::where('id', $job_id)->first();
        $this->saveJob($job, $request, $img);

        if ($job != null) {
            Job_pr::where('job_id', $job->id)->delete();
            $this->save_pr_type($request, $job->id);
            Job_working_place::where('job_id', $job->id)->delete();
            $this->save_job_working_place($request, $job->jober_id, $job->id);
        }
        if ($job != null) {
            return redirect()->route('jober.dashboard')->with(session()->flash('alert-success', '求人情報を更新しました。'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'エラーが発生しました。'));
        }
    }

    public function job_list()
    {
        $jober_id = $this->get_jober_id();
        $jobs = Job::where('jober_id', $jober_id)->whereIn('post_status', [0, 1, 2])->orderBy('updated_at', 'DESC')->paginate(3);
        return view('jober.jober_job_list')->with(compact('jober_id', 'jobs'));
    }

    public function job_status_change(Request $request)
    {
        $this->validate($request, [
            'post_status' => 'required',
            'job_id' => 'required'
        ]);
        $job_ids = explode(',', $request->job_id);
        $profile = Jober_profile::where('jober_id', $request->jober_id)->first();
        foreach ($job_ids as $job_id) {
            $job = Job::where('id', $job_id)->first();
            $job->post_status = $request->post_status;
            $job->save();
            if ($request->post_status === '1') {
                $data['job_id'] = $job->id;
                $data['job_title'] = $job->post_title;
                $data['jober_email'] = $profile->company_email;
                MailController::sendJobOpenMail($data);
            }
        }

        if ($job != null) {
            return redirect()->back();
        }
    }

    public function job_start($job_id)
    {
        $job = Job::where('id', $job_id)->first();
        $job->post_status = 1;
        $job->save();
        if ($job != null) {
            return redirect()->back();
        }
    }

    public function job_stop($job_id)
    {
        $job = Job::where('id', $job_id)->first();
        $job->post_status = 2;
        $job->save();
        if ($job != null) {
            return redirect()->back();
        }
    }

    public function job_tempory_stop($job_id)
    {
        $job = Job::where('id', $job_id)->first();
        $job->post_status = 0;
        $job->save();
        if ($job != null) {
            return redirect()->back();
        }
    }

    public function job_delete($id)
    {
        $job_id = $id;
        DB::beginTransaction();
        try {
            DB::transaction(function () use ($job_id) {
                Job::destroy($job_id);
                Job_pr::destroy($job_id);
                Job_working_place::destroy($job_id);
                return $job_id;
            });
        } catch (Throwable $e) {
            Log::error($e->getMessage());
        }
        if ($job_id) {
            return redirect()->back();
        }
    }

    public function bid_list()
    {
        $jober_id = $this->get_jober_id();
        $bids = Bid::where('bids.jober_id', $jober_id)->orderBy('updated_at', 'DESC')->get();
        return view('jober.jober_bid_list')->with(compact('bids'));
    }

    //    public function job_detail($job_id){
    //        $job = Job::where('id', $job_id)->first();
    //        $job_prs = Job_pr::where('job_id',$job_id)->get();
    //        $working_place = Job_working_place::where('job_id', $job->id)->get();
    //        $working_places = [];
    //        foreach ($working_place as $key => $place) {
    //            $working_places[$key]['area'] = $place->ken_name . $place->city_name;
    //            $working_places[$key]['prefecture'] = $place->ken_name;
    //            $job->working_place = $working_places;
    //        }
    //        return view('jober.jober_job_detail')->with(compact('job', 'job_prs'));
    //    }

    public function hire(Request $request)
    {
        $this->validate($request, [
            'hired_date' => 'required',
            'bid_id' => 'required'
        ]);
        $bid_id = $request->bid_id;
        $hired_date = Carbon::parse($request->hired_date)->format('Y-m-d');
        $bid = Bid::where('id', $bid_id)->first();
        $bid->hired_status = 1;
        $bid->hired_date = $hired_date;
        $bid->save();

        $user = User::where('id', $bid->user_id)->first();
        $job = Job::where('id', $bid->job_id)->first();
        $jober = User::where('id', $bid->jober_id)->first();

        $user_name = $user->name;
        $user_email = $user->email;
        $job_title = $job->post_title;
        $jober_name = $jober->name;

        $push = new PushNotification();
        $push->receiver = $bid->user_id;
        $push->sender = $bid->jober_id;
        $push->job_id = $bid->job_id;
        $push->type = 2;
        $push->status = 0;
        $push->save();

        $data['user_name'] = $user_name;
        $data['user_email'] = $user_email;
        $data['jober_name'] = $jober_name;
        $data['job_title'] = $job_title;

        if ($bid != null) {
            MailController::sendHireMail($data);
            return redirect()->route('jober.hire_list');
        }
    }

    public function hire_status_change(Request $request)
    {
        $this->validate($request, [
            'hired_status' => 'required',
            'bid_id' => 'required'
        ]);

        $expired_date = Carbon::now()->format('Y-m-d');
        $bid = Bid::where('id', $request->bid_id)->first();
        $bid->hired_status = $request->hired_status;
        $bid->expired_date = $expired_date;
        $bid->save();
        if ($bid != null) {
            return redirect()->back()->with(session()->flash('alert-success', '変更されました。'));
        }
    }

    public function hire_stop($bid_id)
    {
        $expired_date = Carbon::now()->format('Y-m-d');
        $bid = Bid::where('id', $bid_id)->first();
        $bid->hired_status = 2;
        $bid->expired_date = $expired_date;
        $bid->save();

        $jober_id = $this->get_jober_id();
        $profile = Jober_profile::where('jober_id', $jober_id)->first();
        $user = User::where('id', $bid->user_id)->first();
        $job = Job::where('id', $bid->job_id)->first();

        $data['user_name'] = $user->name;
        $data['expired_date'] = $expired_date;
        $data['jober_name'] = $profile->company_name;
        $data['jober_email'] = $profile->company_email;
        $data['job_title'] = $job->post_title;

        MailController::sendHireStopMail($data);
        if ($bid != null) {
            return redirect()->back();
        }
    }

    public function hire_list()
    {
        $jober_id = $this->get_jober_id();
        $hired_list = Bid::where('jober_id', $jober_id)->where('hired_status', 1)->get();
        $old_hired_list = Bid::where('jober_id', $jober_id)->where('hired_status', 2)->get();

        return view('jober.jober_hire_list')->with(compact('hired_list', 'old_hired_list'));
    }

    public function jober_password_update()
    {
        return view('jober.jober_password_update');
    }

    public function jober_password_update_db(Request $request)
    {
        $this->validate($request, [
            'new_password' => 'required',
            'new_confirm_password' => 'same:new_password',
        ]);

        $password = Hash::make($request->new_password);
        $user_id = $this->get_jober_id();
        $user = User::where('id', $user_id)->first();
        $user->password = $password;
        $user->save();

        $jober_id = $this->get_jober_id();
        $profile = Jober_profile::where('jober_id', $jober_id)->first();
        $data['jober_email'] = $profile->company_email;
        MailController::sendPasswordUpdateMail($data);

        if ($user !=  null) {
            return redirect()->back()->with(session()->flash('alert-success', '変更されました。'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'エラーが発生しました。'));
        }
    }

    private function saveJob($job, $request, $img, $jober_id = 0, $post_expired = '')
    {
        $post_img = json_encode($img, JSON_UNESCAPED_UNICODE);
        $post_working_place = json_encode($request->post_working_place, JSON_UNESCAPED_UNICODE);
        $post_category = json_encode($request->post_category, JSON_UNESCAPED_UNICODE);
        $post_contract_type = json_encode($request->post_contract_type, JSON_UNESCAPED_UNICODE);
        $post_benefit = json_encode($request->post_benefit, JSON_UNESCAPED_UNICODE);
        $post_working_time_type = $request->post_working_time_type ? json_encode($request->post_working_time_type, JSON_UNESCAPED_UNICODE) : '';

        if ($jober_id !== 0) {
            $job->jober_id = $jober_id;
        }
        $job->post_title = $request->post_title;
        $job->post_img = $post_img;
        $job->post_category = $post_category;
        $job->post_contract_type = $post_contract_type;
        $job->post_working_place = $post_working_place;
        $job->post_selection = $request->post_selection;
        $job->post_benefit = $post_benefit;
        $job->post_working_time = $request->post_working_time;
        $job->post_working_time_type = $post_working_time_type;
        $job->post_payment = $request->post_payment;
        $job->post_payment_text = $request->post_payment_text;
        $job->post_is_payment_more = $request->post_is_payment_more;
        $job->post_payment_max_text = $request->post_payment_max_text;
        $job->post_revenue = $request->post_revenue;
        $job->post_rental_car = $request->post_rental_car;
        $job->post_require = $request->post_require;
        $job->post_suitable = $request->post_suitable;
        $job->post_other = $request->post_other;
        if ($post_expired !== '') {
            $job->post_expired = $post_expired;
        }
        $job->save();
    }

    private function save_pr_type($request, $job_id)
    {
        foreach ($request->post_pr_type as $key => $value) {
            if ($request->post_pr_text[$key]) {
                $job_pr = new Job_pr();
                $job_pr->job_id = $job_id;
                $job_pr->post_pr_type = $request->post_pr_type[$key];
                $job_pr->post_pr_title = isset($request->post_pr_title) ? $request->post_pr_title[$key] : null;
                $job_pr->post_pr_text = $request->post_pr_text[$key];
                $job_pr->save();
            }
        }
    }

    private function save_job_working_place($request, $jober_id, $job_id)
    {
        foreach ($request->city as $key => $value) {
            if ($value !== null) {
                $job_working_place = new Job_working_place();
                $job_working_place->jober_id = $jober_id;
                $job_working_place->job_id = $job_id;
                $job_working_place->ken_id = $request->prefecture[0];
                $job_working_place->city_id = $request->city[$key];
                $ken = Address::select('ken_id', 'ken_name')
                    ->where('ken_id', $request->prefecture[0])
                    ->where('addresses.delete_flg', 0)
                    ->groupBy('ken_id', 'ken_name')->get();
                $job_working_place->ken_name = $ken[0]->ken_name;
                if ($request->city[$key]) {
                    $city = Address::select('city_id', 'city_name')
                        ->where('city_id', $request->city[$key])
                        ->where('addresses.delete_flg', 0)
                        ->groupBy('city_id', 'city_name')
                        ->get();
                    $job_working_place->city_name = $city[0]->city_name;
                }
                $job_working_place->save();
            }
        }
    }

    private function get_img($request)
    {
        $img = [];
        if ($request->hasfile('post_img')) {
            foreach ($request->file('post_img') as $image) {
                $name = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path() . '/images/jobs/', $name);
                $img[] = $name;
            }
        }
        $old_img = [];
        if (isset($request->old_post_img) && $request->old_post_img != null) {
            $old_img = $request->old_post_img;
        }
        return  array_merge($old_img, $img);
    }
}
