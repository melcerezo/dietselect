@extends("layouts.app")
@section('head')
    <style>
        ul.notifCol{
            max-width: 250px !important;
            white-space: normal !important;
        }
    </style>
    <script src="/js/admin/admin.js" defer></script>
    <script src="/js/admin/chefRegistration.validate.js" defer></script>
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
                                <span id="notifBadge"></span>
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
                                Chefs
                            </span>
                            <span class="badge light-green white-text" style="border-radius: 15px">
                                {{$chefs->count()}}
                            </span>
                        </div>
                    </div>
                    <div class="card-content">
                        <table class="responsive-table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Company Name</th>
                                <th>Status</th>
                                <th>Created</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($chefs as $chef)
                                <tr>
                                    <td>{{$chef->id}}</td>
                                    <td>
                                        <a href="{{route('admin.chef', $chef->id)}}">{{$chef->name}}</a>
                                    </td>
                                    <td>
                                        @if($chef->active==1)
                                            <span>Active</span>
                                        @elseif($chef->active==0)
                                            <span>Frozen</span>
                                        @endif
                                    </td>
                                    <td>{{$chef->created_at->format('F d, Y')}}</td>
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
                <button data-target="registration" class="btn waves-effect waves-light modal-trigger">Create Chef</button>
            </div>
        </div>
    </div>

    <div id="registration" class="modal">
        <div class="modal-content">
            <form id="registration" role="form" method="POST" action="{{ route('admin.chef.register') }}">
                {{ csrf_field() }}
                <div class="card-content">
                    <h3 class="mustard-text">Chef Admin Creation</h3>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="n-reg-name" name="name" type="text" data-error=".error-msg-name" value="{{ old('name') }}">
                            <label for="n-reg-name">Business/Company Name</label>
                            <div class="error-msg-name">
                                @if ($errors->has('name'))
                                    {{ $errors->first('name') }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="n-reg-email" name="email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" data-error=".error-msg-email" value="{{ old('email') }}"/>
                            <label for="n-reg-email">Email</label>
                            <div class="error-msg-email">
                                @if ($errors->has('email'))
                                    {{ $errors->first('email') }}
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
                            <input id="n-reg-website" name="website" type="text" data-error=".error-msg-website" value="{{ old('website') }}" placeholder="http://">
                            <label for="n-reg-website">Website</label>
                            <div class="error-msg-website">
                                @if ($errors->has('website'))
                                    {{ $errors->first('website') }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="n-reg-url" name="url_name" type="text" data-error=".error-msg-url" value="{{ old('url_name') }}">
                            <label for="n-reg-url">URL Name</label>
                            <div class="error-msg-url">
                                @if ($errors->has('url_name'))
                                    {{ $errors->first('url_name') }}
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
                <div class="card-action">
                    <input type="submit" class="hidden"/>
                    <a href="javascript:void(0)" class="btn-flat n-btn-link n-submit-btn right"><i class="fa fa-paper-plane-o"></i><span class="hide-on-small-only n-form-btn-text"> Submit</span></a>
                </div>
            </form>
        </div>
    </div>


@endsection