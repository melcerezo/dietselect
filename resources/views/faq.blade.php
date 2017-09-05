@extends('layouts.app')
@section('head')

@endsection
@section('content')
    <nav>
        <div class="nav-wrapper light-green">
            <a href="#" class="brand-logo">Diet Select FAQ</a>
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
                                <span class="collection-header">Frequently Asked Questions</span>
                            </li>
                            <li class="collection-item"><span>Q: What is DietSelect?</span></li>
                            <li class="collection-item"><span>A: We are a website that connects you to various diet delivery services around Metro Manila.</span></li>
                            <li class="collection-item"><span>Q: What is a diet delivery service?</span></li>
                            <li class="collection-item"><span>A: Diet Delivery Services are services that offer you healthy, nutritious diets and deliver them to you.</span></li>
                            <li class="collection-item"><span>Q: Do I get to customize my diet?</span></li>
                            <li class="collection-item"><span>A: Yes you can! DietSelect allows you to customize your meals to your specific needs.</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection