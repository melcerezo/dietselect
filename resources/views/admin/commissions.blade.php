@extends("layouts.app")
@section('head')

@endsection

@section('content')
    <nav>
        <div class="nav-wrapper light-green lighten-1">
            <div style="margin-left: 10px;">
                <a href="#!" class="brand-logo">Admin Panel</a>
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
                    <a href="#">
                        <span class="valign-wrapper">
                            <span style="margin-left: 2px;">
                                Users
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
                                <td>{{'PHP'.number_format($commission->amount,2,'.')}}</td>
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



@endsection