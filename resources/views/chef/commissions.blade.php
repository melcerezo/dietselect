@extends('chef.layout')
@section('page_head')
    <link rel="stylesheet" href="/css/chef/chefCommission.css">
    <script src="/js/chef/chefCommissions.js" defer></script>
@endsection

@section('page_content')
    <div class="container" style="width: 85%;">
        <div class="row" style="margin-top: 5px;">
            <div class="col s12 m2">
                <ul class="collection">
                    <li class="collection-item">
                        <a href="{{route("chef.order.view", ['id'=> 0])}}">Orders</a>
                    </li>
                    <li class="collection-item">
                        <a href="{{route("chef.getCommissions")}}">Commissions</a>
                    </li>
                    <li class="collection-item">
                        <a href="{{route('chef.plan')}}">View Your Plans</a>
                    </li>
                    <li class="collection-item">
                        <a href="{{route('chef.profile')}}">Profile</a>
                    </li>
                    <li class="collection-item">
                        <a href="{{route('chef.message.index')}}">Messages</a>
                        {{--@if($messages->count()>0)--}}
                        {{--<span class="new badge red">{{$messages->count()}}</span>--}}
                        {{--@endif--}}
                    </li>
                    <li class="collection-item">
                        <a href="{{route('chef.ratings')}}">Ratings</a>
                    </li>
                </ul>
            </div>
            <div class="col s12 m10">
                <div class="row">
                </div>
                <div class="row">
                    <div id="chefsContainer">
                            <div id="cardCom" class="card chefCard">
                                <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                                    <div>
                                        <span>
                                            Commissions -
                                            <span>{{$chef->name}}</span>
                                        </span>
                                        {{--<span class="badge light-green white-text" style="border-radius: 15px">--}}
                                        {{--{{$commissions->where('chef_id','=',$uniqueComChef)->count()}}--}}
                                        {{--</span>--}}
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div id="allMonth" class="row comContents">
                                        <div class="row">
                                            <div class="col s12 m3">
                                                <div>
                                                    <span>Type:</span>
                                                </div>
                                                <select id="yearFilter">
                                                </select>
                                            </div>
                                            <div class="col s12 m3">
                                                <div>
                                                    <span>Month:</span>
                                                </div>
                                                <select id="monthFilter">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="divider" style="margin-bottom: 20px;">
                                        </div>
                                        <div class="row">
                                            <div id="monthContainer" class="col s12">
                                                <div class="row">
                                                    <div class="col s12 m3">
                                                        <div>
                                                            <span>Type:</span>
                                                        </div>
                                                        <select id="typeFilter">
                                                            <option value="0" selected>All</option>
                                                            <option value="1">Pending</option>
                                                            <option value="2">Paid</option>
                                                            <option value="3">Cancelled</option>
                                                        </select>
                                                    </div>
                                                    <div id="chefPendTotalAmount" class="col s12 m3 center">
                                                    </div>
                                                    <div id="chefPaidTotalAmount" class="col s12 m3 center">
                                                    </div>
                                                    <div id="dietPaidTotalAmount" class="col s12 m3 center">
                                                    </div>
                                                </div>
                                                <div class="divider">
                                                </div>
                                                <div class="row">
                                                    <div id="monthPicker" class="col s12">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div id="pendMonthPicker" class="col s12">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div id="paidMonthPicker" class="col s12">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div id="cancelMonthPicker" class="col s12">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            $(document).ready(function () {
                                                $('#monthPicker').show();
                                                $('#pendMonthPicker').hide();
                                                $('#paidMonthPicker').hide();
                                                $('#cancelMonthPicker').hide();

                                                var yearAjax = getYears();

                                                yearAjax.done(function (response) {
                                                    var valData = JSON.parse(response);

                                                    for(var i in valData){
                                                        var text = valData[i].yearText;
                                                        if(valData[i].current==1){
                                                            text += '(current)';
                                                            $('select#yearFilter').append(
                                                                    $('<option></option>').attr("value",valData[i].month).text(text).prop('selected','selected')
                                                            );
                                                        }else{
                                                            $('select#yearFilter').append(
                                                                    $('<option></option>').attr("value",valData[i].month).text(text)
                                                            );
                                                        }
                                                    }

                                                    $('select#yearFilter').material_select();

                                                    var selectVal = $('select#yearFilter').val();

                                                    var monthAjax = getMonths(selectVal);

                                                    monthAjax.done(function (response) {

                                                        var valData = JSON.parse(response);
                                                        //                                                        console.log(valData);
                                                        for(var i in valData){
                                                            var text = valData[i].monthText;
                                                            if(valData[i].current==1){
                                                                text += '(current)';
                                                                $('select#monthFilter').append(
                                                                        $('<option></option>').attr("value",valData[i].month).text(text).prop('selected','selected')
                                                                );
                                                            }else{
                                                                $('select#monthFilter').append(
                                                                        $('<option></option>').attr("value",valData[i].month).text(text)
                                                                );
                                                            }
                                                        }

                                                        $('select#monthFilter').material_select();

                                                        var yearVal = $('select#yearFilter').val();

                                                        var selectVal = $('select#monthFilter').val();


                                                        // month change


                                                        var changeMonth = monthChange(yearVal,selectVal);

                                                        changeMonth.done(function (response) {
                                                            $('#monthPicker').empty();
                                                            $('#pendMonthPicker').empty();
                                                            $('#paidMonthPicker').empty();
                                                            $('#cancelMonthPicker').empty();
                                                            $('#chefPendTotalAmount').empty();
                                                            $('#chefPaidTotalAmount').empty();
                                                            $('#dietPaidTotalAmount').empty();
                                                            if(response==''){
                                                                $('#monthPicker').append('<div>No Commissions</div>');
                                                                $('#pendMonthPicker').append('<div>No Commissions</div>');
                                                                $('#paidMonthPicker').append('<div>No Commissions</div>');
                                                                $('#cancelMonthPicker').append('<div>No Commissions</div>');
                                                            }else{
                                                                var valData = JSON.parse(response);
                                                                console.log(valData);

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
                                                                x += '<td>'+chefAllTabPay+'</td>';
                                                                x += '<td>'+chefAllTabChefPay+'</td>';
                                                                x += '<td>'+chefAllTabDietPay+'</td>';
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
                                                                xPend += '<td>'+chefPendTabPay+'</td>';
                                                                xPend += '<td>'+chefPendTabChefPay+'</td>';
                                                                xPend += '<td>'+chefPendTabDietPay+'</td>';
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
                                                                xPaid += '<td>'+chefPaidTabPay+'</td>';
                                                                xPaid += '<td>'+chefPaidTabChefPay+'</td>';
                                                                xPaid += '<td>'+chefPaidTabDietPay+'</td>';
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

                                                                $('#monthPicker').append(x);
                                                                $('#pendMonthPicker').append(xPend);
                                                                $('#paidMonthPicker').append(xPaid);
                                                                $('#cancelMonthPicker').append(xCancel);

                                                                $('#chefPendTotalAmount').append(
                                                                        '<div>Total Pending for Vendor This Month</div>' +
                                                                        '<div>PHP '+addCommas(chefPendTotal.toFixed(2))+'</div>'
                                                                );
                                                                $('#chefPaidTotalAmount').append(
                                                                        '<div>Total Paid for Vendor This Month</div>' +
                                                                        '<div>PHP '+addCommas(chefPaidTotal.toFixed(2))+'</div>'
                                                                );
                                                                $('#dietPaidTotalAmount').append(
                                                                        '<div>Total Paid for DietSelect This Month</div>' +
                                                                        '<div>PHP '+addCommas(dietTotal.toFixed(2))+'</div>'
                                                                );

                                                            }
                                                        });
                                                    });
                                                });



                                                var valType = $('select#typeFilter').val();

                                                if(valType==0){
                                                    $('#monthPicker').show();
                                                    $('#pendMonthPicker').hide();
                                                    $('#paidMonthPicker').hide();
                                                    $('#cancelMonthPicker').hide();
                                                }else if(valType==1){
                                                    $('#monthPicker').hide();
                                                    $('#pendMonthPicker').show();
                                                    $('#paidMonthPicker').hide();
                                                    $('#cancelMonthPicker').hide();
                                                }else if(valType==2){
                                                    $('#monthPicker').hide();
                                                    $('#pendMonthPicker').hide();
                                                    $('#paidMonthPicker').show();
                                                    $('#cancelMonthPicker').hide();
                                                }else if(valType==3){
                                                    $('#monthPicker').hide();
                                                    $('#pendMonthPicker').hide();
                                                    $('#paidMonthPicker').hide();
                                                    $('#cancelMonthPicker').show();
                                                }

                                                $('select#typeFilter').change(function(){
                                                    var valType = $('select#typeFilter').val();

                                                    if(valType==0){
                                                        $('#monthPicker').show();
                                                        $('#pendMonthPicker').hide();
                                                        $('#paidMonthPicker').hide();
                                                        $('#cancelMonthPicker').hide();
                                                    }else if(valType==1){
                                                        $('#monthPicker').hide();
                                                        $('#pendMonthPicker').show();
                                                        $('#paidMonthPicker').hide();
                                                        $('#cancelMonthPicker').hide();
                                                    }else if(valType==2){
                                                        $('#monthPicker').hide();
                                                        $('#pendMonthPicker').hide();
                                                        $('#paidMonthPicker').show();
                                                        $('#cancelMonthPicker').hide();
                                                    }else if(valType==3){
                                                        $('#monthPicker').hide();
                                                        $('#pendMonthPicker').hide();
                                                        $('#paidMonthPicker').hide();
                                                        $('#cancelMonthPicker').show();
                                                    }
                                                });


                                                $('select#yearFilter').change(function(){
                                                    var selectVal = $('select#yearFilter').val();

                                                    var monthAjax = getMonths(selectVal);

                                                    monthAjax.done(function (response) {
                                                        $('select#monthFilter').empty();
                                                        var valData = JSON.parse(response);
                                                        //                                                        console.log(valData);
                                                        for(var i in valData){
                                                            var text = valData[i].monthText;
                                                            if(valData[i].current==1){
                                                                text += '(current)';
                                                                $('select#monthFilter').append(
                                                                        $('<option></option>').attr("value",valData[i].month).text(text).prop('selected','selected')
                                                                );
                                                            }else{
                                                                $('select#monthFilter').append(
                                                                        $('<option></option>').attr("value",valData[i].month).text(text)
                                                                );
                                                            }
                                                        }

                                                        $('select#monthFilter').material_select();

                                                        var yearVal = $('select#yearFilter').val();

                                                        var selectVal = $('select#monthFilter').val();


                                                        // month change


                                                        var changeMonth = monthChange(yearVal,selectVal);

                                                        changeMonth.done(function (response) {
                                                            $('#monthPicker').empty();
                                                            $('#pendMonthPicker').empty();
                                                            $('#paidMonthPicker').empty();
                                                            $('#cancelMonthPicker').empty();
                                                            $('#chefPendTotalAmount').empty();
                                                            $('#chefPaidTotalAmount').empty();
                                                            $('#dietPaidTotalAmount').empty();
                                                            if(response==''){
                                                                $('#monthPicker').append('<div>No Commissions</div>');
                                                                $('#pendMonthPicker').append('<div>No Commissions</div>');
                                                                $('#paidMonthPicker').append('<div>No Commissions</div>');
                                                                $('#cancelMonthPicker').append('<div>No Commissions</div>');
                                                            }else{
                                                                var valData = JSON.parse(response);
                                                                console.log(valData);

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
                                                                x += '<td>'+chefAllTabPay+'</td>';
                                                                x += '<td>'+chefAllTabChefPay+'</td>';
                                                                x += '<td>'+chefAllTabDietPay+'</td>';
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
                                                                xPend += '<td>'+chefPendTabPay+'</td>';
                                                                xPend += '<td>'+chefPendTabChefPay+'</td>';
                                                                xPend += '<td>'+chefPendTabDietPay+'</td>';
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
                                                                xPaid += '<td>'+chefPaidTabPay+'</td>';
                                                                xPaid += '<td>'+chefPaidTabChefPay+'</td>';
                                                                xPaid += '<td>'+chefPaidTabDietPay+'</td>';
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

                                                                $('#monthPicker').append(x);
                                                                $('#pendMonthPicker').append(xPend);
                                                                $('#paidMonthPicker').append(xPaid);
                                                                $('#cancelMonthPicker').append(xCancel);

                                                                $('#chefPendTotalAmount').append(
                                                                        '<div>Total Pending for Vendor This Month</div>' +
                                                                        '<div>PHP '+addCommas(chefPendTotal.toFixed(2))+'</div>'
                                                                );
                                                                $('#chefPaidTotalAmount').append(
                                                                        '<div>Total Paid for Vendor This Month</div>' +
                                                                        '<div>PHP '+addCommas(chefPaidTotal.toFixed(2))+'</div>'
                                                                );
                                                                $('#dietPaidTotalAmount').append(
                                                                        '<div>Total Paid for DietSelect This Month</div>' +
                                                                        '<div>PHP '+addCommas(dietTotal.toFixed(2))+'</div>'
                                                                );

                                                            }
                                                        });
                                                    });
                                                });

                                                $('select#monthFilter').change(function (){
                                                    var yearVal = $('select#yearFilter').val();
                                                    var selectVal = $('select#monthFilter').val();
                                                    console.log(selectVal);
                                                    var changeMonth = monthChange(yearVal,selectVal);
                                                    changeMonth.done(function (response) {
                                                        $('#monthPicker').empty();
                                                        $('#pendMonthPicker').empty();
                                                        $('#paidMonthPicker').empty();
                                                        $('#cancelMonthPicker').empty();
                                                        $('#chefPendTotalAmount').empty();
                                                        $('#chefPaidTotalAmount').empty();
                                                        $('#dietPaidTotalAmount').empty();
                                                        if(response==''){
                                                            $('#monthPicker').append('<div>No Commissions</div>');
                                                            $('#pendMonthPicker').append('<div>No Commissions</div>');
                                                            $('#paidMonthPicker').append('<div>No Commissions</div>');
                                                            $('#cancelMonthPicker').append('<div>No Commissions</div>');
                                                        }else{
                                                            var valData = JSON.parse(response);
                                                            console.log(valData);

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
                                                            x += '<td>'+chefAllTabPay+'</td>';
                                                            x += '<td>'+chefAllTabChefPay+'</td>';
                                                            x += '<td>'+chefAllTabDietPay+'</td>';
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
                                                            xPend += '<td>'+chefPendTabPay+'</td>';
                                                            xPend += '<td>'+chefPendTabChefPay+'</td>';
                                                            xPend += '<td>'+chefPendTabDietPay+'</td>';
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
                                                            xPaid += '<td>'+chefPaidTabPay+'</td>';
                                                            xPaid += '<td>'+chefPaidTabChefPay+'</td>';
                                                            xPaid += '<td>'+chefPaidTabDietPay+'</td>';
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

                                                            $('#monthPicker').append(x);
                                                            $('#pendMonthPicker').append(xPend);
                                                            $('#paidMonthPicker').append(xPaid);
                                                            $('#cancelMonthPicker').append(xCancel);

                                                            $('#chefPendTotalAmount').append(
                                                                    '<div>Total Pending for Vendor This Month</div>' +
                                                                    '<div>PHP '+addCommas(chefPendTotal.toFixed(2))+'</div>'
                                                            );
                                                            $('#chefPaidTotalAmount').append(
                                                                    '<div>Total Paid for Vendor This Month</div>' +
                                                                    '<div>PHP '+addCommas(chefPaidTotal.toFixed(2))+'</div>'
                                                            );
                                                            $('#dietPaidTotalAmount').append(
                                                                    '<div>Total Paid for DietSelect This Month</div>' +
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
                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection