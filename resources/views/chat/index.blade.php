@extends('layouts.default')

@section('content')
<h3 class=" text-center">Chat</h3>
<div class="messaging">
  <div class="inbox_msg">
    <div class="inbox_people">
      <div class="headind_srch">
        <div class="recent_heading">
          <h4>Recent</h4>
        </div>
      </div>

      <div class="inbox_chat">
      @if(!$chats)
      <h3 class="text-center">Je hebt nog geen chatberichten!</h3>
      @else
      {{$name = ''}}
        @foreach($chats as $chat)
          @if($name != $chat['username'])
            {{$name = $chat['username']}}
            @continue
          @endif

          <a href="{{url('chat/'.($chat['receiver']['id'] == Auth::id() ? $chat['sender']['id'] : $chat['receiver']['id']))}}">
            <div class="chat_list">
              <div class="chat_people">
                <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                <div class="chat_ib">
                  {{-- <h5>{{$chat['username']}}</h5> --}}
                </div>
              </div>
            </div>
          </a>

        @endforeach
      @endif

      </div>
    </div>
  </div>
</div>

@endsection
