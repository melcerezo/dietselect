@extends('layouts.app')
@section('head')

@endsection

@section('content')
    <nav>
        <div class="nav-wrapper light-green lighten-1">
            <div style="margin-left: 10px;">
                <a href="#!" class="brand-logo">Diet Select</a>
            </div>
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


    {{"Hello This is the admin page!"}}
@endsection