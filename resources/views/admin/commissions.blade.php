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
                    <li class="collection-item"><a href="{{route('admin.orders')}}">Orders</a></li>
                    <li class="collection-item"><a href="{{route('admin.foodies')}}">Foodies</a></li>
                    <li class="collection-item"><a href="{{route('admin.chefs')}}">Chefs</a></li>
                </ul>
            </div>
            <div class="col s12 m10">
                <div class="row">
                    <div class="col s12 m7">
                        <div class="card">
                            <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                                <div>
                                    <span>
                                        Total Commissions
                                    </span>
                                </div>
                            </div>
                            <ul class="collection">
                                <li class="collection-item">Total Commissions: {{$totalCommissions}}</li>
                                <li class="collection-item">Total Unpaid Commissions: {{$pendCommissions}}</li>
                                <li class="collection-item">Total Paid Commissions: {{$paidCommissions}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <div class="card">
                            <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                                <div>
                                    <span>
                                        Commissions
                                    </span>
                                     <span class="badge light-green white-text" style="border-radius: 15px">
                                        {{$commissions->count()}}
                                    </span>
                                </div>
                            </div>
                            <div class="card-content">
                                <table class="responsive-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Chef Name</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Paid</th>
                                            <th>Update</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($commissions as $commission)
                                            <tr>
                                                <td>{{$commission->id}}</td>
                                                <td>
                                                    @foreach($chefs as $chef)
                                                        @if($chef->id == $commission->chef_id)
                                                            {{$chef->name}}
                                                        @endif
                                                    @endforeach
                                                </td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection