<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Bid;
use App\Models\Article;
use App\Models\Job;
use App\Models\Job_kind;
use App\Models\Job_pr;
use App\Models\Job_working_place;
use App\Models\PushNotification;
use App\Models\Jober_profile;
use App\Models\Notification;
use App\Models\Special;
use App\Models\User;
use App\Models\User_profile;
use App\Models\User_web_resume;
use App\Models\InterviewTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Goutte\Client;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpClient\HttpClient;
use Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    private $wp_articles = array();

    public function index()
    {
        $prefecture = Address::select('ken_id', 'ken_name')->groupBy('ken_id', 'ken_name')->orderBy('ken_id')->get();
        $categories = Job_kind::all();
        $notifications = Notification::orderBy('created_at', 'DESC')->take(2)->get();
        $featured_jobs = Job::where('feature_job', 1)->where('post_status', 1)->take(6)->get();
        $new_jobs = Job::where('post_status', 1)->orderBy('created_at', 'DESC')->take(4)->get();

        $working_place = $this->get_working_place();
        foreach ($featured_jobs as $job) {
            $working_places = [];
            foreach ($working_place as $key => $place) {
                if ($job->id === $place->job_id) {
                    $working_places[$key]['area_name'] = $place->ken_name . $place->city_name;
                    $working_places[$key]['area_id'] = $place->city_id ?? $place->ken_id;
                    $job->working_place = $working_places;
                }
            }
        }
        foreach ($new_jobs as $job) {
            $working_places = [];
            foreach ($working_place as $key => $place) {
                if ($job->id === $place->job_id) {
                    $working_places[$key]['area_name'] = $place->ken_name . $place->city_name;
                    $working_places[$key]['area_id'] = $place->city_id ?? $place->ken_id;
                    $job->working_place = $working_places;
                }
            }
        }
        // 関東の求人情報取得（city_groupごと）
        $ken_group = Job_working_place::select('addresses.ken_group_id', 'addresses.ken_id')
            ->leftJoin('addresses', 'job_working_places.ken_id', 'addresses.ken_id')
            ->where('addresses.delete_flg', 0)
            ->groupBy('addresses.ken_group_id', 'addresses.ken_id')
            ->get();

        $articles = Article::orderBy('created_at', 'DESC')->take(6)->get();
        $specials = Special::orderBy('created_at', 'DESC')->take(6)->get();

        $client = new Client(HttpClient::create(['timeout' => 60]));
        $crawler = $client->request('GET', 'https://hakobozu.com/articles/new-post/');
        if ($crawler != null) {
            $crawler->filter('.p-postList__item')->each(function ($node) {
                $temp['title'] = $node->filter('.p-postList__title')->text();
                $temp['link'] = $node->filter('.p-postList__link')->attr('href');
                $temp['img'] = $node->filter('img')->attr('data-src');
                $temp['content'] = $node->filter('.p-postList__excerpt')->text();
                $this->wp_articles[] = $temp;
            });
        }

        $wp_blogs = $this->wp_articles;
        $structuredDataFaq = true;
        return view('front.index')->with(compact('articles', 'wp_blogs', 'new_jobs', 'featured_jobs', 'notifications', 'prefecture', 'categories', 'specials', 'structuredDataFaq'));
    }

    public function search(Request $request)
    {
        $prefecture = Address::select('ken_id', 'ken_name')->groupBy('ken_id', 'ken_name')->orderBy('ken_id')->get();
        $ken_search = Address::select('ken_id', 'ken_name')->where('ken_id', $request->prefecture)->first();
        $categories = Job_kind::all();
        $category_search_list = $request->category;
        $jobSelector = [
            'jobs.id',
            'jobs.jober_id',
            'jobs.post_img',
            'post_title',
            'post_category',
            'jobs.updated_at',
            'post_other',
            'post_benefit',
            'post_payment_text',
            'post_is_payment_more',
            'post_payment_max_text',
            'post_payment',
            'post_working_time',
            'jober_profiles.company_img',
            'jober_profiles.company_name'
        ];
        $jobs = Job::select($jobSelector)
            ->leftJoin('job_working_places', 'jobs.id', 'job_working_places.job_id')
            ->leftJoin('jober_profiles', 'jobs.jober_id', 'jober_profiles.jober_id')
            ->when($request->prefecture, function ($query) use ($request) {
                $query->where('job_working_places.ken_id', $request->prefecture);
            })
            ->when($category_search_list, function ($query) use ($category_search_list) {
                $query->where('post_category', 'like', '%' . $category_search_list . '%');
            })
            ->where('post_status', 1)
            ->orderBy('jobs.created_at', 'DESC')
            ->groupBy('jobs.id')
            ->groupBy('jober_profiles.company_img')
            ->groupBy('jober_profiles.company_name')
            ->paginate(15)
            ->appends(request()->input());
        $working_place = $this->get_working_place();
        $displayDaysAgo = '';
        foreach ($jobs as $job) {
            $updatedAt = Carbon::parse($job->updated_at);
            // 現在の日時との差を計算
            $diff = $updatedAt->diff(Carbon::now());
            // 差が24時間以上の場合は日数を表示、そうでなければ時間を表示
            if ($diff->days >= 1) {
                $daysAgo = $diff->days;
                $job->displayDaysAgo = '約' . $daysAgo . '日前に更新';
            } else {
                $hoursAgo = $diff->h;
                $job->displayDaysAgo = '約' . $hoursAgo . '時間前に更新';
            }

            $working_places = [];
            foreach ($working_place as $key => $place) {
                if ($job->id === $place->job_id) {
                    $working_places[$key]['area_name'] = $place->ken_name . $place->city_name;
                    $working_places[$key]['area_id'] = $place->city_id ?? $place->ken_id;
                    $job->working_place = $working_places;
                }
            }
        }
        return view('front.search_result')->with(compact('jobs', 'prefecture', 'categories', 'category_search_list', 'ken_search'));
    }

    public function keyword_search(Request $request)
    {
        $keyword = $request->keyword;
        $prefecture = Address::select('ken_id', 'ken_name')->groupBy('ken_id', 'ken_name')->orderBy('ken_id')->get();
        $categories = Job_kind::all();
        $jobSelector = [
            'jobs.id',
            'jobs.post_img',
            'post_title',
            'post_category',
            'jobs.updated_at',
            'post_other',
            'post_benefit',
            'post_payment_text',
            'post_is_payment_more',
            'post_payment_max_text',
            'post_payment',
            'post_working_time',
        ];
        $jobs = Job::select($jobSelector)
            ->leftJoin('job_working_places', 'jobs.id', 'job_working_places.job_id')
            ->leftJoin('job_pr', 'jobs.id', 'job_pr.job_id')
            ->leftJoin('jober_profiles', 'jobs.jober_id', 'jober_profiles.jober_id')
            ->where(function ($query) use ($keyword) {
                $query->where('post_title', 'like', '%' . $keyword . '%')
                    ->orWhere('post_other', 'like', '%' . $keyword . '%')
                    ->orWhere('post_suitable', 'like', '%' . $keyword . '%')
                    ->orWhere('post_require', 'like', '%' . $keyword . '%')
                    ->orWhere('post_payment_text', 'like', '%' . $keyword . '%')
                    ->orWhere('post_payment_max_text', 'like', '%' . $keyword . '%')
                    ->orWhere('post_revenue', 'like', '%' . $keyword . '%')
                    ->orWhere('post_payment', 'like', '%' . $keyword . '%')
                    ->orWhere('post_rental_car', 'like', '%' . $keyword . '%')
                    ->orWhere('post_working_time', 'like', '%' . $keyword . '%')
                    ->orWhere('post_selection', 'like', '%' . $keyword . '%')
                    ->orWhere('job_working_places.ken_name', 'like', '%' . $keyword . '%')
                    ->orWhere('job_working_places.city_name', 'like', '%' . $keyword . '%')
                    ->orWhere('job_pr.post_pr_title', 'like', '%' . $keyword . '%')
                    ->orWhere('job_pr.post_pr_text', 'like', '%' . $keyword . '%')
                    ->orWhere('jober_profiles.company_name', 'like', '%' . $keyword . '%')
                    ->orWhere('jober_profiles.company_province', 'like', '%' . $keyword . '%')
                    ->orWhere('jober_profiles.company_address', 'like', '%' . $keyword . '%')
                    ->orWhere('jober_profiles.company_business_content', 'like', '%' . $keyword . '%')
                    ->orWhere('jober_profiles.company_employee', 'like', '%' . $keyword . '%');
            })
            ->where('jobs.post_status', 1)
            ->orderBy('jobs.created_at', 'DESC')
            ->groupBy('jobs.id')
            ->paginate(20)
            ->appends(['keyword' => $keyword]);

        $working_place = $this->get_working_place();
        foreach ($jobs as $job) {
            $updatedAt = Carbon::parse($job->updated_at);
            // 現在の日時との差を計算
            $diff = $updatedAt->diff(Carbon::now());
            // 差が24時間以上の場合は日数を表示、そうでなければ時間を表示
            if ($diff->days >= 1) {
                $daysAgo = $diff->days;
                $job->displayDaysAgo = '約' . $daysAgo . '日前に更新';
            } else {
                $hoursAgo = $diff->h;
                $job->displayDaysAgo = '約' . $hoursAgo . '時間前に更新';
            }
            $working_places = [];
            foreach ($working_place as $key => $place) {
                if ($job->id === $place->job_id) {
                    $working_places[$key]['area_name'] = $place->ken_name . $place->city_name;
                    $working_places[$key]['area_id'] = $place->city_id ?? $place->ken_id;
                    $job->working_place = $working_places;
                }
            }
        }
        return view('front.search_result')->with(compact('jobs', 'prefecture', 'categories', 'keyword'));
    }

    public function area_search($area_id)
    {
        $prefecture = Address::select('ken_id', 'ken_name')->groupBy('ken_id', 'ken_name')->orderBy('ken_id')->get();
        $categories = Job_kind::all();
        $jobSelector = [
            'jobs.id',
            'post_title',
            'jobs.post_img',
            'post_category',
            'jobs.updated_at',
            'post_other',
            'post_benefit',
            'post_payment_text',
            'post_is_payment_more',
            'post_payment_max_text',
            'post_payment',
            'post_working_time',
        ];
        $jobs = Job::select($jobSelector)
            ->leftJoin('job_working_places', 'jobs.id', 'job_working_places.job_id')
            ->where('post_status', 1)
            ->where(function ($query) use ($area_id) {
                $query->where('job_working_places.ken_id', $area_id)
                    ->orWhere('job_working_places.city_id', $area_id);
            })
            ->orderBy('jobs.created_at', 'DESC')
            ->groupBy('jobs.id')
            ->paginate(20)
            ->appends(request()->input());
        $working_place = $this->get_working_place();
        foreach ($jobs as $job) {
            $updatedAt = Carbon::parse($job->updated_at);
            // 現在の日時との差を計算
            $diff = $updatedAt->diff(Carbon::now());
            // 差が24時間以上の場合は日数を表示、そうでなければ時間を表示
            if ($diff->days >= 1) {
                $daysAgo = $diff->days;
                $job->displayDaysAgo = '約' . $daysAgo . '日前に更新';
            } else {
                $hoursAgo = $diff->h;
                $job->displayDaysAgo = '約' . $hoursAgo . '時間前に更新';
            }
            $working_places = [];
            foreach ($working_place as $key => $place) {
                if ($job->id === $place->job_id) {
                    $working_places[$key]['area_name'] = $place->ken_name . $place->city_name;
                    $working_places[$key]['area_id'] = $place->city_id ?? $place->ken_id;
                    $job->working_place = $working_places;
                }
            }
        }
        return view('front.search_result')->with(compact('jobs', 'prefecture', 'categories'));
    }

    public function city_group_search($city_group_id)
    {
        $prefecture = Address::select('ken_id', 'ken_name')->groupBy('ken_id', 'ken_name')->orderBy('ken_id')->get();
        $categories = Job_kind::all();
        $jobSelector = [
            'jobs.id',
            'post_title',
            'jobs.post_img',
            'post_category',
            'jobs.updated_at',
            'post_other',
            'post_benefit',
            'post_payment_text',
            'post_is_payment_more',
            'post_payment_max_text',
            'post_payment',
            'post_working_time',
        ];
        $jobs = Job::select($jobSelector)
            ->leftJoin('job_working_places', 'jobs.id', 'job_working_places.job_id')
            ->leftJoin('addresses', 'job_working_places.city_id', 'addresses.city_id')
            ->where('addresses.city_group_id', $city_group_id)
            ->where('post_status', 1)
            ->where('addresses.delete_flg', 0)
            ->orderBy('jobs.created_at', 'DESC')
            ->groupBy('jobs.id')
            ->paginate(20)
            ->appends(request()->input());
        $working_place = $this->get_working_place();
        foreach ($jobs as $job) {
            $updatedAt = Carbon::parse($job->updated_at);
            // 現在の日時との差を計算
            $diff = $updatedAt->diff(Carbon::now());
            // 差が24時間以上の場合は日数を表示、そうでなければ時間を表示
            if ($diff->days >= 1) {
                $daysAgo = $diff->days;
                $job->displayDaysAgo = '約' . $daysAgo . '日前に更新';
            } else {
                $hoursAgo = $diff->h;
                $job->displayDaysAgo = '約' . $hoursAgo . '時間前に更新';
            }
            $working_places = [];
            foreach ($working_place as $key => $place) {
                if ($job->id === $place->job_id) {
                    $working_places[$key]['area_name'] = $place->ken_name . $place->city_name;
                    $working_places[$key]['area_id'] = $place->city_id ?? $place->ken_id;
                    $job->working_place = $working_places;
                }
            }
        }
        return view('front.search_result')->with(compact('jobs', 'prefecture', 'categories'));
    }

    public function dsp_jober_list()
    {
        $prefecture = Address::select('ken_id', 'ken_name')->groupBy('ken_id', 'ken_name')->orderBy('ken_id')->get();
        $categories = Job_kind::all();

        $jobSelector = [
            'jobs.id',
            'jobs.jober_id',
            'post_title',
            'jobs.post_img',
            'post_category',
            'jobs.updated_at',
            'post_other',
            'post_benefit',
            'post_payment_text',
            'post_is_payment_more',
            'post_payment_max_text',
            'post_payment',
            'post_working_time',
            'jober_profiles.company_img',
            'jober_profiles.company_name'
        ];
        $jobs = Job::select($jobSelector)
            ->leftJoin('job_working_places', 'jobs.id', 'job_working_places.job_id')
            ->leftJoin('jober_profiles', 'jobs.jober_id', 'jober_profiles.jober_id')
            ->where('post_status', 1)
            ->where('jober_profiles.is_dsp', 1)
            ->orderBy('jobs.created_at', 'DESC')
            ->groupBy('jobs.id')
            ->groupBy('jober_profiles.company_img')
            ->groupBy('jober_profiles.company_name')
            ->paginate(20)
            ->appends(request()->input());
        $working_place = $this->get_working_place();
        $displayDaysAgo = '';
        foreach ($jobs as $job) {
            $updatedAt = Carbon::parse($job->updated_at);
            // 現在の日時との差を計算
            $diff = $updatedAt->diff(Carbon::now());
            // 差が24時間以上の場合は日数を表示、そうでなければ時間を表示
            if ($diff->days >= 1) {
                $daysAgo = $diff->days;
                $job->displayDaysAgo = '約' . $daysAgo . '日前に更新';
            } else {
                $hoursAgo = $diff->h;
                $job->displayDaysAgo = '約' . $hoursAgo . '時間前に更新';
            }
            $working_places = [];
            foreach ($working_place as $key => $place) {
                if ($job->id === $place->job_id) {
                    $working_places[$key]['area_name'] = $place->ken_name . $place->city_name;
                    $working_places[$key]['area_id'] = $place->city_id ?? $place->ken_id;
                    $job->working_place = $working_places;
                }
            }
        }
        return view('front.search_result')->with(compact('jobs', 'prefecture', 'categories'));
    }

    public function category_search($category)
    {
        $prefecture = Address::select('ken_id', 'ken_name')->groupBy('ken_id', 'ken_name')->orderBy('ken_id')->get();
        $categories = Job_kind::all();
        $jobs = Job::where('post_category', 'like', '%' . $category . '%')
            ->where('post_status', 1)->orderBy('jobs.created_at', 'DESC')->paginate(20)
            ->appends(request()->input());
        $working_place = $this->get_working_place();
        foreach ($jobs as $job) {
            $updatedAt = Carbon::parse($job->updated_at);
            // 現在の日時との差を計算
            $diff = $updatedAt->diff(Carbon::now());
            // 差が24時間以上の場合は日数を表示、そうでなければ時間を表示
            if ($diff->days >= 1) {
                $daysAgo = $diff->days;
                $job->displayDaysAgo = '約' . $daysAgo . '日前に更新';
            } else {
                $hoursAgo = $diff->h;
                $job->displayDaysAgo = '約' . $hoursAgo . '時間前に更新';
            }
            $working_places = [];
            foreach ($working_place as $key => $place) {
                if ($job->id === $place->job_id) {
                    $working_places[$key]['area_name'] = $place->ken_name . $place->city_name;
                    $working_places[$key]['area_id'] = $place->city_id ?? $place->ken_id;
                    $job->working_place = $working_places;
                }
            }
        }
        return view('front.search_result')->with(compact('jobs', 'prefecture', 'categories'));
    }

    public function jobList($joberId)
    {
        $prefecture = Address::select('ken_id', 'ken_name')->groupBy('ken_id', 'ken_name')->orderBy('ken_id')->get();
        $categories = Job_kind::all();
        $jobSelector = [
            'jobs.id',
            'jobs.jober_id',
            'jobs.post_img',
            'post_title',
            'post_category',
            'jobs.updated_at',
            'post_other',
            'post_benefit',
            'post_payment_text',
            'post_is_payment_more',
            'post_payment_max_text',
            'post_payment',
            'post_working_time',
            'jober_profiles.company_img',
            'jober_profiles.company_name',
            'jober_profiles.company_url',
        ];
        $jobs = Job::select($jobSelector)
            ->leftJoin('job_working_places', 'jobs.id', 'job_working_places.job_id')
            ->leftJoin('jober_profiles', 'jobs.jober_id', 'jober_profiles.jober_id')
            ->where('jobs.jober_id', $joberId)
            ->where('post_status', 1)
            ->orderBy('jobs.created_at', 'DESC')
            ->groupBy('jobs.id')
            ->groupBy('jober_profiles.company_img')
            ->groupBy('jober_profiles.company_name')
            ->groupBy('jober_profiles.company_url')
            ->paginate(20)
            ->appends(request()->input());
        $jober_profile = Jober_profile::where('jober_id', $jobs[0]['jober_id'])->first();
        $working_place = $this->get_working_place();
        $displayDaysAgo = '';
        foreach ($jobs as $job) {
            $updatedAt = Carbon::parse($job->updated_at);
            // 現在の日時との差を計算
            $diff = $updatedAt->diff(Carbon::now());
            // 差が24時間以上の場合は日数を表示、そうでなければ時間を表示
            if ($diff->days >= 1) {
                $daysAgo = $diff->days;
                $job->displayDaysAgo = '約' . $daysAgo . '日前に更新';
            } else {
                $hoursAgo = $diff->h;
                $job->displayDaysAgo = '約' . $hoursAgo . '時間前に更新';
            }

            $working_places = [];
            foreach ($working_place as $key => $place) {
                if ($job->id === $place->job_id) {
                    $working_places[$key]['area_name'] = $place->ken_name . $place->city_name;
                    $working_places[$key]['area_id'] = $place->city_id ?? $place->ken_id;
                    $job->working_place = $working_places;
                }
            }
        }
        $isJobList = true;
        return view('front.company_job_list')->with(compact('jobs', 'jober_profile', 'prefecture', 'categories', 'isJobList'));
    }

    public function jobAppForm($job_id)
    {
        $job = Job::where('id', $job_id)->first();
        $jober = Jober_profile::where('jober_id', $job['jober_id'])->first();
        return view('jober.jober_application_form')->with(compact('job', 'jober'));
    }


    public function bid_post_unauth(Request $request)
    {

        $request->validate([
            'zip' => 'required',
            'ken_id' => 'required',
            'city_id' => 'required',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            // 'password_confirmation' => 'required|string|min:8', 
            'sei_mei' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'auto_login' => 'required',
            'agree' => 'required'
        ]);



        $name = $request->full_name;
        $experience = $request->ligt_cargo_experience ? 1 : 0;
        $car = $request->vehicle ? 1 : 0;
        $birthday = $request->birth_year . '-' . $request->birth_month . '-' . $request->birth_day;
        $sex = $request->sex;
        $zip = $request->zip;
        $ken_id = $request->ken_id;
        $city_id = $request->city_id;
        $sei_mei = $request->sei_mei;
        // $last_name_kana = $request->sei;
        // $first_name_kana = $request->mei;
        $phone = $request->phone;
        $email_receive = $request->input('email_receive') === 'on' ? 1 : 0;

        $user = new User();
        $user->name = $name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->verification_code = sha1(time());
        $user->is_verified = true;
        $user->save();
        Auth::login($user);

        if ($user != null) {
            //creating profile,sending email, show message
            $profile = new User_profile();
            $profile->user_id = $user->id;
            // $profile->last_name = $last_name;
            // $profile->first_name = $first_name;
            // $profile->last_name_kana = $last_name_kana;
            // $profile->first_name_kana = $first_name_kana;
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
        } else {
            //show error message
            return redirect()->back()->with(session()->flash('alert-danger', 'エラーが発生しました。再登録してください。'));
        }

        $user_id = $user->id;

        $job_id = $request->job_id;
        $jober_id = $request->jober_id;
        $bid_content = $request->bid_content;

        for ($i = 0; $i < count($request->date); $i++) {
            $interview_time = new InterviewTime();
            $interview_time->job_id = $job_id;
            $interview_time->user_id = $user_id;
            $interview_time->jober_id = $jober_id;
            $interview_time->date = $request->date[$i];
            $interview_time->time1 = $request->time1[$i];
            $interview_time->time2 = $request->time2[$i];
            $interview_time->time3 = $request->time3[$i];
            $interview_time->time4 = $request->time4[$i];
            $interview_time->time5 = $request->time5[$i];
            $interview_time->time6 = $request->time6[$i];
            $interview_time->save();
        }


        $job_title = Job::where('id', $job_id)->first()->post_title;
        $user = User::where('id', $user_id)->first();
        $jober = Jober_profile::where('jober_id', $jober_id)->first();

        $user_name = $user->name;
        $user_email = $user->email;
        $jober_name = $jober->company_name;
        $jober_email = $jober->company_email;
        if ($jober_email === null) {
            $jober_email = User::where('id', $jober->jober_id)->first()->email;
        }
        $old_bid = Bid::where('user_id', $user_id)->where('job_id', $job_id)->first();

        if ($old_bid != null) {
            return redirect()->route('user.bid_list');
        } else {
            $bid = new Bid();

            $bid->job_id = $job_id;
            $bid->user_id = $user_id;
            $bid->jober_id = $jober_id;
            $bid->bid_content = $bid_content;
            $bid->save();

            if ($bid != null) {
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
                //    MailController::sendBidMail($data);
                return view('user.user_bid_end');
            }
        }
    }

    public function emailCheck(Request $request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if ($user!= null) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function advantage()
    {
        return view('front.advantage');
    }

    public function privacy()
    {
        $title = '個人情報保護方針（プライバシーポリシー）｜ 軽貨物運送業界に特化した求人情報サイト ハコボウズ';
        $description = '軽貨物運送業界に特化した求人情報サイト「ハコボウズ」の個人情報保護方針（プライバシーポリシー）です。';
        return view('front.privacy')->with(compact('title', 'description'));
        ;
    }

    public function first()
    {
        $title = 'はじめてのご利用の方へ｜軽貨物運送業界に特化した求人情報サイト ハコボウズ';
        $description = '軽貨物ドライバー専門求人サイト「ハコボウズ」へようこそ！ハコボウズの特徴や選ばれている理由、お仕事開始までの流れを紹介しています。';
        return view('front.first')->with(compact('title', 'description'));
        ;
    }

    public function company()
    {
        $title = '会社概要｜軽貨物運送業界に特化した求人情報サイト ハコボウズ';
        $description = '運営会社情報について。軽貨物ドライバーの求人情報を探すなら「ハコボウズ」。採用が決まると最大1万円のお祝い金を全員にプレゼント！ご希望のエリア・職種・給与やこだわりの条件であなたにピッタリの求人案件を見つけましょう！';
        return view('front.company')->with(compact('title', 'description'));
    }

    public function business()
    {
        $title = '完全成果報酬型の軽貨物求人サイトならハコボウズ｜ハコボウズ求人掲載について';
        $description = '完全成果報酬でドライバーが集まる求人サイトはハコボウズ。業務委託の求人広告の掲載が無料です。求人広告掲載から採用期間中のみ課金する採用課金型のシステムです。完全成果報酬型なので掲載費用は無料。求人の採用に至った期間のみ料金が発生致します。';
        return view('front.business')->with(compact('title', 'description'));
    }

    public function about_oiwaikin()
    {
        return view('front.about_oiwaikin');
    }

    public function contact()
    {
        $title = 'お問い合わせ｜軽貨物運送業界に特化した求人情報サイト ハコボウズ';
        $description = '軽貨物ドライバーの求人情報を探すなら「ハコボウズ」。採用が決まると最大1万円のお祝い金を全員にプレゼント！ご希望のエリア・職種・給与やこだわりの条件であなたにピッタリの求人案件を見つけましょう！';
        return view('front.contact')->with(compact('title', 'description'));
    }

    public function send_contact_mail(Request $request)
    {
        $this->validate($request, [
            'last_name' => 'required',
            'first_name' => 'required',
            'kana_last_name' => 'required',
            'kana_first_name' => 'required',
            'phone1' => 'required',
            'phone2' => 'required',
            'phone3' => 'required',
            'email' => 'email|required',
            'subject' => 'required',
            'mail_content' => 'required',
            'g-recaptcha-response' => 'required|recaptchav3:contact_us,0.5'
        ]);

        if ($request->company_name != null) {
            $data['company_name'] = $request->company_name;
        } else {
            $data['company_name'] = '';
        }

        $data['last_name'] = $request->last_name;
        $data['first_name'] = $request->first_name;
        $data['kana_last_name'] = $request->kana_last_name;
        $data['kana_first_name'] = $request->kana_first_name;
        $data['email'] = str_replace("xE2x80x8B", "", $request->email);
        $data['phone1'] = $request->phone1;
        $data['phone2'] = $request->phone2;
        $data['phone3'] = $request->phone3;
        $data['subject'] = $request->subject;
        $data['mail_content'] = $request->mail_content;
        try {
            MailController::sendContactEmail($data);
            return redirect()->back()->with(session()->flash('alert-success', 'メール送信完了しました。'));
        } catch (\Exception $e) {
            return redirect()->back()->with(session()->flash('alert-danger', 'メール送信失敗しました。'));
        }
    }

    public function oubo()
    {
        return view('front.oubo');
    }

    public function oubo_confirm(Request $request)
    {
        $this->validate($request, [
            'last_name' => 'required',
            'first_name' => 'required',
            'company_name' => 'required',
            'zip_code' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'email|required',
        ]);

        if ($request->message_content != null) {
            $message_content = $request->message_content;
        } else {
            $message_content = '';
        }

        $data = [
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'company_name' => $request->company_name,
            'zip_code' => $request->zip_code,
            'province' => $request->province,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'message_content' => $message_content,
        ];

        return view('front.oubo_confirm')->with(compact('data'));
    }

    public function send_company_mail(Request $request)
    {
        $name = $request->name;
        $company_name = $request->company_name;
        $zip_code = $request->zip_code;
        $address = $request->address;
        $phone = $request->phone;
        $email = $request->email;
        if ($request->message_content != null) {
            $message_content = $request->message_content;
        } else {
            $message_content = '';
        }
        try {
            MailController::sendCompanyMail($name, $company_name, $zip_code, $address, $phone, $email, $message_content);
            $result = 'ok';
            return view('front.oubo_end')->with(compact('result'));
        } catch (\Exception $e) {
            $result = 'no';
            return view('front.oubo_end')->with(compact('result'));
        }

    }

    public function job_detail($id, $page = '')
    {
        $job = Job::where('id', $id)->first();
        $jober_id = $job->jober_id;
        $job_prs = Job_pr::where('job_id', $job->id)->get();
        if ($page !== 'jober') {
            $view = $job->view + 1;
            Job::where('id', $id)->update(array('view' => $view));
        }
        $similar_job = Job::where('jober_id', $jober_id)->where('post_status', 1)->get();
        $jober_profile = Jober_profile::where('jober_id', $jober_id)->first();
        $working_place = Job_working_place::leftJoin('jobs', 'jobs.id', 'job_working_places.job_id')
            ->where('jobs.id', $job->id)
            ->get();
        $working_places = [];
        foreach ($working_place as $key => $place) {
            $working_places[$key]['ken_name'] = $place->ken_name;
            $working_places[$key]['ken_id'] = $place->ken_id;
            $working_places[$key]['area_name'] = $place->ken_name . $place->city_name;
            $working_places[$key]['area_id'] = $place->city_id ?? $place->ken_id;
            $job->working_place = $working_places;
        }
        $structuredDataJob = true;
        $title = $job['post_title'];
        return view('front.job_detail')->with(compact('job', 'jober_id', 'similar_job', 'jober_profile', 'job_prs', 'page', 'structuredDataJob', 'working_place', 'title'));
    }

    public static function trip_text($text, $count = 50)
    {
        $content = strip_tags($text);
        return mb_substr($content, 0, $count, 'utf8');
    }

    public function blog_detail($id)
    {
        $article = Article::where('id', $id)->first();
        return view('front.blog_detail')->with(compact('article'));
    }

    public function notification_detail($id)
    {
        $notification = Notification::where('id', $id)->first();
        return view('front.notification_detail')->with(compact('notification'));
    }

    public function blog_list()
    {
        $articles = Article::paginate(20);
        return view('front.blog_list')->with(compact('articles'));
    }

    public function special_list()
    {
        $specials = Special::paginate(20);
        return view('front.special_list')->with(compact('specials'));
    }

    public function special_detail($id)
    {
        $special = Special::where('id', $id)->first();
        $special_area = $special->special_area;
        $special_category = $special->special_category;
        $jobs = Job::where('post_working_place', 'like', '%' . $special_area . '%')
            ->where('post_category', $special_category)->where('post_status', 1)
            ->get();

        return view('front.special_detail')->with(compact('jobs', 'special'));
    }

    public function user_profile($user_id)
    {
        $user = User::where('id', $user_id)->first();
        $profile = User_profile::where('user_id', $user_id)->first();
        if (is_null($profile->city_id)) {
            $address = Address::select('ken_name')->where('ken_id', $profile->ken_id)->first();
        } else {
            $address = Address::select('ken_name', 'city_name')->where('city_id', $profile->city_id)->first();
        }
        //        dd($address);
        return view('front.user_profile')->with(compact('user', 'profile', 'address'));
    }

    public function user_profile_db(Request $request)
    {
        $user_profile = User_profile::where('user_id', $request->user_id)->first();
        $user_profile->memo = $request->memo;
        $user_profile->save();
        if ($user_profile != null) {
            return redirect()->back();
        }
    }

    public function terms_and_service()
    {
        $title = '利用規約｜軽貨物運送業界に特化した求人情報サイト ハコボウズ';
        $description = '利用規約について。軽貨物ドライバーの求人情報を探すなら「ハコボウズ」。採用が決まると最大1万円のお祝い金を全員にプレゼント！ご希望のエリア・職種・給与やこだわりの条件であなたにピッタリの求人案件を見つけましょう！';
        return view('front.termandservice')->with(compact('title', 'description'));
    }

    private function get_working_place()
    {
        return Job_working_place::leftJoin('jobs', 'jobs.id', 'job_working_places.job_id')->where('jobs.post_status', 1)->get();
    }
}
