@extends('layouts.default')

@section('content')
<h3 class=" text-center">Chat met {{$receiver->name}}</h3>
<div id="chat">
    <div class="messaging">
          <div class="inbox_msg">
            <div class="mesgs">
              <div class="msg_history" v-chat-scroll>
                @foreach($messages as $message)
                    @if($message['sender']['id'] != Auth::id())
                        <div class="incoming_msg">
                          <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                          <div class="received_msg">
                            <div class="received_withd_msg">
                              <p>{{$message['message']}}</p>
                              <span class="time_date">{{$message['created_at']->format('H:i')}}</span></div>
                          </div>
                        </div>
                    @else
                        <div class="outgoing_msg">
                          <div class="sent_msg">
                            <p>{{$message['message']}}</p>
                            <span class="time_date">{{$message['created_at']->format('H:i')}}</span> </div>
                        </div>
                    @endif
                @endforeach
                <message v-for="value in chat.message" :key=value.index color='secondary'>
                    @{{value}}
                </message>
              </div>
              <div class="type_msg">
                <div class="input_msg_write">
                  <input type="text" name="message" class="write_msg" placeholder="Type je bericht..." v-model="message" @keyup.enter="send">
                  <input type="hidden" name="receiver" value="{{$receiver->id}}">
                  <button class="msg_send_btn" type="button" v-on:click="send"><i class="fas fa-paper-plane"></i></button>
                </div>
              </div>
            </div>
          </div>

        </div>
</div>

@endsection
