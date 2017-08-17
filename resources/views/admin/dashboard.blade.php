@extends('layouts.app')
@section('head')

@endsection

@section('content')
    <nav>
        <div class="nav-wrapper light-green lighten-1">
            <div style="margin-left: 10px;">
                <a href="#!" class="brand-logo">Admin Panel</a>
            </div>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li>
                    <a>
                        <span class="valign-wrapper" style="position: relative;">
                            <span style="margin-left: 2px;">
                                Dashboard
                            </span>
                        </span>
                    </a>
                </li>
                <li>
                    <a>
                        <span class="valign-wrapper">
                            <span style="margin-left: 2px;">
                                Users
                            </span>
                        </span>
                    </a>
                </li>
                <li>
                    <a>
                        <span style="margin-left: 2px;">
                            Orders
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container" style="width: 85%;">
        <div class="row">
            <div class="col s12 m2">
                <ul class="collection">
                    <li class="collection-item">
                        <span></span>
                    </li>
                    <li class="collection-item"><a href="#">Commissions</a></li>
                    <li class="collection-item"><a href="#">Orders</a></li>
                    <li class="collection-item"><a href="#">Foodies</a></li>
                    <li class="collection-item"><a href="#">Chefs</a></li>
                </ul>
            </div>
            <div>

            </div>
        </div>
    </div>



@endsection