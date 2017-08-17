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
                    <a href="{{route("admin.dashboard")}}">
                        <span class="valign-wrapper" style="position: relative;">
                            <span style="margin-left: 2px;">
                                Dashboard
                            </span>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="valign-wrapper">
                            <span style="margin-left: 2px;">
                                Users
                            </span>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#">
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
                    <li class="collection-item light-green lighten-1 white-text">
                        <span class="collection-header">
                            Admin
                        </span>
                    </li>
                    <li class="collection-item"><a href="#">Commissions</a></li>
                    <li class="collection-item"><a href="#">Orders</a></li>
                    <li class="collection-item"><a href="#">Foodies</a></li>
                    <li class="collection-item"><a href="#">Chefs</a></li>
                </ul>
            </div>
            <div class="col s12 m5">
               <div class="card">
                    <div class="grey lighten-3" style="width: 100%; border-bottom: solid lightgray 1px;">
                        <div>
                            <span>
                                Users
                            </span>
                            <span class="badge light-green white-text" style="border-radius: 15px">
                                {{$foodies->count()}}
                            </span>
                        </div>
                    </div>
                    <div class="card-content">
                        <div>
                            <table>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>User Name</th>
                                </tr>
                                @foreach($foodies->take(5) as $foodie)
                                    <tr>
                                        <td>{{$foodie->first_name}}</td>
                                        <td>{{$foodie->last_name}}</td>
                                        <td>
                                            @if($foodie->username!="")
                                                {{$foodie->username}}
                                            @else
                                                <span>N/A</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
               </div>
                <div class="card">
                    <div class="modal-content">

                    </div>
                </div>
            </div>
            <div class="col s12 m5">

            </div>
        </div>
    </div>



@endsection