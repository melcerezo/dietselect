@extends("layouts.app")
@section('head')
    <style>
        .activeTab{
            color: #f57c00;
            border-bottom: 4px solid #f57c00;
        }
        /*.activeTab a{*/
        /*color: #f57c00;*/
        /*}*/
        .tableTab{
            cursor: pointer;
        }
        .refundTot{
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
        <div class="row" style="margin-top: 5px;">
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

                @foreach($uniqueRefundArray as $refundArray)
                    <ul id="refund{{$refundArray['id']}}" data-id="{{$refundArray['id']}}" class="collection refundTot" style="margin-top: 0;">
                        <li class="collection-item grey lighten-3">
                         <span>
                            Total Refunds For
                             @foreach($foodies as $foodie)
                                 @if($foodie->id==$refundArray['id'])
                                     <span>{{$foodie->first_name.' '.$foodie->last_name}}</span>
                                 @endif
                             @endforeach
                        </span>
                        </li>
                        <li class="collection-item">
                            <div>
                                Total Refunds to
                                @foreach($foodies as $foodie)
                                 @if($foodie->id==$refundArray['id'])
                                     <span>{{$foodie->first_name.' '.$foodie->last_name}}</span>
                                 @endif
                             @endforeach
                            </div>
                            <span style="font-size: 14px;">{{'PHP '.number_format(($refundArray['total']),2,'.',',')}}</span>
                        </li>
                        <li class="collection-item">
                            <div>
                                Total Unpaid Refunds to
                                @foreach($foodies as $foodie)
                                 @if($foodie->id==$refundArray['id'])
                                     <span>{{$foodie->first_name.' '.$foodie->last_name}}</span>
                                 @endif
                             @endforeach
                            </div>
                            <span style="font-size: 14px;">{{'PHP '.number_format(($refundArray['pend']),2,'.',',')}}</span>
                        </li>
                        <li class="collection-item">
                            <div>
                                Total Paid Refunds to
                                @foreach($foodies as $foodie)
                                 @if($foodie->id==$refundArray['id'])
                                     <span>{{$foodie->first_name.' '.$foodie->last_name}}</span>
                                 @endif
                             @endforeach
                            </div>
                            <span style="font-size: 14px;">{{'PHP '.number_format(($refundArray['paid']),2,'.',',')}}</span>
                        </li>
                    </ul>
                @endforeach

                <ul id="refundAll" class="collection" style="margin-top: 0;">
                    <li class="collection-item grey lighten-3">
                         <span>
                            Total Refunds From {{$firstRefund->created_at->format('F d, Y')}} To {{$lastRefund->created_at->format('F d, Y')}}
                        </span>
                    </li>
                    <li class="collection-item"><div>Total Refunds for Customers:</div> <span style="font-size: 14px;">{{'PHP '.number_format(($totalRefunds),2,'.',',')}}</span></li>
                    <li class="collection-item"><div>Total Unpaid Refunds for Customers:</div> <span style="font-size: 14px;">{{'PHP '.number_format(($pendRefunds),2,'.',',')}}</span></li>
                    <li class="collection-item"><div>Total Paid Refunds for Customers:</div> <span style="font-size: 14px;">{{'PHP '.number_format(($paidRefunds),2,'.',',')}}</span></li>
                </ul>
            </div>
            <div class="col s12 m10">
                <div class="row">
                    <div class="col s12 m3">
                        <div>
                            <span>Search by Foodie:</span>
                        </div>
                        <select id="foodieFilter">
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div id="foodiesContainer">
                    </div>
                    <div id="divFoodiesAll">
                        @foreach($refundFoodies as $refundFoodie)
                            <div id="cardRef{{$refundFoodie}}" class="card foodieCard">
                                <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                                    <div>
                                        <span>
                                            Commissions -
                                            @foreach($foodies as $foodie)
                                                @if($foodie->id==$refundFoodie)
                                                    <span>{{$foodie->name}}</span>
                                                @endif
                                            @endforeach
                                        </span>
                                        <span class="badge light-green white-text" style="border-radius: 15px">
                                            {{$refunds->where('foodie_id','=',$refundFoodie)->count()}}
                                        </span>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="row center">
                                        @foreach($uniqueRefundArray as $refundArray)
                                            @if($refundArray['id']==$refundFoodie)
                                                <div class="col s12 m3">
                                                    <div>
                                                        Total For
                                                        @foreach($foodies as $foodie)
                                                            @if($foodie->id==$refundFoodie)
                                                                <span>{{$foodie->name}}</span>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    <span>{{'PHP '.number_format(($refundArray['total']),2,'.',',')}}</span>
                                                </div>
                                                <div class="col s12 m3">
                                                    <div>
                                                        Total Unpaid For
                                                        @foreach($foodies as $foodie)
                                                            @if($foodie->id==$refundFoodie)
                                                                <span>{{$foodie->name}}</span>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                    <span>{{'PHP '.number_format(($refundArray['pend']),2,'.',',')}}</span>
                                                </div>
                                                <div class="col s12 m3">
                                                    <div>
                                                        Total Paid For
                                                        @foreach($foodies as $foodie)
                                                            @if($foodie->id==$refundFoodie)
                                                                <span>{{$foodie->name}}</span>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    <span>{{'PHP '.number_format(($refundArray['paid']),2,'.',',')}}</span>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="divider">
                                    </div>
                                    <div class="row center">
                                        <div class="col s12 m4">
                                            <span class="refundTabAll{{$refundFoodie}} tableTab">All</span>
                                        </div>
                                        <div class="col s12 m4">
                                            <span class="refundTabPend{{$refundFoodie}} tableTab">Pending</span>
                                        </div>
                                        <div class="col s12 m4">
                                            <span class="refundTabPaid{{$refundFoodie}} tableTab">Paid</span>
                                        </div>
                                    </div>
                                    <script>
                                        $(document).ready(function () {
                                            $('span.refundTabAll{{$refundFoodie}}').addClass('activeTab');
                                            $('table#allTable{{$refundFoodie}}').show();
                                            $('table#pendTable{{$refundFoodie}}').hide();
                                            $('table#paidTable{{$refundFoodie}}').hide();


                                            $('span.refundTabAll{{$refundFoodie}}').on('click',function () {
                                                $('.refundTabPend{{$refundFoodie}}').removeClass('activeTab');
                                                $('.refundTabPaid{{$refundFoodie}}').removeClass('activeTab');
                                                $(this).addClass('activeTab');

                                                $('table#allTable{{$refundFoodie}}').show();
                                                $('table#pendTable{{$refundFoodie}}').hide();
                                                $('table#paidTable{{$refundFoodie}}').hide();
                                            });
                                            $('span.refundTabPend{{$refundFoodie}}').on('click',function () {
                                                $('.refundTabPaid{{$refundFoodie}}').removeClass('activeTab');
                                                $('.refundTabAll{{$refundFoodie}}').removeClass('activeTab');
                                                $(this).addClass('activeTab');

                                                $('table#allTable{{$refundFoodie}}').hide();
                                                $('table#pendTable{{$refundFoodie}}').show();
                                                $('table#paidTable{{$refundFoodie}}').hide();
                                            });
                                            $('span.refundTabPaid{{$refundFoodie}}').on('click',function () {
                                                $('.refundTabPend{{$refundFoodie}}').removeClass('activeTab');
                                                $('.refundTabAll{{$refundFoodie}}').removeClass('activeTab');
                                                $(this).addClass('activeTab');

                                                $('table#allTable{{$refundFoodie}}').hide();
                                                $('table#pendTable{{$refundFoodie}}').hide();
                                                $('table#paidTable{{$refundFoodie}}').show();
                                            });
                                        });
                                    </script>
                                    <div class="divider">
                                    </div>
                                    <table id="allTable{{$refundFoodie}}" class="responsive-table centered">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            {{--<th>Chef Name</th>--}}
                                            <th>Date</th>
                                            <th>Refund Amount</th>
                                            <th>Payment Status</th>
                                            <th>Update</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($refunds->where('foodie_id','=',$refundFoodie) as $refund)
                                            <tr>
                                                <td>{{$refund->id}}</td>
                                                {{--<td>--}}
                                                {{--@foreach($chefs as $chef)--}}
                                                {{--@if($chef->id == $commission->chef_id)--}}
                                                {{--{{$chef->name}}--}}
                                                {{--@endif--}}
                                                {{--@endforeach--}}
                                                {{--</td>--}}
                                                <td>{{$refund->created_at->format('F d, Y')}}</td>
                                                <td>{{'PHP '.number_format(($refund->order_item->price * $refund->order_item->quantity),2,'.',',')}}</td>
                                                <td>
                                                    @if($refund->is_paid==0)
                                                        <span>Pending</span>
                                                    @elseif($refund->is_paid==1)
                                                        <span>Paid</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($refund->is_paid==0)
                                                        <a href="#updateRefundModal" data-id="{{$refund->id}}" class="updateRefund btn orange darken-2 waves-effect waves-light modal-trigger">Update</a>
                                                    @elseif($refund->is_paid==1)
                                                        <span>Paid</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <table id="pendTable{{$refundFoodie}}" class="responsive-table centered">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            {{--<th>Chef Name</th>--}}
                                            <th>Date</th>
                                            <th>Amount to Vendor</th>
                                            <th>Payment Status</th>
                                            <th>Update</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($refunds->where('foodie_id','=',$refundFoodie)->where('paid','=',0) as $refund)
                                            <tr>
                                                <td>{{$refund->id}}</td>
                                                {{--<td>--}}
                                                {{--@foreach($chefs as $chef)--}}
                                                {{--@if($chef->id == $commission->chef_id)--}}
                                                {{--{{$chef->name}}--}}
                                                {{--@endif--}}
                                                {{--@endforeach--}}
                                                {{--</td>--}}
                                                <td>{{$refund->created_at->format('F d, Y')}}</td>
                                                <td>{{'PHP '.number_format(($refund->order_item->price * $refund->order_item->quantity),2,'.',',')}}</td>
                                                <td>
                                                    @if($refund->paid==0)
                                                        <span>Pending</span>
                                                    @elseif($refund->paid==1)
                                                        <span>Paid</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($refund->is_paid==0)
                                                        <a href="#updateRefundModal" data-id="{{$refund->id}}" class="updateRefund btn orange darken-2 waves-effect waves-light modal-trigger">Update</a>
                                                    @elseif($refund->is_paid==1)
                                                        <span>Paid</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <table id="paidTable{{$refundFoodie}}" class="responsive-table centered">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            {{--<th>Chef Name</th>--}}
                                            <th>Date</th>
                                            <th>Amount to Vendor</th>
                                            <th>Payment Status</th>
                                            <th>Update</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($refunds->where('chef_id','=',$refundFoodie)->where('paid','=',1) as $refund)
                                            <tr>
                                                <td>{{$refund->id}}</td>
                                                {{--<td>--}}
                                                {{--@foreach($chefs as $chef)--}}
                                                {{--@if($chef->id == $commission->chef_id)--}}
                                                {{--{{$chef->name}}--}}
                                                {{--@endif--}}
                                                {{--@endforeach--}}
                                                {{--</td>--}}
                                                <td>{{$refund->created_at->format('F d, Y')}}</td>
                                                <td>{{'PHP '.number_format(($refund->order_item->price * $refund->order_item->quantity),2,'.',',')}}</td>
                                                <td>
                                                    @if($refund->is_paid==0)
                                                        <span>Pending</span>
                                                    @elseif($refund->is_paid==1)
                                                        <span>Paid</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($refund->is_paid==0)
                                                        <a href="#updateRefundModal" data-id="{{$refund->id}}" class="updateRefund btn orange darken-2 waves-effect waves-light modal-trigger">Update</a>
                                                    @elseif($refund->is_paid==1)
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
        </div>
    </div>


    <div id="updateRefundModal" class="modal">
        <div class="modal-content">
            <form id="refundForm" action="{{route('admin.refundUpdate')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" id="refund-id" name="refund-id" value="">
                <div class="row">
                    <div id="refundContainer">
                    </div>
                    <div class="file-field input-field">
                        <label for="refundPic" class="active">Picture Upload:</label>
                        <div style="padding-top: 10px;">
                            <div class="btn orange darken-2">
                                <span>File</span>
                                <input type="file" data-error=".error-pic" id="refundPic" name="refundPic">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" >
                            </div>
                            <div class="error-pic err"></div>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn waves-effect waves-light orange darken-2" value="Submit">
            </form>
        </div>
    </div>


@endsection