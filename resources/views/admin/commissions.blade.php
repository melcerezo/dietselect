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
        .chefCom{
            display: none;
        }
        /*.comContents{*/
            /*display: none;*/
        /*}*/
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
                        <li class="collection-item">
                            <div>Total Commissions to Vendors:</div>
                            <span style="font-size: 14px;">{{'PHP '.number_format(($comArray['total'] * 0.9),2,'.',',')}}</span>
                        </li>
                        <li class="collection-item"><div>Total Unpaid Commissions to Vendors:</div> <span style="font-size: 14px;">{{'PHP '.number_format(($comArray['pend'] * 0.9),2,'.',',')}}</span></li>
                        <li class="collection-item"><div>Total Paid Commissions to Vendors:</div> <span style="font-size: 14px;">{{'PHP '.number_format(($comArray['paid'] * 0.9),2,'.',',')}}</span></li>
                        <li class="collection-item"><div>Total Collected for DietSelect:</div> <span style="font-size: 14px;">{{'PHP '.number_format(($comArray['total'] * 0.1),2,'.',',')}}</span></li>
                    </ul>
                @endforeach

                <ul id="sumAll" class="collection" style="margin-top: 0;">
                    <li class="collection-item grey lighten-3">
                         <span>
                            Total Commissions From {{$firstCom->created_at->format('F d, Y')}} To {{$lastCom->created_at->format('F d, Y')}}
                        </span>
                    </li>
                    <li class="collection-item">
                        <div>Total Commissions for Vendors:</div>
                        <span style="font-size: 14px; font-weight: bold;">{{'PHP '.number_format(($totalCommissions * 0.9),2,'.',',')}}</span>
                        <div style="margin-top: 5px;">
                            <span>Breakdown</span>
                        </div>
                        @foreach($uniqueComArray as $comArray)
                            @foreach($chefs as $chef)
                                @if($chef->id==$comArray['id'])
                                    <div class="divider">
                                    </div>
                                    <div>
                                        {{$chef->name.':'}}
                                    </div>
                                    <div>{{'PHP '.number_format(($comArray['total']*0.9),2,'.',',')}}</div>
                                @endif
                            @endforeach
                        @endforeach
                    </li>
                    <li class="collection-item">
                        <div>Total Unpaid Commissions for Vendors:</div> <span style="font-size: 14px; font-weight: bold;">{{'PHP '.number_format(($pendCommissions * 0.9),2,'.',',')}}</span>
                        <div style="margin-top: 5px;">
                            <span>Breakdown</span>
                        </div>
                        @foreach($uniqueComArray as $comArray)
                            @foreach($chefs as $chef)
                                @if($chef->id==$comArray['id'])
                                    <div class="divider">
                                    </div>
                                    <div>
                                        {{$chef->name.':'}}
                                    </div>
                                    <div>{{'PHP '.number_format(($comArray['pend']*0.9),2,'.',',')}}</div>
                                @endif
                            @endforeach
                        @endforeach
                    </li>
                    <li class="collection-item">
                        <div>Total Paid Commissions for Vendors:</div>
                        <span style="font-size: 14px; font-weight: bold;">{{'PHP '.number_format(($paidCommissions * 0.9),2,'.',',')}}</span>
                        <div style="margin-top: 5px;">
                            <span>Breakdown</span>
                        </div>
                        @foreach($uniqueComArray as $comArray)
                            @foreach($chefs as $chef)
                                @if($chef->id==$comArray['id'])
                                    <div class="divider">
                                    </div>
                                    <div>
                                        {{$chef->name.':'}}
                                    </div>
                                    <div>{{'PHP '.number_format(($comArray['paid']*0.9),2,'.',',')}}</div>
                                @endif
                            @endforeach
                        @endforeach
                    </li>
                    <li class="collection-item">
                        <div>Total Collected For DietSelect:</div>
                        <span style="font-size: 14px; font-weight: bold;">{{'PHP '.number_format(($paidCommissions * 0.1),2,'.',',')}}</span>
                        <div style="margin-top: 5px;">
                            <span>Breakdown</span>
                        </div>
                        @foreach($uniqueComArray as $comArray)
                            @foreach($chefs as $chef)
                                @if($chef->id==$comArray['id'])
                                    <div class="divider">
                                    </div>
                                    <div>
                                        {{$chef->name.':'}}
                                    </div>
                                    <div>{{'PHP '.number_format(($comArray['paid']*0.1),2,'.',',')}}</div>
                                @endif
                            @endforeach
                        @endforeach
                    </li>
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
                        @foreach($uniqueComChefs as $uniqueComChef)
                            <div id="cardCom{{$uniqueComChef}}" class="card chefCard">
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
                                        {{--<span class="badge light-green white-text" style="border-radius: 15px">--}}
                                            {{--{{$commissions->where('chef_id','=',$uniqueComChef)->count()}}--}}
                                        {{--</span>--}}
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div id="allMonth{{$uniqueComChef}}" class="row comContents">
                                        <div class="col s12 m3">
                                            <div>
                                                <span>Type:</span>
                                            </div>
                                            <select id="yearFilter{{$uniqueComChef}}">
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col s12 m3">
                                                <div>
                                                    <span>Month:</span>
                                                </div>
                                                <select id="monthFilter{{$uniqueComChef}}">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="divider" style="margin-bottom: 20px;">
                                        </div>
                                        <div class="row">
                                            <div id="monthContainer{{$uniqueComChef}}" class="col s12">
                                                <div class="row">
                                                    <div class="col s12 m3">
                                                        <div>
                                                            <span>Type:</span>
                                                        </div>
                                                        <select id="typeFilter{{$uniqueComChef}}">
                                                            <option value="0" selected>All</option>
                                                            <option value="1">Pending</option>
                                                            <option value="2">Paid</option>
                                                            <option value="3">Cancelled</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="divider">
                                                </div>
                                                <div class="row center" style="margin-top:5px;">
                                                    <div id="chefAllTotalAmount{{$uniqueComChef}}" class="col s12 m3 center">
                                                    </div>
                                                    <div id="chefPendTotalAmount{{$uniqueComChef}}" class="col s12 m3 center">
                                                    </div>
                                                    <div id="chefPaidTotalAmount{{$uniqueComChef}}" class="col s12 m3 center">
                                                    </div>
                                                    <div id="dietPaidTotalAmount{{$uniqueComChef}}" class="col s12 m3 center">
                                                    </div>
                                                </div>
                                                <div class="divider">
                                                </div>
                                                <div class="row">
                                                    <div id="monthPicker{{$uniqueComChef}}" class="col s12">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div id="pendMonthPicker{{$uniqueComChef}}" class="col s12">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div id="paidMonthPicker{{$uniqueComChef}}" class="col s12">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div id="cancelMonthPicker{{$uniqueComChef}}" class="col s12">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            $(document).ready(function () {
                                                $('#monthPicker{{$uniqueComChef}}').show();
                                                $('#pendMonthPicker{{$uniqueComChef}}').hide();
                                                $('#paidMonthPicker{{$uniqueComChef}}').hide();
                                                $('#cancelMonthPicker{{$uniqueComChef}}').hide();
                                                
                                                var yearAjax = getYears();
                                                
                                                yearAjax.done(function (response) {
                                                    var valData = JSON.parse(response);

                                                    for(var i in valData){
                                                        var text = valData[i].yearText;
                                                        if(valData[i].current==1){
                                                            text += '(current)';
                                                            $('select#yearFilter{{$uniqueComChef}}').append(
                                                                    $('<option></option>').attr("value",valData[i].month).text(text).prop('selected','selected')
                                                            );
                                                        }else{
                                                            $('select#yearFilter{{$uniqueComChef}}').append(
                                                                    $('<option></option>').attr("value",valData[i].month).text(text)
                                                            );
                                                        }
                                                    }

                                                    $('select#yearFilter{{$uniqueComChef}}').material_select();

                                                    var selectVal = $('select#yearFilter{{$uniqueComChef}}').val();

                                                    var monthAjax = getMonths(selectVal);

                                                    monthAjax.done(function (response) {

                                                        var valData = JSON.parse(response);
    //                                                        console.log(valData);
                                                        for(var i in valData){
                                                            var text = valData[i].monthText;
                                                            if(valData[i].current==1){
                                                                text += '(current)';
                                                                $('select#monthFilter{{$uniqueComChef}}').append(
                                                                        $('<option></option>').attr("value",valData[i].month).text(text).prop('selected','selected')
                                                                );
                                                            }else{
                                                                $('select#monthFilter{{$uniqueComChef}}').append(
                                                                        $('<option></option>').attr("value",valData[i].month).text(text)
                                                                );
                                                            }
                                                        }

                                                        $('select#monthFilter{{$uniqueComChef}}').material_select();

                                                        var yearVal = $('select#yearFilter{{$uniqueComChef}}').val();

                                                        var selectVal = $('select#monthFilter{{$uniqueComChef}}').val();


                                                        // month change


                                                        var changeMonth = monthChange('{{$uniqueComChef}}',yearVal,selectVal);

                                                        changeMonth.done(function (response) {
                                                            $('#monthPicker{{$uniqueComChef}}').empty();
                                                            $('#pendMonthPicker{{$uniqueComChef}}').empty();
                                                            $('#paidMonthPicker{{$uniqueComChef}}').empty();
                                                            $('#cancelMonthPicker{{$uniqueComChef}}').empty();
                                                            $('#chefPendTotalAmount{{$uniqueComChef}}').empty();
                                                            $('#chefPaidTotalAmount{{$uniqueComChef}}').empty();
                                                            $('#dietPaidTotalAmount{{$uniqueComChef}}').empty();
                                                            if(response==''){
                                                                $('#monthPicker{{$uniqueComChef}}').append('<div>No Commissions</div>');
                                                                $('#pendMonthPicker{{$uniqueComChef}}').append('<div>No Commissions</div>');
                                                                $('#paidMonthPicker{{$uniqueComChef}}').append('<div>No Commissions</div>');
                                                                $('#cancelMonthPicker{{$uniqueComChef}}').append('<div>No Commissions</div>');
                                                            }else{
                                                                var valData = JSON.parse(response);
                                                                console.log(valData);


                                                                var chefAllTotal = 0;
                                                                var chefPendTotal = 0;
                                                                var chefPaidTotal = 0;
                                                                var dietTotal = 0;

                                                                var chefAllTabPay = 0;
                                                                var chefAllTabChefPay = 0;
                                                                var chefAllTabDietPay = 0;

                                                                var chefPendTabPay = 0;
                                                                var chefPendTabChefPay = 0;
                                                                var chefPendTabDietPay = 0;

                                                                var chefPaidTabPay = 0;
                                                                var chefPaidTabChefPay = 0;
                                                                var chefPaidTabDietPay = 0;

                                                                var x = '<div class="row">';
                                                                x += '<div class="col s12 m3">';
                                                                x += '</div>';
                                                                x += '<div class="col s12 m3">';
                                                                x += '</div>';
                                                                x += '<div class="col s12 m3">';
                                                                x += '</div>';
                                                                x += '<div class="col s12 m3">';
                                                                x += '</div>';
                                                                x += '</div>';
                                                                x += '<div class="row">';
                                                                x += '<div class="col s12">';
                                                                x += '<table class="">';
                                                                x += '<thead>';
                                                                x += '<tr>';
                                                                x += '<th>ID</th>';
                                                                x += '<th>Name</th>';
                                                                x += '<th>Date</th>';
                                                                x += '<th>Total Payable</th>';
                                                                x += '<th>Payable to Vendor</th>';
                                                                x += '<th>Payable to DietSelect</th>';
                                                                x += '<th>Order Status</th>';
                                                                x += '<th>Payment Status</th>';
                                                                x += '</tr>';
                                                                x += '</thead>';
                                                                x += '<tbody>';
                                                                for(var i in valData){
                                                                    var amount = valData[i].amount;
                                                                    var chefAmount = valData[i].chefAmount;
                                                                    var dietAmount = valData[i].dietAmount;

                                                                    chefAllTabPay += amount;
                                                                    chefAllTabChefPay += chefAmount;
                                                                    chefAllTabDietPay += dietAmount;

                                                                    chefAllTotal += chefAmount;

                                                                    x += '<tr>';
                                                                    x += '<td>'+valData[i].id+'</td>';
                                                                    x += '<td>'+valData[i].name+'</td>';
                                                                    x += '<td>'+valData[i].created_at+'</td>';
                                                                    if(valData[i].status==0){
                                                                        x += '<td>PHP '+addCommas(amount.toFixed(2))+'</td>';
                                                                        x += '<td>PHP '+addCommas(chefAmount.toFixed(2))+'</td>';
                                                                        x += '<td>PHP '+addCommas(dietAmount.toFixed(2))+'</td>';
                                                                        x += '<td>Paid</td>';
                                                                    }else{
                                                                        x += '<td>PHP 0.00</td>';
                                                                        x += '<td>PHP 0.00</td>';
                                                                        x += '<td>PHP 0.00</td>';
                                                                        x += '<td>Cancelled</td>';
                                                                    }
                                                                    if(valData[i].status==0){
                                                                        if(valData[i].paid==0){
                                                                            x += '<td>Pending</td>';
                                                                        }else{
                                                                            x += '<td>Paid</td>';
                                                                        }
                                                                    }else{
                                                                        x += '<td>Cancelled</td>';
                                                                    }
                                                                    x += '</tr>';
                                                                }
                                                                x +='<tr>';
                                                                x +='<td></td>';
                                                                x +='<td></td>';
                                                                x +='<td>Total:</td>';
                                                                x += '<td>PHP '+addCommas(chefAllTabPay.toFixed(2))+'</td>';
                                                                x += '<td>PHP '+addCommas(chefAllTabChefPay.toFixed(2))+'</td>';
                                                                x += '<td>PHP '+addCommas(chefAllTabDietPay.toFixed(2))+'</td>';
                                                                x += '<td></td>';
                                                                x += '<td></td>';
                                                                x += '</tr>';
                                                                x += '</tbody>';
                                                                x += '</table>';
                                                                x += '</div>';
                                                                x += '</div>';

                                                                var xPend = '<div class="row">';
                                                                xPend += '<div class="col s12 m3">';
                                                                xPend += '</div>';
                                                                xPend += '<div class="col s12 m3">';
                                                                xPend += '</div>';
                                                                xPend += '<div class="col s12 m3">';
                                                                xPend += '</div>';
                                                                xPend += '<div class="col s12 m3">';
                                                                xPend += '</div>';
                                                                xPend += '</div>';
                                                                xPend += '<div class="row">';
                                                                xPend += '<div class="col s12">';
                                                                xPend += '<table class="">';
                                                                xPend += '<thead>';
                                                                xPend += '<tr>';
                                                                xPend += '<th>ID</th>';
                                                                xPend += '<th>Name</th>';
                                                                xPend += '<th>Date</th>';
                                                                xPend += '<th>Total Payable</th>';
                                                                xPend += '<th>Payable to Vendor</th>';
                                                                xPend += '<th>Payable to DietSelect</th>';
                                                                xPend += '<th>Order Status</th>';
                                                                xPend += '<th>Payment Status</th>';
                                                                xPend += '</tr>';
                                                                xPend += '</thead>';
                                                                xPend += '<tbody>';
                                                                for(var j in valData){
                                                                    if(valData[j].status==0 && valData[j].paid==0){
                                                                        var pendAmount = valData[j].amount;
                                                                        var pendChefAmount = valData[j].chefAmount;
                                                                        var pendDietAmount = valData[j].dietAmount;

                                                                        chefPendTotal +=valData[j].chefAmount;
                                                                        chefPendTabPay += pendAmount;
                                                                        chefPendTabChefPay += pendChefAmount;
                                                                        chefPendTabDietPay += pendDietAmount;

                                                                        xPend += '<tr>';
                                                                        xPend += '<td>'+valData[j].id+'</td>';
                                                                        xPend += '<td>'+valData[j].name+'</td>';
                                                                        xPend += '<td>'+valData[j].created_at+'</td>';
                                                                        if(valData[j].status==0){
                                                                            xPend += '<td>PHP '+addCommas(pendAmount.toFixed(2))+'</td>';
                                                                            xPend += '<td>PHP '+addCommas(pendChefAmount.toFixed(2))+'</td>';
                                                                            xPend += '<td>PHP '+addCommas(pendDietAmount.toFixed(2))+'</td>';
                                                                            xPend += '<td>Paid</td>';
                                                                        }else{
                                                                            xPend += '<td>PHP 0.00</td>';
                                                                            xPend += '<td>PHP 0.00</td>';
                                                                            xPend += '<td>PHP 0.00</td>';
                                                                            xPend += '<td>Cancelled</td>';
                                                                        }
                                                                        if(valData[j].status==0){
                                                                            if(valData[j].paid==0){
                                                                                xPend += '<td>Pending</td>';
                                                                            }else{
                                                                                xPend += '<td>Paid</td>';
                                                                            }
                                                                        }else{
                                                                            xPend += '<td>Cancelled</td>';
                                                                        }
                                                                    }
                                                                    xPend += '</tr>';
                                                                }
                                                                xPend +='<tr>';
                                                                xPend +='<td></td>';
                                                                xPend +='<td></td>';
                                                                xPend +='<td>Total:</td>';
                                                                xPend += '<td>PHP '+addCommas(chefPendTabPay.toFixed(2))+'</td>';
                                                                xPend += '<td>PHP '+addCommas(chefPendTabChefPay.toFixed(2))+'</td>';
                                                                xPend += '<td>PHP '+addCommas(chefPendTabDietPay.toFixed(2))+'</td>';
                                                                xPend += '<td></td>';
                                                                xPend += '<td></td>';
                                                                xPend += '</tr>';
                                                                xPend += '</tbody>';
                                                                xPend += '</table>';
                                                                xPend += '</div>';
                                                                xPend += '</div>';

                                                                var xPaid = '<div class="row">';
                                                                xPaid += '<div class="col s12 m3">';
                                                                xPaid += '</div>';
                                                                xPaid += '<div class="col s12 m3">';
                                                                xPaid += '</div>';
                                                                xPaid += '<div class="col s12 m3">';
                                                                xPaid += '</div>';
                                                                xPaid += '<div class="col s12 m3">';
                                                                xPaid += '</div>';
                                                                xPaid += '</div>';
                                                                xPaid += '<div class="row">';
                                                                xPaid += '<div class="col s12">';
                                                                xPaid += '<table class="">';
                                                                xPaid += '<thead>';
                                                                xPaid += '<tr>';
                                                                xPaid += '<th>ID</th>';
                                                                xPaid += '<th>Name</th>';
                                                                xPaid += '<th>Date</th>';
                                                                xPaid += '<th>Total Payable</th>';
                                                                xPaid += '<th>Payable to Vendor</th>';
                                                                xPaid += '<th>Payable to DietSelect</th>';
                                                                xPaid += '<th>Order Status</th>';
                                                                xPaid += '<th>Payment Status</th>';
                                                                xPaid += '</tr>';
                                                                xPaid += '</thead>';
                                                                xPaid += '<tbody>';
                                                                for(var k in valData){
                                                                    if(valData[k].status==0 && valData[k].paid==1){
                                                                        var paidAmount = valData[k].amount;
                                                                        var paidChefAmount = valData[k].chefAmount;
                                                                        var paidDietAmount = valData[k].dietAmount;

                                                                        chefPaidTotal +=paidChefAmount;
                                                                        dietTotal += paidDietAmount;
                                                                        chefPaidTabPay += paidAmount;
                                                                        chefPaidTabChefPay += paidChefAmount;
                                                                        chefPaidTabDietPay += paidDietAmount;

                                                                        xPaid += '<tr>';
                                                                        xPaid += '<td>'+valData[k].id+'</td>';
                                                                        xPaid += '<td>'+valData[k].name+'</td>';
                                                                        xPaid += '<td>'+valData[k].created_at+'</td>';
                                                                        if(valData[k].status==0){
                                                                            xPaid += '<td>PHP '+addCommas(paidAmount.toFixed(2))+'</td>';
                                                                            xPaid += '<td>PHP '+addCommas(paidChefAmount.toFixed(2))+'</td>';
                                                                            xPaid += '<td>PHP '+addCommas(paidDietAmount.toFixed(2))+'</td>';
                                                                            xPaid += '<td>Paid</td>';
                                                                        }else{
                                                                            xPaid += '<td>PHP 0.00</td>';
                                                                            xPaid += '<td>PHP 0.00</td>';
                                                                            xPaid += '<td>PHP 0.00</td>';
                                                                            xPaid += '<td>Cancelled</td>';
                                                                        }
                                                                        if(valData[k].status==0){
                                                                            if(valData[k].paid==0){
                                                                                xPaid += '<td>Pending</td>';
                                                                            }else{
                                                                                xPaid += '<td>Paid</td>';
                                                                            }
                                                                        }else{
                                                                            xPaid += '<td>Cancelled</td>';
                                                                        }
                                                                    }
                                                                    xPaid += '</tr>';
                                                                }
                                                                xPaid +='<tr>';
                                                                xPaid +='<td></td>';
                                                                xPaid +='<td></td>';
                                                                xPaid +='<td>Total:</td>';
                                                                xPaid += '<td>PHP '+addCommas(chefPaidTabPay.toFixed(2))+'</td>';
                                                                xPaid += '<td>PHP '+addCommas(chefPaidTabChefPay.toFixed(2))+'</td>';
                                                                xPaid += '<td>PHP '+addCommas(chefPaidTabDietPay.toFixed(2))+'</td>';
                                                                xPaid += '<td></td>';
                                                                xPaid += '<td></td>';
                                                                xPaid += '</tr>';
                                                                xPaid += '</tbody>';
                                                                xPaid += '</table>';
                                                                xPaid += '</div>';
                                                                xPaid += '</div>';

                                                                var xCancel = '<div class="row">';
                                                                xCancel += '<div class="col s12 m3">';
                                                                xCancel += '</div>';
                                                                xCancel += '<div class="col s12 m3">';
                                                                xCancel += '</div>';
                                                                xCancel += '<div class="col s12 m3">';
                                                                xCancel += '</div>';
                                                                xCancel += '<div class="col s12 m3">';
                                                                xCancel += '</div>';
                                                                xCancel += '</div>';
                                                                xCancel += '<div class="row">';
                                                                xCancel += '<div class="col s12">';
                                                                xCancel += '<table class="">';
                                                                xCancel += '<thead>';
                                                                xCancel += '<tr>';
                                                                xCancel += '<th>ID</th>';
                                                                xCancel += '<th>Name</th>';
                                                                xCancel += '<th>Date</th>';
                                                                xCancel += '<th>Total Payable</th>';
                                                                xCancel += '<th>Payable to Vendor</th>';
                                                                xCancel += '<th>Payable to DietSelect</th>';
                                                                xCancel += '<th>Order Status</th>';
                                                                xCancel += '<th>Payment Status</th>';
                                                                xCancel += '</tr>';
                                                                xCancel += '</thead>';
                                                                xCancel += '<tbody>';
                                                                for(var l in valData){
                                                                    if(valData[l].status==1){
                                                                        xCancel += '<tr>';
                                                                        xCancel += '<td>'+valData[l].id+'</td>';
                                                                        xCancel += '<td>'+valData[l].name+'</td>';
                                                                        xCancel += '<td>'+valData[l].created_at+'</td>';
                                                                        xCancel += '<td>PHP 0.00</td>';
                                                                        xCancel += '<td>PHP 0.00</td>';
                                                                        xCancel += '<td>PHP 0.00</td>';
                                                                        xCancel += '<td>Cancelled</td>';
                                                                        if(valData[l].status==0){
                                                                            if(valData[l].paid==0){
                                                                                xCancel += '<td>Pending</td>';
                                                                            }else{
                                                                                xCancel += '<td>Paid</td>';
                                                                            }
                                                                        }else{
                                                                            xCancel += '<td>Cancelled</td>';
                                                                        }
                                                                    }
                                                                    xCancel += '</tr>';
                                                                }
                                                                xCancel +='<tr>';
                                                                xCancel +='<td></td>';
                                                                xCancel +='<td></td>';
                                                                xCancel +='<td>Total:</td>';
                                                                xCancel += '<td>PHP 0.00</td>';
                                                                xCancel += '<td>PHP 0.00</td>';
                                                                xCancel += '<td>PHP 0.00</td>';
                                                                xCancel += '<td></td>';
                                                                xCancel += '<td></td>';
                                                                xCancel += '</tr>';
                                                                xCancel += '</tbody>';
                                                                xCancel += '</table>';
                                                                xCancel += '</div>';
                                                                xCancel += '</div>';

                                                                $('#monthPicker{{$uniqueComChef}}').append(x);
                                                                $('#pendMonthPicker{{$uniqueComChef}}').append(xPend);
                                                                $('#paidMonthPicker{{$uniqueComChef}}').append(xPaid);
                                                                $('#cancelMonthPicker{{$uniqueComChef}}').append(xCancel);

                                                                $('#chefAllTotalAmount{{$uniqueComChef}}').append(
                                                                        '<div>Total Payables for Vendor This Month</div>' +
                                                                        '<div>PHP '+addCommas(chefAllTotal.toFixed(2))+'</div>'
                                                                );

                                                                $('#chefPendTotalAmount{{$uniqueComChef}}').append(
                                                                        '<div>Total Pending Payables for Vendor This Month</div>' +
                                                                        '<div>PHP '+addCommas(chefPendTotal.toFixed(2))+'</div>'
                                                                );
                                                                $('#chefPaidTotalAmount{{$uniqueComChef}}').append(
                                                                        '<div>Total Paid Payables for Vendor This Month</div>' +
                                                                        '<div>PHP '+addCommas(chefPaidTotal.toFixed(2))+'</div>'
                                                                );
                                                                $('#dietPaidTotalAmount{{$uniqueComChef}}').append(
                                                                        '<div>Receivables for DietSelect This Month</div>' +
                                                                        '<div>PHP '+addCommas(dietTotal.toFixed(2))+'</div>'
                                                                );

                                                            }
                                                        });
                                                    });
                                                });



                                                var valType = $('select#typeFilter{{$uniqueComChef}}').val();

                                                if(valType==0){
                                                    $('#monthPicker{{$uniqueComChef}}').show();
                                                    $('#pendMonthPicker{{$uniqueComChef}}').hide();
                                                    $('#paidMonthPicker{{$uniqueComChef}}').hide();
                                                    $('#cancelMonthPicker{{$uniqueComChef}}').hide();
                                                }else if(valType==1){
                                                    $('#monthPicker{{$uniqueComChef}}').hide();
                                                    $('#pendMonthPicker{{$uniqueComChef}}').show();
                                                    $('#paidMonthPicker{{$uniqueComChef}}').hide();
                                                    $('#cancelMonthPicker{{$uniqueComChef}}').hide();
                                                }else if(valType==2){
                                                    $('#monthPicker{{$uniqueComChef}}').hide();
                                                    $('#pendMonthPicker{{$uniqueComChef}}').hide();
                                                    $('#paidMonthPicker{{$uniqueComChef}}').show();
                                                    $('#cancelMonthPicker{{$uniqueComChef}}').hide();
                                                }else if(valType==3){
                                                    $('#monthPicker{{$uniqueComChef}}').hide();
                                                    $('#pendMonthPicker{{$uniqueComChef}}').hide();
                                                    $('#paidMonthPicker{{$uniqueComChef}}').hide();
                                                    $('#cancelMonthPicker{{$uniqueComChef}}').show();
                                                }

                                                $('select#typeFilter{{$uniqueComChef}}').change(function(){
                                                    var valType = $('select#typeFilter{{$uniqueComChef}}').val();

                                                    if(valType==0){
                                                        $('#monthPicker{{$uniqueComChef}}').show();
                                                        $('#pendMonthPicker{{$uniqueComChef}}').hide();
                                                        $('#paidMonthPicker{{$uniqueComChef}}').hide();
                                                        $('#cancelMonthPicker{{$uniqueComChef}}').hide();
                                                    }else if(valType==1){
                                                        $('#monthPicker{{$uniqueComChef}}').hide();
                                                        $('#pendMonthPicker{{$uniqueComChef}}').show();
                                                        $('#paidMonthPicker{{$uniqueComChef}}').hide();
                                                        $('#cancelMonthPicker{{$uniqueComChef}}').hide();
                                                    }else if(valType==2){
                                                        $('#monthPicker{{$uniqueComChef}}').hide();
                                                        $('#pendMonthPicker{{$uniqueComChef}}').hide();
                                                        $('#paidMonthPicker{{$uniqueComChef}}').show();
                                                        $('#cancelMonthPicker{{$uniqueComChef}}').hide();
                                                    }else if(valType==3){
                                                        $('#monthPicker{{$uniqueComChef}}').hide();
                                                        $('#pendMonthPicker{{$uniqueComChef}}').hide();
                                                        $('#paidMonthPicker{{$uniqueComChef}}').hide();
                                                        $('#cancelMonthPicker{{$uniqueComChef}}').show();
                                                    }
                                                });


                                                $('select#yearFilter{{$uniqueComChef}}').change(function(){
                                                    var selectVal = $('select#yearFilter{{$uniqueComChef}}').val();

                                                    var monthAjax = getMonths(selectVal);

                                                    monthAjax.done(function (response) {
                                                        $('select#monthFilter{{$uniqueComChef}}').empty();
                                                        var valData = JSON.parse(response);
                                                        //                                                        console.log(valData);
                                                        for(var i in valData){
                                                            var text = valData[i].monthText;
                                                            if(valData[i].current==1){
                                                                text += '(current)';
                                                                $('select#monthFilter{{$uniqueComChef}}').append(
                                                                        $('<option></option>').attr("value",valData[i].month).text(text).prop('selected','selected')
                                                                );
                                                            }else{
                                                                $('select#monthFilter{{$uniqueComChef}}').append(
                                                                        $('<option></option>').attr("value",valData[i].month).text(text)
                                                                );
                                                            }
                                                        }

                                                        $('select#monthFilter{{$uniqueComChef}}').material_select();

                                                        var yearVal = $('select#yearFilter{{$uniqueComChef}}').val();

                                                        var selectVal = $('select#monthFilter{{$uniqueComChef}}').val();


                                                        // month change


                                                        var changeMonth = monthChange('{{$uniqueComChef}}',yearVal,selectVal);

                                                        changeMonth.done(function (response) {
                                                            $('#monthPicker{{$uniqueComChef}}').empty();
                                                            $('#pendMonthPicker{{$uniqueComChef}}').empty();
                                                            $('#paidMonthPicker{{$uniqueComChef}}').empty();
                                                            $('#cancelMonthPicker{{$uniqueComChef}}').empty();
                                                            $('#chefPendTotalAmount{{$uniqueComChef}}').empty();
                                                            $('#chefPaidTotalAmount{{$uniqueComChef}}').empty();
                                                            $('#dietPaidTotalAmount{{$uniqueComChef}}').empty();
                                                            if(response==''){
                                                                $('#monthPicker{{$uniqueComChef}}').append('<div>No Commissions</div>');
                                                                $('#pendMonthPicker{{$uniqueComChef}}').append('<div>No Commissions</div>');
                                                                $('#paidMonthPicker{{$uniqueComChef}}').append('<div>No Commissions</div>');
                                                                $('#cancelMonthPicker{{$uniqueComChef}}').append('<div>No Commissions</div>');
                                                            }else{
                                                                var valData = JSON.parse(response);
                                                                console.log(valData);

                                                                var chefAllTotal = 0;
                                                                var chefPendTotal = 0;
                                                                var chefPaidTotal = 0;
                                                                var dietTotal = 0;

                                                                var chefAllTabPay = 0;
                                                                var chefAllTabChefPay = 0;
                                                                var chefAllTabDietPay = 0;

                                                                var chefPendTabPay = 0;
                                                                var chefPendTabChefPay = 0;
                                                                var chefPendTabDietPay = 0;

                                                                var chefPaidTabPay = 0;
                                                                var chefPaidTabChefPay = 0;
                                                                var chefPaidTabDietPay = 0;

                                                                var x = '<div class="row">';
                                                                x += '<div class="col s12 m3">';
                                                                x += '</div>';
                                                                x += '<div class="col s12 m3">';
                                                                x += '</div>';
                                                                x += '<div class="col s12 m3">';
                                                                x += '</div>';
                                                                x += '<div class="col s12 m3">';
                                                                x += '</div>';
                                                                x += '</div>';
                                                                x += '<div class="row">';
                                                                x += '<div class="col s12">';
                                                                x += '<table class="">';
                                                                x += '<thead>';
                                                                x += '<tr>';
                                                                x += '<th>ID</th>';
                                                                x += '<th>Name</th>';
                                                                x += '<th>Date</th>';
                                                                x += '<th>Total Payable</th>';
                                                                x += '<th>Payable to Vendor</th>';
                                                                x += '<th>Payable to DietSelect</th>';
                                                                x += '<th>Order Status</th>';
                                                                x += '<th>Payment Status</th>';
                                                                x += '</tr>';
                                                                x += '</thead>';
                                                                x += '<tbody>';
                                                                for(var i in valData){
                                                                    var amount = valData[i].amount;
                                                                    var chefAmount = valData[i].chefAmount;
                                                                    var dietAmount = valData[i].dietAmount;

                                                                    chefAllTabPay += amount;
                                                                    chefAllTabChefPay += chefAmount;
                                                                    chefAllTabDietPay += dietAmount;

                                                                    chefAllTotal += chefAmount;

                                                                    x += '<tr>';
                                                                    x += '<td>'+valData[i].id+'</td>';
                                                                    x += '<td>'+valData[i].name+'</td>';
                                                                    x += '<td>'+valData[i].created_at+'</td>';
                                                                    if(valData[i].status==0){
                                                                        x += '<td>PHP '+addCommas(amount.toFixed(2))+'</td>';
                                                                        x += '<td>PHP '+addCommas(chefAmount.toFixed(2))+'</td>';
                                                                        x += '<td>PHP '+addCommas(dietAmount.toFixed(2))+'</td>';
                                                                        x += '<td>Paid</td>';
                                                                    }else{
                                                                        x += '<td>PHP 0.00</td>';
                                                                        x += '<td>PHP 0.00</td>';
                                                                        x += '<td>PHP 0.00</td>';
                                                                        x += '<td>Cancelled</td>';
                                                                    }
                                                                    if(valData[i].status==0){
                                                                        if(valData[i].paid==0){
                                                                            x += '<td>Pending</td>';
                                                                        }else{
                                                                            x += '<td>Paid</td>';
                                                                        }
                                                                    }else{
                                                                        x += '<td>Cancelled</td>';
                                                                    }
                                                                    x += '</tr>';
                                                                }
                                                                x +='<tr>';
                                                                x +='<td></td>';
                                                                x +='<td></td>';
                                                                x +='<td>Total:</td>';
                                                                x += '<td>PHP '+addCommas(chefAllTabPay.toFixed(2))+'</td>';
                                                                x += '<td>PHP '+addCommas(chefAllTabChefPay.toFixed(2))+'</td>';
                                                                x += '<td>PHP '+addCommas(chefAllTabDietPay.toFixed(2))+'</td>';
                                                                x += '<td></td>';
                                                                x += '<td></td>';
                                                                x += '</tr>';
                                                                x += '</tbody>';
                                                                x += '</table>';
                                                                x += '</div>';
                                                                x += '</div>';

                                                                var xPend = '<div class="row">';
                                                                xPend += '<div class="col s12 m3">';
                                                                xPend += '</div>';
                                                                xPend += '<div class="col s12 m3">';
                                                                xPend += '</div>';
                                                                xPend += '<div class="col s12 m3">';
                                                                xPend += '</div>';
                                                                xPend += '<div class="col s12 m3">';
                                                                xPend += '</div>';
                                                                xPend += '</div>';
                                                                xPend += '<div class="row">';
                                                                xPend += '<div class="col s12">';
                                                                xPend += '<table class="">';
                                                                xPend += '<thead>';
                                                                xPend += '<tr>';
                                                                xPend += '<th>ID</th>';
                                                                xPend += '<th>Name</th>';
                                                                xPend += '<th>Date</th>';
                                                                xPend += '<th>Total Payable</th>';
                                                                xPend += '<th>Payable to Vendor</th>';
                                                                xPend += '<th>Payable to DietSelect</th>';
                                                                xPend += '<th>Order Status</th>';
                                                                xPend += '<th>Payment Status</th>';
                                                                xPend += '</tr>';
                                                                xPend += '</thead>';
                                                                xPend += '<tbody>';
                                                                for(var j in valData){
                                                                    if(valData[j].status==0 && valData[j].paid==0){
                                                                        var pendAmount = valData[j].amount;
                                                                        var pendChefAmount = valData[j].chefAmount;
                                                                        var pendDietAmount = valData[j].dietAmount;

                                                                        chefPendTotal +=valData[j].chefAmount;
                                                                        chefPendTabPay += pendAmount;
                                                                        chefPendTabChefPay += pendChefAmount;
                                                                        chefPendTabDietPay += pendDietAmount;

                                                                        xPend += '<tr>';
                                                                        xPend += '<td>'+valData[j].id+'</td>';
                                                                        xPend += '<td>'+valData[j].name+'</td>';
                                                                        xPend += '<td>'+valData[j].created_at+'</td>';
                                                                        if(valData[j].status==0){
                                                                            xPend += '<td>PHP '+addCommas(pendAmount.toFixed(2))+'</td>';
                                                                            xPend += '<td>PHP '+addCommas(pendChefAmount.toFixed(2))+'</td>';
                                                                            xPend += '<td>PHP '+addCommas(pendDietAmount.toFixed(2))+'</td>';
                                                                            xPend += '<td>Paid</td>';
                                                                        }else{
                                                                            xPend += '<td>PHP 0.00</td>';
                                                                            xPend += '<td>PHP 0.00</td>';
                                                                            xPend += '<td>PHP 0.00</td>';
                                                                            xPend += '<td>Cancelled</td>';
                                                                        }
                                                                        if(valData[j].status==0){
                                                                            if(valData[j].paid==0){
                                                                                xPend += '<td>Pending</td>';
                                                                            }else{
                                                                                xPend += '<td>Paid</td>';
                                                                            }
                                                                        }else{
                                                                            xPend += '<td>Cancelled</td>';
                                                                        }
                                                                    }
                                                                    xPend += '</tr>';
                                                                }
                                                                xPend +='<tr>';
                                                                xPend +='<td></td>';
                                                                xPend +='<td></td>';
                                                                xPend +='<td>Total:</td>';
                                                                xPend += '<td>PHP '+addCommas(chefPendTabPay.toFixed(2))+'</td>';
                                                                xPend += '<td>PHP '+addCommas(chefPendTabChefPay.toFixed(2))+'</td>';
                                                                xPend += '<td>PHP '+addCommas(chefPendTabDietPay.toFixed(2))+'</td>';
                                                                xPend += '<td></td>';
                                                                xPend += '<td></td>';
                                                                xPend += '</tr>';
                                                                xPend += '</tbody>';
                                                                xPend += '</table>';
                                                                xPend += '</div>';
                                                                xPend += '</div>';

                                                                var xPaid = '<div class="row">';
                                                                xPaid += '<div class="col s12 m3">';
                                                                xPaid += '</div>';
                                                                xPaid += '<div class="col s12 m3">';
                                                                xPaid += '</div>';
                                                                xPaid += '<div class="col s12 m3">';
                                                                xPaid += '</div>';
                                                                xPaid += '<div class="col s12 m3">';
                                                                xPaid += '</div>';
                                                                xPaid += '</div>';
                                                                xPaid += '<div class="row">';
                                                                xPaid += '<div class="col s12">';
                                                                xPaid += '<table class="">';
                                                                xPaid += '<thead>';
                                                                xPaid += '<tr>';
                                                                xPaid += '<th>ID</th>';
                                                                xPaid += '<th>Name</th>';
                                                                xPaid += '<th>Date</th>';
                                                                xPaid += '<th>Total Payable</th>';
                                                                xPaid += '<th>Payable to Vendor</th>';
                                                                xPaid += '<th>Payable to DietSelect</th>';
                                                                xPaid += '<th>Order Status</th>';
                                                                xPaid += '<th>Payment Status</th>';
                                                                xPaid += '</tr>';
                                                                xPaid += '</thead>';
                                                                xPaid += '<tbody>';
                                                                for(var k in valData){
                                                                    if(valData[k].status==0 && valData[k].paid==1){
                                                                        var paidAmount = valData[k].amount;
                                                                        var paidChefAmount = valData[k].chefAmount;
                                                                        var paidDietAmount = valData[k].dietAmount;

                                                                        chefPaidTotal +=paidChefAmount;
                                                                        dietTotal += paidDietAmount;
                                                                        chefPaidTabPay += paidAmount;
                                                                        chefPaidTabChefPay += paidChefAmount;
                                                                        chefPaidTabDietPay += paidDietAmount;

                                                                        xPaid += '<tr>';
                                                                        xPaid += '<td>'+valData[k].id+'</td>';
                                                                        xPaid += '<td>'+valData[k].name+'</td>';
                                                                        xPaid += '<td>'+valData[k].created_at+'</td>';
                                                                        if(valData[k].status==0){
                                                                            xPaid += '<td>PHP '+addCommas(paidAmount.toFixed(2))+'</td>';
                                                                            xPaid += '<td>PHP '+addCommas(paidChefAmount.toFixed(2))+'</td>';
                                                                            xPaid += '<td>PHP '+addCommas(paidDietAmount.toFixed(2))+'</td>';
                                                                            xPaid += '<td>Paid</td>';
                                                                        }else{
                                                                            xPaid += '<td>PHP 0.00</td>';
                                                                            xPaid += '<td>PHP 0.00</td>';
                                                                            xPaid += '<td>PHP 0.00</td>';
                                                                            xPaid += '<td>Cancelled</td>';
                                                                        }
                                                                        if(valData[k].status==0){
                                                                            if(valData[k].paid==0){
                                                                                xPaid += '<td>Pending</td>';
                                                                            }else{
                                                                                xPaid += '<td>Paid</td>';
                                                                            }
                                                                        }else{
                                                                            xPaid += '<td>Cancelled</td>';
                                                                        }
                                                                    }
                                                                    xPaid += '</tr>';
                                                                }
                                                                xPaid +='<tr>';
                                                                xPaid +='<td></td>';
                                                                xPaid +='<td></td>';
                                                                xPaid +='<td>Total:</td>';
                                                                xPaid += '<td>PHP '+addCommas(chefPaidTabPay.toFixed(2))+'</td>';
                                                                xPaid += '<td>PHP '+addCommas(chefPaidTabChefPay.toFixed(2))+'</td>';
                                                                xPaid += '<td>PHP '+addCommas(chefPaidTabDietPay.toFixed(2))+'</td>';
                                                                xPaid += '<td></td>';
                                                                xPaid += '<td></td>';
                                                                xPaid += '</tr>';
                                                                xPaid += '</tbody>';
                                                                xPaid += '</table>';
                                                                xPaid += '</div>';
                                                                xPaid += '</div>';

                                                                var xCancel = '<div class="row">';
                                                                xCancel += '<div class="col s12 m3">';
                                                                xCancel += '</div>';
                                                                xCancel += '<div class="col s12 m3">';
                                                                xCancel += '</div>';
                                                                xCancel += '<div class="col s12 m3">';
                                                                xCancel += '</div>';
                                                                xCancel += '<div class="col s12 m3">';
                                                                xCancel += '</div>';
                                                                xCancel += '</div>';
                                                                xCancel += '<div class="row">';
                                                                xCancel += '<div class="col s12">';
                                                                xCancel += '<table class="">';
                                                                xCancel += '<thead>';
                                                                xCancel += '<tr>';
                                                                xCancel += '<th>ID</th>';
                                                                xCancel += '<th>Name</th>';
                                                                xCancel += '<th>Date</th>';
                                                                xCancel += '<th>Total Payable</th>';
                                                                xCancel += '<th>Payable to Vendor</th>';
                                                                xCancel += '<th>Payable to DietSelect</th>';
                                                                xCancel += '<th>Order Status</th>';
                                                                xCancel += '<th>Payment Status</th>';
                                                                xCancel += '</tr>';
                                                                xCancel += '</thead>';
                                                                xCancel += '<tbody>';
                                                                for(var l in valData){
                                                                    if(valData[l].status==1){
                                                                        xCancel += '<tr>';
                                                                        xCancel += '<td>'+valData[l].id+'</td>';
                                                                        xCancel += '<td>'+valData[l].name+'</td>';
                                                                        xCancel += '<td>'+valData[l].created_at+'</td>';
                                                                        xCancel += '<td>PHP 0.00</td>';
                                                                        xCancel += '<td>PHP 0.00</td>';
                                                                        xCancel += '<td>PHP 0.00</td>';
                                                                        xCancel += '<td>Cancelled</td>';
                                                                        if(valData[l].status==0){
                                                                            if(valData[l].paid==0){
                                                                                xCancel += '<td>Pending</td>';
                                                                            }else{
                                                                                xCancel += '<td>Paid</td>';
                                                                            }
                                                                        }else{
                                                                            xCancel += '<td>Cancelled</td>';
                                                                        }
                                                                    }
                                                                    xCancel += '</tr>';
                                                                }
                                                                xCancel +='<tr>';
                                                                xCancel +='<td></td>';
                                                                xCancel +='<td></td>';
                                                                xCancel +='<td>Total:</td>';
                                                                xCancel += '<td>PHP 0.00</td>';
                                                                xCancel += '<td>PHP 0.00</td>';
                                                                xCancel += '<td>PHP 0.00</td>';
                                                                xCancel += '<td></td>';
                                                                xCancel += '<td></td>';
                                                                xCancel += '</tr>';
                                                                xCancel += '</tbody>';
                                                                xCancel += '</table>';
                                                                xCancel += '</div>';
                                                                xCancel += '</div>';

                                                                $('#monthPicker{{$uniqueComChef}}').append(x);
                                                                $('#pendMonthPicker{{$uniqueComChef}}').append(xPend);
                                                                $('#paidMonthPicker{{$uniqueComChef}}').append(xPaid);
                                                                $('#cancelMonthPicker{{$uniqueComChef}}').append(xCancel);

                                                                $('#chefAllTotalAmount{{$uniqueComChef}}').append(
                                                                        '<div>Total Payables for Vendor This Month</div>' +
                                                                        '<div>PHP '+addCommas(chefAllTotal.toFixed(2))+'</div>'
                                                                );

                                                                $('#chefPendTotalAmount{{$uniqueComChef}}').append(
                                                                        '<div>Total Pending Payables for Vendor This Month</div>' +
                                                                        '<div>PHP '+addCommas(chefPendTotal.toFixed(2))+'</div>'
                                                                );
                                                                $('#chefPaidTotalAmount{{$uniqueComChef}}').append(
                                                                        '<div>Total Paid Payables for Vendor This Month</div>' +
                                                                        '<div>PHP '+addCommas(chefPaidTotal.toFixed(2))+'</div>'
                                                                );
                                                                $('#dietPaidTotalAmount{{$uniqueComChef}}').append(
                                                                        '<div>Receivables for DietSelect This Month</div>' +
                                                                        '<div>PHP '+addCommas(dietTotal.toFixed(2))+'</div>'
                                                                );

                                                            }
                                                        });
                                                    });
                                                });

                                                $('select#monthFilter{{$uniqueComChef}}').change(function (){
                                                    var yearVal = $('select#yearFilter{{$uniqueComChef}}').val();
                                                    var selectVal = $('select#monthFilter{{$uniqueComChef}}').val();
                                                    console.log(selectVal);
                                                    var changeMonth = monthChange('{{$uniqueComChef}}',yearVal,selectVal);
                                                    changeMonth.done(function (response) {
                                                        $('#monthPicker{{$uniqueComChef}}').empty();
                                                        $('#pendMonthPicker{{$uniqueComChef}}').empty();
                                                        $('#paidMonthPicker{{$uniqueComChef}}').empty();
                                                        $('#cancelMonthPicker{{$uniqueComChef}}').empty();
                                                        $('#chefPendTotalAmount{{$uniqueComChef}}').empty();
                                                        $('#chefPaidTotalAmount{{$uniqueComChef}}').empty();
                                                        $('#dietPaidTotalAmount{{$uniqueComChef}}').empty();
                                                        if(response==''){
                                                            $('#monthPicker{{$uniqueComChef}}').append('<div>No Commissions</div>');
                                                            $('#pendMonthPicker{{$uniqueComChef}}').append('<div>No Commissions</div>');
                                                            $('#paidMonthPicker{{$uniqueComChef}}').append('<div>No Commissions</div>');
                                                            $('#cancelMonthPicker{{$uniqueComChef}}').append('<div>No Commissions</div>');
                                                        }else{
                                                            var valData = JSON.parse(response);
                                                            console.log(valData);

                                                            var chefAllTotal = 0;
                                                            var chefPendTotal = 0;
                                                            var chefPaidTotal = 0;
                                                            var dietTotal = 0;

                                                            var chefAllTabPay = 0;
                                                            var chefAllTabChefPay = 0;
                                                            var chefAllTabDietPay = 0;

                                                            var chefPendTabPay = 0;
                                                            var chefPendTabChefPay = 0;
                                                            var chefPendTabDietPay = 0;

                                                            var chefPaidTabPay = 0;
                                                            var chefPaidTabChefPay = 0;
                                                            var chefPaidTabDietPay = 0;

                                                            var x = '<div class="row">';
                                                            x += '<div class="col s12 m3">';
                                                            x += '</div>';
                                                            x += '<div class="col s12 m3">';
                                                            x += '</div>';
                                                            x += '<div class="col s12 m3">';
                                                            x += '</div>';
                                                            x += '<div class="col s12 m3">';
                                                            x += '</div>';
                                                            x += '</div>';
                                                            x += '<div class="row">';
                                                            x += '<div class="col s12">';
                                                            x += '<table class="">';
                                                            x += '<thead>';
                                                            x += '<tr>';
                                                            x += '<th>ID</th>';
                                                            x += '<th>Name</th>';
                                                            x += '<th>Date</th>';
                                                            x += '<th>Total Payable</th>';
                                                            x += '<th>Payable to Vendor</th>';
                                                            x += '<th>Payable to DietSelect</th>';
                                                            x += '<th>Order Status</th>';
                                                            x += '<th>Payment Status</th>';
                                                            x += '</tr>';
                                                            x += '</thead>';
                                                            x += '<tbody>';
                                                            for(var i in valData){
                                                                var amount = valData[i].amount;
                                                                var chefAmount = valData[i].chefAmount;
                                                                var dietAmount = valData[i].dietAmount;

                                                                chefAllTabPay += amount;
                                                                chefAllTabChefPay += chefAmount;
                                                                chefAllTabDietPay += dietAmount;
                                                                chefAllTotal += chefAmount;

                                                                x += '<tr>';
                                                                x += '<td>'+valData[i].id+'</td>';
                                                                x += '<td>'+valData[i].name+'</td>';
                                                                x += '<td>'+valData[i].created_at+'</td>';
                                                                if(valData[i].status==0){
                                                                    x += '<td>PHP '+addCommas(amount.toFixed(2))+'</td>';
                                                                    x += '<td>PHP '+addCommas(chefAmount.toFixed(2))+'</td>';
                                                                    x += '<td>PHP '+addCommas(dietAmount.toFixed(2))+'</td>';
                                                                    x += '<td>Paid</td>';
                                                                }else{
                                                                    x += '<td>PHP 0.00</td>';
                                                                    x += '<td>PHP 0.00</td>';
                                                                    x += '<td>PHP 0.00</td>';
                                                                    x += '<td>Cancelled</td>';
                                                                }
                                                                if(valData[i].status==0){
                                                                    if(valData[i].paid==0){
                                                                        x += '<td>Pending</td>';
                                                                    }else{
                                                                        x += '<td>Paid</td>';
                                                                    }
                                                                }else{
                                                                    x += '<td>Cancelled</td>';
                                                                }
                                                                x += '</tr>';
                                                            }
                                                            x +='<tr>';
                                                            x +='<td></td>';
                                                            x +='<td></td>';
                                                            x +='<td>Total:</td>';
                                                            x += '<td>PHP '+addCommas(chefAllTabPay.toFixed(2))+'</td>';
                                                            x += '<td>PHP '+addCommas(chefAllTabChefPay.toFixed(2))+'</td>';
                                                            x += '<td>PHP '+addCommas(chefAllTabDietPay.toFixed(2))+'</td>';
                                                            x += '<td></td>';
                                                            x += '<td></td>';
                                                            x += '</tr>';
                                                            x += '</tbody>';
                                                            x += '</table>';
                                                            x += '</div>';
                                                            x += '</div>';

                                                            var xPend = '<div class="row">';
                                                            xPend += '<div class="col s12 m3">';
                                                            xPend += '</div>';
                                                            xPend += '<div class="col s12 m3">';
                                                            xPend += '</div>';
                                                            xPend += '<div class="col s12 m3">';
                                                            xPend += '</div>';
                                                            xPend += '<div class="col s12 m3">';
                                                            xPend += '</div>';
                                                            xPend += '</div>';
                                                            xPend += '<div class="row">';
                                                            xPend += '<div class="col s12">';
                                                            xPend += '<table class="">';
                                                            xPend += '<thead>';
                                                            xPend += '<tr>';
                                                            xPend += '<th>ID</th>';
                                                            xPend += '<th>Name</th>';
                                                            xPend += '<th>Date</th>';
                                                            xPend += '<th>Total Payable</th>';
                                                            xPend += '<th>Payable to Vendor</th>';
                                                            xPend += '<th>Payable to DietSelect</th>';
                                                            xPend += '<th>Order Status</th>';
                                                            xPend += '<th>Payment Status</th>';
                                                            xPend += '</tr>';
                                                            xPend += '</thead>';
                                                            xPend += '<tbody>';
                                                            for(var j in valData){
                                                                if(valData[j].status==0 && valData[j].paid==0){
                                                                    var pendAmount = valData[j].amount;
                                                                    var pendChefAmount = valData[j].chefAmount;
                                                                    var pendDietAmount = valData[j].dietAmount;

                                                                    chefPendTotal +=valData[j].chefAmount;
                                                                    chefPendTabPay += pendAmount;
                                                                    chefPendTabChefPay += pendChefAmount;
                                                                    chefPendTabDietPay += pendDietAmount;

                                                                    xPend += '<tr>';
                                                                    xPend += '<td>'+valData[j].id+'</td>';
                                                                    xPend += '<td>'+valData[j].name+'</td>';
                                                                    xPend += '<td>'+valData[j].created_at+'</td>';
                                                                    if(valData[j].status==0){
                                                                        xPend += '<td>PHP '+addCommas(pendAmount.toFixed(2))+'</td>';
                                                                        xPend += '<td>PHP '+addCommas(pendChefAmount.toFixed(2))+'</td>';
                                                                        xPend += '<td>PHP '+addCommas(pendDietAmount.toFixed(2))+'</td>';
                                                                        xPend += '<td>Paid</td>';
                                                                    }else{
                                                                        xPend += '<td>PHP 0.00</td>';
                                                                        xPend += '<td>PHP 0.00</td>';
                                                                        xPend += '<td>PHP 0.00</td>';
                                                                        xPend += '<td>Cancelled</td>';
                                                                    }
                                                                    if(valData[j].status==0){
                                                                        if(valData[j].paid==0){
                                                                            xPend += '<td>Pending</td>';
                                                                        }else{
                                                                            xPend += '<td>Paid</td>';
                                                                        }
                                                                    }else{
                                                                        xPend += '<td>Cancelled</td>';
                                                                    }
                                                                }
                                                                xPend += '</tr>';
                                                            }
                                                            xPend +='<tr>';
                                                            xPend +='<td></td>';
                                                            xPend +='<td></td>';
                                                            xPend +='<td>Total:</td>';
                                                            xPend += '<td>PHP '+addCommas(chefPendTabPay.toFixed(2))+'</td>';
                                                            xPend += '<td>PHP '+addCommas(chefPendTabChefPay.toFixed(2))+'</td>';
                                                            xPend += '<td>PHP '+addCommas(chefPendTabDietPay.toFixed(2))+'</td>';
                                                            xPend += '<td></td>';
                                                            xPend += '<td></td>';
                                                            xPend += '</tr>';
                                                            xPend += '</tbody>';
                                                            xPend += '</table>';
                                                            xPend += '</div>';
                                                            xPend += '</div>';

                                                            var xPaid = '<div class="row">';
                                                            xPaid += '<div class="col s12 m3">';
                                                            xPaid += '</div>';
                                                            xPaid += '<div class="col s12 m3">';
                                                            xPaid += '</div>';
                                                            xPaid += '<div class="col s12 m3">';
                                                            xPaid += '</div>';
                                                            xPaid += '<div class="col s12 m3">';
                                                            xPaid += '</div>';
                                                            xPaid += '</div>';
                                                            xPaid += '<div class="row">';
                                                            xPaid += '<div class="col s12">';
                                                            xPaid += '<table class="">';
                                                            xPaid += '<thead>';
                                                            xPaid += '<tr>';
                                                            xPaid += '<th>ID</th>';
                                                            xPaid += '<th>Name</th>';
                                                            xPaid += '<th>Date</th>';
                                                            xPaid += '<th>Total Payable</th>';
                                                            xPaid += '<th>Payable to Vendor</th>';
                                                            xPaid += '<th>Payable to DietSelect</th>';
                                                            xPaid += '<th>Order Status</th>';
                                                            xPaid += '<th>Payment Status</th>';
                                                            xPaid += '</tr>';
                                                            xPaid += '</thead>';
                                                            xPaid += '<tbody>';
                                                            for(var k in valData){
                                                                if(valData[k].status==0 && valData[k].paid==1){
                                                                    var paidAmount = valData[k].amount;
                                                                    var paidChefAmount = valData[k].chefAmount;
                                                                    var paidDietAmount = valData[k].dietAmount;

                                                                    chefPaidTotal +=paidChefAmount;
                                                                    dietTotal += paidDietAmount;
                                                                    chefPaidTabPay += paidAmount;
                                                                    chefPaidTabChefPay += paidChefAmount;
                                                                    chefPaidTabDietPay += paidDietAmount;

                                                                    xPaid += '<tr>';
                                                                    xPaid += '<td>'+valData[k].id+'</td>';
                                                                    xPaid += '<td>'+valData[k].name+'</td>';
                                                                    xPaid += '<td>'+valData[k].created_at+'</td>';
                                                                    if(valData[k].status==0){
                                                                        xPaid += '<td>PHP '+addCommas(paidAmount.toFixed(2))+'</td>';
                                                                        xPaid += '<td>PHP '+addCommas(paidChefAmount.toFixed(2))+'</td>';
                                                                        xPaid += '<td>PHP '+addCommas(paidDietAmount.toFixed(2))+'</td>';
                                                                        xPaid += '<td>Paid</td>';
                                                                    }else{
                                                                        xPaid += '<td>PHP 0.00</td>';
                                                                        xPaid += '<td>PHP 0.00</td>';
                                                                        xPaid += '<td>PHP 0.00</td>';
                                                                        xPaid += '<td>Cancelled</td>';
                                                                    }
                                                                    if(valData[k].status==0){
                                                                        if(valData[k].paid==0){
                                                                            xPaid += '<td>Pending</td>';
                                                                        }else{
                                                                            xPaid += '<td>Paid</td>';
                                                                        }
                                                                    }else{
                                                                        xPaid += '<td>Cancelled</td>';
                                                                    }
                                                                }
                                                                xPaid += '</tr>';
                                                            }
                                                            xPaid +='<tr>';
                                                            xPaid +='<td></td>';
                                                            xPaid +='<td></td>';
                                                            xPaid +='<td>Total:</td>';
                                                            xPaid += '<td>PHP '+addCommas(chefPaidTabPay.toFixed(2))+'</td>';
                                                            xPaid += '<td>PHP '+addCommas(chefPaidTabChefPay.toFixed(2))+'</td>';
                                                            xPaid += '<td>PHP '+addCommas(chefPaidTabDietPay.toFixed(2))+'</td>';
                                                            xPaid += '<td></td>';
                                                            xPaid += '<td></td>';
                                                            xPaid += '</tr>';
                                                            xPaid += '</tbody>';
                                                            xPaid += '</table>';
                                                            xPaid += '</div>';
                                                            xPaid += '</div>';

                                                            var xCancel = '<div class="row">';
                                                            xCancel += '<div class="col s12 m3">';
                                                            xCancel += '</div>';
                                                            xCancel += '<div class="col s12 m3">';
                                                            xCancel += '</div>';
                                                            xCancel += '<div class="col s12 m3">';
                                                            xCancel += '</div>';
                                                            xCancel += '<div class="col s12 m3">';
                                                            xCancel += '</div>';
                                                            xCancel += '</div>';
                                                            xCancel += '<div class="row">';
                                                            xCancel += '<div class="col s12">';
                                                            xCancel += '<table class="">';
                                                            xCancel += '<thead>';
                                                            xCancel += '<tr>';
                                                            xCancel += '<th>ID</th>';
                                                            xCancel += '<th>Name</th>';
                                                            xCancel += '<th>Date</th>';
                                                            xCancel += '<th>Total Payable</th>';
                                                            xCancel += '<th>Payable to Vendor</th>';
                                                            xCancel += '<th>Payable to DietSelect</th>';
                                                            xCancel += '<th>Order Status</th>';
                                                            xCancel += '<th>Payment Status</th>';
                                                            xCancel += '</tr>';
                                                            xCancel += '</thead>';
                                                            xCancel += '<tbody>';
                                                            for(var l in valData){
                                                                if(valData[l].status==1){
                                                                    xCancel += '<tr>';
                                                                    xCancel += '<td>'+valData[l].id+'</td>';
                                                                    xCancel += '<td>'+valData[l].name+'</td>';
                                                                    xCancel += '<td>'+valData[l].created_at+'</td>';
                                                                    xCancel += '<td>PHP 0.00</td>';
                                                                    xCancel += '<td>PHP 0.00</td>';
                                                                    xCancel += '<td>PHP 0.00</td>';
                                                                    xCancel += '<td>Cancelled</td>';
                                                                    if(valData[l].status==0){
                                                                        if(valData[l].paid==0){
                                                                            xCancel += '<td>Pending</td>';
                                                                        }else{
                                                                            xCancel += '<td>Paid</td>';
                                                                        }
                                                                    }else{
                                                                        xCancel += '<td>Cancelled</td>';
                                                                    }
                                                                }
                                                                xCancel += '</tr>';
                                                            }
                                                            xCancel +='<tr>';
                                                            xCancel +='<td></td>';
                                                            xCancel +='<td></td>';
                                                            xCancel +='<td>Total:</td>';
                                                            xCancel += '<td>PHP 0.00</td>';
                                                            xCancel += '<td>PHP 0.00</td>';
                                                            xCancel += '<td>PHP 0.00</td>';
                                                            xCancel += '<td></td>';
                                                            xCancel += '<td></td>';
                                                            xCancel += '</tr>';
                                                            xCancel += '</tbody>';
                                                            xCancel += '</table>';
                                                            xCancel += '</div>';
                                                            xCancel += '</div>';

                                                            $('#monthPicker{{$uniqueComChef}}').append(x);
                                                            $('#pendMonthPicker{{$uniqueComChef}}').append(xPend);
                                                            $('#paidMonthPicker{{$uniqueComChef}}').append(xPaid);
                                                            $('#cancelMonthPicker{{$uniqueComChef}}').append(xCancel);

                                                            $('#chefAllTotalAmount{{$uniqueComChef}}').append(
                                                                    '<div>Total Payables for Vendor This Month</div>' +
                                                                    '<div>PHP '+addCommas(chefAllTotal.toFixed(2))+'</div>'
                                                            );

                                                            $('#chefPendTotalAmount{{$uniqueComChef}}').append(
                                                                    '<div>Total Pending Payables for Vendor This Month</div>' +
                                                                    '<div>PHP '+addCommas(chefPendTotal.toFixed(2))+'</div>'
                                                            );
                                                            $('#chefPaidTotalAmount{{$uniqueComChef}}').append(
                                                                    '<div>Total Paid Payables for Vendor This Month</div>' +
                                                                    '<div>PHP '+addCommas(chefPaidTotal.toFixed(2))+'</div>'
                                                            );
                                                            $('#dietPaidTotalAmount{{$uniqueComChef}}').append(
                                                                    '<div>Receivables for DietSelect This Month</div>' +
                                                                    '<div>PHP '+addCommas(dietTotal.toFixed(2))+'</div>'
                                                            );

                                                        }
                                                    });
                                                });



                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection