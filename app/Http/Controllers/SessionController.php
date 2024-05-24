<?php

namespace App\Http\Controllers;

use App\Events\SessionEvent;
use App\Http\Resources\SessionResource;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        try{
            $available_1 = is_null(Session::where('user1_id' ,auth()->id())->where('user2_id',$request->friend_id)->first());
            $available_2 = is_null(Session::where('user2_id' ,auth()->id())->where('user1_id',$request->friend_id)->first());

            if(($available_1 && $available_2 ) == true){
                $session = Session::create(['user1_id' => auth()->id(), 'user2_id' => $request->friend_id]);

                $modifiedSession = new SessionResource($session);

                broadcast(new SessionEvent($modifiedSession, auth()->id()));

                return $modifiedSession;
            }else{
                return 'error';
            }

        }catch (\Exception $e){
            return 'error';
        }

    }
}
