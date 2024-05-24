<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Benefit;
use App\Models\Bid;
use App\Models\Job;
use App\Models\Job_pr;
use App\Models\Job_working_place;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\User_profile;
use App\Models\Notification;
use App\Models\Article;
use App\Models\Jober_profile;
use App\Models\Job_kind;
use App\Models\Area;
use App\Models\Special;

class AdminController extends Controller
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
        $jobs = Job::where('post_status', 1)->get();
        $jobers = User::where('user_type', 2)->get();
        $users = User::where('user_type', 3)->get();
        return view('admin.admin_dashboard')->with(compact('jobs', 'jobers', 'users'));
    }

    public function admin_password()
    {
        return view('admin.admin_password');
    }

    public function admin_password_update(Request $request)
    {
        $this->validate($request, [
            'password' => 'required',
            'confirm_password' => 'required|string|same:password|min:8',
        ]);
        $admin_id = Auth::user()->id;
        $p = $request->password;
        $cp = $request->confirm_password;
        if ($p == $cp) {
            $password = Hash::make($request->password);
            $user = User::where('id', $admin_id)->update(array('password' => $password));
            if ($user != null) {
                return redirect()->back()->with(session()->flash('alert-success', 'パスワードが変更されました。'));
            } else {
                return redirect()->back()->with(session()->flash('alert-danger', 'パスワードが変更されません。'));
            }
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'パスワードが正しくありません。'));
        }
    }

    public function user_add()
    {
        return view('admin.admin_user_add');
    }
    public function user_add_db(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->is_verified = 1;
        $user->user_type = 3;
        $user->save();
        if ($user != null) {
            $user_profile = new User_profile();
            $user_profile->user_id = $user->id;
            $user_profile->save();
            return redirect()->back()->with(session()->flash('alert-success', '追加されました。'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'バグ発生しました。'));
        }
    }

    public function user_list()
    {
        $users = User::where('user_type', 3)->get();
        return view('admin.admin_user_list')->with(compact('users'));
    }

    public function get_user_profile($id)
    {
        $user_id = $id;
        $profile = User_profile::where('user_id', $user_id)->first();
        $prefecture = Address::select('ken_id', 'ken_name')->where('addresses.delete_flg', 0)->groupBy('ken_id', 'ken_name')->orderBy('ken_id')->get();
        return view('admin.admin_user_profile')->with(compact('profile', 'user_id', 'prefecture'));
    }

    public function user_profile_update(Request $request)
    {
        $user_id = $request->user_id;
        $profile = User_profile::where('user_id', $user_id)->first();
        $profile->last_name = $request->last_name;
        $profile->first_name = $request->first_name;
        $profile->last_name_kana = $request->last_name_kana;
        $profile->first_name_kana = $request->first_name_kana;
        $profile->phone = $request->phone;
        $profile->birthday = $request->birthday;
        $profile->sex = $request->sex;
        $profile->zip = $request->zip;
        $profile->ken_id = $request->ken_id;
        $profile->city_id = $request->city_id;
        $profile->email_receive = $request->email_receive;
        $profile->save();
        if ($profile !=  null) {
            return redirect()->back()->with(session()->flash('alert-success', '変更されました。'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'エラーが発生しました。'));
        }
    }

    public function user_password($id)
    {
        $user_name = User::where('id', $id)->first()->name;
        return view('admin.admin_user_password')->with(compact('id', 'user_name'));
    }

    public function user_password_update(Request $request)
    {
        $id = $request->id;
        $p = $request->password;
        $cp = $request->confirm_password;
        if ($p == $cp) {
            $password = Hash::make($request->password);
            $user = User::where('id', $id)->update(array('password' => $password));
            if ($user != null) {
                return redirect()->back()->with(session()->flash('alert-success', 'パスワードが変更されました。'));
            } else {
                return redirect()->back()->with(session()->flash('alert-danger', 'パスワードが変更されません。'));
            }
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'パスワードが正しくありません。'));
        }
    }

    public function user_delete($id)
    {
        $result = User::destroy($id);
        if ($result != null) {
            return redirect()->back();
        }
    }

    public function enterprise_add()
    {
        return view('admin.admin_enterprise_add');
    }

    public function enterprise_list()
    {
        $enterprises = User::where('user_type', 2)->get();
        $isDsp = false;
        return view('admin.admin_enterprise_list')->with(compact('enterprises', 'isDsp'));
    }

    public function dsp_enterprise_list()
    {
        $enterprises = User::select('users.*')->leftJoin('jober_profiles', 'users.id', 'jober_profiles.jober_id')
            ->where('users.user_type', 2)
            ->where('jober_profiles.is_dsp', 1)
            ->get();
        $isDsp = true;
        // dd($enterprises);
        return view('admin.admin_enterprise_list')->with(compact('enterprises', 'isDsp'));
    }

    public function enterprise_profile($id)
    {
        $jober_id = $id;
        $profile = Jober_profile::where('jober_id', $jober_id)->first();
        return view('admin.admin_enterprise_profile')->with(compact('jober_id', 'profile'));
    }

    public function enterprise_profile_update(Request $request)
    {
        $jober_id = $request->jober_id;
        $this->validate($request, [
            'company_name' => 'required',
        ]);

        if ($request->hasfile('new_company_img')) {
            $name = time() . '-' . $request->file('new_company_img')->getClientOriginalName();
            $request->file('new_company_img')->move(public_path() . '/images/jober_profile/', $name);
            $company_img = $name;
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
        $profile->company_fax = $request->company_fax;
        $profile->company_email = $request->company_email;
        $profile->company_url = $request->company_url;
        $profile->company_img = $company_img;
        $profile->company_business_content = $request->company_business_content;
        $profile->company_establish_date = $request->company_establish_date;
        $profile->company_employee = $request->company_employee;
        $profile->is_dsp = $request->is_dsp;

        $profile->save();
        if ($profile != null) {
            return redirect()->back()->with(session()->flash('alert-success', '新規求人情報登録されました。'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'エラーが発生しました。'));
        }
    }

    public function enterprise_job_list($id)
    {
        $public_jobs = Job::where('post_status', 1)->where('jober_id', $id)->get();
        $non_public_jobs = Job::where('post_status', 0)->where('jober_id', $id)->get();
        $close_jobs = Job::where('post_status', 2)->where('jober_id', $id)->get();
        return view('admin.admin_enterprise_job_list')->with(compact('public_jobs', 'non_public_jobs', 'close_jobs'));
    }


    public function job_register($id)
    {
        $jober_id = $id;
        $jobs = Job::where('jober_id', $jober_id)->whereIn('post_status', [0, 1, 2])->orderBy('updated_at', 'DESC')->get();
        $category =  Job_kind::all();
        $receptions = Benefit::where('category', 1)->where('is_delete', 0)->get();
        $treatments = Benefit::where('category', 2)->where('is_delete', 0)->get();
        $working_times = Benefit::where('category', 3)->where('is_delete', 0)->get();
        $prefecture = Address::select('ken_id', 'ken_name')->where('addresses.delete_flg', 0)->groupBy('ken_id', 'ken_name')->orderBy('ken_id')->get();

        return view('admin.admin_job_register')->with(compact('jober_id', 'category', 'prefecture', 'receptions', 'treatments', 'jobs', 'working_times'));
    }
    public function job_register_db(Request $request)
    {
        $this->validate($request, [
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
        $jober_id = $request->jober_id;
        $post_expired = \Carbon\Carbon::now()->addDay(7)->format('Y-m-d');
        $job = new Job();
        $this->saveJob($job, $request, $img, $jober_id, $post_expired);
        if ($job != null) {
            $this->save_pr_type($request, $job->id);
            $this->save_job_working_place($request, $job->jober_id, $job->id);
        }
        if ($job != null) {
            return redirect()->back()->with(session()->flash('alert-success', '新規求人情報登録されました。'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'エラーが発生しました。'));
        }
    }

    public function job_detail($id)
    {
        $job = Job::where('id', $id)->first();
        $jober_id = $job->jober_id;
        $job_prs = Job_pr::where('job_id', $job->id)->get();
        $view = $job->view + 1;
        Job::where('id', $id)->update(array('view' => $view));
        $working_place = Job_working_place::leftJoin('jobs', 'jobs.id', 'job_working_places.job_id')
            ->where('jobs.id', $job->id)
            ->get();
        $working_places = [];
        foreach ($working_place as $key => $place) {
            $working_places[$key]['area_name'] = $place->ken_name . $place->city_name;
            $working_places[$key]['area_id'] = $place->city_id ?? $place->ken_id;
            $job->working_place = $working_places;
        }
        $bids = Bid::where('job_id', $id)->get();
        return view('admin.admin_job_detail')->with(compact('job', 'bids', 'job_prs', 'working_place'));
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
        return view('admin.admin_job_update')->with(compact('job', 'category', 'prefecture', 'job_id', 'job_working_place', 'receptions', 'treatments', 'job_pr', 'working_times'));
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
            return redirect()->back()->with(session()->flash('alert-success', '登録情報が編集されました。'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'エラーが発生しました。'));
        }
    }

    public function job_delete($id)
    {
        $job = Job::where('id', $id)->first();
        $job->post_status = 3;
        $job->save();
        if ($job != null) {
            return redirect()->back();
        }
    }

    public function enterprise_hire_list($jober_id)
    {
        $hires = Bid::where('jober_id', $jober_id)->where('hired_status', 1)->get();
        $old_hires = Bid::where('jober_id', $jober_id)->where('hired_status', 2)->get();
        return view('admin.admin_enterprise_hire_list')->with(compact('hires', 'jober_id', 'old_hires'));
    }

    public function enterprise_add_db(Request $request)
    {
        $this->validate($request, [
            'store_name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $user = new User();
        $user->name = $request->store_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->is_verified = 1;
        $user->user_type = 2;
        $user->save();
        if ($user != null) {
            $jober_profile = new Jober_profile();
            $jober_profile->jober_id = $user->id;
            $jober_profile->save();
            return redirect()->back()->with(session()->flash('alert-success', '追加されました。'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'バグ発生しました。'));
        }
    }

    public function public_job_list()
    {
        $public_jobs = Job::where('post_status', 1)->get();
        return view('admin.admin_public_job_list')->with(compact('public_jobs'));
    }

    public function old_job_list()
    {
        $old_jobs = Job::where('post_status', 2)->get();
        return view('admin.admin_old_job_list')->with(compact('old_jobs'));
    }

    public  function featured_job_list()
    {
        $public_jobs = Job::where('post_status', 1)->get();
        $feature_ids = [];
        $featured_jobs = Job::where('feature_job', 1)->get();
        foreach ($featured_jobs as $item) {
            $feature_ids[] = $item['id'];
        }
        return view('admin.admin_featured_job_setting')->with(compact('public_jobs', 'feature_ids'));
    }

    public function featured_job_setting(Request $request)
    {
        $featured_ids = explode(',', $request->featured_id[0]);
        $all_job = Job::where('post_status', 1)->get();

        // 全ての仕事を非フィーチャーに設定
        foreach ($all_job as $job) {
            $job->feature_job = 0;
            $job->save();
        }
        // チェックされた仕事だけをフィーチャーに設定
        if ($featured_ids != null) {
            foreach ($featured_ids as $featured_id) {
                $job = Job::find($featured_id);
                if ($job) {
                    $job->feature_job = 1;
                    $job->save();
                }
            }
            return redirect()->back()->with(session()->flash('alert-success', '追加されました。'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'バグ発生しました。'));
        }
    }

    public function article_setting()
    {
        return view('admin.admin_article_setting');
    }

    public function article_imageUpload(Request $request)
    {
        if ($request->ajax()) {
            $image_data = $request->image;
            $image_array_1 = explode(";", $image_data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $imageName = time() . '_thumbnail.png';
            $upload_path = public_path('images/blogs/' . $imageName);
            file_put_contents($upload_path, $data);
            return $imageName;
        }
    }

    public function article_add(Request $request)
    {
        $this->validate($request, [
            'article_title' => 'required',
            'article_content' => 'required',
        ]);

        $article_title = $request->article_title;
        $article_content = $request->article_content;
        $media_url = $request->imagePath;

        $article = new Article();
        $article->article_title = $article_title;
        $article->article_content = $article_content;
        $article->media_url = $media_url;
        $article->save();

        if ($article != null) {
            return redirect()->back()->with(session()->flash('alert-success', '追加されました。'));
        }
    }

    public function article_list()
    {
        $article_list = Article::all();
        return view('admin.admin_article_list')->with(compact('article_list'));
    }

    public function article_update($id)
    {
        $article_detail = Article::where('id', $id)->get();
        return view('admin.admin_article_update')->with(compact('article_detail'));
    }

    public function article_update_db(Request $request)
    {
        $article_id = $request->article_id;
        $article_title = $request->article_title;
        $article_content = $request->article_content;
        $article_img = $request->imagePath;

        $article = Article::where('id', $article_id)->first();
        $article->article_title = $article_title;
        $article->article_content = $article_content;
        $article->media_url = $article_img;
        $article->save();

        if ($article != null) {
            return redirect()->back()->with(session()->flash('alert-success', '追加されました。'));
        }
    }

    public function article_delete($id)
    {
        $article_id = $id;
        $result = Article::destroy($article_id);
        if ($result != null) {
            return redirect()->back();
        }
    }


    public function notification_add()
    {
        return view('admin.admin_notification_add');
    }

    public function notification_add_db(Request $request)
    {
        $title = $request->n_title;
        $content = $request->n_content;
        $media_url = $request->media_url;
        $notification = new Notification();
        $notification->notification_title = $title;
        $notification->notification_content = $content;
        $notification->media_url = $media_url;
        $notification->save();
        if ($notification != null) {
            return redirect()->back()->with(session()->flash('alert-success', '追加されました。'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'バグ発生しました。'));
        }
    }
    public function notification_list()
    {
        $notifications = Notification::all();
        return view('admin.admin_notification_list')->with(compact('notifications'));
    }

    public function notification_delete($id)
    {
        $notification_id  = $id;
        $result = Notification::destroy($notification_id);
        if ($result != null) {
            return redirect()->back();
        }
    }

    public function category_list()
    {
        $category_list = Job_kind::all();
        return view('admin.admin_category_list')->with(compact('category_list'));
    }

    public function category_add()
    {
        return view('admin.admin_category_add');
    }

    public function category_add_db(Request $request)
    {
        $kind_name = $request->kind_name;
        $job_kind = new Job_kind();
        $job_kind->kind_name = $kind_name;
        $job_kind->save();
        if ($job_kind != null) {
            return redirect()->back()->with(session()->flash('alert-success', '追加されました。'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'バグ発生しました。'));
        }
    }

    public function category_update($id)
    {
        $category = Job_kind::where('id', $id)->first();
        return view('admin.admin_category_update')->with(compact('category', 'id'));
    }

    public function category_update_db(Request $request)
    {
        $kind_id = $request->kind_id;
        $kind_name = $request->kind_name;
        $job_kind = Job_kind::where('id', $kind_id)->first();
        $job_kind->kind_name = $kind_name;
        $job_kind->save();
        if ($job_kind != null) {
            return redirect()->back()->with(session()->flash('alert-success', '追加されました。'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'バグ発生しました。'));
        }
    }

    public function category_delete($id)
    {
        $kind_id = $id;
        $result = Job_kind::destroy($kind_id);
        if ($result != null) {
            return redirect()->back();
        }
    }

    public function area_list()
    {
        $areas = Area::all();
        return view('admin.admin_area_list')->with(compact('areas'));
    }

    public function area_add()
    {
        return view('admin.admin_area_add');
    }

    public function area_add_db(Request $request)
    {
        $this->validate($request, [
            'area_name' => 'required',
        ]);

        $area_name = $request->area_name;
        $area = new Area();
        $area->area_name = $area_name;
        $area->save();
        if ($area != null) {
            return redirect()->back()->with(session()->flash('alert-success', '追加されました。'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'バグ発生しました。'));
        }
    }

    public function area_update($id)
    {
        $area_id = $id;
        $area = Area::where('id', $area_id)->first();
        return view('admin.admin_area_update')->with(compact('area', 'area_id'));
    }

    public function area_update_db(Request $request)
    {
        $area_id = $request->area_id;
        $area_name = $request->area_name;
        $area = Area::where('id', $area_id)->first();
        $area->area_name = $area_name;
        $area->save();
        if ($area != null) {
            return redirect()->back()->with(session()->flash('alert-success', '保存されました。'));
        } else {
            return redirect()->back()->with(session()->flash('alert-danger', 'バグ発生しました。'));
        }
    }

    public function area_delete($id)
    {
        $area_id = $id;
        $result = Area::destroy($area_id);
        if ($result != null) {
            return redirect()->back();
        }
    }

    public function special_imageUpload(Request $request)
    {
        if ($request->ajax()) {
            $image_data = $request->image;
            $image_array_1 = explode(";", $image_data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $imageName = time() . '_special.png';
            $upload_path = public_path('images/special/' . $imageName);
            file_put_contents($upload_path, $data);
            return $imageName;
        }
    }

    public function special_add()
    {
        $areas = Area::all();
        $categories = Job_kind::all();
        return view('admin.admin_special_job_add')->with(compact('areas', 'categories'));
    }

    public function special_add_db(Request $request)
    {
        $this->validate($request, [
            'special_title' => 'required',
            'special_content' => 'required',
        ]);

        $special_title = $request->special_title;
        $special_content = $request->special_content;
        $special_img = $request->imagePath;

        $special = new Special();
        $special->special_title = $special_title;
        $special->special_content = $special_content;
        $special->special_img = $special_img;
        $special->special_area = $request->special_area;
        $special->special_category = $request->special_category;
        $special->save();
        if ($special != null) {
            return redirect()->back()->with(session()->flash('alert-success', '追加されました。'));
        }
    }

    public function special_list()
    {
        $special_list = Special::all();
        return view('admin.admin_special_job_list')->with(compact('special_list'));
    }

    public function special_update($id)
    {
        $areas = Area::all();
        $categories = Job_kind::all();
        $special_detail = Special::where('id', $id)->first();
        return view('admin.admin_special_job_update')->with(compact('special_detail', 'areas', 'categories'));
    }

    public function special_update_db(Request $request)
    {
        $special_id = $request->special_id;
        $special_title = $request->special_title;
        $special_content = $request->special_content;
        $special_img = $request->imagePath;

        $special = Special::where('id', $special_id)->first();
        $special->special_title = $special_title;
        $special->special_content = $special_content;
        $special->special_img = $special_img;
        $special->special_area = $request->special_area;
        $special->special_category = $request->special_category;
        $special->save();

        if ($special != null) {
            return redirect()->back()->with(session()->flash('alert-success', '追加されました。'));
        }
    }

    public function special_delete($id)
    {
        $special_id = $id;
        $result = Special::destroy($special_id);
        if ($result != null) {
            return redirect()->back();
        }
    }

    public function impersonate(Request $request)
    {
        $user_to_impersonate = User::where('email', $request->user_id)->where('is_verified', '1')->first();
        if ($user_to_impersonate) {
            Auth::login($user_to_impersonate);
            if ($user_to_impersonate['user_type'] === 2) {
                return redirect('/jober/dashboard');
            } else {
                return redirect('/user/dashboard');
            }
        } else {
            return redirect('/login')->withErrors(['message' => 'User ID to impersonate not found.']);
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
        if ($request->post_status !== '') {
            $job->post_status = $request->post_status;
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
        foreach ($request->prefecture as $key => $value) {
            if ($value !== null) {
                $job_working_place = new Job_working_place();
                $job_working_place->jober_id = $jober_id;
                $job_working_place->job_id = $job_id;
                $job_working_place->ken_id = $request->prefecture[$key];
                $job_working_place->city_id = $request->city[$key];
                $ken = Address::select('ken_id', 'ken_name')
                    ->where('ken_id', $request->prefecture[$key])
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
