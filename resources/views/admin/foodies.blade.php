@extends("layouts.app")
@section('head')
    <script src="/js/admin/admin.js" defer></script>
    <script src="/js/admin/foodieRegistration.validate.js" defer></script>
@endsection

@section('content')
    <nav>
        <div class="nav-wrapper light-green lighten-1">
            <div style="margin-left: 10px;">
                <a href="{{route("admin.dashboard")}}" class="brand-logo">Admin Panel</a>
            </div>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li>
                    <a class="dropdown-button" href="#" data-activates='adminNotificationDropdown' data-beloworigin="true" data-constrainwidth="false">
                        <span class="valign-wrapper" style="position: relative;">
                            <span style="margin-left: 2px;">
                                Notifications
                            </span>
                        </span>
                    </a>
                    <ul id="adminNotificationDropdown" class="notifCol dropdown-content collection" style="max-width: 300px;">
                        <li class="collection-item"><a id="clearAll" href="#">Mark All Read</a></li>
                        @unless($notifications->count()>0)
                            <li class="collection-item">
                                <span>No notifications</span>
                            </li>
                        @endunless
                    </ul>
                </li>
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
            </div>
            <div class="col s12 m10">
                <div class="card">
                    <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                        <div>
                            <span>
                                Foodies
                            </span>
                            <span class="badge light-green white-text" style="border-radius: 15px">
                                {{$foodies->count()}}
                            </span>
                        </div>
                    </div>
                    <div class="card-content">
                        <table class="responsive-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email Address</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($foodies as $foodie)
                                    <tr>
                                        <td>{{$foodie->id}}</td>
                                        <td>
                                            <a href="{{route('admin.foodie', $foodie->id)}}">{{$foodie->first_name.' '.$foodie->last_name}}</a>
                                        </td>
                                        <td>
                                            {{$foodie->email}}
                                            {{--@if($foodie->username!="")--}}
                                                {{--{{$foodie->username}}--}}
                                            {{--@else--}}
                                                {{--N/A--}}
                                            {{--@endif--}}
                                        </td>
                                        <td>
                                            @if($foodie->active==1)
                                                <span>Active</span>
                                            @elseif($foodie->active==0)
                                                <span>Frozen</span>
                                            @endif
                                        </td>
                                        <td>{{$foodie->created_at->format('F d, Y')}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 offset-m2">
                <button data-target="foodie-reg-form-modal" class="btn waves-effect waves-light modal-trigger">Create Foodie</button>
            </div>
        </div>
    </div>

    <div id="foodie-reg-form-modal" class="modal modal-fixed-footer">
        <form id="registration" role="form" method="POST" action="{{ route('admin.foodie.register') }}">
            {{ csrf_field() }}
            <div class="modal-content">
                <h3 class="mustard-text">Admin Foodie Creation</h3>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="n-reg-fname" name="first_name" type="text" data-error=".error-msg-fname" value="{{ old('first_name') }}"/>
                        <label for="n-reg-fname">First Name</label>
                        <div class="error-msg-fname">
                            @if ($errors->has('first_name'))
                                {{ $errors->first('first_name') }}
                            @endif
                        </div>
                    </div>
                    <div class="input-field col s6">
                        <input id="n-reg-lname" name="last_name" type="text" data-error=".error-msg-lname" value="{{ old('last_name') }}">
                        <label for="n-reg-lname">Last Name</label>
                        <div class="error-msg-lname">
                            @if ($errors->has('last_name'))
                                {{ $errors->first('last_name') }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <div class="col s1 light-green lighten-1 valign-wrapper center" style="height: 2rem; margin-top: 10px;">
                            <span>+63</span>
                        </div>
                        <div class="col s11">
                            <label for="n-reg-mobile-num">Mobile Number</label>
                            <input id="n-reg-mobile-num" name="mobile_number" type="text" placeholder="i.e. 9159876543" data-error=".error-msg-mobile-num" value="{{ old('mobile_number') }}"/>
                            <div class="error-msg-mobile-num">
                                @if ($errors->has('mobile_number'))
                                    {{ $errors->first('mobile_number') }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="n-reg-email" name="registration_email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" data-error=".error-msg-email" value="{{ old('registration_email') }}"/>
                        <label for="n-reg-email">Email</label>
                        <div class="error-msg-email">
                            @if ($errors->has('registration_email'))
                                {{ $errors->first('registration_email') }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s9">
                        <input id="n-reg-pass" name="password" type="password" data-error=".error-msg-pass"/>
                        <label for="n-reg-pass">Password</label>
                        <div class="error-msg-pass">
                            @if ($errors->has('password'))
                                {{ $errors->first('password') }}
                            @endif
                        </div>
                    </div>
                    <div class="col s3 valign-wrapper">
                        <span id="result" style="margin-top:43px;"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="n-reg-confirm-password" name="password_confirmation" type="password" data-error=".error-msg-confirm-pass"/>
                        <label for="n-reg-confirm-password">Confirm Password</label>
                        <div class="error-msg-confirm-pass">
                            @if ($errors->has('password_confirmation'))
                                {{ $errors->first('password_confirmation') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="hidden"/>
                <a href="javascript:void(0)" class="modal-action modal-close btn-flat right-align n-btn-link"><i class="fa fa-times-circle"></i> <span class="hide-on-small-only n-modal-form-btn-text">Close</span></a>
                <a href="javascript:void(0)" class="modal-action btn-flat n-btn-link n-submit-btn"><i class="fa fa-paper-plane-o"></i><span class="hide-on-small-only n-modal-form-btn-text"> Submit</span></a>
            </div>
        </form>
    </div>


@endsection