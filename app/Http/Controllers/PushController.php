<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Job;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PushNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PushController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get_unread_notification(){
        $temp = [];
        $user_id = Auth::user()->id;
        $results = PushNotification::where('receiver', $user_id)->where('status', 0)->get();
        foreach($results as $result){
            $data['id'] = $result->id;
            // $result->sender のnullチェックを追加
            if ($result->sender) {
                $sender = User::where('id', $result->sender)->first();
                if ($sender) {
                    $data['sender_name'] = $sender->name;
                } else {
                    // ユーザーが見つからない場合、エラーログを記録
                    Log::error('User not found for ID: ' . $result->sender);
                    $data['sender_name'] = '';
                }
            } else {
                $data['sender_name'] = '';
            }

            // $result->job_id のnullチェックを追加
            if ($result->job_id) {
                $job = Job::where('id', $result->job_id)->first();
                if ($job) {
                    $data['post_title'] = $job->post_title;
                } else {
                    // ジョブが見つからない場合、エラーログを記録
                    Log::error('Job not found for ID: ' . $result->job_id);
                    $data['post_title'] = '';
                }
            } else {
                $data['post_title'] = '';
            }

            $data['type'] = $result->type;
            $temp[] = $data;
        }
        return $temp;
    }

    public function get_unread_message(){
        $sessions = Session::select('id')->orWhere(function($query){
                $query->where('user1_id',auth()->id());
            })
            ->orWhere(function($query){
                $query->where('user2_id',auth()->id());
            })->get();

//        $chats = Chat::where('session_id',41)->where('read_at', null)->where('type', 0)->where('user_id','!=',auth()->id())->get();

        $unreads = 0;

        foreach($sessions as $session){
            $chats = Chat::where('session_id',$session['id'])->where('read_at', null)->where('type', 0)->where('user_id','!=', auth()->id())->get();
            foreach($chats as $chat){
                $unreads++;
            }
        }
        return $unreads;
    }

    public function read_notification($id){
        $results = PushNotification::where('id',$id)->first();
        $results->status = 1;
        $results->save();
        return $results;
    }
}
