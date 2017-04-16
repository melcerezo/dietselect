@extends('chef.layout')

@section('page_head')
    <link rel="stylesheet" href="/css/chef/messaging.css">

    <script src="/js/messaging.js"></script>

@endsection

@section('page_content')


    <div class="container">
        <div class="row">
            <h2 class="center white-text">Messages</h2>
            <span class="center full-width white-text" style="font-size: 1.5em">Keep in touch with your foodies!</span>

{{--send a message--}}
            <div class="row">
                <div class="card">
                    <div class="card-panel">
                        <h3>Send A Message</h3>
                        <form action="{{route('chef.message.send')}}" method="post" autocomplete="off">
                            {{csrf_field()}}
                            <label for="chefMessageSelect">Receiver</label>
                            <div class="input-field col s12">
                                <select id="chefMessageSelect" name="chefMessageSelect">
                                    <option value="" disabled selected>Choose Receiver</option>
                                    @foreach($foodies as $foodie)
                                        <option value="{{$foodie->id}}">{{$foodie->first_name.' '.$foodie->last_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input placeholder="message" id="chefMessage" name="chefMessage" type="text" class="validate">
                                </div>
                            </div>
                            <div>
                                <div><input type="submit" value="Submit" class="btn btn-primary"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
{{--message inbox--}}
        <div class="row">
            <div class="card">
                <div class="card-panel green lighten-3">
                    <h3>Inbox({{$messages->count()}})</h3>

                    @unless($messages->count()<1)
                        @foreach($messages as $key => $message)
                            <div class="card papaya-whip">
                                <div class="card-content">
                                    {{-- ID OF THE MESSAGE OR NOT--}}
                                    <i data-message-id="{{$message->id}}"></i>
                                    @foreach($foodies as $foodie)
                                        @if($foodie->id == $message->sender_id)
                                            <h4>{{$foodie->username}}</h4>
                                                <button id="m{{$message->id}}" class="revealMessageContent btn" type="button">Read</button>
                                            <div style="display: inline; float: right;">
                                                <button data-target="delete-message-modal{{$message->id}}" class="btn modal-trigger">Delete Address</button>
                                            </div>
                                        @endif
                                    @endforeach
                                    <div id="mConm{{$message->id}}" class="messageContent">
                                        <div>
                                            <div class="messageBody">
                                                {{--<img src="/uploads/avatars/{{ Auth::user()->avatar }}" class="img-circle" alt="User Image">--}}
                                                <div class="card">
                                                    <div class="card-content">
                                                        <div>{{$message->message}}</div>
                                                        {{--{{$message->deposit_id}}--}}
                                                        @unless($message->receipt_name=='')
                                                            <div>
                                                                 <img src="/img/{{$message->receipt_name}}" alt="User Image">
                                                            </div>
                                                        @endunless
                                                    </div>
                                                </div>

                                                <div class="replyButton">
                                                    <button data-target="replyM{{$message->id}}" class="btn modal-trigger">Reply</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="delete-message-modal{{$message->id}}" class="modal">
                                        <div class="modal-content">
                                            <div><h4>Are you sure you want to delete this message?</h4></div>
                                            <form action="{{route('foodie.message.delete', $message->id)}}">
                                                {{csrf_field()}}
                                                <div>
                                                    <input type="submit" class="btn" value="delete">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endunless
                    </div>
                </div>
            </div>


            @unless($messages->count()<1)
                @foreach($messages as $message)
                    <div id="replyM{{$message->id}}" class="modal">
                        <div class="modal-content">
                            @foreach($foodies as $foodie)
                                @if($foodie->id == $message->sender_id)
                                    <h4>Receiver: {{$foodie->username}}</h4>
                                @endif
                            @endforeach
                            <form id="replyForm{{$message->id}}" action="{{route('chef.message.reply', $message->sender_id)}}"
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
                @endforeach
            @endunless

        </div>
    </div>
@endsection