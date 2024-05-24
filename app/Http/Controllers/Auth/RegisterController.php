<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;
use App\Models\User_profile;
use App\Models\User_web_resume;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'zip' => ['required'],
            'ken_id' => ['required'],
            'city_id' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'sei' => ['required', 'string', 'max:255'],
            'mei' => ['required', 'string', 'max:255'],
            'phone' =>['required', 'string', 'max:12'],
            'auto_login' =>['required'],
            'agree' =>['required'],
//            'g-recaptcha-response' => ['required','recaptchav3:register'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function register(Request $request){
        $this->validator($request->all())->validate();

        $last_name = $request->last_name;
        $first_name = $request->first_name;
        $name = $last_name.$first_name;
        $birthday = $request->birth_year.'-'.$request->birth_month.'-'.$request->birth_day;
        $sex = $request->sex;
        $zip = $request->zip;
        $ken_id = $request->ken_id;
        $city_id = $request->city_id;
        $experience = $request->experience;
        $car = $request->car;
        $last_name_kana = $request->sei;
        $first_name_kana = $request->mei;
        $phone = $request->phone;
        $email_receive = $request->input('email_receive') === 'on' ? 1 : 0;

        $user = new User();
        $user->name = $name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->verification_code = sha1(time());
        $user->save();
        if ($user != null){
            //creating profile,sending email, show message
            $profile = new User_profile();
            $profile->user_id = $user->id;
            $profile->last_name = $last_name;
            $profile->first_name = $first_name;
            $profile->last_name_kana = $last_name_kana;
            $profile->first_name_kana = $first_name_kana;
            $profile->birthday = $birthday;
            $profile->sex = $sex;
            $profile->zip = $zip;
            $profile->ken_id = $ken_id;
            $profile->city_id = $city_id;
            $profile->car = $car;
            $profile->experience = $experience;
            $profile->email_receive = $email_receive;
            $profile->phone = $phone;
            $profile->save();
            $user_history = new User_web_resume();
            $user_history->user_id = $user->id;
            $user_history->save();

            if($user_history != null){
                MailController::sendRegisterEmail($user->name, $user->email, $user->verification_code);
                return redirect()->back()->with(session()->flash('alert-success','仮登録完了しました。<br>
                登録されたメールアドレスに認証リンクをお送りしました。<br>
                                            確認後、登録を完了してください。'));
            }

        }else{
            //show error message
            return redirect()->back()->with(session()->flash('alert-danger','エラーが発生しました。再登録してください。'));
        }

    }

    public function verifyUser(){
        $verification_code = \Illuminate\Support\Facades\Request::get('code');
        $user = User::where(['verification_code' => $verification_code])->first();
        if($user != null){
            $user->is_verified = 1;
            $user->save();

            return redirect()->route('login')->with(session()->flash('alert-success','メール認証が完了しました。ログインページでログインをお願いいたします。'));
        }
        return redirect()->route('login')->with(session()->flash('alert-danger','認証コードが正しくありません。'));
    }
}
