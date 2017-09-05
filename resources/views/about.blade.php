@extends('layouts.app')
@section('head')

@endsection
@section('content')
    <nav>
        <div class="nav-wrapper light-green">
            <a href="#" class="brand-logo">Diet Select</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li>
                    <a href="{{route('welcome')}}">
                        <span style="margin-left: 2px;">Back To Welcome Page</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <ul class="collection">
                            <li class="collection-item light-green white-text">
                                <span class="collection-header">About</span>
                            </li>
                            <li class="collection-item"><a href="{{route('disclaimer')}}"></a></li>
                            <li class="collection-item"><a href="{{route('faq')}}"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection