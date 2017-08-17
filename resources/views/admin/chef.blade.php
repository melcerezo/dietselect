@extends("layouts.app")
@section('head')

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
                    <a href="#">
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
            </ul>
        </div>
    </nav>

    <div class="container" style="width: 85%;">
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
                            <table class="responsive-table">
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
                                    @foreach($orderItems->take(5) as $orderItem)
                                        @if($orderItem->order->is_cancelled!=1 && $orderItem->order->is_paid==1)
                                            <tr>
                                                <td>{{$orderItem->id}}</td>
                                                <td>
                                                    @if($orderItem->order_type==0)
                                                        @foreach($plans as $plan)
                                                            @if($plan->id == $orderItem->plan_id)
                                                                {{$plan->plan_name}}
                                                            @endif
                                                        @endforeach
                                                    @else
                                                    @endif
                                                </td>
                                                <td>{{$orderItem->quantity}}</td>
                                                <td>{{$orderItem->price}}</td>
                                                <td>
                                                    @if($orderItem->order_type==0)
                                                        <span>Standard</span>
                                                    @elseif($orderItem->order_type==1||$orderItem->order_type==2)
                                                        <span>Customized</span>
                                                    @endif
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
                            <table class="responsive-table">
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
                                @foreach($orderItems->take(5) as $orderItem)
                                    @if($orderItem->order->is_cancelled==1)
                                        <tr>
                                            <td>{{$orderItem->id}}</td>
                                            <td>
                                                @foreach($plans as $plan)
                                                    @if($plan->id == $orderItem->plan_id)
                                                        {{$plan->plan_name}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{$orderItem->quantity}}</td>
                                            <td>{{$orderItem->price}}</td>
                                            <td>
                                                @if($orderItem->order_type==0)
                                                    <span>Standard</span>
                                                @elseif($orderItem->order_type==1||$orderItem->order_type==2)
                                                    <span>Customized</span>
                                                @endif
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

                </div>
            </div>
        </div>
    </div>



@endsection