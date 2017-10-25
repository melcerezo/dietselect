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
        .comContents{
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
                                    <div class="row center">
                                        <div class="col s12 m3">
                                            <span class="chefTabAll{{$uniqueComChef}} tableTab">All</span>
                                        </div>
                                        <div class="col s12 m3">
                                            <span class="chefTabPend{{$uniqueComChef}} tableTab">Pending</span>
                                        </div>
                                        <div class="col s12 m3">
                                            <span class="chefTabPaid{{$uniqueComChef}} tableTab">Paid</span>
                                        </div>
                                        <div class="col s12 m3">
                                            <span class="chefTabCancel{{$uniqueComChef}} tableTab">Cancel</span>
                                        </div>
                                    </div>
                                    <script>
                                        $(document).ready(function(){
                                            $('#allMonth{{$uniqueComChef}}').show();
                                            $('.chefTabAll{{$uniqueComChef}}').addClass('activeTab');

                                            $('.chefTabAll{{$uniqueComChef}}').click(function () {
                                                $('.tableTab').removeClass('activeTab');
                                                $(this).addClass('activeTab');
                                                $('#allMonth{{$uniqueComChef}}').show();
                                                $('#pendMonth{{$uniqueComChef}}').hide();
                                                $('#paidMonth{{$uniqueComChef}}').hide();
                                                $('#cancelMonth{{$uniqueComChef}}').hide();
                                            });
                                            $('.chefTabPend{{$uniqueComChef}}').click(function () {
                                                $('.tableTab').removeClass('activeTab');
                                                $(this).addClass('activeTab');
                                                $('#allMonth{{$uniqueComChef}}').hide();
                                                $('#pendMonth{{$uniqueComChef}}').show();
                                                $('#paidMonth{{$uniqueComChef}}').hide();
                                                $('#cancelMonth{{$uniqueComChef}}').hide();
                                            });
                                            $('.chefTabPaid{{$uniqueComChef}}').click(function () {
                                                $('.tableTab').removeClass('activeTab');
                                                $(this).addClass('activeTab');
                                                $('#allMonth{{$uniqueComChef}}').hide();
                                                $('#pendMonth{{$uniqueComChef}}').hide();
                                                $('#paidMonth{{$uniqueComChef}}').show();
                                                $('#cancelMonth{{$uniqueComChef}}').hide();
                                            });
                                            $('.chefTabCancel{{$uniqueComChef}}').click(function () {
                                                $('.tableTab').removeClass('activeTab');
                                                $(this).addClass('activeTab');
                                                $('#allMonth{{$uniqueComChef}}').hide();
                                                $('#pendMonth{{$uniqueComChef}}').hide();
                                                $('#paidMonth{{$uniqueComChef}}').hide();
                                                $('#cancelMonth{{$uniqueComChef}}').show();
                                            });
                                        });
                                    </script>
                                    <div id="allMonth{{$uniqueComChef}}" class="row comContents">
                                        <div class="col s12 m3">
                                            <div>
                                                <span>Month:</span>
                                            </div>
                                            <select id="monthFilter{{$uniqueComChef}}">
                                            </select>
                                            <script>
                                                $(document).ready(function () {
                                                    var monthAjax = getMonths();

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

                                                        // $("select#monthFilter").val($("select#monthFilter option:first").val());

                                                        $('select#monthFilter{{$uniqueComChef}}').material_select();

                                                        var selectVal = $('select#monthFilter{{$uniqueComChef}}').val();

                                                        var changeMonth = monthChange('{{$uniqueComChef}}',selectVal,'0');

                                                        changeMonth.done(function (response) {
                                                            $('#monthPicker{{$uniqueComChef}}').empty();
                                                            if(response==''){
                                                                $('#monthPicker{{$uniqueComChef}}').append('<div>No Commissions</div>');
                                                            }else{
                                                                var valData = JSON.parse(response);
                                                                console.log(valData);

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

                                                                    x += '<tr>';
                                                                    x += '<td>'+valData[i].id+'</td>';
                                                                    x += '<td>'+valData[i].name+'</td>';
                                                                    x += '<td>'+valData[i].created_at+'</td>';
                                                                    x += '<td>PHP '+addCommas(amount.toFixed(2))+'</td>';
                                                                    x += '<td>PHP '+addCommas(chefAmount.toFixed(2))+'</td>';
                                                                    x += '<td>PHP '+addCommas(dietAmount.toFixed(2))+'</td>';
                                                                    if(valData[i].status==0){
                                                                        x += '<td>Paid</td>';
                                                                    }else{
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
                                                                x += '</tbody>';
                                                                x += '</table>';
                                                                x += '</div>';
                                                                x += '</div>';

                                                                $('#monthPicker{{$uniqueComChef}}').append(x);
                                                            }
                                                        });
                                                    });

                                                    $('select#monthFilter{{$uniqueComChef}}').change(function (){
                                                        var selectVal = $('select#monthFilter{{$uniqueComChef}}').val();
                                                        console.log(selectVal);
                                                        var changeMonth = monthChange('{{$uniqueComChef}}',selectVal,'0');
                                                        $('#monthPicker{{$uniqueComChef}}').empty();
                                                        changeMonth.done(function (response) {
                                                            if(response==''){
                                                                $('#monthPicker{{$uniqueComChef}}').append('<div>No Commissions</div>');
                                                            }else{
                                                                var valData = JSON.parse(response);
                                                                console.log(valData);

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

                                                                    x += '<tr>';
                                                                    x += '<td>'+valData[i].id+'</td>';
                                                                    x += '<td>'+valData[i].name+'</td>';
                                                                    x += '<td>'+valData[i].created_at+'</td>';
                                                                    x += '<td>PHP '+addCommas(amount.toFixed(2))+'</td>';
                                                                    x += '<td>PHP '+addCommas(chefAmount.toFixed(2))+'</td>';
                                                                    x += '<td>PHP '+addCommas(dietAmount.toFixed(2))+'</td>';
                                                                    if(valData[i].status==0){
                                                                        x += '<td>Paid</td>';
                                                                    }else{
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
                                                                x += '</tbody>';
                                                                x += '</table>';
                                                                x += '</div>';
                                                                x += '</div>';

                                                                $('#monthPicker{{$uniqueComChef}}').append(x);
                                                            }
                                                        });
                                                    });

                                                });
                                            </script>
                                        </div>
                                        <div id="monthPicker{{$uniqueComChef}}" class="col s12">
                                        </div>
                                    </div>
                                    <div id="pendMonth{{$uniqueComChef}}" class="row comContents">
                                        <div class="col s12 m3">
                                            <div>
                                                <span>Month:</span>
                                            </div>
                                            <select id="pendMonthFilter{{$uniqueComChef}}">
                                            </select>
                                            <script>
                                                $(document).ready(function () {
                                                    var monthAjax = getMonths();

                                                    monthAjax.done(function (response) {
                                                        var valData = JSON.parse(response);
//                                                        console.log(valData);
                                                        for(var i in valData){
                                                            var text = valData[i].monthText;
                                                            if(valData[i].current==1){
                                                                text += '(current)';
                                                                $('select#pendMonthFilter{{$uniqueComChef}}').append(
                                                                        $('<option></option>').attr("value",valData[i].month).text(text).prop('selected','selected')
                                                                );
                                                            }else{
                                                                $('select#pendMonthFilter{{$uniqueComChef}}').append(
                                                                        $('<option></option>').attr("value",valData[i].month).text(text)
                                                                );
                                                            }
                                                        }

                                                        // $("select#monthFilter").val($("select#monthFilter option:first").val());

                                                        $('select#pendMonthFilter{{$uniqueComChef}}').material_select();

                                                        var selectVal = $('select#pendMonthFilter{{$uniqueComChef}}').val();

                                                        var changeMonth = monthChange('{{$uniqueComChef}}',selectVal,'1');

                                                        changeMonth.done(function (response) {
                                                            $('#pendMonthPicker{{$uniqueComChef}}').empty();
                                                            if(response==''){
                                                                $('#pendMonthPicker{{$uniqueComChef}}').append('<div>No Commissions</div>');
                                                            }else{
                                                                var valData = JSON.parse(response);
                                                                console.log(valData);

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

                                                                    x += '<tr>';
                                                                    x += '<td>'+valData[i].id+'</td>';
                                                                    x += '<td>'+valData[i].name+'</td>';
                                                                    x += '<td>'+valData[i].created_at+'</td>';
                                                                    x += '<td>PHP '+addCommas(amount.toFixed(2))+'</td>';
                                                                    x += '<td>PHP '+addCommas(chefAmount.toFixed(2))+'</td>';
                                                                    x += '<td>PHP '+addCommas(dietAmount.toFixed(2))+'</td>';
                                                                    if(valData[i].status==0){
                                                                        x += '<td>Paid</td>';
                                                                    }else{
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
                                                                x += '</tbody>';
                                                                x += '</table>';
                                                                x += '</div>';
                                                                x += '</div>';

                                                                $('#pendMonthPicker{{$uniqueComChef}}').append(x);
                                                            }
                                                        });
                                                    });

                                                    $('select#pendMonthFilter{{$uniqueComChef}}').change(function (){
                                                        var selectVal = $('select#pendMonthFilter{{$uniqueComChef}}').val();
                                                        console.log(selectVal);
                                                        var changeMonth = monthChange('{{$uniqueComChef}}',selectVal,'1');
                                                        $('#pendMonthPicker{{$uniqueComChef}}').empty();
                                                        changeMonth.done(function (response) {
                                                            if(response==''){
                                                                $('#pendMonthPicker{{$uniqueComChef}}').append('<div>No Commissions</div>');
                                                            }else{
                                                                var valData = JSON.parse(response);
                                                                console.log(valData);

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

                                                                    x += '<tr>';
                                                                    x += '<td>'+valData[i].id+'</td>';
                                                                    x += '<td>'+valData[i].name+'</td>';
                                                                    x += '<td>'+valData[i].created_at+'</td>';
                                                                    x += '<td>PHP '+addCommas(amount.toFixed(2))+'</td>';
                                                                    x += '<td>PHP '+addCommas(chefAmount.toFixed(2))+'</td>';
                                                                    x += '<td>PHP '+addCommas(dietAmount.toFixed(2))+'</td>';
                                                                    if(valData[i].status==0){
                                                                        x += '<td>Paid</td>';
                                                                    }else{
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
                                                                x += '</tbody>';
                                                                x += '</table>';
                                                                x += '</div>';
                                                                x += '</div>';

                                                                $('#pendMonthPicker{{$uniqueComChef}}').append(x);
                                                            }
                                                        });
                                                    });

                                                });
                                            </script>
                                        </div>
                                        <div id="pendMonthPicker{{$uniqueComChef}}" class="col s12">
                                        </div>
                                    </div>
                                    <div id="paidMonth{{$uniqueComChef}}" class="row comContents">
                                        <div class="col s12 m3">
                                            <div>
                                                <span>Month:</span>
                                            </div>
                                            <select id="paidMonthFilter{{$uniqueComChef}}">
                                            </select>
                                            <script>
                                                $(document).ready(function () {
                                                    var monthAjax = getMonths();

                                                    monthAjax.done(function (response) {
                                                        var valData = JSON.parse(response);
//                                                        console.log(valData);
                                                        for(var i in valData){
                                                            var text = valData[i].monthText;
                                                            if(valData[i].current==1){
                                                                text += '(current)';
                                                                $('select#paidMonthFilter{{$uniqueComChef}}').append(
                                                                        $('<option></option>').attr("value",valData[i].month).text(text).prop('selected','selected')
                                                                );
                                                            }else{
                                                                $('select#paidMonthFilter{{$uniqueComChef}}').append(
                                                                        $('<option></option>').attr("value",valData[i].month).text(text)
                                                                );
                                                            }
                                                        }

                                                        // $("select#monthFilter").val($("select#monthFilter option:first").val());

                                                        $('select#paidMonthFilter{{$uniqueComChef}}').material_select();

                                                        var selectVal = $('select#paidMonthFilter{{$uniqueComChef}}').val();

                                                        var changeMonth = monthChange('{{$uniqueComChef}}',selectVal,'2');

                                                        changeMonth.done(function (response) {
                                                            $('#paidMonthPicker{{$uniqueComChef}}').empty();
                                                            if(response==''){
                                                                $('#paidMonthPicker{{$uniqueComChef}}').append('<div>No Commissions</div>');
                                                            }else{
                                                                var valData = JSON.parse(response);
                                                                console.log(valData);

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

                                                                    x += '<tr>';
                                                                    x += '<td>'+valData[i].id+'</td>';
                                                                    x += '<td>'+valData[i].name+'</td>';
                                                                    x += '<td>'+valData[i].created_at+'</td>';
                                                                    x += '<td>PHP '+addCommas(amount.toFixed(2))+'</td>';
                                                                    x += '<td>PHP '+addCommas(chefAmount.toFixed(2))+'</td>';
                                                                    x += '<td>PHP '+addCommas(dietAmount.toFixed(2))+'</td>';
                                                                    if(valData[i].status==0){
                                                                        x += '<td>Paid</td>';
                                                                    }else{
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
                                                                x += '</tbody>';
                                                                x += '</table>';
                                                                x += '</div>';
                                                                x += '</div>';

                                                                $('#paidMonthPicker{{$uniqueComChef}}').append(x);
                                                            }
                                                        });
                                                    });

                                                    $('select#paidMonthFilter{{$uniqueComChef}}').change(function (){
                                                        var selectVal = $('select#paidMonthFilter{{$uniqueComChef}}').val();
                                                        console.log(selectVal);
                                                        var changeMonth = monthChange('{{$uniqueComChef}}',selectVal,'2');
                                                        $('#paidMonthPicker{{$uniqueComChef}}').empty();
                                                        changeMonth.done(function (response) {
                                                            if(response==''){
                                                                $('#paidMonthPicker{{$uniqueComChef}}').append('<div>No Commissions</div>');
                                                            }else{
                                                                var valData = JSON.parse(response);
                                                                console.log(valData);

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

                                                                    x += '<tr>';
                                                                    x += '<td>'+valData[i].id+'</td>';
                                                                    x += '<td>'+valData[i].name+'</td>';
                                                                    x += '<td>'+valData[i].created_at+'</td>';
                                                                    x += '<td>PHP '+addCommas(amount.toFixed(2))+'</td>';
                                                                    x += '<td>PHP '+addCommas(chefAmount.toFixed(2))+'</td>';
                                                                    x += '<td>PHP '+addCommas(dietAmount.toFixed(2))+'</td>';
                                                                    if(valData[i].status==0){
                                                                        x += '<td>Paid</td>';
                                                                    }else{
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
                                                                x += '</tbody>';
                                                                x += '</table>';
                                                                x += '</div>';
                                                                x += '</div>';

                                                                $('#paidMonthPicker{{$uniqueComChef}}').append(x);
                                                            }
                                                        });
                                                    });

                                                });
                                            </script>
                                        </div>
                                        <div id="paidMonthPicker{{$uniqueComChef}}" class="col s12">
                                        </div>
                                    </div>
                                    <div id="cancelMonth{{$uniqueComChef}}" class="row comContents">
                                        <div class="col s12 m3">
                                            <div>
                                                <span>Month:</span>
                                            </div>
                                            <select id="cancelMonthFilter{{$uniqueComChef}}">
                                            </select>
                                            <script>
                                                $(document).ready(function () {
                                                    var monthAjax = getMonths();

                                                    monthAjax.done(function (response) {
                                                        var valData = JSON.parse(response);
//                                                        console.log(valData);
                                                        for(var i in valData){
                                                            var text = valData[i].monthText;
                                                            if(valData[i].current==1){
                                                                text += '(current)';
                                                                $('select#cancelMonthFilter{{$uniqueComChef}}').append(
                                                                        $('<option></option>').attr("value",valData[i].month).text(text).prop('selected','selected')
                                                                );
                                                            }else{
                                                                $('select#cancelMonthFilter{{$uniqueComChef}}').append(
                                                                        $('<option></option>').attr("value",valData[i].month).text(text)
                                                                );
                                                            }
                                                        }

                                                        // $("select#monthFilter").val($("select#monthFilter option:first").val());

                                                        $('select#cancelMonthFilter{{$uniqueComChef}}').material_select();

                                                        var selectVal = $('select#cancelMonthFilter{{$uniqueComChef}}').val();

                                                        var changeMonth = monthChange('{{$uniqueComChef}}',selectVal,'3');

                                                        changeMonth.done(function (response) {
                                                            $('#cancelMonthPicker{{$uniqueComChef}}').empty();
                                                            if(response==''){
                                                                $('#cancelMonthPicker{{$uniqueComChef}}').append('<div>No Commissions</div>');
                                                            }else{
                                                                var valData = JSON.parse(response);
                                                                console.log(valData);

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

                                                                    x += '<tr>';
                                                                    x += '<td>'+valData[i].id+'</td>';
                                                                    x += '<td>'+valData[i].name+'</td>';
                                                                    x += '<td>'+valData[i].created_at+'</td>';
                                                                    x += '<td>PHP '+addCommas(amount.toFixed(2))+'</td>';
                                                                    x += '<td>PHP '+addCommas(chefAmount.toFixed(2))+'</td>';
                                                                    x += '<td>PHP '+addCommas(dietAmount.toFixed(2))+'</td>';
                                                                    if(valData[i].status==0){
                                                                        x += '<td>Paid</td>';
                                                                    }else{
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
                                                                x += '</tbody>';
                                                                x += '</table>';
                                                                x += '</div>';
                                                                x += '</div>';

                                                                $('#cancelMonthPicker{{$uniqueComChef}}').append(x);
                                                            }
                                                        });
                                                    });

                                                    $('select#cancelMonthFilter{{$uniqueComChef}}').change(function (){
                                                        var selectVal = $('select#cancelMonthFilter{{$uniqueComChef}}').val();
                                                        console.log(selectVal);
                                                        var changeMonth = monthChange('{{$uniqueComChef}}',selectVal,'3');
                                                        $('#cancelMonthPicker{{$uniqueComChef}}').empty();
                                                        changeMonth.done(function (response) {
                                                            if(response==''){
                                                                $('#cancelMonthPicker{{$uniqueComChef}}').append('<div>No Commissions</div>');
                                                            }else{
                                                                var valData = JSON.parse(response);
                                                                console.log(valData);

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

                                                                    x += '<tr>';
                                                                    x += '<td>'+valData[i].id+'</td>';
                                                                    x += '<td>'+valData[i].name+'</td>';
                                                                    x += '<td>'+valData[i].created_at+'</td>';
                                                                    x += '<td>PHP '+addCommas(amount.toFixed(2))+'</td>';
                                                                    x += '<td>PHP '+addCommas(chefAmount.toFixed(2))+'</td>';
                                                                    x += '<td>PHP '+addCommas(dietAmount.toFixed(2))+'</td>';
                                                                    if(valData[i].status==0){
                                                                        x += '<td>Paid</td>';
                                                                    }else{
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
                                                                x += '</tbody>';
                                                                x += '</table>';
                                                                x += '</div>';
                                                                x += '</div>';

                                                                $('#cancelMonthPicker{{$uniqueComChef}}').append(x);
                                                            }
                                                        });
                                                    });

                                                });
                                            </script>
                                        </div>
                                        <div id="cancelMonthPicker{{$uniqueComChef}}" class="col s12">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
                {{--<div class="row">--}}
                    {{--<div id="chefsContainer">--}}
                    {{--</div>--}}
                    {{--<div id="divChefsAll">--}}
                        {{--@foreach($uniqueComChefs as $uniqueComChef)--}}
                            {{--<div id="cardCom{{$uniqueComChef}}" class="card chefCard">--}}
                                {{--<div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">--}}
                                    {{--<div>--}}
                                        {{--<span>--}}
                                            {{--Commissions ---}}
                                            {{--@foreach($chefs as $chef)--}}
                                                {{--@if($chef->id==$uniqueComChef)--}}
                                                    {{--<span>{{$chef->name}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</span>--}}
                                        {{--<span class="badge light-green white-text" style="border-radius: 15px">--}}
                                            {{--{{$commissions->where('chef_id','=',$uniqueComChef)->count()}}--}}
                                        {{--</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="card-content">--}}
                                    {{--<div class="row center">--}}
                                        {{--@foreach($uniqueComArray as $comArray)--}}
                                            {{--@if($comArray['id']==$uniqueComChef)--}}
                                                {{--<div class="col s12 m3">--}}
                                                    {{--<div>--}}
                                                        {{--Total For--}}
                                                        {{--@foreach($chefs as $chef)--}}
                                                            {{--@if($chef->id==$uniqueComChef)--}}
                                                                {{--<span>{{$chef->name}}</span>--}}
                                                            {{--@endif--}}
                                                        {{--@endforeach--}}
                                                    {{--</div>--}}
                                                    {{--<span>{{'PHP '.number_format(($comArray['total'] * 0.9),2,'.',',')}}</span>--}}
                                                {{--</div>--}}
                                                {{--<div class="col s12 m3">--}}
                                                    {{--<div>--}}
                                                        {{--Total Unpaid For--}}
                                                        {{--@foreach($chefs as $chef)--}}
                                                            {{--@if($chef->id==$uniqueComChef)--}}
                                                                {{--<span>{{$chef->name}}</span>--}}
                                                            {{--@endif--}}
                                                        {{--@endforeach--}}

                                                    {{--</div>--}}
                                                    {{--<span>{{'PHP '.number_format(($comArray['pend'] * 0.9),2,'.',',')}}</span>--}}
                                                {{--</div>--}}
                                                {{--<div class="col s12 m3">--}}
                                                    {{--<div>--}}
                                                        {{--Total Paid For--}}
                                                        {{--@foreach($chefs as $chef)--}}
                                                            {{--@if($chef->id==$uniqueComChef)--}}
                                                                {{--<span>{{$chef->name}}</span>--}}
                                                            {{--@endif--}}
                                                        {{--@endforeach--}}
                                                    {{--</div>--}}
                                                    {{--<span>{{'PHP '.number_format(($comArray['paid'] * 0.9),2,'.',',')}}</span>--}}
                                                {{--</div>--}}
                                                {{--<div class="col s12 m3">--}}
                                                    {{--<div>--}}
                                                        {{--Total for DietSelect--}}
                                                    {{--</div>--}}
                                                    {{--<span>{{'PHP '.number_format(($comArray['paid'] * 0.1),2,'.',',')}}</span>--}}
                                                {{--</div>--}}
                                            {{--@endif--}}
                                        {{--@endforeach--}}
                                    {{--</div>--}}
                                    {{--<div class="divider">--}}
                                    {{--</div>--}}
                                    {{--<div class="row center">--}}
                                        {{--<div class="col s12 m4">--}}
                                            {{--<span class="chefTabAll{{$uniqueComChef}} tableTab">All</span>--}}
                                        {{--</div>--}}
                                        {{--<div class="col s12 m4">--}}
                                            {{--<span class="chefTabPend{{$uniqueComChef}} tableTab">Pending</span>--}}
                                        {{--</div>--}}
                                        {{--<div class="col s12 m4">--}}
                                            {{--<span class="chefTabPaid{{$uniqueComChef}} tableTab">Paid</span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<script>--}}
                                        {{--$(document).ready(function () {--}}
                                            {{--$('span.chefTabAll{{$uniqueComChef}}').addClass('activeTab');--}}
                                            {{--$('div#allTable{{$uniqueComChef}}').show();--}}
                                            {{--$('table#weekAllTable{{$uniqueComChef}}').show();--}}
                                            {{--$('table#monthAllTable{{$uniqueComChef}}').hide();--}}
                                            {{--$('table#yearAllTable{{$uniqueComChef}}').hide();--}}
                                            {{--$('table#allAllTable{{$uniqueComChef}}').hide();--}}
                                            {{--$('div#pendTable{{$uniqueComChef}}').hide();--}}
                                            {{--$('div#paidTable{{$uniqueComChef}}').hide();--}}


                                            {{--$('span.chefTabAll{{$uniqueComChef}}').on('click',function () {--}}
                                                {{--$('.chefTabPend{{$uniqueComChef}}').removeClass('activeTab');--}}
                                                {{--$('.chefTabPaid{{$uniqueComChef}}').removeClass('activeTab');--}}
                                                {{--$(this).addClass('activeTab');--}}

                                                {{--$('div#allTable{{$uniqueComChef}}').show();--}}
                                                {{--var val = $('select#comAllFilter{{$uniqueComChef}} option:selected').val();--}}
                                                {{--if(val==2){--}}
                                                    {{--$('#weekAllTable{{$uniqueComChef}}').show();--}}
                                                    {{--$('#monthAllTable{{$uniqueComChef}}').hide();--}}
                                                    {{--$('#yearAllTable{{$uniqueComChef}}').hide();--}}
                                                    {{--$('#allAllTable{{$uniqueComChef}}').hide();--}}
                                                {{--}else if(val==3){--}}
                                                    {{--$('#weekAllTable{{$uniqueComChef}}').hide();--}}
                                                    {{--$('#monthAllTable{{$uniqueComChef}}').show();--}}
                                                    {{--$('#yearAllTable{{$uniqueComChef}}').hide();--}}
                                                    {{--$('#allAllTable{{$uniqueComChef}}').hide();--}}
                                                {{--}else if(val==4){--}}
                                                    {{--$('#weekAllTable{{$uniqueComChef}}').hide();--}}
                                                    {{--$('#monthAllTable{{$uniqueComChef}}').hide();--}}
                                                    {{--$('#yearAllTable{{$uniqueComChef}}').show();--}}
                                                    {{--$('#allAllTable{{$uniqueComChef}}').hide();--}}
                                                {{--}else if(val==5){--}}
                                                    {{--$('#weekAllTable{{$uniqueComChef}}').hide();--}}
                                                    {{--$('#monthAllTable{{$uniqueComChef}}').hide();--}}
                                                    {{--$('#yearAllTable{{$uniqueComChef}}').hide();--}}
                                                    {{--$('#allAllTable{{$uniqueComChef}}').show();--}}
                                                {{--}--}}

                                                {{--$('div#pendTable{{$uniqueComChef}}').hide();--}}
                                                {{--$('div#paidTable{{$uniqueComChef}}').hide();--}}
                                            {{--});--}}
                                            {{--$('span.chefTabPend{{$uniqueComChef}}').on('click',function () {--}}
                                                {{--$('.chefTabPaid{{$uniqueComChef}}').removeClass('activeTab');--}}
                                                {{--$('.chefTabAll{{$uniqueComChef}}').removeClass('activeTab');--}}
                                                {{--$(this).addClass('activeTab');--}}

                                                {{--$('div#allTable{{$uniqueComChef}}').hide();--}}
                                                {{--$('div#pendTable{{$uniqueComChef}}').show();--}}

                                                {{--var val = $('select#comPendFilter{{$uniqueComChef}} option:selected').val();--}}
                                                {{--if(val==2){--}}
                                                    {{--$('#weekPendTable{{$uniqueComChef}}').show();--}}
                                                    {{--$('#monthPendTable{{$uniqueComChef}}').hide();--}}
                                                    {{--$('#yearPendTable{{$uniqueComChef}}').hide();--}}
                                                    {{--$('#allPendTable{{$uniqueComChef}}').hide();--}}
                                                {{--}else if(val==3){--}}
                                                    {{--$('#weekPendTable{{$uniqueComChef}}').hide();--}}
                                                    {{--$('#monthPendTable{{$uniqueComChef}}').show();--}}
                                                    {{--$('#yearPendTable{{$uniqueComChef}}').hide();--}}
                                                    {{--$('#allPendTable{{$uniqueComChef}}').hide();--}}
                                                {{--}else if(val==4){--}}
                                                    {{--$('#weekPendTable{{$uniqueComChef}}').hide();--}}
                                                    {{--$('#monthPendTable{{$uniqueComChef}}').hide();--}}
                                                    {{--$('#yearPendTable{{$uniqueComChef}}').show();--}}
                                                    {{--$('#allPendTable{{$uniqueComChef}}').hide();--}}
                                                {{--}else if(val==5){--}}
                                                    {{--$('#weekPendTable{{$uniqueComChef}}').hide();--}}
                                                    {{--$('#monthPendTable{{$uniqueComChef}}').hide();--}}
                                                    {{--$('#yearPendTable{{$uniqueComChef}}').hide();--}}
                                                    {{--$('#allPendTable{{$uniqueComChef}}').show();--}}
                                                {{--}--}}

                                                {{--$('div#paidTable{{$uniqueComChef}}').hide();--}}
                                            {{--});--}}
                                            {{--$('span.chefTabPaid{{$uniqueComChef}}').on('click',function () {--}}
                                                {{--$('.chefTabPend{{$uniqueComChef}}').removeClass('activeTab');--}}
                                                {{--$('.chefTabAll{{$uniqueComChef}}').removeClass('activeTab');--}}
                                                {{--$(this).addClass('activeTab');--}}

                                                {{--$('div#allTable{{$uniqueComChef}}').hide();--}}
                                                {{--$('div#pendTable{{$uniqueComChef}}').hide();--}}
                                                {{--$('div#paidTable{{$uniqueComChef}}').show();--}}

                                                {{--var val = $('select#comPaidFilter{{$uniqueComChef}} option:selected').val();--}}
                                                {{--if(val==2){--}}
                                                    {{--$('#weekPaidTable{{$uniqueComChef}}').show();--}}
                                                    {{--$('#monthPaidTable{{$uniqueComChef}}').hide();--}}
                                                    {{--$('#yearPaidTable{{$uniqueComChef}}').hide();--}}
                                                    {{--$('#allPaidTable{{$uniqueComChef}}').hide();--}}
                                                {{--}else if(val==3){--}}
                                                    {{--$('#weekPaidTable{{$uniqueComChef}}').hide();--}}
                                                    {{--$('#monthPaidTable{{$uniqueComChef}}').show();--}}
                                                    {{--$('#yearPaidTable{{$uniqueComChef}}').hide();--}}
                                                    {{--$('#allPaidTable{{$uniqueComChef}}').hide();--}}
                                                {{--}else if(val==4){--}}
                                                    {{--$('#weekPaidTable{{$uniqueComChef}}').hide();--}}
                                                    {{--$('#monthPaidTable{{$uniqueComChef}}').hide();--}}
                                                    {{--$('#yearPaidTable{{$uniqueComChef}}').show();--}}
                                                    {{--$('#allPaidTable{{$uniqueComChef}}').hide();--}}
                                                {{--}else if(val==5){--}}
                                                    {{--$('#weekPaidTable{{$uniqueComChef}}').hide();--}}
                                                    {{--$('#monthPaidTable{{$uniqueComChef}}').hide();--}}
                                                    {{--$('#yearPaidTable{{$uniqueComChef}}').hide();--}}
                                                    {{--$('#allPaidTable{{$uniqueComChef}}').show();--}}
                                                {{--}--}}
                                            {{--});--}}
                                        {{--});--}}
                                    {{--</script>--}}
                                    {{--<div class="divider">--}}
                                    {{--</div>--}}
                                    {{--<div id="allTable{{$uniqueComChef}}">--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="col s12 m3">--}}
                                                {{--<div>--}}
                                                    {{--<span>Search by Interval:</span>--}}
                                                {{--</div>--}}
                                                {{--<select id="comAllFilter{{$uniqueComChef}}">--}}
                                                    {{--<option value="2" selected>This Week</option>--}}
                                                    {{--<option value="3">This Month</option>--}}
                                                    {{--<option value="4">This Year</option>--}}
                                                    {{--<option value="5">All</option>--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                            {{--<script>--}}
                                                {{--$(document).ready(function () {--}}
                                                    {{--$('#comAllFilter{{$uniqueComChef}}').change(function () {--}}
                                                        {{--var val = $('select#comAllFilter{{$uniqueComChef}} option:selected').val();--}}
                                                        {{--if(val==2){--}}
                                                            {{--$('#weekAllTable{{$uniqueComChef}}').show();--}}
                                                            {{--$('#monthAllTable{{$uniqueComChef}}').hide();--}}
                                                            {{--$('#yearAllTable{{$uniqueComChef}}').hide();--}}
                                                            {{--$('#allAllTable{{$uniqueComChef}}').hide();--}}
                                                        {{--}else if(val==3){--}}
                                                            {{--$('#weekAllTable{{$uniqueComChef}}').hide();--}}
                                                            {{--$('#monthAllTable{{$uniqueComChef}}').show();--}}
                                                            {{--$('#yearAllTable{{$uniqueComChef}}').hide();--}}
                                                            {{--$('#allAllTable{{$uniqueComChef}}').hide();--}}
                                                        {{--}else if(val==4){--}}
                                                            {{--$('#weekAllTable{{$uniqueComChef}}').hide();--}}
                                                            {{--$('#monthAllTable{{$uniqueComChef}}').hide();--}}
                                                            {{--$('#yearAllTable{{$uniqueComChef}}').show();--}}
                                                            {{--$('#allAllTable{{$uniqueComChef}}').hide();--}}
                                                        {{--}else if(val==5){--}}
                                                            {{--$('#weekAllTable{{$uniqueComChef}}').hide();--}}
                                                            {{--$('#monthAllTable{{$uniqueComChef}}').hide();--}}
                                                            {{--$('#yearAllTable{{$uniqueComChef}}').hide();--}}
                                                            {{--$('#allAllTable{{$uniqueComChef}}').show();--}}
                                                        {{--}--}}
                                                    {{--});--}}
                                                {{--});--}}
                                            {{--</script>--}}
                                        {{--</div>--}}
                                        {{--<table id="weekAllTable{{$uniqueComChef}}" class="responsive-table centered">--}}
                                            {{--<thead>--}}
                                            {{--<tr>--}}
                                                {{--<th>ID</th>--}}
                                                {{--<th>Chef Name</th>--}}
                                                {{--<th>Date</th>--}}
                                                {{--<th>Total Amount</th>--}}
                                                {{--<th>Amount to Vendor(90%)</th>--}}
                                                {{--<th>Amount to DietSelect(10%)</th>--}}
                                                {{--<th>Payment Status</th>--}}
                                                {{--<th>Update</th>--}}
                                            {{--</tr>--}}
                                            {{--</thead>--}}
                                            {{--<tbody>--}}
                                            {{--@foreach($commissions->where('chef_id','=',$uniqueComChef)->where('created_at','>', $startWeek)->where('created_at','<',$endWeek) as $commission)--}}
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
                                                    {{--<td>{{'PHP '.number_format(($commission->amount),2,'.',',')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format(($commission->amount * 0.9),2,'.',',')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format(($commission->amount * 0.1),2,'.',',')}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<span>Pending</span>--}}
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

                                        {{--<table id="monthAllTable{{$uniqueComChef}}" class="responsive-table centered">--}}
                                            {{--<thead>--}}
                                            {{--<tr>--}}
                                                {{--<th>ID</th>--}}
                                                {{--<th>Chef Name</th>--}}
                                                {{--<th>Date</th>--}}
                                                {{--<th>Total Amount</th>--}}
                                                {{--<th>Amount to Vendor(90%)</th>--}}
                                                {{--<th>Amount to DietSelect(10%)</th>--}}
                                                {{--<th>Payment Status</th>--}}
                                                {{--<th>Update</th>--}}
                                            {{--</tr>--}}
                                            {{--</thead>--}}
                                            {{--<tbody>--}}
                                            {{--@foreach($commissions->where('chef_id','=',$uniqueComChef)->where('created_at','>', $startMonth)->where('created_at','<',$endMonth) as $commission)--}}
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
                                                    {{--<td>{{'PHP '.number_format(($commission->amount),2,'.',',')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format(($commission->amount * 0.9),2,'.',',')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format(($commission->amount * 0.1),2,'.',',')}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<span>Pending</span>--}}
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

                                        {{--<table id="yearAllTable{{$uniqueComChef}}" class="responsive-table centered">--}}
                                            {{--<thead>--}}
                                            {{--<tr>--}}
                                                {{--<th>ID</th>--}}
                                                {{--<th>Chef Name</th>--}}
                                                {{--<th>Date</th>--}}
                                                {{--<th>Total Amount</th>--}}
                                                {{--<th>Amount to Vendor(90%)</th>--}}
                                                {{--<th>Amount to DietSelect(10%)</th>--}}
                                                {{--<th>Payment Status</th>--}}
                                                {{--<th>Update</th>--}}
                                            {{--</tr>--}}
                                            {{--</thead>--}}
                                            {{--<tbody>--}}
                                            {{--@foreach($commissions->where('chef_id','=',$uniqueComChef)->where('created_at','>', $startYear)->where('created_at','<',$endYear) as $commission)--}}
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
                                                    {{--<td>{{'PHP '.number_format(($commission->amount),2,'.',',')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format(($commission->amount * 0.9),2,'.',',')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format(($commission->amount * 0.1),2,'.',',')}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<span>Pending</span>--}}
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

                                        {{--<table id="allAllTable{{$uniqueComChef}}" class="responsive-table centered">--}}
                                            {{--<thead>--}}
                                            {{--<tr>--}}
                                                {{--<th>ID</th>--}}
                                                {{--<th>Chef Name</th>--}}
                                                {{--<th>Date</th>--}}
                                                {{--<th>Total Amount</th>--}}
                                                {{--<th>Amount to Vendor(90%)</th>--}}
                                                {{--<th>Amount to DietSelect(10%)</th>--}}
                                                {{--<th>Payment Status</th>--}}
                                                {{--<th>Update</th>--}}
                                            {{--</tr>--}}
                                            {{--</thead>--}}
                                            {{--<tbody>--}}
                                            {{--@foreach($commissions->where('chef_id','=',$uniqueComChef) as $commission)--}}
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
                                                    {{--<td>{{'PHP '.number_format(($commission->amount),2,'.',',')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format(($commission->amount * 0.9),2,'.',',')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format(($commission->amount * 0.1),2,'.',',')}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<span>Pending</span>--}}
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
                                    {{--<div id="pendTable{{$uniqueComChef}}">--}}
                                        {{--<div>--}}
                                            {{--<div class="col s12 m3">--}}
                                                {{--<div>--}}
                                                    {{--<span>Search by Interval:</span>--}}
                                                {{--</div>--}}
                                                {{--<select id="comPendFilter{{$uniqueComChef}}">--}}
                                                    {{--<option value="2" selected>This Week</option>--}}
                                                    {{--<option value="3">This Month</option>--}}
                                                    {{--<option value="4">This Year</option>--}}
                                                    {{--<option value="5">All</option>--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                            {{--<script>--}}
                                                {{--$(document).ready(function () {--}}
                                                    {{--$('#comPendFilter{{$uniqueComChef}}').change(function () {--}}
                                                        {{--var val = $('select#comPendFilter{{$uniqueComChef}} option:selected').val();--}}
                                                        {{--if(val==2){--}}
                                                            {{--$('#weekPendTable{{$uniqueComChef}}').show();--}}
                                                            {{--$('#monthPendTable{{$uniqueComChef}}').hide();--}}
                                                            {{--$('#yearPendTable{{$uniqueComChef}}').hide();--}}
                                                            {{--$('#allPendTable{{$uniqueComChef}}').hide();--}}
                                                        {{--}else if(val==3){--}}
                                                            {{--$('#weekPendTable{{$uniqueComChef}}').hide();--}}
                                                            {{--$('#monthPendTable{{$uniqueComChef}}').show();--}}
                                                            {{--$('#yearPendTable{{$uniqueComChef}}').hide();--}}
                                                            {{--$('#allPendTable{{$uniqueComChef}}').hide();--}}
                                                        {{--}else if(val==4){--}}
                                                            {{--$('#weekPendTable{{$uniqueComChef}}').hide();--}}
                                                            {{--$('#monthPendTable{{$uniqueComChef}}').hide();--}}
                                                            {{--$('#yearPendTable{{$uniqueComChef}}').show();--}}
                                                            {{--$('#allPendTable{{$uniqueComChef}}').hide();--}}
                                                        {{--}else if(val==5){--}}
                                                            {{--$('#weekPendTable{{$uniqueComChef}}').hide();--}}
                                                            {{--$('#monthPendTable{{$uniqueComChef}}').hide();--}}
                                                            {{--$('#yearPendTable{{$uniqueComChef}}').hide();--}}
                                                            {{--$('#allPendTable{{$uniqueComChef}}').show();--}}
                                                        {{--}--}}
                                                    {{--});--}}
                                                {{--});--}}
                                            {{--</script>--}}
                                        {{--</div>--}}
                                        {{--<table id="weekPendTable{{$uniqueComChef}}" class="responsive-table centered">--}}
                                            {{--<thead>--}}
                                            {{--<tr>--}}
                                                {{--<th>ID</th>--}}
                                                {{--<th>Chef Name</th>--}}
                                                {{--<th>Date</th>--}}
                                                {{--<th>Total Amount</th>--}}
                                                {{--<th>Amount to Vendor(90%)</th>--}}
                                                {{--<th>Amount to DietSelect(10%)</th>--}}
                                                {{--<th>Payment Status</th>--}}
                                                {{--<th>Update</th>--}}
                                            {{--</tr>--}}
                                            {{--</thead>--}}
                                            {{--<tbody>--}}
                                            {{--@foreach($commissions->where('chef_id','=',$uniqueComChef)->where('paid','=',0)->where('created_at','>', $startWeek)->where('created_at','<',$endWeek) as $commission)--}}
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
                                                    {{--<td>{{'PHP '.number_format(($commission->amount),2,'.',',')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format(($commission->amount * 0.9),2,'.',',')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format(($commission->amount * 0.1),2,'.',',')}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<span>Pending</span>--}}
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

                                        {{--<table id="monthPendTable{{$uniqueComChef}}" class="responsive-table centered">--}}
                                            {{--<thead>--}}
                                            {{--<tr>--}}
                                                {{--<th>ID</th>--}}
                                                {{--<th>Chef Name</th>--}}
                                                {{--<th>Date</th>--}}
                                                {{--<th>Total Amount</th>--}}
                                                {{--<th>Amount to Vendor(90%)</th>--}}
                                                {{--<th>Amount to DietSelect(10%)</th>--}}
                                                {{--<th>Payment Status</th>--}}
                                                {{--<th>Update</th>--}}
                                            {{--</tr>--}}
                                            {{--</thead>--}}
                                            {{--<tbody>--}}
                                            {{--@foreach($commissions->where('chef_id','=',$uniqueComChef)->where('paid','=',0)->where('created_at','>', $startMonth)->where('created_at','<',$endMonth) as $commission)--}}
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
                                                    {{--<td>{{'PHP '.number_format(($commission->amount),2,'.',',')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format(($commission->amount * 0.9),2,'.',',')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format(($commission->amount * 0.1),2,'.',',')}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<span>Pending</span>--}}
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

                                        {{--<table id="yearPendTable{{$uniqueComChef}}" class="responsive-table centered">--}}
                                            {{--<thead>--}}
                                            {{--<tr>--}}
                                                {{--<th>ID</th>--}}
                                                {{--<th>Chef Name</th>--}}
                                                {{--<th>Date</th>--}}
                                                {{--<th>Total Amount</th>--}}
                                                {{--<th>Amount to Vendor(90%)</th>--}}
                                                {{--<th>Amount to DietSelect(10%)</th>--}}
                                                {{--<th>Payment Status</th>--}}
                                                {{--<th>Update</th>--}}
                                            {{--</tr>--}}
                                            {{--</thead>--}}
                                            {{--<tbody>--}}
                                            {{--@foreach($commissions->where('chef_id','=',$uniqueComChef)->where('paid','=',0)->where('created_at','>', $startYear)->where('created_at','<',$endYear) as $commission)--}}
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
                                                    {{--<td>{{'PHP '.number_format(($commission->amount),2,'.',',')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format(($commission->amount * 0.9),2,'.',',')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format(($commission->amount * 0.1),2,'.',',')}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<span>Pending</span>--}}
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

                                        {{--<table id="allPendTable{{$uniqueComChef}}" class="responsive-table centered">--}}
                                            {{--<thead>--}}
                                            {{--<tr>--}}
                                                {{--<th>ID</th>--}}
                                                {{--<th>Chef Name</th>--}}
                                                {{--<th>Date</th>--}}
                                                {{--<th>Total Amount</th>--}}
                                                {{--<th>Amount to Vendor(90%)</th>--}}
                                                {{--<th>Amount to DietSelect(10%)</th>--}}
                                                {{--<th>Payment Status</th>--}}
                                                {{--<th>Update</th>--}}
                                            {{--</tr>--}}
                                            {{--</thead>--}}
                                            {{--<tbody>--}}
                                            {{--@foreach($commissions->where('chef_id','=',$uniqueComChef)->where('paid','=',0) as $commission)--}}
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
                                                    {{--<td>{{'PHP '.number_format(($commission->amount),2,'.',',')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format(($commission->amount * 0.9),2,'.',',')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format(($commission->amount * 0.1),2,'.',',')}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<span>Pending</span>--}}
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
                                    {{--<div id="paidTable{{$uniqueComChef}}">--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="col s12 m3">--}}
                                                {{--<div>--}}
                                                    {{--<span>Search by Interval:</span>--}}
                                                {{--</div>--}}
                                                {{--<select id="comPaidFilter{{$uniqueComChef}}">--}}
                                                    {{--<option value="2" selected>This Week</option>--}}
                                                    {{--<option value="3">This Month</option>--}}
                                                    {{--<option value="4">This Year</option>--}}
                                                    {{--<option value="5">All</option>--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                            {{--<script>--}}
                                                {{--$(document).ready(function () {--}}
                                                    {{--$('#comPaidFilter{{$uniqueComChef}}').change(function () {--}}
                                                        {{--var val = $('select#comPaidFilter{{$uniqueComChef}} option:selected').val();--}}
                                                        {{--if(val==2){--}}
                                                            {{--$('#weekPaidTable{{$uniqueComChef}}').show();--}}
                                                            {{--$('#monthPaidTable{{$uniqueComChef}}').hide();--}}
                                                            {{--$('#yearPaidTable{{$uniqueComChef}}').hide();--}}
                                                            {{--$('#allPaidTable{{$uniqueComChef}}').hide();--}}
                                                        {{--}else if(val==3){--}}
                                                            {{--$('#weekPaidTable{{$uniqueComChef}}').hide();--}}
                                                            {{--$('#monthPaidTable{{$uniqueComChef}}').show();--}}
                                                            {{--$('#yearPaidTable{{$uniqueComChef}}').hide();--}}
                                                            {{--$('#allPaidTable{{$uniqueComChef}}').hide();--}}
                                                        {{--}else if(val==4){--}}
                                                            {{--$('#weekPaidTable{{$uniqueComChef}}').hide();--}}
                                                            {{--$('#monthPaidTable{{$uniqueComChef}}').hide();--}}
                                                            {{--$('#yearPaidTable{{$uniqueComChef}}').show();--}}
                                                            {{--$('#allPaidTable{{$uniqueComChef}}').hide();--}}
                                                        {{--}else if(val==5){--}}
                                                            {{--$('#weekPaidTable{{$uniqueComChef}}').hide();--}}
                                                            {{--$('#monthPaidTable{{$uniqueComChef}}').hide();--}}
                                                            {{--$('#yearPaidTable{{$uniqueComChef}}').hide();--}}
                                                            {{--$('#allPaidTable{{$uniqueComChef}}').show();--}}
                                                        {{--}--}}
                                                    {{--});--}}
                                                {{--});--}}
                                            {{--</script>--}}
                                        {{--</div>--}}
                                        {{--<table id="weekPaidTable{{$uniqueComChef}}" class="responsive-table centered">--}}
                                            {{--<thead>--}}
                                            {{--<tr>--}}
                                                {{--<th>ID</th>--}}
                                                {{--<th>Chef Name</th>--}}
                                                {{--<th>Date</th>--}}
                                                {{--<th>Total Amount</th>--}}
                                                {{--<th>Amount to Vendor(90%)</th>--}}
                                                {{--<th>Amount to DietSelect(10%)</th>--}}
                                                {{--<th>Payment Status</th>--}}
                                                {{--<th>Update</th>--}}
                                            {{--</tr>--}}
                                            {{--</thead>--}}
                                            {{--<tbody>--}}
                                            {{--@foreach($commissions->where('chef_id','=',$uniqueComChef)->where('paid','=',1)->where('created_at','>', $startWeek)->where('created_at','<',$endWeek) as $commission)--}}
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
                                                    {{--<td>{{'PHP '.number_format(($commission->amount),2,'.',',')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format(($commission->amount * 0.9),2,'.',',')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format(($commission->amount * 0.1),2,'.',',')}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<span>Pending</span>--}}
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

                                        {{--<table id="monthPaidTable{{$uniqueComChef}}" class="responsive-table centered">--}}
                                            {{--<thead>--}}
                                            {{--<tr>--}}
                                                {{--<th>ID</th>--}}
                                                {{--<th>Chef Name</th>--}}
                                                {{--<th>Date</th>--}}
                                                {{--<th>Total Amount</th>--}}
                                                {{--<th>Amount to Vendor(90%)</th>--}}
                                                {{--<th>Amount to DietSelect(10%)</th>--}}
                                                {{--<th>Payment Status</th>--}}
                                                {{--<th>Update</th>--}}
                                            {{--</tr>--}}
                                            {{--</thead>--}}
                                            {{--<tbody>--}}
                                            {{--@foreach($commissions->where('chef_id','=',$uniqueComChef)->where('paid','=',1)->where('created_at','>', $startMonth)->where('created_at','<',$endMonth) as $commission)--}}
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
                                                    {{--<td>{{'PHP '.number_format(($commission->amount),2,'.',',')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format(($commission->amount * 0.9),2,'.',',')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format(($commission->amount * 0.1),2,'.',',')}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<span>Pending</span>--}}
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

                                        {{--<table id="yearPaidTable{{$uniqueComChef}}" class="responsive-table centered">--}}
                                            {{--<thead>--}}
                                            {{--<tr>--}}
                                                {{--<th>ID</th>--}}
                                                {{--<th>Chef Name</th>--}}
                                                {{--<th>Date</th>--}}
                                                {{--<th>Total Amount</th>--}}
                                                {{--<th>Amount to Vendor(90%)</th>--}}
                                                {{--<th>Amount to DietSelect(10%)</th>--}}
                                                {{--<th>Payment Status</th>--}}
                                                {{--<th>Update</th>--}}
                                            {{--</tr>--}}
                                            {{--</thead>--}}
                                            {{--<tbody>--}}
                                            {{--@foreach($commissions->where('chef_id','=',$uniqueComChef)->where('paid','=',1)->where('created_at','>', $startYear)->where('created_at','<',$endYear) as $commission)--}}
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
                                                    {{--<td>{{'PHP '.number_format(($commission->amount),2,'.',',')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format(($commission->amount * 0.9),2,'.',',')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format(($commission->amount * 0.1),2,'.',',')}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<span>Pending</span>--}}
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

                                        {{--<table id="allPaidTable{{$uniqueComChef}}" class="responsive-table centered">--}}
                                            {{--<thead>--}}
                                            {{--<tr>--}}
                                                {{--<th>ID</th>--}}
                                                {{--<th>Chef Name</th>--}}
                                                {{--<th>Date</th>--}}
                                                {{--<th>Total Amount</th>--}}
                                                {{--<th>Amount to Vendor(90%)</th>--}}
                                                {{--<th>Amount to DietSelect(10%)</th>--}}
                                                {{--<th>Payment Status</th>--}}
                                                {{--<th>Update</th>--}}
                                            {{--</tr>--}}
                                            {{--</thead>--}}
                                            {{--<tbody>--}}
                                            {{--@foreach($commissions->where('chef_id','=',$uniqueComChef)->where('paid','=',1) as $commission)--}}
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
                                                    {{--<td>{{'PHP '.number_format(($commission->amount),2,'.',',')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format(($commission->amount * 0.9),2,'.',',')}}</td>--}}
                                                    {{--<td>{{'PHP '.number_format(($commission->amount * 0.1),2,'.',',')}}</td>--}}
                                                    {{--<td>--}}
                                                        {{--@if($commission->paid==0)--}}
                                                            {{--<span>Pending</span>--}}
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
                        {{--@endforeach--}}
                    {{--</div>--}}
                {{--</div>--}}
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