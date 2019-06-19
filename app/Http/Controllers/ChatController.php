<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Events\ChatEvent;
use App\Message;
use App\User;

class ChatController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
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
	    // dd($messages);
    	foreach ($messages as $message) {
    		echo $message['sender']['name'].': '.$message['message'].' '.$message['created_at'];
    		echo "<br><br>";
    	}
    	return view('chat.chat', [
    		'messages' => $messages,
    		'receiver_id' => $id
    	]);
    }

    // public function send(Request $request)
    // {
    // 	$user = User::find(Auth::id());
    // 	event(new ChatEvent($request->$message, $user));
    // }

    public function send(Request $request)
    {
    	$message = new Message;
    	$message->sender_id = Auth::id();
    	$message->receiver_id = request('receiver');
    	$message->message = request('message');
    	$message->save();
    }
}
