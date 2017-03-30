@extends('chef.layout')

@section('page_head')
    <link rel="stylesheet" href="/css/chef/messaging.css">
    <script>

    </script>
    {{--<script src="/js/messaging.js"></script>--}}

@endsection

@section('page_content')

    <div class="container">
        <div class="row">
            <h2 class="center white-text">Messages</h2>
            <span class="center full-width white-text" style="font-size: 1.5em">Keep in touch with your foodies!</span>

            @foreach($messages as $key => $message)

                <div class="card papaya-whip">
                    <div class="card-content">
                        {{-- ID OF THE MESSAGE OR NOT--}}
                        <i data-message-id="{{$message->id}}"></i>
                        @foreach($foodies as $foodie)
                            @if($foodie->id == $message->sender_id)
                                <h4>{{$foodie->username}}</h4>
                                <form action="" method="post">
                                    <button id="m{{$message->id}}" class="revealMessageContent btn" type="button">Read</button>
                                </form>
                                <a href="#mConm{{$message->id}}" class="modal-trigger">View Message</a>
                                <div class="replyButton">
                                    <button data-target="replyM{{$message->id}}" class="btn modal-trigger">Reply</button>
                                </div>
                            @endif
                        @endforeach
                        <div id="mConm{{$message->id}}" class="messageContent modal">
                            <div class="modal-content">
                                <div class="messageBody">
                                    {{--<img src="/uploads/avatars/{{ Auth::user()->avatar }}" class="img-circle" alt="User Image">--}}
                                    <img src="/img/{{$message->receipt_name}}" alt="User Image">
                                    {{$message->message}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach


            {{--@for($i=0;$i<=$messageCount;$i++)--}}
                {{--<div class="card papaya-whip">--}}
                    {{--<div class="card-content">--}}
                        {{--<i data-message-id="{{$messages[$i]->id}}"></i>--}}
                        {{--@foreach($foodies as $foodie)--}}
                            {{--@if($foodie->id == $messages[$i]->sender_id)--}}
                                {{--<h4>{{$foodie->username}}</h4>--}}
                                {{--<form action="" method="post">--}}
                                    {{--<button id="m{{$i}}" class="revealMessageContent btn" type="button">Read</button>--}}
                                {{--</form>--}}
                                {{--<div class="replyButton">--}}
                                    {{--<button data-target="replyM{{$i}}" class="btn modal-trigger">Reply</button>--}}
                                {{--</div>--}}
                            {{--@endif--}}
                        {{--@endforeach--}}
                        {{--<div id="mConm{{$i}}" class="messageContent">--}}
                        {{--<div class="messageBody">--}}
                        {{--{{$messages[$i]->message}}--}}
                        {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--@endfor--}}
        </div>
    </div>

    @unless($messageCount<1)
        @for($i=0;$i<$messageCount;$i++)
            <div id="replyM{{$i}}" class="modal">
                <div class="modal-content">
                    @foreach($foodies as $foodie)
                        @if($foodie->id == $messages[$i]->sender_id)
                            <h4>Receiver: {{$foodie->username}}</h4>
                        @endif
                    @endforeach
                    <form id="replyForm{{$i}}" action="{{route('chef.message.reply', $messages[$i]->sender_id)}}"
                          method="post" autocomplete="off">
                        {{csrf_field()}}
                        <div class="input-field">
                            <textarea id="replyMessage" name="replyMessage" class="materialize-textarea"></textarea>
                            <label for="replyMessage">Message</label>
                        </div>
                        <div>
                            <input type="submit" value="Submit" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        @endfor
    @endunless

    <div class="container">
        <form action="{{route('chef.message.send')}}" method="post" autocomplete="off">
            {{csrf_field()}}
            <div class="row">
                <div class="input-field col s6">
                    <input placeholder="message" id="chefMessage" name="chefMessage" type="text" class="validate">
                </div>
            </div>
            <label for="chefMessageSelect">Receiver</label>
            <div class="input-field col s12">
                <select id="chefMessageSelect" name="chefMessageSelect">
                    <option value="" disabled selected>Choose Receiver</option>
                    @foreach($foodies as $foodie)
                        <option value="{{$foodie->id}}">{{$foodie->username}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <div><input type="submit" value="Submit" class="btn btn-primary"></div>
            </div>
        </form>
    </div>
@endsection