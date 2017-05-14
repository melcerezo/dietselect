@extends('layouts.app')
@section('head')
    <style>
        #email-list .collection .collection-item:hover{
            background: #e1f5fe;
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <nav>
        <div class="nav-wrapper light-green lighten-1">
            <a href="#" class="brand-logo">Diet Select</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li>
                    <a>
                        <span class="valign-wrapper" style="position: relative;">
                            <i class="material-icons" style="display: inline">email</i>
                            <span style="margin-left: 2px;">
                                Messages
                                <span class="new badge red">4</span>
                            </span>
                        </span>
                    </a>
                </li>
                <li>
                    <a>
                        <span class="valign-wrapper">
                            <i class="material-icons" style="display: inline">announcement</i>
                            <span style="margin-left: 2px;">
                                Notifications
                                <span class="new badge red">2</span>
                            </span>
                        </span>
                    </a>
                </li>
                <li>
                    <a>
                        <img class="circle" src="/img/user.jpg" style="width: 40px; height: 40px; position: relative;">
                        <span style="margin-left: 2px;">Profile</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container" style="width:85%;">
        <div id="mail-app" style="padding-top: 1rem;
            padding-bottom: 1rem;">
            <div class="row">
                <div class="col s12">
                    <nav class="light-green lighten-1">
                        <div class="nav-wrapper">
                            <div class="left col s12 m5 l5">
                                <ul>
                                    <li>
                                        <span>Inbox</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="left col s12 m7 l7 hide-on-med-and-down">
                                <ul class="right">
                                    <li>
                                        <a href="#!"><i class="material-icons">edit</i></a>
                                    </li>
                                    <li>
                                        <a href="#!"><i class="material-icons">delete</i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <div id="email-list" class="col s12 m3 l3 card-panel" style="margin: 0; padding: 0;">
                        <ul class="collection" style="margin: 0; padding: 0;">
                            <li class="collection-item" style="position: relative;
                                height: auto;
                                background: #e1f5fe;
                                border-left: 4px solid #29b6f6;">
                                <img class="circle" style="width: 50px;" src="/img/user.jpg">
                                <span class="message-title">Chef 1</span>
                                <p class="truncate grey-text">I have received your payment for plan 5.</p>
                                <a href="#!" class="secondary-content" style="position: absolute; bottom: 80px; right: 18px;">
                                    <span class="blue-text">12:15am</span>
                                </a>
                            </li>
                            <li class="collection-item" style="position: relative;
                                height: auto;">
                                <img class="circle" style="width: 50px;" src="/img/user.jpg">
                                <span class="message-title">Chef 2</span>
                                <p class="truncate grey-text">I have received your payment for plan 5.</p>
                                <a href="#!" class="secondary-content" style="position: absolute; bottom: 80px; right: 18px;">
                                    <span class="blue-text">12:15am</span>
                                </a>
                            </li>
                            <li class="collection-item" style="position: relative;
                                height: auto;">
                                <img class="circle" style="width: 50px;" src="/img/user.jpg">
                                <span class="message-title">Chef 3</span>
                                <p class="truncate grey-text">I have received your payment for plan 5.</p>
                                <a href="#!" class="secondary-content" style="position: absolute; bottom: 80px; right: 18px;">
                                    <span class="blue-text">12:15am</span>
                                </a>
                            </li>
                            <li class="collection-item" style="position: relative;
                                height: auto;">
                                <img class="circle" style="width: 50px;" src="/img/user.jpg">
                                <span class="message-title">Chef 4</span>
                                <p class="truncate grey-text">I have received your payment for plan 5.</p>
                                <a href="#!" class="secondary-content" style="position: absolute; bottom: 80px; right: 18px;">
                                    <span class="blue-text">12:15am</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div id="email-details" class="col s12 m9 l9 card-panel" style="margin: 0;">
                        <p class="email-subject truncate">Payment Received</p>
                        <hr class="grey-text text-lighten-2">
                        <div class="email-content-wrap">
                            <div class="row">
                                <div class="col s10 m10 l10">
                                    <ul class="collection" style="border: none;">
                                        <li class="collection-item">
                                            <img class="circle" style="width:50px;" src="/img/user.jpg">
                                            <span class="email-title">Chef 1</span>
                                            <p class="grey-text ">To me, Melchor Cerezo</p>
                                            <p class="grey-text">Yesterday</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col s2 m2 l2 email-actions" style="padding-top: 32px;">
                                    <a href="#!"><span><i class="material-icons">reply</i></span></a>
                                </div>
                            </div>
                            <div class="email-content">
                                <p>Hello, Melchor Cerezo</p>
                                <p>We have received your payment for plan 5</p>
                                <p>Thank you!</p>
                                <p>Chef 1</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
