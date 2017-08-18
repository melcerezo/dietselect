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
        <div class="card">
            <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                <div>
                    <span>
                        {{$foodie->first_name.' '.$foodie->last_name}}
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
                                       Foodie Information
                                    </span>
                                </div>
                            </div>
                            <ul class="collection">
                                <li class="collection-item">
                                    <span>Gender: </span>
                                    <span>
                                        @if($foodie->gender=='M')
                                            Male
                                        @elseif($foodie->gender=='F')
                                            Female
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                </li>
                                <li class="collection-item">
                                    <span>Birthday: </span>
                                    <span>{{$foodie->birthday}}</span>
                                </li>
                                <li class="collection-item">
                                    <span>Username: </span>
                                    <span>
                                        @if($foodie->username!="")
                                            {{$foodie->username}}
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                </li>
                                <li class="collection-item">
                                    <span>Preference: </span>
                                    <span>
                                        @if($foodiePreference->ingredient!='')
                                            {{ucfirst($foodiePreference->ingredient)}}
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                </li>
                                <li class="collection-item">
                                    <span>Foodie Since:</span>
                                    <span>{{$foodie->created_at->format('F d, Y')}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
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
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    @if($order->is_cancelled!=1)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->total}}</td>
                                            <td>
                                                @if($order->is_paid==0)
                                                    <span>Pending</span>
                                                @elseif($order->is_paid==1)
                                                    <span>Paid</span>
                                                @endif
                                            </td>
                                            <td>{{$order->created_at->format('F d, Y')}}</td>
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
                                        Cancelled Orders
                                    </span>
                                </div>
                            </div>
                            <table class="responsive-table centered" style="table-layout: fixed;">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    @if($order->is_cancelled==1)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->total}}</td>
                                            <td>
                                                <span>Cancelled</span>
                                            </td>
                                            <td>{{$order->created_at->format('F d, Y')}}</td>
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
                                        Addresses
                                    </span>
                                </div>
                            </div>
                            <table class="responsive-table centered" style="table-layout: fixed;">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Address</th>
                                    <th>Type</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($foodieAddresses as $foodieAddress)
                                    <tr>
                                        <td>{{$foodieAddress->id}}</td>
                                        <td>
                                            {{$foodieAddress->unit}}
                                            @if($foodie->bldg!='')
                                                {{$foodieAddress->bldg}}
                                            @endif
                                            {{', '.$foodieAddress->street.', '.$foodieAddress->brgy.', '.$foodieAddress->city}}
                                        </td>
                                        <td>
                                            @if($foodieAddress->type=='R')
                                                <span>Residence</span>
                                            @elseif($foodieAddress->type=='O')
                                                <span>Office</span>
                                            @endif
                                        </td>
                                    </tr>
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
                                    Allergies
                                </span>
                                </div>
                            </div>
                            <ul class="collection">
                                @foreach($foodieAllergy as $allergy)
                                    <li class="collection-item">{{$allergy->allergy}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection