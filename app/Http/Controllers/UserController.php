<?php

namespace App\Http\Controllers;


use App\Models\Address;
use App\Models\Bid;
use App\Models\Favorite;
use App\Models\Jober_profile;
use App\Models\PushNotification;
use App\Models\Session;
use App\Models\User;
use App\Models\Job;
use App\Models\User_pdf_resume;
use App\Models\User_profile;
use App\Models\User_web_resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mail;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get_user_id(){
        $user_id = Auth::user()->id;
        return $user_id;
    }

    public function index(){
        $user_id = $this->get_user_id();
        $bids = Bid::leftJoin('jobs','jobs.id','bids.job_id')->where('bids.user_id',$user_id)->take(3)->get();
        $myFavorites = Favorite::where('user_id',$user_id)->orderBy('created_at','DESC')->take(3)->get();
        return view('user.user_dashboard')->with(compact('bids','myFavorites'));
    }

    public function web_history_main(){
        $user_id = $this->get_user_id();
        $main = User_web_resume::where('user_id',$user_id)->first();

        return view('user.user_web_history_main')->with(compact('main'));
    }

    public function web_history_main_db(Request $request){
        $this->validate($request,[
            'user_postal_code' => 'required',
            'user_city' => 'required',
            'user_address' => 'required',
            'user_station' => 'required',
            'user_education' => 'required',
        ]);

        $user_id = $this->get_user_id();
        $main = User_web_resume::where('user_id',$user_id)->first();
        $main->user_basic_status = 1;
        $main->user_postal_code = $request->user_postal_code;
        $main->user_province = $request->user_province;
        $main->user_city = $request->user_city;
        $main->user_address = $request->user_address;
        $main->user_station = $request->user_station;
        $main->user_education = $request->user_education;
        $main->user_drive_license = $request->user_drive_license;
        $main->user_salary = $request->user_salary;
        $main->user_back_pain = $request->user_back_pain;
        $main->user_epilepsy = $request->user_epilepsy;
        $main->user_mental = $request->user_mental;
        $main->user_tattoos = $request->user_tattoos;
        $main->user_hurt = $request->user_hurt;
        $main->user_insomnia = $request->user_insomnia;
        $main->user_condition = $request->user_condition;
        $main->save();
        if($main !=  null){
            return redirect()->back()->with(session()->flash('alert-success','登録されました。'));
        }else{
            return redirect()->back()->with(session()->flash('alert-danger','エラーが発生しました。'));
        }
    }

    public function web_history_experience(){
        $user_id = $this->get_user_id();
        $main = User_web_resume::where('user_id',$user_id)->first();

        return view('user.user_web_history_experience')->with(compact('main'));
    }

    public function web_history_experience_db(Request $request){
        $this->validate($request,[
            'user_company_name' => 'required',
            'work_content' => 'required',
            'hired_style' => 'required',
            'level' => 'required',
            'work_name' => 'required',
        ]);

        $user_company_name = $request->user_company_name;

        $temp['from_year'] = $request->period_from_year;
        $temp['from_month'] = $request->period_from_month;
        $temp['to_year'] = $request->period_to_year;
        $temp['to_month'] = $request->period_to_month;
        $user_period = json_encode($temp);

        $work_name = $request->work_name;
        $work_from_year = $request->work_from_year;
        $work_from_month = $request->work_from_month;
        $work_to_year = $request->work_to_year;
        $work_to_month = $request->work_to_month;
        $hired_style = $request->hired_style;
        $level = $request->level;
        $work_content = $request->work_content;
        $user_company_history = [];

        for($i = 0; $i < count($work_name); $i++){
            $work_temp['name'] = $work_name[$i];
            $work_temp['work_from_year'] = $work_from_year[$i];
            $work_temp['work_from_month'] = $work_from_month[$i];
            $work_temp['work_to_year'] = $work_to_year[$i];
            $work_temp['work_to_month'] = $work_to_month[$i];
            $work_temp['hired_style'] = $hired_style[$i];
            $work_temp['level'] = $level[$i];
            $work_temp['work_content'] = $work_content[$i];
            $user_company_history[] = $work_temp;
        }
        $user_id = $this->get_user_id();
        $main = User_web_resume::where('user_id',$user_id)->first();
        $main->user_experience_status = 1;
        $main->user_company_name = $user_company_name;
        $main->user_period = $user_period;
        $main->user_company_history = $user_company_history;
        $main->save();
        if($main !=  null){
            return redirect()->back()->with(session()->flash('alert-success','登録されました。'));
        }else{
            return redirect()->back()->with(session()->flash('alert-danger','エラーが発生しました。'));
        }
    }

    public function web_history_qualification(){
        $user_id = $this->get_user_id();
        $main = User_web_resume::where('user_id',$user_id)->first();

        return view('user.user_web_history_qualification')->with(compact('main'));
    }

    public function web_history_qualification_db(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'year' => 'required',
            'month' => 'required',
        ]);

        $name = $request->name;
        $year = $request->year;
        $month = $request->month;
        $user_qualification1 = [];
        for($i = 0; $i < count($name); $i++ ){
            $temp['name'] = $name[$i];
            $temp['year'] = $year[$i];
            $temp['month'] = $month[$i];
            $user_qualification1[] = $temp;
        }
        $user_qualification2 = $request->qualification2;
        $user_id = $this->get_user_id();
        $main = User_web_resume::where('user_id',$user_id)->first();
        $main->user_qualification_status = 1;
        $main->user_qualification1 = json_encode($user_qualification1,JSON_UNESCAPED_UNICODE) ;
        $main->user_qualification2 = json_encode($user_qualification2,JSON_UNESCAPED_UNICODE);
        $main->save();
        if($main !=  null){
            return redirect()->back()->with(session()->flash('alert-success','登録されました。'));
        }else{
            return redirect()->back()->with(session()->flash('alert-danger','エラーが発生しました。'));
        }
    }

    public function web_history_skill(){
        $user_id = $this->get_user_id();
        $main = User_web_resume::where('user_id',$user_id)->first();
        return view('user.user_web_history_skill')->with(compact('main'));
    }

    public function web_history_skill_db(Request $request){
        $user_id = $this->get_user_id();
        $main = User_web_resume::where('user_id',$user_id)->first();
        $main->user_skill_status = 1;
        $main->user_skill_1 = $request->user_skill_1;
        $main->user_skill_2 = $request->user_skill_2;
        $main->user_skill_3 = $request->user_skill_3;
        $main->user_skill_4 = $request->user_skill_4;
        $main->user_skill_5 = $request->user_skill_5;
        $main->user_skill_6 = $request->user_skill_6;
        $main->user_skill_7 = $request->user_skill_7;
        $main->user_skill_8 = $request->user_skill_8;
        $main->user_skill_9 = $request->user_skill_9;
        $main->user_skill_10 = $request->user_skill_10;
        $main->user_skill_capable = json_encode($request->user_skill_capable,JSON_UNESCAPED_UNICODE);
        $main->user_business_capable = $request->user_business_capable;
        $main->save();
        if($main !=  null){
            return redirect()->back()->with(session()->flash('alert-success','登録されました。'));
        }else{
            return redirect()->back()->with(session()->flash('alert-danger','エラーが発生しました。'));
        }
    }

    public function web_history_aspect(){
        $user_id = $this->get_user_id();
        $main = User_web_resume::where('user_id',$user_id)->first();

        return view('user.user_web_history_aspect')->with(compact('main'));
    }

    public function web_history_aspect_db(Request $request){
        $user_id = $this->get_user_id();
        $main = User_web_resume::where('user_id',$user_id)->first();
        if($main != null){
            $main->user_history_status = 1;
            $main->user_history_1 = json_encode($request->user_history_1, JSON_UNESCAPED_UNICODE);
            $main->save();
            if($main !=  null){
                return redirect()->back()->with(session()->flash('alert-success','登録されました。'));
            }else{
                return redirect()->back()->with(session()->flash('alert-danger','エラーが発生しました。'));
            }
        }else{
            return redirect()->route('user.web_history_main');
        }
    }

    public function history_resume(){
        return view('user.user_history_resume');
    }

    public function resume_contact(){
        return view('user.user_pdf_contact');
    }

    public function pdf_mail(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'kana_name' => 'required',
            'email' => 'email|required',
            'pdf1' => 'required|mimetypes:application/pdf|max:100000',
            'pdf2' => 'required|mimetypes:application/pdf|max:100000',
        ]);

        $user_id = Auth::user()->id;

        $pdf1_name =time().'_'.$request->pdf1->getClientOriginalName();
        $request->pdf1->move(public_path('pdf/'),  $pdf1_name);

        $pdf2_name =time().'_'.$request->pdf2->getClientOriginalName();
        $request->pdf2->move(public_path('pdf/'),  $pdf2_name);

        $data = [
            'name' => $request->name,
            'kana_name' => $request->kana_name,
            'email' => $request->email,
            'pdf1' => $pdf1_name,
            'pdf2' => $pdf2_name,
        ];
        $result = User_pdf_resume::where('user_id',$user_id)->first();
        if($result != null){
            $result->pdf1_url = $pdf1_name;
            $result->pdf2_url = $pdf2_name;
            $result->save();
        }else{
            $user_pdf = new User_pdf_resume();
            $user_pdf->user_id =  $user_id;
            $user_pdf->pdf1_url = $pdf1_name;
            $user_pdf->pdf2_url = $pdf2_name;
            $user_pdf->save();
        }

        if(($user_pdf != null) || ($result != null)){
            Mail::send('mail.pdf_mail', $data, function($message)use($data) {
                $message->to(env('ADMIN_EMAIL'),env('ADMIN_EMAIL'))
                    ->from(env('MAIL_USERNAME'),'ハコボウズ事務局')
                    ->subject("履歴書・職務経歴書の送付")
                    ->attach(
                        public_path('pdf/').$data['pdf1'],[
                            "as" => "履歴書.pdf",
                            "mime" => "application/pdf",
                        ])
                    ->attach(
                        public_path('pdf/').$data['pdf2'], [
                            "as" => "職務経歴書.pdf",
                            "mime" => "application/pdf",
                        ]);
            });
            return redirect()->back()->with(session()->flash('alert-success','メール送信完了しました。'));
        }else{
            return redirect()->back()->with(session()->flash('alert-danger','メール送信失敗しました。'));
        }

    }

    public function user_profile(){
        $user_id = $this->get_user_id();
        $profile = User_profile::where('user_id', $user_id)->first();
        if (isset($profile->city_id)) {
            $address = Address::where('city_id', $profile->city_id)->first();
        } else {
            $address = Address::select('ken_id','ken_name')->where('ken_id', $profile->ken_id)->first();
        }
        return view('user.user_profile')->with(compact('profile', 'address'));
    }

    public function user_profile_update(){
        $user_id = $this->get_user_id();
        $profile = User_profile::where('user_id', $user_id)->first();
        $prefecture = Address::select('ken_id','ken_name')->where('addresses.delete_flg',0)->groupBy('ken_id','ken_name')->orderBy('ken_id')->get();
        return view('user.user_profile_update')->with(compact('profile', 'prefecture'));
    }

    public function user_profile_update_db(Request $request){
        $user_id = $this->get_user_id();
        $profile = User_profile::where('user_id',$user_id)->first();
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
        $profile->car = $request->car;
        $profile->experience = $request->experience;
        $profile->save();
        if($profile !=  null){
            return redirect()->back()->with(session()->flash('alert-success','変更されました。'));
        }else{
            return redirect()->back()->with(session()->flash('alert-danger','エラーが発生しました。'));
        }
    }

    public function user_password_update(){
        return view('user.user_password_update');
    }

    public function user_password_update_db(Request $request){
        $this->validate($request,[
            'new_password' => 'required',
            'new_confirm_password' => 'same:new_password',
        ]);

        $password = Hash::make($request->new_password);
        $user_id = $this->get_user_id();
        $user = User::where('id', $user_id)->first();
        $user->password = $password;
        $user->save();

        if($user !=  null){
            return redirect()->back()->with(session()->flash('alert-success','変更されました。'));
        }else{
            return redirect()->back()->with(session()->flash('alert-danger','エラーが発生しました。'));
        }
    }

    public function message_page(Request $request){
        $session_id = $request->session_id;
        $receive = $request->jober_id;
        $job_id = $request->job_id;
        return view('user.user_send_message')->with(compact('receive','job_id','session_id'));
    }

    public function favoriteJob(Job $job){
        Auth::user()->favorites()->attach($job->id);
        return back();
    }

    public function unFavoriteJob(Job $job){
        Auth::user()->favorites()->detach($job->id);
        return back();
    }

    public function myFavorites(){
        $myFavorites = Auth::user()->favorites;
        return view('user.user_favorites', compact('myFavorites'));
    }

    public function remove_favorite($job_id){
        $user_id = Auth::user()->id;
        $favorite = Favorite::where('user_id',$user_id)->where('job_id',$job_id)->delete();
        if($favorite != null){
            return redirect()->back();
        }
    }

    public function bid_list(){
        $user_id = Auth::user()->id;
        $bids = Bid::leftJoin('jobs','jobs.id','bids.job_id')->where('bids.user_id',$user_id)->orderBy('bids.updated_at','DESC')->get();
        return view('user.user_bid_list')->with(compact('bids'));
    }

    public function bid_content($job_id){
        $job = Job::where('id',$job_id)->first();
        $jober = Jober_profile::where('jober_id',$job['jober_id'])->first();
        return view('user.user_bid_content')->with(compact('jober','job'));

    }

    public function bid_post(Request $request){
        
        $user_id = Auth::user()->id;
        $job_id = $request->job_id;
        $jober_id = $request->jober_id;
        $bid_content = $request->bid_content;

        $job_title = Job::where('id',$job_id)->first()->post_title;
        $user = User::where('id',$user_id)->first();
        $jober= Jober_profile::where('jober_id',$jober_id)->first();

        $user_name = $user->name;
        $user_email = $user->email;
        $jober_name = $jober->company_name;
        $jober_email = $jober->company_email;
        if ($jober_email === null) {
            $jober_email = User::where('id',$jober->jober_id)->first()->email;
        }
        $old_bid = Bid::where('user_id',$user_id)->where('job_id', $job_id)->first();

        if($old_bid != null){
            return redirect()->route('user.bid_list');
        }else{
            $bid = new Bid();

            $bid->job_id = $job_id;
            $bid->user_id = $user_id;
            $bid->jober_id = $jober_id;
            $bid->bid_content = $bid_content;
            $bid->save();

            if($bid != null){
                $push = new PushNotification();
                $push->receiver = $jober_id;
                $push->sender = $user_id;
                $push->job_id = $job_id;
                $push->type = 1;
                $push->status = 0;
                $push->save();
                $data['job_id'] = $job_id;
                $data['job_title'] = $job_title;
                $data['user_email'] = $user_email;
                $data['jober_email'] = $jober_email;
                $data['user_name'] = $user_name;
                $data['jober_name'] = $jober_name;
                MailController::sendBidMail($data);
                return view('user.user_bid_end');
            }
        }
    }
    

    public function account_delete(){
        $user_id = $this->get_user_id();
        $result_favorite = Favorite::where('user_id',$user_id)->delete();
        $result_profile = User_profile::where('user_id',$user_id)->delete();
        $result_session_1 = Session::where('user1_id',$user_id)->delete();
        $result_session_2 = Session::where('user2_id',$user_id)->delete();
        $result_resume = User_web_resume::where('user_id',$user_id)->delete();
        $result_user = User::destroy($user_id);
        return redirect()->route('home');
    }
}
