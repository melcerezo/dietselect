@extends('layouts.app')
@section('head')
    <script src="/js/admin/admin.js" defer></script>
@endsection

@section('content')
    <nav>
        <div class="nav-wrapper light-green lighten-1">
            <div style="margin-left: 10px;">
                <a href="{{route("admin.dashboard")}}" class="brand-logo">Admin Panel</a>
            </div>
            <ul class="right hide-on-med-and-down">
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
                    <a href="{{route("admin.commissions")}}">
                        <span class="valign-wrapper" style="position: relative;">
                            <span style="margin-left: 2px;">
                                Commissions
                            </span>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.foodies')}}">
                        <span class="valign-wrapper">
                            <span style="margin-left: 2px;">
                                Foodies
                            </span>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.chefs')}}">
                        <span class="valign-wrapper">
                            <span style="margin-left: 2px;">
                                Chefs
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

                <li>
                    <form id="logout" method="post" action="{{ route('admin.logout') }}">
                        {{ csrf_field() }}
                        <a id="logout-link" class="nvItLnk" href="#">
                            {{--<i class="fa fa-sign-out" aria-hidden="true"></i>--}}
                            <span class="hide-on-med-and-down">Logout</span>
                        </a>
                    </form>
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
                    <li class="collection-item"><a href="{{route('admin.commissions')}}">Commissions</a></li>
                    <li class="collection-item"><a href="#">Orders</a></li>
                    <li class="collection-item"><a href="#">Foodies</a></li>
                    <li class="collection-item"><a href="{{route('admin.chefs')}}">Chefs</a></li>
                </ul>
            </div>
            <div class="col s12 m5">
                <div class="card">
                    <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                        <div>
                            <span>
                                Unpaid Commissions
                            </span>
                            <span class="badge light-green white-text" style="border-radius: 15px">
                                {{$commissions->count()}}
                            </span>
                        </div>
                    </div>
                    <div class="card-content">
                        @if($commissions->count()!=0)
                        <div>
                            <table class="">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Company Name</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($commissions->take(5) as $commission)
                                    <tr>
                                        <td>{{$commission->id}}</td>
                                        <td>
                                            @foreach($chefs as $chef)
                                                @if($chef->id==$commission->chef_id)
                                                    {{$chef->name}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{$commission->created_at->format('F d, Y')}}</td>
                                        <td>{{'PHP'.number_format($commission->amount,2,'.','')}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div>
                                <a href="{{route('admin.commissions')}}">See All</a>
                            </div>
                        </div>
                        @else
                            <div>
                                <span>No Unpaid Commissions</span>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
            <div class="col s12 m5">
                <div class="card">
                    <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                        <div>
                            <span>
                                Paid Commissions
                            </span>
                            <span class="badge light-green white-text" style="border-radius: 15px">
                                {{$paidCommissions->count()}}
                            </span>
                        </div>
                    </div>
                    <div class="card-content">
                        @if($paidCommissions->count()!=0)
                            <div>
                                <table class="">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Company Name</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($paidCommissions->take(5) as $commission)
                                        <tr>
                                            <td>{{$commission->id}}</td>
                                            <td>
                                                @foreach($chefs as $chef)
                                                    @if($chef->id==$commission->chef_id)
                                                        {{$chef->name}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{$commission->created_at->format('F d, Y')}}</td>
                                            <td>{{'PHP'.number_format($commission->amount,2,'.','')}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div>
                                    <a href="{{route('admin.commissions')}}">See All</a>
                                </div>
                            </div>
                            @else
                                <div>
                                    <span>No Paid Commissions</span>
                                </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m5 offset-m2">
               <div class="card">
                    <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
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
                            <table class="">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>User Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($foodies->take(5) as $foodie)
                                        <tr>
                                            <td>{{$foodie->id}}</td>
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
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <a href="{{route('admin.foodies')}}">See All</a>
                        </div>
                    </div>
               </div>
                <div class="card">
                    <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                        <div>
                            <span>
                                Vendors
                            </span>
                            <span class="badge light-green white-text" style="border-radius: 15px">
                                {{$chefs->count()}}
                            </span>
                        </div>
                    </div>
                    <div class="card-content">
                        <div>
                            <table class="">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Company Name</th>
                                    <th>User Name</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($chefs->take(5) as $chef)
                                    <tr>
                                        <td>{{$chef->id}}</td>
                                        <td>{{$chef->name}}</td>
                                        <td>{{$chef->url_name}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <a href="{{route('admin.chefs')}}">See All</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m5">
                <div class="card">
                    <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                        <div>
                            <span>
                                Plans
                            </span>
                            <span class="badge light-green white-text" style="border-radius: 15px">
                                {{$plans->count()}}
                            </span>
                        </div>
                    </div>
                    <div class="card-content">
                        <div>
                            <table class="">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Plan Name</th>
                                    <th>Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($plans->take(5) as $plan)
                                    <tr>
                                        <td>{{$plan->id}}</td>
                                        <td>{{$plan->plan_name}}</td>
                                        <td>{{'PHP'.number_format($plan->price, 2, '.', '')}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <a href="#">See All</a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                        <div>
                            <span>
                                Orders
                            </span>
                            <span class="badge light-green white-text" style="border-radius: 15px">
                                {{$orders->count()}}
                            </span>
                        </div>
                    </div>
                    <div class="card-content">
                        <div>
                            <table class="">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders->take(5) as $order)
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->created_at->format('F d, Y')}}</td>
                                        <td>{{'PHP'.number_format($order->total, 2, '.', '')}}</td>
                                        <td>
                                            @if($order->is_cancelled==0)
                                                @if($order->is_paid==0)
                                                    <span>Pending</span>
                                                @elseif($order->is_paid==1)
                                                    <span>Paid</span>
                                                @endif
                                            @elseif($order->is_cancelled==1)
                                                <span>Cancelled</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <a href="#">See All</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection