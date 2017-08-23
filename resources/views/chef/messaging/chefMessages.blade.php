@extends('chef.layout')

@section('page_head')
    <link rel="stylesheet" href="/css/chef/messaging.css">
    @if($chatId!=null)
        <script>
            chatId='{{$chatId}}';
        </script>
    @endif
    <script src="/js/messaging.js"></script>
    <script src="/js/chef/chefMessageValidate.js"></script>
@endsection

@section('page_content')

    <div class="container msgCntr">
        <div class="msgApp">
            <div class="row">
                <div class="col s12">
                    <nav class="light-green lighten-1">
                        <div class="nav-wrapper">
                            <div class="left col s12 m5 l5">
                                <ul>
                                    <li>
                                        <span>Messages</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="left col s12 m7 l7 hide-on-med-and-down">
                                <ul class="right">
                                    <li>
                                        <a href="#crtMsg" class="modal-trigger"><i class="material-icons">edit</i></a>
                                    </li>
                                    <li>
                                        @if($chatId!=null)
                                            <a href="#dltCht" class="modal-trigger"><i class="material-icons">delete</i></a>
                                        @else
                                            <a href="#!"><i class="material-icons grey-text">delete</i></a>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <div class="col s12 m3 l3 card-panel msgList">
                        <ul class="collection msgListItem">
                            @if($chats->count() > 0)
                                @foreach($chats as $chat)
                                    @if($chat->message->where('is_read',0)->where('receiver_type','c')->count()==0)
                                        <li id="chtItem-{{$chat->id}}" class="collection-item msgItem">
                                            <a href="{{route('chef.message.message', $chat->id)}}">
                                                <div class="truncate">
                                                    @foreach($foodies as $foodie)
                                                        @if($foodie->id == $chat->foodie_id)
                                                            <img class="circle msgImg" src="/img/{{ $foodie->avatar }}">
                                                            <span class="msgUserName">{{$foodie->first_name.' '.$foodie->last_name}}</span>
                                                            <p class="truncate grey-text">
                                                                @if($chat->message()->latest()->first()->receiver_type=='c')
                                                                    <span>{{$foodie->first_name.': '}}</span>
                                                                @else
                                                                    <span>Me: </span>
                                                                @endif
                                                                {{$chat->message()->latest()->first()->message}}
                                                            </p>
                                                        @endif
                                                    @endforeach
                                                    {{--@foreach($chat->message as $message)--}}
                                                    {{--@if($chat->message()->latest()->first()->receiver_type=='')--}}
                                                    {{--@endif--}}
                                                    <a href="#!" class="secondary-content msgListTime">
                                                        <span class="blue-text">{{$chat->message()->latest()->first()->created_at->format('g:ia')}}</span>
                                                    </a>
                                                    {{--@endforeach--}}
                                                </div>
                                            </a>
                                        </li>
                                    @else
                                        <li id="chtItem-{{$chat->id}}" class="collection-item msgItem" style="background-color: #00e5ff">
                                            <a href="{{route('chef.message.message', $chat->id)}}">
                                                <div class="truncate">
                                                    @foreach($foodies as $foodie)
                                                        @if($foodie->id == $chat->foodie_id)
                                                            <img class="circle msgImg" src="/img/{{ $foodie->avatar }}">
                                                            <span class="msgUserName">{{$foodie->first_name.' '.$foodie->last_name}}</span>
                                                        @endif
                                                    @endforeach
                                                    {{--@foreach($chat->message as $message)--}}
                                                    {{--@if($chat->message()->latest()->first()->receiver_type=='')--}}
                                                    <p class="truncate grey-text">{{$chat->message()->latest()->first()->message}}</p>
                                                    {{--@endif--}}
                                                    <a href="#!" class="secondary-content msgListTime">
                                                        <span class="blue-text">{{$chat->message()->latest()->first()->created_at->format('g:ia')}}</span>
                                                    </a>
                                                    {{--@endforeach--}}
                                                </div>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            @else
                                <li>
                                    <span>No Messages Yet!</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="col s12 m9 l9 card-panel msgDtl">
                        @foreach($chats as $chat)
                            <div id="chat-{{$chat->id}}" class="msgMsg">
                                @foreach($chat->message()->latest()->get() as $message)
                                    <div class="msgBody">
                                        <p class="email-subject truncate">{{$message->subject}}</p>
                                        <hr class="grey-text text-lighten-2">
                                        <div class="email-content-wrap">
                                            <div class="row">
                                                <div class="col s10 m10 l10">
                                                    <ul class="collection msgMta">
                                                        <li class="collection-item">
                                                            @foreach($foodies as $foodie)
                                                                @if($message->receiver_type=='c')
                                                                    @if($foodie->id == $chat->foodie_id)
                                                                        <img class="circle msgImg" src="/img/{{ $foodie->avatar }}">
                                                                        <span class="email-title"> From {{$foodie->first_name.' '.$foodie->last_name}}</span>
                                                                        <p class="grey-text ">To me, {{$chef->name}}</p>
                                                                    @endif
                                                                @else
                                                                    @if($foodie->id == $chat->foodie_id)
                                                                        <img class="circle msgImg" src="/img/{{ $chef->avatar }}">
                                                                        <span class="email-title">From Me, {{$chef->name}}</span>
                                                                        <p class="grey-text ">To {{$foodie->first_name.' '.$foodie->last_name}}</p>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                            <p class="grey-text">{{$message->created_at->format('F d, Y, g:ia')}}</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                                @foreach($foodies as $foodie)
                                                    @if($foodie->id == $chat->foodie_id)
                                                        <div class="col s2 m2 l2 email-actions msgRply">
                                                            <a class="rplBtn modal-trigger" href="#rplMsg" data-rec-name="{{$foodie->first_name.' '.$foodie->last_name}}" data-rec="{{$foodie->id}}" data-rpl-sub="{{$message->subject}}" data-chat-id="{{$chat->id}}"><span><i class="material-icons">reply</i></span></a>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="msgCnt">
                                                <p>{{$message->message}}</p>
                                                <div>
                                                    @unless($message->receipt_name=='')
                                                        <div>
                                                            <img src="/img/{{$message->receipt_name}}" alt="User Image">
                                                        </div>
                                                    @endunless
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="crtMsg" class="modal">
        <nav class="light-green lighten-1 white-text">
            <div class="left col s12 m5 l5">
                <ul>
                    <li>
                        <a id="msgCmpsCls" href="#!">
                            <i class="material-icons">close</i>
                        </a>
                    </li>
                    <li>
                        <span>Compose</span>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="modal-content">
            <form id="chefMessageSend" action="{{route('chef.message.send')}}" method="post" autocomplete="off">
                {{csrf_field()}}
                <div class="row">
                    <div class="row">
                        <div class="input-field col s6">
                            <label for="chefMessageSelect" class="active">Receiver</label>
                            <select id="chefMessageSelect" name="chefMessageSelect" class="selectRequired" data-error=".error-select-message">
                                <option value="" selected>Choose Receiver</option>
                                @foreach($foodies as $foodie)
                                    <option value="{{$foodie->id}}">{{$foodie->first_name.' '.$foodie->last_name}}</option>
                                @endforeach
                            </select>
                            <div class="error-select-message err"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <label for="foodieSubject" class="active">Subject</label>
                            <input placeholder="subject" id="chefSubject" name="chefSubject" data-error=".error-message" type="text" class="validate">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <label for="foodieMessage" class="active">Message</label>
                            <input placeholder="message" id="chefMessage" name="chefMessage" type="text" data-error=".error-message" class="validate">
                            <div class="error-message err"></div>
                        </div>
                    </div>
                </div>
                <div>
                    <div><input type="submit" value="Submit" class="btn btn-primary"></div>
                </div>
            </form>
        </div>
    </div>
    <div id="rplMsg" class="modal">
        <nav class="light-green lighten-1 white-text">
            <div class="left col s12 m5 l5">
                <ul>
                    <li>
                        <a id="msgRplCls" href="#!">
                            <i class="material-icons">close</i>
                        </a>
                    </li>
                    <li>
                        <span>Reply to <span id="replyRecName"></span></span>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="modal-content">
            <form id="chefMessageReply" action="{{route('chef.message.reply')}}" method="post" autocomplete="off">
                {{csrf_field()}}
                <input name="replyRec" id="replyRec" type="hidden" value="">
                <input name="chtId" id="chtId" type="hidden" value="">
                <div class="row">
                    <div class="row">
                        <div class="input-field col s6">
                            <label for="replySubject" class="active">Subject</label>
                            <input placeholder="subject" id="replySubject" name="replySubject" data-error=".error-message" type="text" class="validate">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <label for="replyMessage" class="active">Message</label>
                            <input placeholder="message" id="replyMessage" name="replyMessage" type="text" data-error=".error-message" class="validate">
                            <div class="error-message err"></div>
                        </div>
                    </div>
                </div>
                <div>
                    <div><input type="submit" value="Submit" class="btn btn-primary"></div>
                </div>
            </form>
        </div>
    </div>
    <div id="dltCht" class="modal">
        <div class="modal-content">
            <div>
                <span>Do you want to delete this chat?</span>
            </div>
            <form action="{{route('chef.chat.delete',$chatId)}}" method="post">
                {{csrf_field()}}
                <div>
                    <div><input type="submit" value="Delete" class="btn btn-primary"></div>
                </div>
            </form>
        </div>
    </div>

    @endsection
        {{--<div class="row">--}}
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<h2 class="center white-text">Messages</h2>--}}
            {{--<span class="center full-width white-text" style="font-size: 1.5em">Keep in touch with your foodies!</span>--}}

{{--send a message--}}
            {{--<div class="row">--}}
                {{--<div class="card">--}}
                    {{--<div class="card-panel">--}}
                        {{--<h3>Send A Message</h3>--}}
                        {{--<form id="chefMessageSend" action="{{route('chef.message.send')}}" method="post" autocomplete="off">--}}
                            {{--{{csrf_field()}}--}}
                            {{--<div class="row">--}}
                                {{--<div class="input-field col s6">--}}
                                    {{--<label for="chefMessageSelect" class="active">Receiver</label>--}}
                                    {{--<select id="chefMessageSelect" name="chefMessageSelect" data-error=".error-select-message">--}}
                                        {{--<option value="" disabled selected>Choose Receiver</option>--}}
                                        {{--@foreach($foodies as $foodie)--}}
                                            {{--<option value="{{$foodie->id}}">{{$foodie->first_name.' '.$foodie->last_name}}</option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                    {{--<div class="error-select-message err"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="row">--}}
                                {{--<div class="input-field col s6">--}}
                                    {{--<label for="chefSubject" class="active">Subject</label>--}}
                                    {{--<input placeholder="subject" id="chefSubject" name="chefSubject" data-error=".error-message" type="text" class="validate">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="row">--}}
                                {{--<div class="input-field col s12">--}}
                                    {{--<label for="chefMessage" class="active">Message</label>--}}
                                    {{--<input placeholder="message" id="chefMessage" name="chefMessage" data-error=".error-message" type="text" class="validate">--}}
                                    {{--<div class="error-select-message err"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div>--}}
                                {{--<div><input type="submit" value="Submit" class="btn btn-primary"></div>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
{{--message inbox--}}

        {{--</div>--}}
    {{--</div>--}}
            {{--<div class="card">--}}
                {{--<div class="card-panel green lighten-3">--}}
                    {{--<h3>Inbox({{$chats->count()}})</h3>--}}

                    {{--@unless($messages->count()<1)--}}
                        {{--@foreach($messages as $key => $message)--}}
                            {{--<div class="card papaya-whip">--}}
                                {{--<div class="card-content">--}}
                                    {{-- ID OF THE MESSAGE OR NOT--}}
                                    {{--<i data-message-id="{{$message->id}}"></i>--}}
                                    {{--@foreach($foodies as $foodie)--}}
                                        {{--@if($foodie->id == $message->sender_id)--}}
                                            {{--<h4>{{$foodie->first_name.' '.$foodie->last_name}}</h4>--}}
                                                {{--<button id="m{{$message->id}}" class="revealMessageContent btn" type="button">Read</button>--}}
                                            {{--<div style="display: inline; float: right;">--}}
                                                {{--<button data-target="delete-message-modal{{$message->id}}" class="btn modal-trigger">Delete Message</button>--}}
                                            {{--</div>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                    {{--<div id="mConm{{$message->id}}" class="messageContent">--}}
                                        {{--<div>--}}
                                            {{--<div class="messageBody">--}}
                                                {{--<img src="/uploads/avatars/{{ Auth::user()->avatar }}" class="img-circle" alt="User Image">--}}
                                                {{--<div class="card">--}}
                                                    {{--<div class="card-content">--}}
                                                        {{--<div>{{$message->message}}</div>--}}
                                                        {{--{{$message->deposit_id}}--}}
                                                        {{--@unless($message->receipt_name=='')--}}
                                                            {{--<div>--}}
                                                                 {{--<img src="/img/{{$message->receipt_name}}" alt="User Image">--}}
                                                            {{--</div>--}}
                                                        {{--@endunless--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}

                                                {{--<div class="replyButton">--}}
                                                    {{--<button data-target="replyM{{$message->id}}" class="btn modal-trigger">Reply</button>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div id="delete-message-modal{{$message->id}}" class="modal">--}}
                                        {{--<div class="modal-content">--}}
                                            {{--<div><h4>Are you sure you want to delete this message?</h4></div>--}}
                                            {{--<form method="post" action="{{route('chef.message.delete', ['message'=>$message->id])}}">--}}
                                                {{--{{csrf_field()}}--}}
                                                {{--<div>--}}
                                                    {{--<input type="submit" class="btn" value="delete">--}}
                                                {{--</div>--}}
                                            {{--</form>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@endforeach--}}
                    {{--@endunless--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}


            {{--@unless($messages->count()<1)--}}
                {{--@foreach($messages as $message)--}}
                    {{--<div id="replyM{{$message->id}}" class="modal">--}}
                        {{--<div class="modal-content">--}}
                            {{--@foreach($foodies as $foodie)--}}
                                {{--@if($foodie->id == $message->sender_id)--}}
                                    {{--<h4>Receiver: {{$foodie->username}}</h4>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                            {{--<form id="replyForm{{$message->id}}" class="replyForm" action="{{route('chef.message.reply', $message->sender_id)}}"--}}
                                  {{--method="post" autocomplete="off">--}}
                                {{--{{csrf_field()}}--}}
                                {{--<div class="input-field">--}}
                                    {{--<textarea id="replyMessage" name="replyMessage" data-error=".error-reply" class="materialize-textarea required"></textarea>--}}
                                    {{--<label for="replyMessage">Message</label>--}}
                                    {{--<div class="error-reply err"></div>--}}
                                {{--</div>--}}
                                {{--<div>--}}
                                    {{--<input type="submit" value="Submit" class="btn btn-primary">--}}
                                {{--</div>--}}
                            {{--</form>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            {{--@endunless--}}
