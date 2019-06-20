<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Events\ChatEvent;
use App\Message;
use App\User;
use DB;

class ChatController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $query = 'SELECT * FROM `messages` WHERE sender_id = :id1 OR receiver_id = :id2 GROUP BY sender_id, receiver_id';
        // $chats = DB::select($query, ['id1' => Auth::id(), 'id2' => Auth::id()]);

        $chats = Message::where('sender_id', Auth::id())
            ->orWhere('receiver_id', Auth::id())
            ->groupBy('sender_id', 'receiver_id')
            ->orderBy('updated_at')
            ->get();

        if (count($chats)) {
            foreach ($chats as $key => $chat) {
                if ($chat['sender_id'] != Auth::id()) {
                    $username = User::find($chat['sender_id']);
                    $chats[$key]['username'] = $username['name'];
                } else {
                    $user = User::find($chat['receiver_id']);
                    $chats[$key]['username'] = $user['name'];
                }
            }
        } else {
            $chats = 0;
        }
        // dd($chats);

	    return view('chat.index', ['chats' => $chats]);

    }

    public function show($id)
    {
        $user = User::find($id);
        if (!count($user)) {
            return back();
        }
    	$messages = Message::
	    	where([
	    		['sender_id', $id],
	    		['receiver_id', Auth::id()]

	    	])
	    	->orWhere([
	    		['receiver_id', $id],
	    		['sender_id', Auth::id()]
	    	])
	    	->with('sender', 'receiver')
	    	->get();
	    $receiver = User::find($id);
    	return view('chat.show', [
    		'messages' => $messages,
    		'receiver' => $receiver
    	]);
    }

    // public function send(Request $request)
    // {
    // 	$user = User::find(Auth::id());
    // 	event(new ChatEvent($request->$message, $user));
    // }

    public function send(Request $request)
    {
        request()->validate([
            'message' => 'required'
        ]);

    	$message = new Message;
    	$message->sender_id = Auth::id();
    	$message->receiver_id = request('receiver');
    	$message->message = request('message');
    	$message->save();
    }
}
