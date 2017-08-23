@extends("layouts.app")
@section('head')
    <script src="/js/admin/admin.js" defer></script>
@endsection

@section('content')
    <nav>
        <div class="nav-wrapper light-green lighten-1">
            <div style="margin-left: 10px;">
                <a href="{{route("admin.dashboard")}}" class="brand-logo">Admin Panel</a>
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
                    <a href="{{route('admin.orders')}}">
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
                    <li class="collection-item"><a href={{route('admin.orders)}}>Orders</a></li>
                    <li class="collection-item"><a href="{{route('admin.foodies')}}">Foodies</a></li>
                    <li class="collection-item"><a href="{{route('admin.chefs')}}">Chefs</a></li>
                </ul>
            </div>
            <div class="col s12 m10">
                <div class="card">
                    <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                        <div>
                            <span>
                                {{$chef->name}}
                            </span>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="row">
                            <div class="col s12 m6">
                                <div class="card-panel">
                                    <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                                        <div>
                                            <span>
                                                Latest Orders
                                            </span>
                                        </div>
                                    </div>
                                    <table class="responsive-table centered" style="table-layout: fixed;">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Plan Name</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                                <th>Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orderPlanNames as $orderItem)
                                                @if($orderItem['is_cancelled']!=1&&$orderItem['is_paid']==1)
                                                    <tr>
                                                        <td>{{$orderItem['id']}}</td>
                                                        <td>
                                                            {{$orderItem['plan_name']}}
                                                        </td>
                                                        <td>{{$orderItem['quantity']}}</td>
                                                        <td>{{'PHP'.$orderItem['price']}}</td>
                                                        <td>
                                                            {{$orderItem['type']}}
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col s12 m6">
                                <div class="card-panel">
                                    <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                                        <div>
                                            <span>
                                                Cancelled Orders
                                            </span>
                                        </div>
                                    </div>
                                    <table class="responsive-table centered" style="table-layout: fixed;">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Plan Name</th>
                                            <th>Quantity</th>
                                            <th>Amount</th>
                                            <th>Type</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orderPlanNames as $orderItem)
                                            @if($orderItem['is_cancelled']==1)
                                                <tr>
                                                    <td>{{$orderItem['id']}}</td>
                                                    <td>
                                                        {{$orderItem['plan_name']}}
                                                    </td>
                                                    <td>{{$orderItem['quantity']}}</td>
                                                    <td>{{'PHP'.$orderItem['price']}}</td>
                                                    <td>
                                                        {{$orderItem['type']}}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6">
                                <div class="card-panel">
                                    <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                                        <div>
                                            <span>
                                                Commission
                                            </span>
                                        </div>
                                    </div>
                                    <table class="responsive-table centered" style="table-layout: fixed;">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($commissions as $commission)
                                                <tr>
                                                    <td>{{$commission->id}}</td>
                                                    <td>{{'PHP'.number_format($commission->amount,2,'.','')}}</td>
                                                    <td>
                                                        @if($commission->paid==0)
                                                            <span>Unpaid</span>
                                                        @elseif($commission->paid==1)
                                                            <span>Paid</span>
                                                        @endif
                                                    </td>
                                                    <td>{{$commission->created_at->format('F d, Y')}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col s12 m6">
                                <div class="card-panel">
                                    <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                                        <div>
                                            <span>
                                                Plans
                                            </span>
                                        </div>
                                    </div>
                                    <table class="responsive-table centered" style="table-layout: fixed;">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Plan Name</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($plans as $plan)
                                            <tr>
                                                <td>{{$plan->id}}</td>
                                                <td>{{$plan->plan_name}}</td>
                                                <td>{{$plan->price}}</td>
                                                <td>{{$plan->created_at->format('F d, Y')}}</td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection