$(document).ready(function () {

    if(from == 0){
        $('#allLinkContain').addClass('activeTab');
        $('#ordAll').show();
    }else if(from == 1){
        $('#pendLinkContain').addClass('activeTab');
        $('#ordPend').show();
    }else if(from == 2){
        $('#paidLinkContain').addClass('activeTab');
        $('#ordPaid').show();
    }else if(from == 3){
        $('#cancelLinkContain').addClass('activeTab');
        $('#ordCancel').show();
    }

    $('.allLink').on('click',function () {

        // hide other tabs
        $('#pendLinkContain').removeClass('activeTab');
        $('#paidLinkContain').removeClass('activeTab');
        $('#cancelLinkContain').removeClass('activeTab');
        $('#ordPend').hide();
        $('#ordPaid').hide();
        $('#ordCancel').hide();

        // show pending tab
        $('#allLinkContain').addClass('activeTab');
        $('#ordAll').show();
    });
    $('.pendLink').on('click',function () {

        // hide other tabs
        $('#allLinkContain').removeClass('activeTab');
        $('#paidLinkContain').removeClass('activeTab');
        $('#cancelLinkContain').removeClass('activeTab');
        $('#ordAll').hide();
        $('#ordPaid').hide();
        $('#ordCancel').hide();

        // show pending tab
        $('#pendLinkContain').addClass('activeTab');
        $('#ordPend').show();
    });
    $('.paidLink').on('click',function () {

        // hide other tabs
        $('#allLinkContain').removeClass('activeTab');
        $('#pendLinkContain').removeClass('activeTab');
        $('#cancelLinkContain').removeClass('activeTab');
        $('#ordAll').hide();
        $('#ordPend').hide();
        $('#ordCancel').hide();

        // show paid tab
        $('#paidLinkContain').addClass('activeTab');
        $('#ordPaid').show();
    });
    $('.cancelLink').on('click',function () {

        // hide other tabs
        $('#pendLinkContain').removeClass('activeTab');
        $('#paidLinkContain').removeClass('activeTab');
        $('#allLinkContain').removeClass('activeTab');
        $('#ordPend').hide();
        $('#ordPaid').hide();
        $('#ordAll').hide();

        // show pending tab
        $('#cancelLinkContain').addClass('activeTab');
        $('#ordCancel').show();
    });

    var daySelect= selectDay();

    daySelect.done(function (response) {
        console.log(response[0]);
        var valData = response;
        // var yearArray=[];
        // var monthArray=[];
        // var dayArray=[];
        $.each(valData,function( index,value){
            // var parts=value.split('-');
            // yearArray.push(parts[0]);
            // monthArray.push(parts[1]);
            // dayArray.push(parts[2]);
            $('select#dateFilter').append(
                $('<option></option>').attr("value",value).text(value)
            );
        });
        // var uniqueYear = [];
        // var uniqueMonth = [];
        // var uniqueDay = [];
        // $.each(yearArray,function (index,value) {
        //     if($.inArray(value, uniqueYear) == -1){
        //         uniqueYear.push(value);
        //     }
        // });
        // $.each(monthArray,function (index,value) {
        //     if($.inArray(value, uniqueMonth) == -1){
        //         uniqueMonth.push(value);
        //     }
        // });
        // $.each(dayArray,function (index,value) {
        //     if($.inArray(value, uniqueDay) == -1){
        //         uniqueDay.push(value);
        //     }
        // });
        // $.each(uniqueYear, function (index,value) {
        //     $('select#dateFilter').append(
        //         $('<option></option>').attr("value",value).text(value)
        //     );
        // });
        $('select#dateFilter').material_select();
    });

    $('select#dateFilter').change(function () {
        var dayVal=$('select#dateFilter option:selected').val();
        var dayChange = dayChoose(dayVal);
        dayChange.done(function (response) {
            console.log(response);
            $('div#dayPick').empty();
            if(response==''){
                $('div#dayPick').append('<span>No Plans Ordered Yet!</span>');
            }else {
                var valData = JSON.parse(response);
                // console.log(JSON.parse(response));
                // console.log(response);
                for (var i in valData) {
                    var x = '<div class="card">';
                    x += '<div class="card-title" style="font-size: 18px;">';
                    x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                    x += ' <div class="col s12 m2">';
                    x += '<div>For Week Of</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].week + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m3" style="font-size: 20px;">';
                    x += '<div> Ordered By:</div>';
                    x += '<div>' + valData[i].foodie + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m2" style="font-size: 20px;">';
                    x += '<div>Payment:</div>';
                    if(valData[i].is_paid==0){
                        x += '<div>Pending</div>';
                    }else if(valData[i].is_paid==1){
                        x += '<div>Paid</div>';
                    }
                    x += '</div>';
                    x += ' <div class="col s12 m2">';
                    x += '<div>Order Date:</div>';
                    x += '<div>' + valData[i].created_at + '</div>';
                    x += '</div>';
                    x += ' <div class="col s12 m2">';
                    x += '<div>Delivery:</div>';
                    if(valData[i].is_delivered==0){
                        x += '<div>Pending</div>';
                    }else if(valData[i].is_delivered==1){
                        x += '<div>Delivered</div>';
                    }
                    x += '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="divider" style="margin: 0 5px;"></div>';
                    x += '<div class="card-content">';
                    x += '<div class="row">';
                    x += '<div class="col s12 m2">';
                    x += '<img src="/img/'+valData[i].picture+'" class="img-responsive" style="max-width:100px;"/>';
                    x += '</div>';
                    x += '<div class="col s12 m4">';
                    x += '<div style="font-size: 20px;">';
                    x += ' <span>Plan: </span><span>' + valData[i].plan_name + '</span>';
                    x += '</div>';
                    x += '<div style="font-size: 20px;">';
                    x += '<span>Type: </span><span>' + valData[i].type + '</span>';
                    x += '</div>';
                    x += '<div style="font-size: 20px;">';
                    x += '<span>Quantity: </span><span>' + valData[i].quantity + '</span>';
                    x += '</div>';
                    x += '<div style="font-size: 20px;">';
                    x += '<span>Amount: </span><span>' + valData[i].price + '</span>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m2 offset-m2">';
                    x += '<a href="#!" data-id="' + valData[i].id + '" class="btnView orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100;">Details</a>';
                    x += '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '</div>';
                    $('div#dayPick').append(x);
                }
            }
        });
    });

    var startVal = $('select#orderFilter option:selected').val();

    var dateChange = dateChoose(startVal);
    dateChange.done(function (response) {
        console.log(response);
        $('div#dayPick').empty();
        if(response==''){
            $('div#dayPick').append('<span>No Plans Ordered Yet!</span>');
        }else {
            var valData = JSON.parse(response);
            // console.log(JSON.parse(response));
            // console.log(response);
            for (var i in valData) {
                var x = '<div class="card">';
                x += '<div class="card-title" style="font-size: 18px;">';
                x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                x += ' <div class="col s12 m2">';
                x += '<div>For Week Of</div>';
                x += '<div style="font-size: 22px;">' + valData[i].week + '</div>';
                x += '</div>';
                x += '<div class="col s12 m3" style="font-size: 20px;">';
                x += '<div> Ordered By:</div>';
                x += '<div>' + valData[i].foodie + '</div>';
                x += '</div>';
                x += '<div class="col s12 m2" style="font-size: 20px;">';
                x += '<div>Payment:</div>';
                if(valData[i].is_paid==0){
                    x += '<div>Pending</div>';
                }else if(valData[i].is_paid==1){
                    x += '<div>Paid</div>';
                }
                x += '</div>';
                x += ' <div class="col s12 m2">';
                x += '<div>Order Date:</div>';
                x += '<div>' + valData[i].created_at + '</div>';
                x += '</div>';
                x += ' <div class="col s12 m2">';
                x += '<div>Delivery:</div>';
                if(valData[i].is_delivered==0){
                    x += '<div>Pending</div>';
                }else if(valData[i].is_delivered==1){
                    x += '<div>Delivered</div>';
                }
                x += '</div>';
                x += '</div>';
                x += '</div>';
                x += '<div class="divider" style="margin: 0 5px;"></div>';
                x += '<div class="card-content">';
                x += '<div class="row">';
                x += '<div class="col s12 m2">';
                x += '<img src="/img/'+valData[i].picture+'" class="img-responsive" style="max-width:100px;"/>';
                x += '</div>';
                x += '<div class="col s12 m4">';
                x += '<div style="font-size: 20px;">';
                x += ' <span>Plan: </span><span>' + valData[i].plan_name + '</span>';
                x += '</div>';
                x += '<div style="font-size: 20px;">';
                x += '<span>Type: </span><span>' + valData[i].type + '</span>';
                x += '</div>';
                x += '<div style="font-size: 20px;">';
                x += '<span>Quantity: </span><span>' + valData[i].quantity + '</span>';
                x += '</div>';
                x += '<div style="font-size: 20px;">';
                x += '<span>Amount: </span><span>' + valData[i].price + '</span>';
                x += '</div>';
                x += '</div>';
                x += '<div class="col s12 m2 offset-m2">';
                x += '<a href="#!" data-id="' + valData[i].id + '" class="btnView orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100;">Details</a>';
                x += '</div>';
                x += '</div>';
                x += '</div>';
                x += '</div>';
                $('div#dayPick').append(x);
            }
        }
    });

    $('#orderFilter').change(function () {
        var val = $('select#orderFilter option:selected').val();

        var dateChange = dateChoose(val);
        dateChange.done(function (response) {
            console.log(response);
            $('div#dayPick').empty();
            if(response==''){
                $('div#dayPick').append('<span>No Plans Ordered Yet!</span>');
            }else {
                var valData = JSON.parse(response);
                // console.log(JSON.parse(response));
                // console.log(response);
                for (var i in valData) {
                    var x = '<div class="card">';
                    x += '<div class="card-title" style="font-size: 18px;">';
                    x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                    x += ' <div class="col s12 m2">';
                    x += '<div>For Week Of</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].week + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m3" style="font-size: 20px;">';
                    x += '<div> Ordered By:</div>';
                    x += '<div>' + valData[i].foodie + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m2" style="font-size: 20px;">';
                    x += '<div>Payment:</div>';
                    if(valData[i].is_paid==0){
                        x += '<div>Pending</div>';
                    }else if(valData[i].is_paid==1){
                        x += '<div>Paid</div>';
                    }
                    x += '</div>';
                    x += ' <div class="col s12 m2">';
                    x += '<div>Order Date:</div>';
                    x += '<div>' + valData[i].created_at + '</div>';
                    x += '</div>';
                    x += ' <div class="col s12 m2">';
                    x += '<div>Delivery:</div>';
                    if(valData[i].is_delivered==0){
                        x += '<div>Pending</div>';
                    }else if(valData[i].is_delivered==1){
                        x += '<div>Delivered</div>';
                    }
                    x += '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="divider" style="margin: 0 5px;"></div>';
                    x += '<div class="card-content">';
                    x += '<div class="row">';
                    x += '<div class="col s12 m2">';
                    x += '<img src="/img/'+valData[i].picture+'" class="img-responsive" style="max-width:100px;"/>';
                    x += '</div>';
                    x += '<div class="col s12 m4">';
                    x += '<div style="font-size: 20px;">';
                    x += ' <span>Plan: </span><span>' + valData[i].plan_name + '</span>';
                    x += '</div>';
                    x += '<div style="font-size: 20px;">';
                    x += '<span>Type: </span><span>' + valData[i].type + '</span>';
                    x += '</div>';
                    x += '<div style="font-size: 20px;">';
                    x += '<span>Quantity: </span><span>' + valData[i].quantity + '</span>';
                    x += '</div>';
                    x += '<div style="font-size: 20px;">';
                    x += '<span>Amount: </span><span>' + valData[i].price + '</span>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m2 offset-m2">';
                    x += '<a href="#!" data-id="' + valData[i].id + '" class="btnView orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100;">Details</a>';
                    x += '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '</div>';
                    $('div#dayPick').append(x);
                }
            }
        });
    });

    $(document).on('click','.btnView', function () {
        var id = $(this).attr('data-id');
        $.ajax({
            url:'/chef/order/viewSingle/'+ id
        }).success(function () {
            window.location.href= this.url;
        });

    });

});

function dateChoose($val){
    return $.ajax({
        url: '/chef/order/dateChange/' + $val

    });
}

function dayChoose($val){
    return $.ajax({
        url: '/chef/order/dayChange/' + $val

    });
}

function selectDay() {
    return $.ajax({
        url: '/chef/order/selectDay'
    });
}