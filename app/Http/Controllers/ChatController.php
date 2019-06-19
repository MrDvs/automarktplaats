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

    public function index()
    {
    	// $messages = Message::where('receiver_id', Auth::id())
	    // 	->orWhere('sender_id', Auth::id())
	    // 	->get();

	    $chats = Message::groupBy('receiver_id')->where('sender_id', Auth::id())->get();

	   	dd($chats);


	    // return view('chat.index', ['chats' => $chats]);

    }

    public function show($id)
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
    	$message = new Message;
    	$message->sender_id = Auth::id();
    	$message->receiver_id = request('receiver');
    	$message->message = request('message');
    	$message->save();
    }
}
