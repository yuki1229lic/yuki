<?php

namespace App\Http\Controllers;

use App\Events\MsgReadEvent;
use App\Events\PrivateChatEvent;
use App\Http\Resources\ChatResource;
use App\Http\Resources\UserResource;
use App\Models\Bid;
use App\Models\Jober_profile;
use App\Models\Message;
use App\Models\Session;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function chatting() {
        return view('chat.chat');
    }

    public function getFriends(){
        $session = new Session();
        $other_user1_ids = [];
        $other_user2_ids = [];
        $temp1 = $session->select('user1_id')->where('user2_id', auth()->id())->get();
        foreach($temp1 as $temp){
            $other_user1_ids[] = $temp['user1_id'];
        }
        $temp2 = Session::select('user2_id')->where('user1_id', auth()->id())->get();
        foreach($temp2 as $temp){
            $other_user2_ids[] = $temp['user2_id'];
        }
        $ids  = array_unique(array_merge($other_user1_ids,$other_user2_ids));
        $result =User::whereIn('id',$ids)->where('id','!=', auth()->id())->where('users.user_type', '!=',1)->get();
        return UserResource::collection($result);
    }

    public function send_first_message(Session $session, Request $request){
        $session_id = $request->session_id;
        $message = $session->messages()->create([
            'content' => $request->message,
        ]);
        $chat = $message->createForSend($session_id);
        $message->createForReceive($session_id, $request->to_user);
        broadcast(new PrivateChatEvent($message->content, $chat));
        if( $chat != null){
            return redirect()->route('user.dashboard');
        }
    }

    public function send(Session $session, Request $request){
        $message = $session->messages()->create([
            'content' => $request->message
        ]);
        $chat = $message->createForSend($session->id);
        $message->createForReceive($session->id, $request->to_user);

        $jober = User::where('users.id', $session->user1_id)->leftjoin('jober_profiles','jober_profiles.jober_id' , '=', 'users.id')->first();
        $user = User::where('id', $session->user2_id)->first();
        if ($request->to_user === $session->user1_id) {
            $data['toName'] = $jober->company_name;
            $data['toEmail'] = $jober->company_email;
            $data['fromName'] = $user->name;
        } else {
            $data['toName'] = $user->name;
            $data['toEmail'] = $user->email;
            $data['fromName'] = $jober->company_name;
        }
        $data['content'] = $message->content;
        MailController::chatSendMail($data);

        broadcast(new PrivateChatEvent($message->content, $chat));

        return response($chat->id, 200);
    }

    public function chats(Session $session){
        return ChatResource::collection($session->chats->where('user_id', auth()->id()));
    }

    public function read(Session $session){
        $chats = $session->chats->where('read_at', null)->where('type', 0)->where('user_id', '!=', auth()->id());
        foreach ($chats as $chat){
            $chat->update(['read_at' => Carbon::now()]);
            broadcast(new MsgReadEvent(new ChatResource($chat), $chat->session_id));
        }
    }

    public function clear(Session $session){
        $session->deleteChats();
        $session->chats->count() == 0 ? $session->deleteMessages() : '';
        return response('cleared', 200);
    }

}
