@extends("layouts.app")
@section('head')
    <style>
        .activeTab{
            border-bottom: 4px solid #f57c00;
        }
        .activeTab a{
            color: #f57c00;
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
                    <a href="{{route('admin.adminRefund')}}">
                        <span style="margin-left: 2px;">
                            Refunds
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
                    <li class="collection-item"><a href="{{route('admin.adminRefund')}}">Refunds</a></li>
                    <li class="collection-item"><a href="{{route('admin.orders')}}">Orders</a></li>
                    <li class="collection-item"><a href="{{route('admin.foodies')}}">Foodies</a></li>
                    <li class="collection-item"><a href="{{route('admin.chefs')}}">Chefs</a></li>
                </ul>
                <ul class="collection" style="margin-top: 0;">
                    <li class="collection-item grey lighten-3">
                         <span>
                            Totals from {{$firstOrd->created_at->format('F d, Y')}} To {{$lastOrd->created_at->format('F d, Y')}}
                        </span>
                    </li>
                    <li class="collection-item"><div>Orders:</div> <span style="font-size: 14px;">{{$orders->count()}}</span></li>
                    <li class="collection-item"><div>Unpaid Orders:</div> <span style="font-size: 14px;">{{$orders->where('is_paid','=',0)->where('is_cancelled','=',0)->count()}}</span></li>
                    <li class="collection-item"><div>Paid Orders:</div> <span style="font-size: 14px;">{{$orders->where('is_paid','=',1)->where('is_cancelled','=',0)->count()}}</span></li>
                    <li class="collection-item"><div>Cancelled Orders:</div> <span style="font-size: 14px;">{{$orders->where('is_cancelled','=',1)->count()}}</span></li>
                    <li class="collection-item"><div>Total Paid:</div> <span style="font-size: 14px;">{{'PHP '.number_format($totalPaid,2,'.',',')}}</span></li>
                    <li class="collection-item"><div>Total Pending:</div> <span style="font-size: 14px;">{{'PHP '.number_format($totalPend,2,'.',',')}}</span></li>
                </ul>
            </div>
            <div class="col s12 m10">
                <div class="row">
                    <div class="col s12 m7">
                        <div id="allOrderLinkContain" class="col s3 center"><a href="#!" class="allOrderLink">All</a></div>
                        <div id="pendOrderLinkContain" class="col s3 center"><a href="#!" class="pendOrderLink">Pending</a></div>
                        <div id="paidOrderLinkContain" class="col s3 center"><a href="#!" class="paidOrderLink">Paid</a></div>
                        <div id="cancelledOrderLinkContain" class="col s3 center"><a href="#!" class="cancelledOrderLink">Cancelled</a></div>
                    </div>
                </div>
                <div id="orderPageAll">
                    <div class="row">
                        <div class="col s12 m3">
                            <div>
                                <span>Search by Interval:</span>
                            </div>
                            <select id="orderPageFilter">
                                <option value="0" disabled selected>Pick an interval</option>
                                {{--<option value="1">Today</option>--}}
                                <option value="5">All</option>
                                <option value="2">This Week</option>
                                <option value="3">This Month</option>
                                <option value="4">This Year</option>
                            </select>
                        </div>
                    </div>
                    <div id="orderWeekPicker">
                        <div class="card" id="orderWeekTable">
                            <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                                <div>
                                <span>
                                    Orders From {{$startOfTheWeek->format('F d, Y')}} to {{$endOfWeek->format('F d, Y')}}
                                </span>
                                    <span class="badge light-green white-text" style="border-radius: 15px">
                                    {{$orders->where('created_at','>',$startOfTheWeek)->where('created_at','<',$endOfWeek)->count()}}
                                </span>
                                </div>
                            </div>
                            <div>
                                <div class="card-content">
                                    <table class="responsive-table">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Foodie</th>
                                            <th>Method</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Created</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders->where('created_at','>',$startOfTheWeek)->where('created_at','<',$endOfWeek) as $order)
                                            <tr>

                                                <td><a href="{{route('admin.order', $order->id)}}">{{$order->id}}</a></td>
                                                <td>
                                                    {{$order->foodie->first_name.' '.$order->foodie->last_name}}
                                                </td>
                                                <td>
                                                    @if(count($order->deposit()->get()))
                                                        <span>Deposit</span>
                                                    @elseif(count($order->gcash()->get()))
                                                        <span>Gcash</span>
                                                    @elseif(count($order->paypal()->get()))
                                                        <span>PayPal</span>
                                                    @else
                                                        <span>None</span>
                                                    @endif
                                                </td>
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
                                                <td>{{'PHP '.number_format($order->total, 2, '.', ',')}}</td>
                                                <td>{{$order->created_at->format('F d, Y')}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="orderMonthPicker">
                        <div class="card" id="orderMonthTable">
                            <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                                <div>
                                <span>
                                    Orders From {{$startOfMonth->format('F d, Y')}} to {{$endOfMonth->format('F d, Y')}}
                                </span>
                                    <span class="badge light-green white-text" style="border-radius: 15px">
                                    {{$orders->where('created_at','>',$startOfMonth)->where('created_at','<',$endOfMonth)->count()}}
                                </span>
                                </div>
                            </div>
                            <div>
                                <div class="card-content">
                                    <table class="responsive-table">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Foodie</th>
                                            <th>Method</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Created</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders->where('created_at','>',$startOfMonth)->where('created_at','<',$endOfMonth) as $order)
                                            <tr>

                                                <td><a href="{{route('admin.order', $order->id)}}">{{$order->id}}</a></td>
                                                <td>
                                                    {{$order->foodie->first_name.' '.$order->foodie->last_name}}
                                                </td>
                                                <td>
                                                    @if(count($order->deposit()->get()))
                                                        <span>Deposit</span>
                                                    @elseif(count($order->gcash()->get()))
                                                        <span>Gcash</span>
                                                    @elseif(count($order->paypal()->get()))
                                                        <span>PayPal</span>
                                                    @else
                                                        <span>None</span>
                                                    @endif
                                                </td>
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
                                                <td>{{'PHP '.number_format($order->total, 2, '.', ',')}}</td>
                                                <td>{{$order->created_at->format('F d, Y')}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="orderYearPicker">
                        <div class="card" id="orderYearTable">
                            <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                                <div>
                                <span>
                                    Orders From {{$startOfYear->format('F d, Y')}} to {{$endOfYear->format('F d, Y')}}
                                </span>
                                    <span class="badge light-green white-text" style="border-radius: 15px">
                                    {{$orders->where('created_at','>',$startOfYear)->where('created_at','<',$endOfYear)->count()}}
                                </span>
                                </div>
                            </div>
                            <div>
                                <div class="card-content">
                                    <table class="responsive-table">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Foodie</th>
                                            <th>Method</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Created</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders->where('created_at','>',$startOfYear)->where('created_at','<',$endOfYear) as $order)
                                            <tr>

                                                <td><a href="{{route('admin.order', $order->id)}}">{{$order->id}}</a></td>
                                                <td>
                                                    {{$order->foodie->first_name.' '.$order->foodie->last_name}}
                                                </td>
                                                <td>
                                                    @if(count($order->deposit()->get()))
                                                        <span>Deposit</span>
                                                    @elseif(count($order->gcash()->get()))
                                                        <span>Gcash</span>
                                                    @elseif(count($order->paypal()->get()))
                                                        <span>PayPal</span>
                                                    @else
                                                        <span>None</span>
                                                    @endif
                                                </td>
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
                                                <td>{{'PHP '.number_format($order->total, 2, '.', ',')}}</td>
                                                <td>{{$order->created_at->format('F d, Y')}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" id="orderAllTable">
                        <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                            <div>
                                <span>
                                    Orders From {{$firstOrd->created_at->format('F d, Y')}} To {{$lastOrd->created_at->format('F d, Y')}}
                                </span>
                                <span class="badge light-green white-text" style="border-radius: 15px">
                                    {{$orders->count()}}
                                </span>
                            </div>
                        </div>
                        <div class="card-content">
                            <table class="responsive-table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Foodie</th>
                                    <th>Method</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Created</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>

                                        <td><a href="{{route('admin.order', $order->id)}}">{{$order->id}}</a></td>
                                        <td>
                                            {{$order->foodie->first_name.' '.$order->foodie->last_name}}
                                        </td>
                                        <td>
                                            @if(count($order->deposit()->get()))
                                                <span>Deposit</span>
                                            @elseif(count($order->gcash()->get()))
                                                <span>Gcash</span>
                                            @elseif(count($order->paypal()->get()))
                                                <span>PayPal</span>
                                            @else
                                                <span>None</span>
                                            @endif
                                        </td>
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
                                        <td>{{'PHP '.number_format($order->total, 2, '.', ',')}}</td>
                                        <td>{{$order->created_at->format('F d, Y')}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="orderPagePend">
                    <div class="row">
                        <div class="col s12 m3">
                            <div>
                                <span>Search by Interval:</span>
                            </div>
                            <select id="orderPendFilter">
                                <option value="0" disabled selected>Pick an interval</option>
                                {{--<option value="1">Today</option>--}}
                                <option value="5">All</option>
                                <option value="2">This Week</option>
                                <option value="3">This Month</option>
                                <option value="4">This Year</option>
                            </select>
                        </div>
                    </div>
                    <div id="orderPendWeekPicker">
                        <div class="card" id="orderPendWeekTable">
                            <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                                <div>
                                <span>
                                    Orders From {{$startOfTheWeek->format('F d, Y')}} to {{$endOfWeek->format('F d, Y')}}
                                </span>
                                    <span class="badge light-green white-text" style="border-radius: 15px">
                                    {{$orders->where('is_paid','=',0)->where('is_cancelled','=',0)->where('created_at','>',$startOfTheWeek)->where('created_at','<',$endOfWeek)->count()}}
                                </span>
                                </div>
                            </div>
                            <div>
                                <div class="card-content">
                                    <table class="responsive-table">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Foodie</th>
                                            <th>Method</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Created</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders->where('is_paid','=',0)->where('is_cancelled','=',0)->where('created_at','>',$startOfTheWeek)->where('created_at','<',$endOfWeek) as $order)
                                            <tr>

                                                <td><a href="{{route('admin.order', $order->id)}}">{{$order->id}}</a></td>
                                                <td>
                                                    {{$order->foodie->first_name.' '.$order->foodie->last_name}}
                                                </td>
                                                <td>
                                                    @if(count($order->deposit()->get()))
                                                        <span>Deposit</span>
                                                    @elseif(count($order->gcash()->get()))
                                                        <span>Gcash</span>
                                                    @elseif(count($order->paypal()->get()))
                                                        <span>PayPal</span>
                                                    @else
                                                        <span>None</span>
                                                    @endif
                                                </td>
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
                                                <td>{{'PHP '.number_format($order->total, 2, '.', ',')}}</td>
                                                <td>{{$order->created_at->format('F d, Y')}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="orderPendMonthPicker">
                        <div class="card" id="orderPendMonthTable">
                            <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                                <div>
                                <span>
                                    Orders From {{$startOfMonth->format('F d, Y')}} to {{$endOfMonth->format('F d, Y')}}
                                </span>
                                    <span class="badge light-green white-text" style="border-radius: 15px">
                                    {{$orders->where('is_paid','=',0)->where('is_cancelled','=',0)->where('created_at','>',$startOfMonth)->where('created_at','<',$endOfMonth)->count()}}
                                </span>
                                </div>
                            </div>
                            <div>
                                <div class="card-content">
                                    <table class="responsive-table">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Foodie</th>
                                            <th>Method</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Created</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders->where('is_paid','=',0)->where('is_cancelled','=',0)->where('created_at','>',$startOfMonth)->where('created_at','<',$endOfMonth) as $order)
                                            <tr>

                                                <td><a href="{{route('admin.order', $order->id)}}">{{$order->id}}</a></td>
                                                <td>
                                                    {{$order->foodie->first_name.' '.$order->foodie->last_name}}
                                                </td>
                                                <td>
                                                    @if(count($order->deposit()->get()))
                                                        <span>Deposit</span>
                                                    @elseif(count($order->gcash()->get()))
                                                        <span>Gcash</span>
                                                    @elseif(count($order->paypal()->get()))
                                                        <span>PayPal</span>
                                                    @else
                                                        <span>None</span>
                                                    @endif
                                                </td>
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
                                                <td>{{'PHP '.number_format($order->total, 2, '.', ',')}}</td>
                                                <td>{{$order->created_at->format('F d, Y')}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="orderPendYearPicker">
                        <div class="card" id="orderPendYearTable">
                            <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                                <div>
                                <span>
                                    Orders From {{$startOfYear->format('F d, Y')}} to {{$endOfYear->format('F d, Y')}}
                                </span>
                                    <span class="badge light-green white-text" style="border-radius: 15px">
                                    {{$orders->where('is_paid','=',0)->where('is_cancelled','=',0)->where('created_at','>',$startOfYear)->where('created_at','<',$endOfYear)->count()}}
                                </span>
                                </div>
                            </div>
                            <div>
                                <div class="card-content">
                                    <table class="responsive-table">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Foodie</th>
                                            <th>Method</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Created</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders->where('is_paid','=',0)->where('is_cancelled','=',0)->where('created_at','>',$startOfYear)->where('created_at','<',$endOfYear) as $order)
                                            <tr>

                                                <td><a href="{{route('admin.order', $order->id)}}">{{$order->id}}</a></td>
                                                <td>
                                                    {{$order->foodie->first_name.' '.$order->foodie->last_name}}
                                                </td>
                                                <td>
                                                    @if(count($order->deposit()->get()))
                                                        <span>Deposit</span>
                                                    @elseif(count($order->gcash()->get()))
                                                        <span>Gcash</span>
                                                    @elseif(count($order->paypal()->get()))
                                                        <span>PayPal</span>
                                                    @else
                                                        <span>None</span>
                                                    @endif
                                                </td>
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
                                                <td>{{'PHP '.number_format($order->total, 2, '.', ',')}}</td>
                                                <td>{{$order->created_at->format('F d, Y')}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" id="orderPendAllTable">
                        <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                            <div>
                                <span>
                                    Pending Orders From {{$firstOrd->created_at->format('F d, Y')}} To {{$lastOrd->created_at->format('F d, Y')}}
                                </span>
                                <span class="badge light-green white-text" style="border-radius: 15px">
                                    {{$orders->where('is_paid','=',0)->where('is_cancelled','=',0)->count()}}
                                </span>
                            </div>
                        </div>
                        <div class="card-content">
                            <table class="responsive-table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Foodie</th>
                                    <th>Method</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Created</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders->where('is_paid','=',0)->where('is_cancelled','=',0) as $order)
                                    <tr>

                                        <td><a href="{{route('admin.order', $order->id)}}">{{$order->id}}</a></td>
                                        <td>
                                            {{$order->foodie->first_name.' '.$order->foodie->last_name}}
                                        </td>
                                        <td>
                                            @if(count($order->deposit()->get()))
                                                <span>Deposit</span>
                                            @elseif(count($order->gcash()->get()))
                                                <span>Gcash</span>
                                            @elseif(count($order->paypal()->get()))
                                                <span>PayPal</span>
                                            @else
                                                <span>None</span>
                                            @endif
                                        </td>
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
                                        <td>{{'PHP '.number_format($order->total, 2, '.', ',')}}</td>
                                        <td>{{$order->created_at->format('F d, Y')}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="orderPagePaid">
                    <div class="row">
                        <div class="col s12 m3">
                            <div>
                                <span>Search by Interval:</span>
                            </div>
                            <select id="orderPaidFilter">
                                <option value="0" disabled selected>Pick an interval</option>
                                {{--<option value="1">Today</option>--}}
                                <option value="5">All</option>
                                <option value="2">This Week</option>
                                <option value="3">This Month</option>
                                <option value="4">This Year</option>
                            </select>
                        </div>
                    </div>
                    <div id="orderPaidWeekPicker">
                        <div class="card" id="orderPaidWeekTable">
                            <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                                <div>
                                <span>
                                    Orders From {{$startOfTheWeek->format('F d, Y')}} to {{$endOfWeek->format('F d, Y')}}
                                </span>
                                    <span class="badge light-green white-text" style="border-radius: 15px">
                                    {{$orders->where('is_paid','=',1)->where('is_cancelled','=',0)->where('created_at','>',$startOfTheWeek)->where('created_at','<',$endOfWeek)->count()}}
                                </span>
                                </div>
                            </div>
                            <div>
                                <div class="card-content">
                                    <table class="responsive-table">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Foodie</th>
                                            <th>Method</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Created</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders->where('is_paid','=',1)->where('is_cancelled','=',0)->where('created_at','>',$startOfTheWeek)->where('created_at','<',$endOfWeek) as $order)
                                            <tr>

                                                <td><a href="{{route('admin.order', $order->id)}}">{{$order->id}}</a></td>
                                                <td>
                                                    {{$order->foodie->first_name.' '.$order->foodie->last_name}}
                                                </td>
                                                <td>
                                                    @if(count($order->deposit()->get()))
                                                        <span>Deposit</span>
                                                    @elseif(count($order->gcash()->get()))
                                                        <span>Gcash</span>
                                                    @elseif(count($order->paypal()->get()))
                                                        <span>PayPal</span>
                                                    @else
                                                        <span>None</span>
                                                    @endif
                                                </td>
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
                                                <td>{{'PHP '.number_format($order->total, 2, '.', ',')}}</td>
                                                <td>{{$order->created_at->format('F d, Y')}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="orderPaidMonthPicker">
                        <div class="card" id="orderPaidMonthTable">
                            <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                                <div>
                                <span>
                                    Orders From {{$startOfMonth->format('F d, Y')}} to {{$endOfMonth->format('F d, Y')}}
                                </span>
                                    <span class="badge light-green white-text" style="border-radius: 15px">
                                    {{$orders->where('is_paid','=',1)->where('is_cancelled','=',0)->where('created_at','>',$startOfMonth)->where('created_at','<',$endOfMonth)->count()}}
                                </span>
                                </div>
                            </div>
                            <div>
                                <div class="card-content">
                                    <table class="responsive-table">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Foodie</th>
                                            <th>Method</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Created</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders->where('is_paid','=',1)->where('is_cancelled','=',0)->where('created_at','>',$startOfMonth)->where('created_at','<',$endOfMonth) as $order)
                                            <tr>

                                                <td><a href="{{route('admin.order', $order->id)}}">{{$order->id}}</a></td>
                                                <td>
                                                    {{$order->foodie->first_name.' '.$order->foodie->last_name}}
                                                </td>
                                                <td>
                                                    @if(count($order->deposit()->get()))
                                                        <span>Deposit</span>
                                                    @elseif(count($order->gcash()->get()))
                                                        <span>Gcash</span>
                                                    @elseif(count($order->paypal()->get()))
                                                        <span>PayPal</span>
                                                    @else
                                                        <span>None</span>
                                                    @endif
                                                </td>
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
                                                <td>{{'PHP '.number_format($order->total, 2, '.', ',')}}</td>
                                                <td>{{$order->created_at->format('F d, Y')}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="orderPaidYearPicker">
                        <div class="card" id="orderPaidYearTable">
                            <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                                <div>
                                <span>
                                    Orders From {{$startOfYear->format('F d, Y')}} to {{$endOfYear->format('F d, Y')}}
                                </span>
                                    <span class="badge light-green white-text" style="border-radius: 15px">
                                    {{$orders->where('is_paid','=',1)->where('is_cancelled','=',0)->where('created_at','>',$startOfYear)->where('created_at','<',$endOfYear)->count()}}
                                </span>
                                </div>
                            </div>
                            <div>
                                <div class="card-content">
                                    <table class="responsive-table">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Foodie</th>
                                            <th>Method</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Created</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders->where('is_paid','=',1)->where('is_cancelled','=',0)->where('created_at','>',$startOfYear)->where('created_at','<',$endOfYear) as $order)
                                            <tr>

                                                <td><a href="{{route('admin.order', $order->id)}}">{{$order->id}}</a></td>
                                                <td>
                                                    {{$order->foodie->first_name.' '.$order->foodie->last_name}}
                                                </td>
                                                <td>
                                                    @if(count($order->deposit()->get()))
                                                        <span>Deposit</span>
                                                    @elseif(count($order->gcash()->get()))
                                                        <span>Gcash</span>
                                                    @elseif(count($order->paypal()->get()))
                                                        <span>PayPal</span>
                                                    @else
                                                        <span>None</span>
                                                    @endif
                                                </td>
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
                                                <td>{{'PHP '.number_format($order->total, 2, '.', ',')}}</td>
                                                <td>{{$order->created_at->format('F d, Y')}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" id="orderPaidAllTable">
                        <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                            <div>
                                <span>
                                    Paid Orders From {{$firstOrd->created_at->format('F d, Y')}} To {{$lastOrd->created_at->format('F d, Y')}}
                                </span>
                                <span class="badge light-green white-text" style="border-radius: 15px">
                                    {{$orders->where('is_paid','=',1)->where('is_cancelled','=',0)->count()}}
                                </span>
                            </div>
                        </div>
                        <div class="card-content">
                            <table class="responsive-table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Foodie</th>
                                    <th>Method</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Created</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders->where('is_paid','=',1)->where('is_cancelled','=',0) as $order)
                                    <tr>

                                        <td><a href="{{route('admin.order', $order->id)}}">{{$order->id}}</a></td>
                                        <td>
                                            {{$order->foodie->first_name.' '.$order->foodie->last_name}}
                                        </td>
                                        <td>
                                            @if(count($order->deposit()->get()))
                                                <span>Deposit</span>
                                            @elseif(count($order->gcash()->get()))
                                                <span>Gcash</span>
                                            @elseif(count($order->paypal()->get()))
                                                <span>PayPal</span>
                                            @else
                                                <span>None</span>
                                            @endif
                                        </td>
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
                                        <td>{{'PHP '.number_format($order->total, 2, '.', ',')}}</td>
                                        <td>{{$order->created_at->format('F d, Y')}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="orderPageCancel">
                    <div class="row">
                        <div class="col s12 m3">
                            <div>
                                <span>Search by Interval:</span>
                            </div>
                            <select id="orderCancelFilter">
                                <option value="0" disabled selected>Pick an interval</option>
                                {{--<option value="1">Today</option>--}}
                                <option value="5">All</option>
                                <option value="2">This Week</option>
                                <option value="3">This Month</option>
                                <option value="4">This Year</option>
                            </select>
                        </div>
                    </div>
                    <div id="orderCancelWeekPicker">
                        <div class="card" id="orderCancelWeekTable">
                            <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                                <div>
                                <span>
                                    Cancelled Orders From {{$startOfTheWeek->format('F d, Y')}} to {{$endOfWeek->format('F d, Y')}}
                                </span>
                                    <span class="badge light-green white-text" style="border-radius: 15px">
                                    {{$orders->where('is_cancelled','=',1)->where('created_at','>',$startOfTheWeek)->where('created_at','<',$endOfWeek)->count()}}
                                </span>
                                </div>
                            </div>
                            <div>
                                <div class="card-content">
                                    <table class="responsive-table">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Foodie</th>
                                            <th>Method</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Created</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders->where('is_cancelled','=',1)->where('created_at','>',$startOfTheWeek)->where('created_at','<',$endOfWeek) as $order)
                                            <tr>

                                                <td><a href="{{route('admin.order', $order->id)}}">{{$order->id}}</a></td>
                                                <td>
                                                    {{$order->foodie->first_name.' '.$order->foodie->last_name}}
                                                </td>
                                                <td>
                                                    @if(count($order->deposit()->get()))
                                                        <span>Deposit</span>
                                                    @elseif(count($order->gcash()->get()))
                                                        <span>Gcash</span>
                                                    @elseif(count($order->paypal()->get()))
                                                        <span>PayPal</span>
                                                    @else
                                                        <span>None</span>
                                                    @endif
                                                </td>
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
                                                <td>{{'PHP '.number_format($order->total, 2, '.', ',')}}</td>
                                                <td>{{$order->created_at->format('F d, Y')}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="orderCancelMonthPicker">
                        <div class="card" id="orderCancelMonthTable">
                            <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                                <div>
                                <span>
                                    Cancelled Orders From {{$startOfMonth->format('F d, Y')}} to {{$endOfMonth->format('F d, Y')}}
                                </span>
                                    <span class="badge light-green white-text" style="border-radius: 15px">
                                    {{$orders->where('is_cancelled','=',1)->where('created_at','>',$startOfMonth)->where('created_at','<',$endOfMonth)->count()}}
                                </span>
                                </div>
                            </div>
                            <div>
                                <div class="card-content">
                                    <table class="responsive-table">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Foodie</th>
                                            <th>Method</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Created</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders->where('is_cancelled','=',1)->where('created_at','>',$startOfMonth)->where('created_at','<',$endOfMonth) as $order)
                                            <tr>

                                                <td><a href="{{route('admin.order', $order->id)}}">{{$order->id}}</a></td>
                                                <td>
                                                    {{$order->foodie->first_name.' '.$order->foodie->last_name}}
                                                </td>
                                                <td>
                                                    @if(count($order->deposit()->get()))
                                                        <span>Deposit</span>
                                                    @elseif(count($order->gcash()->get()))
                                                        <span>Gcash</span>
                                                    @elseif(count($order->paypal()->get()))
                                                        <span>PayPal</span>
                                                    @else
                                                        <span>None</span>
                                                    @endif
                                                </td>
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
                                                <td>{{'PHP '.number_format($order->total, 2, '.', ',')}}</td>
                                                <td>{{$order->created_at->format('F d, Y')}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="orderCancelYearPicker">
                        <div class="card" id="orderCancelYearTable">
                            <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                                <div>
                                <span>
                                    Cancelled Orders From {{$startOfYear->format('F d, Y')}} to {{$endOfYear->format('F d, Y')}}
                                </span>
                                    <span class="badge light-green white-text" style="border-radius: 15px">
                                    {{$orders->where('is_cancelled','=',1)->where('created_at','>',$startOfYear)->where('created_at','<',$endOfYear)->count()}}
                                </span>
                                </div>
                            </div>
                            <div>
                                <div class="card-content">
                                    <table class="responsive-table">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Foodie</th>
                                            <th>Method</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Created</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders->where('is_cancelled','=',1)->where('created_at','>',$startOfYear)->where('created_at','<',$endOfYear) as $order)
                                            <tr>

                                                <td><a href="{{route('admin.order', $order->id)}}">{{$order->id}}</a></td>
                                                <td>
                                                    {{$order->foodie->first_name.' '.$order->foodie->last_name}}
                                                </td>
                                                <td>
                                                    @if(count($order->deposit()->get()))
                                                        <span>Deposit</span>
                                                    @elseif(count($order->gcash()->get()))
                                                        <span>Gcash</span>
                                                    @elseif(count($order->paypal()->get()))
                                                        <span>PayPal</span>
                                                    @else
                                                        <span>None</span>
                                                    @endif
                                                </td>
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
                                                <td>{{'PHP '.number_format($order->total, 2, '.', ',')}}</td>
                                                <td>{{$order->created_at->format('F d, Y')}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" id="orderCancelAllTable">
                        <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                            <div>
                                <span>
                                    Cancelled Orders From {{$firstOrd->created_at->format('F d, Y')}} To {{$lastOrd->created_at->format('F d, Y')}}
                                </span>
                                <span class="badge light-green white-text" style="border-radius: 15px">
                                    {{$orders->where('is_cancelled','=',1)->count()}}
                                </span>
                            </div>
                        </div>
                        <div class="card-content">
                            <table class="responsive-table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Foodie</th>
                                    <th>Method</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Created</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders->where('is_cancelled','=',1) as $order)
                                    <tr>

                                        <td><a href="{{route('admin.order', $order->id)}}">{{$order->id}}</a></td>
                                        <td>
                                            {{$order->foodie->first_name.' '.$order->foodie->last_name}}
                                        </td>
                                        <td>
                                            @if(count($order->deposit()->get()))
                                                <span>Deposit</span>
                                            @elseif(count($order->gcash()->get()))
                                                <span>Gcash</span>
                                            @elseif(count($order->paypal()->get()))
                                                <span>PayPal</span>
                                            @else
                                                <span>None</span>
                                            @endif
                                        </td>
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
                                        <td>{{'PHP '.number_format($order->total, 2, '.', ',')}}</td>
                                        <td>{{$order->created_at->format('F d, Y')}}</td>
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



@endsection