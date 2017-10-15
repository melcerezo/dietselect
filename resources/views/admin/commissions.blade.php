@extends("layouts.app")
@section('head')
    <style>
        .activeTab{
            border-bottom: 4px solid #f57c00;
        }
        .activeTab a{
            color: #f57c00;
        }

        .chefCom{
            display: none;
        }
    </style>
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
        <div class="row" style="margin-top: 5px;">
            <div class="col s12 m2">
                <ul class="collection">
                    <li class="collection-item light-green lighten-1 white-text">
                        <span class="collection-header">
                            Admin
                        </span>
                    </li>
                    <li class="collection-item"><a href="{{route('admin.commissions')}}">Commissions</a></li>
                    <li class="collection-item"><a href="{{route('admin.orders')}}">Orders</a></li>
                    <li class="collection-item"><a href="{{route('admin.foodies')}}">Foodies</a></li>
                    <li class="collection-item"><a href="{{route('admin.chefs')}}">Chefs</a></li>
                </ul>

                @foreach($uniqueComArray as $comArray)
                    <ul id="chef{{$comArray['id']}}" data-id="{{$comArray['id']}}" class="collection chefCom" style="margin-top: 0;">
                        <li class="collection-item grey lighten-3">
                         <span>
                            Total Commissions For
                             @foreach($chefs as $chef)
                                 @if($chef->id==$comArray['id'])
                                     <span>{{$chef->name}}</span>
                                 @endif
                             @endforeach
                        </span>
                        </li>
                        <li class="collection-item"><div>Total Commissions:</div> <span style="font-size: 14px;">{{'PHP '.number_format($comArray['total'],2,'.',',')}}</span></li>
                        <li class="collection-item"><div>Total Unpaid Commissions:</div> <span style="font-size: 14px;">{{'PHP '.number_format($comArray['pend'],2,'.',',')}}</span></li>
                        <li class="collection-item"><div>Total Paid Commissions:</div> <span style="font-size: 14px;">{{'PHP '.number_format($comArray['paid'],2,'.',',')}}</span></li>
                    </ul>
                @endforeach

                <ul id="sumAll" class="collection" style="margin-top: 0;">
                    <li class="collection-item grey lighten-3">
                         <span>
                            Total Commissions From {{$firstCom->created_at->format('F d, Y')}} To {{$lastCom->created_at->format('F d, Y')}}
                        </span>
                    </li>
                    <li class="collection-item"><div>Total Commissions:</div> <span style="font-size: 14px;">{{'PHP '.number_format($totalCommissions,2,'.',',')}}</span></li>
                    <li class="collection-item"><div>Total Unpaid Commissions:</div> <span style="font-size: 14px;">{{'PHP '.number_format($pendCommissions,2,'.',',')}}</span></li>
                    <li class="collection-item"><div>Total Paid Commissions:</div> <span style="font-size: 14px;">{{'PHP '.number_format($paidCommissions,2,'.',',')}}</span></li>
                </ul>
            </div>
            <div class="col s12 m10">
                <div class="row">
                    <div class="col s12 m3">
                        <div>
                            <span>Search by Chef:</span>
                        </div>
                        <select id="chefFilter">
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div id="chefsContainer">
                    </div>
                    <div id="divChefsAll">
                        @foreach($uniqueComChefs as $uniqueComChef)
                            <div class="card">
                                <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                                    <div>
                                        <span>
                                            Commissions -
                                            @foreach($chefs as $chef)
                                                @if($chef->id==$uniqueComChef)
                                                    <span>{{$chef->name}}</span>
                                                @endif
                                            @endforeach
                                        </span>
                                        <span class="badge light-green white-text" style="border-radius: 15px">
                                            {{$commissions->where('chef_id','=',$uniqueComChef)->count()}}
                                        </span>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="row">
                                        @foreach($uniqueComArray as $comArray)
                                            @if($comArray['id']==$uniqueComChef)
                                                <div class="col s12 m4">
                                                    <span>Total: {{'PHP '.number_format($comArray['total'],2,'.',',')}}</span>
                                                </div>
                                                <div class="col s12 m4">
                                                    <span>Total Unpaid: {{'PHP '.number_format($comArray['pend'],2,'.',',')}}</span>
                                                </div>
                                                <div class="col s12 m4">
                                                    <span>Total Paid: {{'PHP '.number_format($comArray['paid'],2,'.',',')}}</span>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="divider">
                                    </div>
                                    <table class="responsive-table">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            {{--<th>Chef Name</th>--}}
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Paid</th>
                                            <th>Update</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($commissions->where('chef_id','=',$uniqueComChef) as $commission)
                                            <tr>
                                                <td>{{$commission->id}}</td>
                                                {{--<td>--}}
                                                    {{--@foreach($chefs as $chef)--}}
                                                        {{--@if($chef->id == $commission->chef_id)--}}
                                                            {{--{{$chef->name}}--}}
                                                        {{--@endif--}}
                                                    {{--@endforeach--}}
                                                {{--</td>--}}
                                                <td>{{$commission->created_at->format('F d, Y')}}</td>
                                                <td>{{'PHP '.number_format($commission->amount,2,'.',',')}}</td>
                                                <td>
                                                    @if($commission->paid==0)
                                                        <span>Not Paid</span>
                                                    @elseif($commission->paid==1)
                                                        <span>Paid</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($commission->paid==0)
                                                        <form method="post" action="{{route('admin.pay',$commission->id)}}">
                                                            {{ csrf_field() }}
                                                            <button type="submit" class="btn btn-primary waves-light waves-effect">Update</button>
                                                        </form>
                                                    @elseif($commission->paid==1)
                                                        <span>Paid</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
                {{--<div class="row">--}}
                    {{--<div class="col s12 m7">--}}
                        {{--<div id="allLinkContain" class="col s2 center"><a href="#!" class="allLink">All</a></div>--}}
                        {{--<div id="pendLinkContain" class="col s2 center"><a href="#!" class="pendLink">Pending</a></div>--}}
                        {{--<div id="paidLinkContain" class="col s2 center"><a href="#!" class="paidLink">Paid</a></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="row">--}}
                    {{--<div class="col s12">--}}
                        {{--<div id="allCom">--}}
                            {{--<div class="row">--}}
                                {{--<div class="col s12 m3">--}}
                                    {{--<div>--}}
                                        {{--<span>Search by Interval:</span>--}}
                                    {{--</div>--}}
                                    {{--<select id="orderFilter">--}}
                                        {{--<option value="0" disabled>Pick an interval</option>--}}
                                        {{--<option value="1">Today</option>--}}
                                        {{--<option value="5">All</option>--}}
                                        {{--<option value="2">This Week</option>--}}
                                        {{--<option value="3">This Month</option>--}}
                                        {{--<option value="4">This Year</option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div id="dayCom">--}}
                                {{--<div class="card">--}}
                                    {{--<div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">--}}
                                        {{--<div>--}}
                                            {{--<span>--}}
                                                {{--Commissions--}}
                                            {{--</span>--}}
                                            {{--<span class="badge light-green white-text" style="border-radius: 15px">--}}
                                                {{--{{$commissions->where('created_at','>',$thisDay)->count()}}--}}
                                            {{--</span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="card-content">--}}
                                        {{--<table class="responsive-table">--}}
                                            {{--<thead>--}}
                                            {{--<tr>--}}
                                                {{--<th>ID</th>--}}
                                                {{--<th>Chef Name</th>--}}
                                                {{--<th>Date</th>--}}
                                                {{--<th>Amount</th>--}}
                                                {{--<th>Paid</th>--}}
                                                {{--<th>Update</th>--}}
                                            {{--</tr>--}}
                                            {{--</thead>--}}
                                            {{--<tbody>--}}
                                            {{--@foreach($commissions->where('created_at','>',$thisDay) as $commission)--}}
                                                {{--<tr>--}}
                                                    {{--<td>{{$commission->id}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@foreach($chefs as $chef)--}}
                                                            {{--@if($chef->id == $commission->chef_id)--}}
                                                                {{--{{$chef->name}}--}}
                                                            {{--@endif--}}
                                                        {{--@endforeach--}}
                                                    {{--</td>--}}
                                                    {{--<td>{{$commission->created_at->format('F d, Y')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format($commission->amount,2,'.',',')}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<span>Not Paid</span>--}}
                                                        {{--@elseif($commission->paid==1)--}}
                                                            {{--<span>Paid</span>--}}
                                                        {{--@endif--}}
                                                    {{--</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<form method="post" action="{{route('admin.pay',$commission->id)}}">--}}
                                                                {{--{{ csrf_field() }}--}}
                                                                {{--<button type="submit" class="btn btn-primary waves-light waves-effect">Update</button>--}}
                                                            {{--</form>--}}
                                                        {{--@elseif($commission->paid==1)--}}
                                                            {{--<span>Paid</span>--}}
                                                        {{--@endif--}}
                                                    {{--</td>--}}
                                                {{--</tr>--}}
                                            {{--@endforeach--}}
                                            {{--</tbody>--}}
                                        {{--</table>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div id="weekCom">--}}
                                {{--<div class="card">--}}
                                    {{--<div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">--}}
                                        {{--<div>--}}
                                            {{--<span>--}}
                                                {{--Commissions From {{$startOfTheWeek->format('F d, Y')}} to {{$endOfWeek->format('F d, Y')}}--}}
                                            {{--</span>--}}
                                            {{--<span class="badge light-green white-text" style="border-radius: 15px">--}}
                                                {{--{{$commissions->where('created_at','>',$startOfTheWeek)->where('created_at','<',$endOfWeek)->count()}}--}}
                                            {{--</span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="card-content">--}}
                                        {{--<table class="responsive-table">--}}
                                            {{--<thead>--}}
                                            {{--<tr>--}}
                                                {{--<th>ID</th>--}}
                                                {{--<th>Chef Name</th>--}}
                                                {{--<th>Date</th>--}}
                                                {{--<th>Amount</th>--}}
                                                {{--<th>Paid</th>--}}
                                                {{--<th>Update</th>--}}
                                            {{--</tr>--}}
                                            {{--</thead>--}}
                                            {{--<tbody>--}}
                                            {{--@foreach($commissions->where('created_at','>',$startOfTheWeek)->where('created_at','<',$endOfWeek) as $commission)--}}
                                                {{--<tr>--}}
                                                    {{--<td>{{$commission->id}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@foreach($chefs as $chef)--}}
                                                            {{--@if($chef->id == $commission->chef_id)--}}
                                                                {{--{{$chef->name}}--}}
                                                            {{--@endif--}}
                                                        {{--@endforeach--}}
                                                    {{--</td>--}}
                                                    {{--<td>{{$commission->created_at->format('F d, Y')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format($commission->amount,2,'.',',')}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<span>Not Paid</span>--}}
                                                        {{--@elseif($commission->paid==1)--}}
                                                            {{--<span>Paid</span>--}}
                                                        {{--@endif--}}
                                                    {{--</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<form method="post" action="{{route('admin.pay',$commission->id)}}">--}}
                                                                {{--{{ csrf_field() }}--}}
                                                                {{--<button type="submit" class="btn btn-primary waves-light waves-effect">Update</button>--}}
                                                            {{--</form>--}}
                                                        {{--@elseif($commission->paid==1)--}}
                                                            {{--<span>Paid</span>--}}
                                                        {{--@endif--}}
                                                    {{--</td>--}}
                                                {{--</tr>--}}
                                            {{--@endforeach--}}
                                            {{--</tbody>--}}
                                        {{--</table>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div id="monthCom">--}}
                                {{--<div class="card">--}}
                                    {{--<div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">--}}
                                        {{--<div>--}}
                                            {{--<span>--}}
                                                {{--Commissions From {{$startOfMonth->format('F d, Y')}} to {{$endOfMonth->format('F d, Y')}}--}}
                                            {{--</span>--}}
                                            {{--<span class="badge light-green white-text" style="border-radius: 15px">--}}
                                                {{--{{$commissions->where('created_at','>',$startOfMonth)->where('created_at','<',$endOfMonth)->count()}}--}}
                                            {{--</span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="card-content">--}}
                                        {{--<table class="responsive-table">--}}
                                            {{--<thead>--}}
                                            {{--<tr>--}}
                                                {{--<th>ID</th>--}}
                                                {{--<th>Chef Name</th>--}}
                                                {{--<th>Date</th>--}}
                                                {{--<th>Amount</th>--}}
                                                {{--<th>Paid</th>--}}
                                                {{--<th>Update</th>--}}
                                            {{--</tr>--}}
                                            {{--</thead>--}}
                                            {{--<tbody>--}}
                                            {{--@foreach($commissions->where('created_at','>',$startOfMonth)->where('created_at','<',$endOfMonth) as $commission)--}}
                                                {{--<tr>--}}
                                                    {{--<td>{{$commission->id}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@foreach($chefs as $chef)--}}
                                                            {{--@if($chef->id == $commission->chef_id)--}}
                                                                {{--{{$chef->name}}--}}
                                                            {{--@endif--}}
                                                        {{--@endforeach--}}
                                                    {{--</td>--}}
                                                    {{--<td>{{$commission->created_at->format('F d, Y')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format($commission->amount,2,'.',',')}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<span>Not Paid</span>--}}
                                                        {{--@elseif($commission->paid==1)--}}
                                                            {{--<span>Paid</span>--}}
                                                        {{--@endif--}}
                                                    {{--</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<form method="post" action="{{route('admin.pay',$commission->id)}}">--}}
                                                                {{--{{ csrf_field() }}--}}
                                                                {{--<button type="submit" class="btn btn-primary waves-light waves-effect">Update</button>--}}
                                                            {{--</form>--}}
                                                        {{--@elseif($commission->paid==1)--}}
                                                            {{--<span>Paid</span>--}}
                                                        {{--@endif--}}
                                                    {{--</td>--}}
                                                {{--</tr>--}}
                                            {{--@endforeach--}}
                                            {{--</tbody>--}}
                                        {{--</table>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div id="yearCom">--}}
                                {{--<div class="card">--}}
                                    {{--<div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">--}}
                                        {{--<div>--}}
                                            {{--<span>--}}
                                                {{--Commissions From {{$startOfYear->format('F d, Y')}} to {{$endOfYear->format('F d, Y')}}--}}
                                            {{--</span>--}}
                                            {{--<span class="badge light-green white-text" style="border-radius: 15px">--}}
                                                {{--{{$commissions->where('created_at','>',$startOfYear)->where('created_at','<',$endOfYear)->count()}}--}}
                                            {{--</span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="card-content">--}}
                                        {{--<table class="responsive-table">--}}
                                            {{--<thead>--}}
                                            {{--<tr>--}}
                                                {{--<th>ID</th>--}}
                                                {{--<th>Chef Name</th>--}}
                                                {{--<th>Date</th>--}}
                                                {{--<th>Amount</th>--}}
                                                {{--<th>Paid</th>--}}
                                                {{--<th>Update</th>--}}
                                            {{--</tr>--}}
                                            {{--</thead>--}}
                                            {{--<tbody>--}}
                                            {{--@foreach($commissions->where('created_at','>',$startOfYear)->where('created_at','<',$endOfYear) as $commission)--}}
                                                {{--<tr>--}}
                                                    {{--<td>{{$commission->id}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@foreach($chefs as $chef)--}}
                                                            {{--@if($chef->id == $commission->chef_id)--}}
                                                                {{--{{$chef->name}}--}}
                                                            {{--@endif--}}
                                                        {{--@endforeach--}}
                                                    {{--</td>--}}
                                                    {{--<td>{{$commission->created_at->format('F d, Y')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format($commission->amount,2,'.',',')}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<span>Not Paid</span>--}}
                                                        {{--@elseif($commission->paid==1)--}}
                                                            {{--<span>Paid</span>--}}
                                                        {{--@endif--}}
                                                    {{--</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<form method="post" action="{{route('admin.pay',$commission->id)}}">--}}
                                                                {{--{{ csrf_field() }}--}}
                                                                {{--<button type="submit" class="btn btn-primary waves-light waves-effect">Update</button>--}}
                                                            {{--</form>--}}
                                                        {{--@elseif($commission->paid==1)--}}
                                                            {{--<span>Paid</span>--}}
                                                        {{--@endif--}}
                                                    {{--</td>--}}
                                                {{--</tr>--}}
                                            {{--@endforeach--}}
                                            {{--</tbody>--}}
                                        {{--</table>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div id="comAll" class="card">--}}
                                {{--<div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">--}}
                                    {{--<div>--}}
                                        {{--<span>--}}
                                            {{--Commissions From {{$firstCom->created_at->format('F d, Y')}} To {{$lastCom->created_at->format('F d, Y')}}--}}
                                        {{--</span>--}}
                                         {{--<span class="badge light-green white-text" style="border-radius: 15px">--}}
                                            {{--{{$commissions->count()}}--}}
                                        {{--</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="card-content">--}}
                                    {{--<table class="responsive-table">--}}
                                        {{--<thead>--}}
                                            {{--<tr>--}}
                                                {{--<th>ID</th>--}}
                                                {{--<th>Chef Name</th>--}}
                                                {{--<th>Date</th>--}}
                                                {{--<th>Amount</th>--}}
                                                {{--<th>Paid</th>--}}
                                                {{--<th>Update</th>--}}
                                            {{--</tr>--}}
                                        {{--</thead>--}}
                                        {{--<tbody>--}}
                                            {{--@foreach($commissions as $commission)--}}
                                                {{--<tr>--}}
                                                    {{--<td>{{$commission->id}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@foreach($chefs as $chef)--}}
                                                            {{--@if($chef->id == $commission->chef_id)--}}
                                                                {{--{{$chef->name}}--}}
                                                            {{--@endif--}}
                                                        {{--@endforeach--}}
                                                    {{--</td>--}}
                                                    {{--<td>{{$commission->created_at->format('F d, Y')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format($commission->amount,2,'.',',')}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<span>Not Paid</span>--}}
                                                        {{--@elseif($commission->paid==1)--}}
                                                            {{--<span>Paid</span>--}}
                                                        {{--@endif--}}
                                                    {{--</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<form method="post" action="{{route('admin.pay',$commission->id)}}">--}}
                                                                {{--{{ csrf_field() }}--}}
                                                                {{--<button type="submit" class="btn btn-primary waves-light waves-effect">Update</button>--}}
                                                            {{--</form>--}}
                                                        {{--@elseif($commission->paid==1)--}}
                                                            {{--<span>Paid</span>--}}
                                                        {{--@endif--}}
                                                    {{--</td>--}}
                                                {{--</tr>--}}
                                            {{--@endforeach--}}
                                        {{--</tbody>--}}
                                    {{--</table>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div id="pendCom">--}}
                            {{--<div class="row">--}}
                                {{--<div class="col s12 m3">--}}
                                    {{--<div>--}}
                                        {{--<span>Search by Interval:</span>--}}
                                    {{--</div>--}}
                                    {{--<select id="pendOrderFilter">--}}
                                        {{--<option value="0" disabled>Pick an interval</option>--}}
                                        {{--<option value="1">Today</option>--}}
                                        {{--<option value="5">All</option>--}}
                                        {{--<option value="2">This Week</option>--}}
                                        {{--<option value="3">This Month</option>--}}
                                        {{--<option value="4">This Year</option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div id="dayCom">--}}
                            {{--<div class="card">--}}
                            {{--<div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">--}}
                            {{--<div>--}}
                            {{--<span>--}}
                            {{--Commissions--}}
                            {{--</span>--}}
                            {{--<span class="badge light-green white-text" style="border-radius: 15px">--}}
                            {{--{{$commissions->where('created_at','>',$thisDay)->count()}}--}}
                            {{--</span>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="card-content">--}}
                            {{--<table class="responsive-table">--}}
                            {{--<thead>--}}
                            {{--<tr>--}}
                            {{--<th>ID</th>--}}
                            {{--<th>Chef Name</th>--}}
                            {{--<th>Date</th>--}}
                            {{--<th>Amount</th>--}}
                            {{--<th>Paid</th>--}}
                            {{--<th>Update</th>--}}
                            {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}
                            {{--@foreach($commissions->where('created_at','>',$thisDay) as $commission)--}}
                            {{--<tr>--}}
                            {{--<td>{{$commission->id}}</td>--}}
                            {{--<td>--}}
                            {{--@foreach($chefs as $chef)--}}
                            {{--@if($chef->id == $commission->chef_id)--}}
                            {{--{{$chef->name}}--}}
                            {{--@endif--}}
                            {{--@endforeach--}}
                            {{--</td>--}}
                            {{--<td>{{$commission->created_at->format('F d, Y')}}</td>--}}
                            {{--<td>{{'PHP '.number_format($commission->amount,2,'.',',')}}</td>--}}
                            {{--<td>--}}
                            {{--@if($commission->paid==0)--}}
                            {{--<span>Not Paid</span>--}}
                            {{--@elseif($commission->paid==1)--}}
                            {{--<span>Paid</span>--}}
                            {{--@endif--}}
                            {{--</td>--}}
                            {{--<td>--}}
                            {{--@if($commission->paid==0)--}}
                            {{--<form method="post" action="{{route('admin.pay',$commission->id)}}">--}}
                            {{--{{ csrf_field() }}--}}
                            {{--<button type="submit" class="btn btn-primary waves-light waves-effect">Update</button>--}}
                            {{--</form>--}}
                            {{--@elseif($commission->paid==1)--}}
                            {{--<span>Paid</span>--}}
                            {{--@endif--}}
                            {{--</td>--}}
                            {{--</tr>--}}
                            {{--@endforeach--}}
                            {{--</tbody>--}}
                            {{--</table>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div id="pendweekCom">--}}
                                {{--<div class="card">--}}
                                    {{--<div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">--}}
                                        {{--<div>--}}
                                            {{--<span>--}}
                                                {{--Pending Commissions From {{$startOfTheWeek->format('F d, Y')}} to {{$endOfWeek->format('F d, Y')}}--}}
                                            {{--</span>--}}
                                            {{--<span class="badge light-green white-text" style="border-radius: 15px">--}}
                                                {{--{{$commissions->where('paid','=',0)->where('created_at','>',$startOfTheWeek)->where('created_at','<',$endOfWeek)->count()}}--}}
                                            {{--</span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="card-content">--}}
                                        {{--<table class="responsive-table">--}}
                                            {{--<thead>--}}
                                            {{--<tr>--}}
                                                {{--<th>ID</th>--}}
                                                {{--<th>Chef Name</th>--}}
                                                {{--<th>Date</th>--}}
                                                {{--<th>Amount</th>--}}
                                                {{--<th>Paid</th>--}}
                                                {{--<th>Update</th>--}}
                                            {{--</tr>--}}
                                            {{--</thead>--}}
                                            {{--<tbody>--}}
                                            {{--@foreach($commissions->where('paid','=',0)->where('created_at','>',$startOfTheWeek)->where('created_at','<',$endOfWeek) as $commission)--}}
                                                {{--<tr>--}}
                                                    {{--<td>{{$commission->id}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@foreach($chefs as $chef)--}}
                                                            {{--@if($chef->id == $commission->chef_id)--}}
                                                                {{--{{$chef->name}}--}}
                                                            {{--@endif--}}
                                                        {{--@endforeach--}}
                                                    {{--</td>--}}
                                                    {{--<td>{{$commission->created_at->format('F d, Y')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format($commission->amount,2,'.',',')}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<span>Not Paid</span>--}}
                                                        {{--@elseif($commission->paid==1)--}}
                                                            {{--<span>Paid</span>--}}
                                                        {{--@endif--}}
                                                    {{--</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<form method="post" action="{{route('admin.pay',$commission->id)}}">--}}
                                                                {{--{{ csrf_field() }}--}}
                                                                {{--<button type="submit" class="btn btn-primary waves-light waves-effect">Update</button>--}}
                                                            {{--</form>--}}
                                                        {{--@elseif($commission->paid==1)--}}
                                                            {{--<span>Paid</span>--}}
                                                        {{--@endif--}}
                                                    {{--</td>--}}
                                                {{--</tr>--}}
                                            {{--@endforeach--}}
                                            {{--</tbody>--}}
                                        {{--</table>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div id="pendmonthCom">--}}
                                {{--<div class="card">--}}
                                    {{--<div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">--}}
                                        {{--<div>--}}
                                            {{--<span>--}}
                                                {{--Pending Commissions From {{$startOfMonth->format('F d, Y')}} to {{$endOfMonth->format('F d, Y')}}--}}
                                            {{--</span>--}}
                                            {{--<span class="badge light-green white-text" style="border-radius: 15px">--}}
                                                {{--{{$commissions->where('paid','=',0)->where('created_at','>',$startOfMonth)->where('created_at','<',$endOfMonth)->count()}}--}}
                                            {{--</span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="card-content">--}}
                                        {{--<table class="responsive-table">--}}
                                            {{--<thead>--}}
                                            {{--<tr>--}}
                                                {{--<th>ID</th>--}}
                                                {{--<th>Chef Name</th>--}}
                                                {{--<th>Date</th>--}}
                                                {{--<th>Amount</th>--}}
                                                {{--<th>Paid</th>--}}
                                                {{--<th>Update</th>--}}
                                            {{--</tr>--}}
                                            {{--</thead>--}}
                                            {{--<tbody>--}}
                                            {{--@foreach($commissions->where('paid','=',0)->where('created_at','>',$startOfMonth)->where('created_at','<',$endOfMonth) as $commission)--}}
                                                {{--<tr>--}}
                                                    {{--<td>{{$commission->id}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@foreach($chefs as $chef)--}}
                                                            {{--@if($chef->id == $commission->chef_id)--}}
                                                                {{--{{$chef->name}}--}}
                                                            {{--@endif--}}
                                                        {{--@endforeach--}}
                                                    {{--</td>--}}
                                                    {{--<td>{{$commission->created_at->format('F d, Y')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format($commission->amount,2,'.',',')}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<span>Not Paid</span>--}}
                                                        {{--@elseif($commission->paid==1)--}}
                                                            {{--<span>Paid</span>--}}
                                                        {{--@endif--}}
                                                    {{--</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<form method="post" action="{{route('admin.pay',$commission->id)}}">--}}
                                                                {{--{{ csrf_field() }}--}}
                                                                {{--<button type="submit" class="btn btn-primary waves-light waves-effect">Update</button>--}}
                                                            {{--</form>--}}
                                                        {{--@elseif($commission->paid==1)--}}
                                                            {{--<span>Paid</span>--}}
                                                        {{--@endif--}}
                                                    {{--</td>--}}
                                                {{--</tr>--}}
                                            {{--@endforeach--}}
                                            {{--</tbody>--}}
                                        {{--</table>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div id="pendyearCom">--}}
                                {{--<div class="card">--}}
                                    {{--<div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">--}}
                                        {{--<div>--}}
                                            {{--<span>--}}
                                                {{--Pending Commissions From {{$startOfYear->format('F d, Y')}} to {{$endOfYear->format('F d, Y')}}--}}
                                            {{--</span>--}}
                                            {{--<span class="badge light-green white-text" style="border-radius: 15px">--}}
                                                {{--{{$commissions->where('paid','=',0)->where('created_at','>',$startOfYear)->where('created_at','<',$endOfYear)->count()}}--}}
                                            {{--</span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="card-content">--}}
                                        {{--<table class="responsive-table">--}}
                                            {{--<thead>--}}
                                            {{--<tr>--}}
                                                {{--<th>ID</th>--}}
                                                {{--<th>Chef Name</th>--}}
                                                {{--<th>Date</th>--}}
                                                {{--<th>Amount</th>--}}
                                                {{--<th>Paid</th>--}}
                                                {{--<th>Update</th>--}}
                                            {{--</tr>--}}
                                            {{--</thead>--}}
                                            {{--<tbody>--}}
                                            {{--@foreach($commissions->where('paid','=',0)->where('created_at','>',$startOfYear)->where('created_at','<',$endOfYear) as $commission)--}}
                                                {{--<tr>--}}
                                                    {{--<td>{{$commission->id}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@foreach($chefs as $chef)--}}
                                                            {{--@if($chef->id == $commission->chef_id)--}}
                                                                {{--{{$chef->name}}--}}
                                                            {{--@endif--}}
                                                        {{--@endforeach--}}
                                                    {{--</td>--}}
                                                    {{--<td>{{$commission->created_at->format('F d, Y')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format($commission->amount,2,'.',',')}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<span>Not Paid</span>--}}
                                                        {{--@elseif($commission->paid==1)--}}
                                                            {{--<span>Paid</span>--}}
                                                        {{--@endif--}}
                                                    {{--</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<form method="post" action="{{route('admin.pay',$commission->id)}}">--}}
                                                                {{--{{ csrf_field() }}--}}
                                                                {{--<button type="submit" class="btn btn-primary waves-light waves-effect">Update</button>--}}
                                                            {{--</form>--}}
                                                        {{--@elseif($commission->paid==1)--}}
                                                            {{--<span>Paid</span>--}}
                                                        {{--@endif--}}
                                                    {{--</td>--}}
                                                {{--</tr>--}}
                                            {{--@endforeach--}}
                                            {{--</tbody>--}}
                                        {{--</table>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div id="allPend" class="card">--}}
                                {{--<div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">--}}
                                    {{--<div>--}}
                                        {{--<span>--}}
                                            {{--Unpaid Commissions From {{$firstCom->created_at->format('F d, Y')}} To {{$lastCom->created_at->format('F d, Y')}}--}}
                                        {{--</span>--}}
                                        {{--<span class="badge light-green white-text" style="border-radius: 15px">--}}
                                            {{--{{$commissions->where('paid','=',0)->count()}}--}}
                                        {{--</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="card-content">--}}
                                    {{--<table class="responsive-table">--}}
                                        {{--<thead>--}}
                                        {{--<tr>--}}
                                            {{--<th>ID</th>--}}
                                            {{--<th>Chef Name</th>--}}
                                            {{--<th>Date</th>--}}
                                            {{--<th>Amount</th>--}}
                                            {{--<th>Paid</th>--}}
                                            {{--<th>Update</th>--}}
                                        {{--</tr>--}}
                                        {{--</thead>--}}
                                        {{--<tbody>--}}
                                        {{--@foreach($commissions->where('paid','=',0) as $commission)--}}
                                            {{--<tr>--}}
                                                {{--<td>{{$commission->id}}</td>--}}
                                                {{--<td>--}}
                                                    {{--@foreach($chefs as $chef)--}}
                                                        {{--@if($chef->id == $commission->chef_id)--}}
                                                            {{--{{$chef->name}}--}}
                                                        {{--@endif--}}
                                                    {{--@endforeach--}}
                                                {{--</td>--}}
                                                {{--<td>{{$commission->created_at->format('F d, Y')}}</td>--}}
                                                {{--<td>{{'PHP '.number_format($commission->amount,2,'.',',')}}</td>--}}
                                                {{--<td>--}}
                                                    {{--@if($commission->paid==0)--}}
                                                        {{--<span>Not Paid</span>--}}
                                                    {{--@elseif($commission->paid==1)--}}
                                                        {{--<span>Paid</span>--}}
                                                    {{--@endif--}}
                                                {{--</td>--}}
                                                {{--<td>--}}
                                                    {{--@if($commission->paid==0)--}}
                                                        {{--<form method="post" action="{{route('admin.pay',$commission->id)}}">--}}
                                                            {{--{{ csrf_field() }}--}}
                                                            {{--<button type="submit" class="btn btn-primary waves-light waves-effect">Update</button>--}}
                                                        {{--</form>--}}
                                                    {{--@elseif($commission->paid==1)--}}
                                                        {{--<span>Paid</span>--}}
                                                    {{--@endif--}}
                                                {{--</td>--}}
                                            {{--</tr>--}}
                                        {{--@endforeach--}}
                                        {{--</tbody>--}}
                                    {{--</table>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div id="paidCom">--}}
                            {{--<div class="row">--}}
                                {{--<div class="col s12 m3">--}}
                                    {{--<div>--}}
                                        {{--<span>Search by Interval:</span>--}}
                                    {{--</div>--}}
                                    {{--<select id="paidOrderFilter">--}}
                                        {{--<option value="0" disabled>Pick an interval</option>--}}
                                        {{--<option value="1">Today</option>--}}
                                        {{--<option value="5">All</option>--}}
                                        {{--<option value="2">This Week</option>--}}
                                        {{--<option value="3">This Month</option>--}}
                                        {{--<option value="4">This Year</option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div id="dayCom">--}}
                            {{--<div class="card">--}}
                            {{--<div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">--}}
                            {{--<div>--}}
                            {{--<span>--}}
                            {{--Commissions--}}
                            {{--</span>--}}
                            {{--<span class="badge light-green white-text" style="border-radius: 15px">--}}
                            {{--{{$commissions->where('created_at','>',$thisDay)->count()}}--}}
                            {{--</span>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="card-content">--}}
                            {{--<table class="responsive-table">--}}
                            {{--<thead>--}}
                            {{--<tr>--}}
                            {{--<th>ID</th>--}}
                            {{--<th>Chef Name</th>--}}
                            {{--<th>Date</th>--}}
                            {{--<th>Amount</th>--}}
                            {{--<th>Paid</th>--}}
                            {{--<th>Update</th>--}}
                            {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}
                            {{--@foreach($commissions->where('created_at','>',$thisDay) as $commission)--}}
                            {{--<tr>--}}
                            {{--<td>{{$commission->id}}</td>--}}
                            {{--<td>--}}
                            {{--@foreach($chefs as $chef)--}}
                            {{--@if($chef->id == $commission->chef_id)--}}
                            {{--{{$chef->name}}--}}
                            {{--@endif--}}
                            {{--@endforeach--}}
                            {{--</td>--}}
                            {{--<td>{{$commission->created_at->format('F d, Y')}}</td>--}}
                            {{--<td>{{'PHP '.number_format($commission->amount,2,'.',',')}}</td>--}}
                            {{--<td>--}}
                            {{--@if($commission->paid==0)--}}
                            {{--<span>Not Paid</span>--}}
                            {{--@elseif($commission->paid==1)--}}
                            {{--<span>Paid</span>--}}
                            {{--@endif--}}
                            {{--</td>--}}
                            {{--<td>--}}
                            {{--@if($commission->paid==0)--}}
                            {{--<form method="post" action="{{route('admin.pay',$commission->id)}}">--}}
                            {{--{{ csrf_field() }}--}}
                            {{--<button type="submit" class="btn btn-primary waves-light waves-effect">Update</button>--}}
                            {{--</form>--}}
                            {{--@elseif($commission->paid==1)--}}
                            {{--<span>Paid</span>--}}
                            {{--@endif--}}
                            {{--</td>--}}
                            {{--</tr>--}}
                            {{--@endforeach--}}
                            {{--</tbody>--}}
                            {{--</table>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div id="paidweekCom">--}}
                                {{--<div class="card">--}}
                                    {{--<div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">--}}
                                        {{--<div>--}}
                                            {{--<span>--}}
                                                {{--Commissions For This Week--}}
                                            {{--</span>--}}
                                            {{--<span class="badge light-green white-text" style="border-radius: 15px">--}}
                                                {{--{{$commissions->where('paid','=',1)->where('created_at','>',$startOfTheWeek)->where('created_at','<',$endOfWeek)->count()}}--}}
                                            {{--</span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="card-content">--}}
                                        {{--<table class="responsive-table">--}}
                                            {{--<thead>--}}
                                            {{--<tr>--}}
                                                {{--<th>ID</th>--}}
                                                {{--<th>Chef Name</th>--}}
                                                {{--<th>Date</th>--}}
                                                {{--<th>Amount</th>--}}
                                                {{--<th>Paid</th>--}}
                                                {{--<th>Update</th>--}}
                                            {{--</tr>--}}
                                            {{--</thead>--}}
                                            {{--<tbody>--}}
                                            {{--@foreach($commissions->where('paid','=',1)->where('created_at','>',$startOfTheWeek)->where('created_at','<',$endOfWeek) as $commission)--}}
                                                {{--<tr>--}}
                                                    {{--<td>{{$commission->id}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@foreach($chefs as $chef)--}}
                                                            {{--@if($chef->id == $commission->chef_id)--}}
                                                                {{--{{$chef->name}}--}}
                                                            {{--@endif--}}
                                                        {{--@endforeach--}}
                                                    {{--</td>--}}
                                                    {{--<td>{{$commission->created_at->format('F d, Y')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format($commission->amount,2,'.',',')}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<span>Not Paid</span>--}}
                                                        {{--@elseif($commission->paid==1)--}}
                                                            {{--<span>Paid</span>--}}
                                                        {{--@endif--}}
                                                    {{--</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<form method="post" action="{{route('admin.pay',$commission->id)}}">--}}
                                                                {{--{{ csrf_field() }}--}}
                                                                {{--<button type="submit" class="btn btn-primary waves-light waves-effect">Update</button>--}}
                                                            {{--</form>--}}
                                                        {{--@elseif($commission->paid==1)--}}
                                                            {{--<span>Paid</span>--}}
                                                        {{--@endif--}}
                                                    {{--</td>--}}
                                                {{--</tr>--}}
                                            {{--@endforeach--}}
                                            {{--</tbody>--}}
                                        {{--</table>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div id="paidmonthCom">--}}
                                {{--<div class="card">--}}
                                    {{--<div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">--}}
                                        {{--<div>--}}
                                            {{--<span>--}}
                                                {{--Commissions For This Month--}}
                                            {{--</span>--}}
                                            {{--<span class="badge light-green white-text" style="border-radius: 15px">--}}
                                                {{--{{$commissions->where('paid','=',1)->where('created_at','>',$startOfMonth)->where('created_at','<',$endOfMonth)->count()}}--}}
                                            {{--</span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="card-content">--}}
                                        {{--<table class="responsive-table">--}}
                                            {{--<thead>--}}
                                            {{--<tr>--}}
                                                {{--<th>ID</th>--}}
                                                {{--<th>Chef Name</th>--}}
                                                {{--<th>Date</th>--}}
                                                {{--<th>Amount</th>--}}
                                                {{--<th>Paid</th>--}}
                                                {{--<th>Update</th>--}}
                                            {{--</tr>--}}
                                            {{--</thead>--}}
                                            {{--<tbody>--}}
                                            {{--@foreach($commissions->where('paid','=',1)->where('created_at','>',$startOfMonth)->where('created_at','<',$endOfMonth) as $commission)--}}
                                                {{--<tr>--}}
                                                    {{--<td>{{$commission->id}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@foreach($chefs as $chef)--}}
                                                            {{--@if($chef->id == $commission->chef_id)--}}
                                                                {{--{{$chef->name}}--}}
                                                            {{--@endif--}}
                                                        {{--@endforeach--}}
                                                    {{--</td>--}}
                                                    {{--<td>{{$commission->created_at->format('F d, Y')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format($commission->amount,2,'.',',')}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<span>Not Paid</span>--}}
                                                        {{--@elseif($commission->paid==1)--}}
                                                            {{--<span>Paid</span>--}}
                                                        {{--@endif--}}
                                                    {{--</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<form method="post" action="{{route('admin.pay',$commission->id)}}">--}}
                                                                {{--{{ csrf_field() }}--}}
                                                                {{--<button type="submit" class="btn btn-primary waves-light waves-effect">Update</button>--}}
                                                            {{--</form>--}}
                                                        {{--@elseif($commission->paid==1)--}}
                                                            {{--<span>Paid</span>--}}
                                                        {{--@endif--}}
                                                    {{--</td>--}}
                                                {{--</tr>--}}
                                            {{--@endforeach--}}
                                            {{--</tbody>--}}
                                        {{--</table>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div id="paidyearCom">--}}
                                {{--<div class="card">--}}
                                    {{--<div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">--}}
                                        {{--<div>--}}
                                            {{--<span>--}}
                                                {{--Commissions For This Year--}}
                                            {{--</span>--}}
                                            {{--<span class="badge light-green white-text" style="border-radius: 15px">--}}
                                                {{--{{$commissions->where('paid','=',1)->where('created_at','>',$startOfYear)->where('created_at','<',$endOfYear)->count()}}--}}
                                            {{--</span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="card-content">--}}
                                        {{--<table class="responsive-table">--}}
                                            {{--<thead>--}}
                                            {{--<tr>--}}
                                                {{--<th>ID</th>--}}
                                                {{--<th>Chef Name</th>--}}
                                                {{--<th>Date</th>--}}
                                                {{--<th>Amount</th>--}}
                                                {{--<th>Paid</th>--}}
                                                {{--<th>Update</th>--}}
                                            {{--</tr>--}}
                                            {{--</thead>--}}
                                            {{--<tbody>--}}
                                            {{--@foreach($commissions->where('paid','=',1)->where('created_at','>',$startOfYear)->where('created_at','<',$endOfYear) as $commission)--}}
                                                {{--<tr>--}}
                                                    {{--<td>{{$commission->id}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@foreach($chefs as $chef)--}}
                                                            {{--@if($chef->id == $commission->chef_id)--}}
                                                                {{--{{$chef->name}}--}}
                                                            {{--@endif--}}
                                                        {{--@endforeach--}}
                                                    {{--</td>--}}
                                                    {{--<td>{{$commission->created_at->format('F d, Y')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format($commission->amount,2,'.',',')}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<span>Not Paid</span>--}}
                                                        {{--@elseif($commission->paid==1)--}}
                                                            {{--<span>Paid</span>--}}
                                                        {{--@endif--}}
                                                    {{--</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<form method="post" action="{{route('admin.pay',$commission->id)}}">--}}
                                                                {{--{{ csrf_field() }}--}}
                                                                {{--<button type="submit" class="btn btn-primary waves-light waves-effect">Update</button>--}}
                                                            {{--</form>--}}
                                                        {{--@elseif($commission->paid==1)--}}
                                                            {{--<span>Paid</span>--}}
                                                        {{--@endif--}}
                                                    {{--</td>--}}
                                                {{--</tr>--}}
                                            {{--@endforeach--}}
                                            {{--</tbody>--}}
                                        {{--</table>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div id="allPaid" class="card">--}}
                                {{--<div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">--}}
                                    {{--<div>--}}
                                        {{--<span>--}}
                                            {{--Paid Commissions From {{$firstCom->created_at->format('F d, Y')}} To {{$lastCom->created_at->format('F d, Y')}}--}}
                                        {{--</span>--}}
                                        {{--<span class="badge light-green white-text" style="border-radius: 15px">--}}
                                            {{--{{$commissions->where('paid','=',1)->count()}}--}}
                                        {{--</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="card-content">--}}
                                    {{--<table class="responsive-table">--}}
                                        {{--<thead>--}}
                                        {{--<tr>--}}
                                            {{--<th>ID</th>--}}
                                            {{--<th>Chef Name</th>--}}
                                            {{--<th>Date</th>--}}
                                            {{--<th>Amount</th>--}}
                                            {{--<th>Paid</th>--}}
                                            {{--<th>Update</th>--}}
                                        {{--</tr>--}}
                                        {{--</thead>--}}
                                        {{--<tbody>--}}
                                        {{--@foreach($commissions->where('paid','=',1) as $commission)--}}
                                            {{--<tr>--}}
                                                {{--<td>{{$commission->id}}</td>--}}
                                                {{--<td>--}}
                                                    {{--@foreach($chefs as $chef)--}}
                                                        {{--@if($chef->id == $commission->chef_id)--}}
                                                            {{--{{$chef->name}}--}}
                                                        {{--@endif--}}
                                                    {{--@endforeach--}}
                                                {{--</td>--}}
                                                {{--<td>{{$commission->created_at->format('F d, Y')}}</td>--}}
                                                {{--<td>{{'PHP '.number_format($commission->amount,2,'.',',')}}</td>--}}
                                                {{--<td>--}}
                                                    {{--@if($commission->paid==0)--}}
                                                        {{--<span>Not Paid</span>--}}
                                                    {{--@elseif($commission->paid==1)--}}
                                                        {{--<span>Paid</span>--}}
                                                    {{--@endif--}}
                                                {{--</td>--}}
                                                {{--<td>--}}
                                                    {{--@if($commission->paid==0)--}}
                                                        {{--<form method="post" action="{{route('admin.pay',$commission->id)}}">--}}
                                                            {{--{{ csrf_field() }}--}}
                                                            {{--<button type="submit" class="btn btn-primary waves-light waves-effect">Update</button>--}}
                                                        {{--</form>--}}
                                                    {{--@elseif($commission->paid==1)--}}
                                                        {{--<span>Paid</span>--}}
                                                    {{--@endif--}}
                                                {{--</td>--}}
                                            {{--</tr>--}}
                                        {{--@endforeach--}}
                                        {{--</tbody>--}}
                                    {{--</table>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
        </div>
    </div>



@endsection