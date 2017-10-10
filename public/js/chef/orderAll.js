$(document).ready(function () {

    if(from == 0){
        $('#allLinkContain').addClass('activeTab');
        $('#ordAll').show();

        //initialize day select all
        var daySelect= selectDay('0');

        daySelect.done(function (response) {
            console.log(response[0]);
            var valData = response;
            $.each(valData,function( index,value){
                $('select#dateFilter').append(
                    $('<option></option>').attr("value",value).text(value)
                );
            });
            $('select#dateFilter').material_select();
        });

    }else if(from == 1){
        $('#pendLinkContain').addClass('activeTab');
        $('#ordPend').show(1);

        //initialize day select pending
        var daySelect= selectDay('1');

        daySelect.done(function (response) {
            console.log(response[0]);
            var valData = response;
            $.each(valData,function( index,value){
                $('select#datePendFilter').append(
                    $('<option></option>').attr("value",value).text(value)
                );
            });
            $('select#datePendFilter').material_select();
        });

    }else if(from == 2){
        $('#paidLinkContain').addClass('activeTab');
        $('#ordPaid').show(2);

        //initialize day select paid
        var daySelect= selectDay('2');

        daySelect.done(function (response) {
            console.log(response[0]);
            var valData = response;
            $.each(valData,function( index,value){
                $('select#datePaidFilter').append(
                    $('<option></option>').attr("value",value).text(value)
                );
            });
            $('select#datePaidFilter').material_select();
        });

    }else if(from == 3){
        $('#cancelLinkContain').addClass('activeTab');
        $('#ordCancel').show();

        //initialize day select cancel
        var daySelect= selectDay('3');

        daySelect.done(function (response) {
            console.log(response[0]);
            var valData = response;
            $.each(valData,function( index,value){
                $('select#dateCancelFilter').append(
                    $('<option></option>').attr("value",value).text(value)
                );
            });
            $('select#dateCancelFilter').material_select();
        });

    }else if(from==4){
        $('#deliveredLinkContain').addClass('activeTab');
        $('#ordDelivered').show();

        //initialize day select delivered
        var daySelect= selectDay('4');

        daySelect.done(function (response) {
            console.log(response[0]);
            var valData = response;
            $.each(valData,function( index,value){
                $('select#dateDeliverFilter').append(
                    $('<option></option>').attr("value",value).text(value)
                );
            });
            $('select#dateDeliverFilter').material_select();
        });

    }

    $('.allLink').on('click',function () {

        // hide other tabs
        $('#pendLinkContain').removeClass('activeTab');
        $('#paidLinkContain').removeClass('activeTab');
        $('#cancelLinkContain').removeClass('activeTab');
        $('#deliveredLinkContain').removeClass('activeTab');
        $('#ordPend').hide();
        $('#ordPaid').hide();
        $('#ordCancel').hide();
        $('#ordDelivered').hide();

        //initialize day select all again on tab click
        var daySelect= selectDay('0');

        daySelect.done(function (response) {
            console.log(response[0]);
            var valData = response;
            $.each(valData,function( index,value){
                $('select#dateFilter').append(
                    $('<option></option>').attr("value",value).text(value)
                );
            });
            $('select#dateFilter').material_select();
        });


        // show pending tab
        $('#allLinkContain').addClass('activeTab');
        $('#ordAll').show();
    });
    $('.pendLink').on('click',function () {

        // hide other tabs
        $('#allLinkContain').removeClass('activeTab');
        $('#paidLinkContain').removeClass('activeTab');
        $('#cancelLinkContain').removeClass('activeTab');
        $('#deliveredLinkContain').removeClass('activeTab');
        $('#ordAll').hide();
        $('#ordPaid').hide();
        $('#ordCancel').hide();
        $('#ordDelivered').hide();


        //initialize day select pend again on tab click
        var daySelect= selectDay('1');

        daySelect.done(function (response) {
            console.log(response[0]);
            var valData = response;
            $.each(valData,function( index,value){
                $('select#datePendFilter').append(
                    $('<option></option>').attr("value",value).text(value)
                );
            });
            $('select#datePendFilter').material_select();
        });


        // show pending tab
        $('#pendLinkContain').addClass('activeTab');
        $('#ordPend').show();
    });
    $('.paidLink').on('click',function () {

        // hide other tabs
        $('#allLinkContain').removeClass('activeTab');
        $('#pendLinkContain').removeClass('activeTab');
        $('#cancelLinkContain').removeClass('activeTab');
        $('#deliveredLinkContain').removeClass('activeTab');
        $('#ordAll').hide();
        $('#ordPend').hide();
        $('#ordCancel').hide();
        $('#ordDelivered').hide();

        //initialize day select paid again on tab click
        var daySelect= selectDay('2');

        daySelect.done(function (response) {
            console.log(response[0]);
            var valData = response;
            $.each(valData,function( index,value){
                $('select#datePaidFilter').append(
                    $('<option></option>').attr("value",value).text(value)
                );
            });
            $('select#datePaidFilter').material_select();
        });

        // show paid tab
        $('#paidLinkContain').addClass('activeTab');
        $('#ordPaid').show();
    });
    $('.cancelLink').on('click',function () {

        // hide other tabs
        $('#pendLinkContain').removeClass('activeTab');
        $('#paidLinkContain').removeClass('activeTab');
        $('#allLinkContain').removeClass('activeTab');
        $('#deliveredLinkContain').removeClass('activeTab');
        $('#ordPend').hide();
        $('#ordPaid').hide();
        $('#ordAll').hide();
        $('#ordDelivered').hide();

        //initialize day select cancel again on tab click
        var daySelect= selectDay('3');

        daySelect.done(function (response) {
            console.log(response[0]);
            var valData = response;
            $.each(valData,function( index,value){
                $('select#dateCancelFilter').append(
                    $('<option></option>').attr("value",value).text(value)
                );
            });
            $('select#dateCancelFilter').material_select();
        });


        // show pending tab
        $('#cancelLinkContain').addClass('activeTab');
        $('#ordCancel').show();
    });
    $('.deliveredLink').on('click',function () {

        // hide other tabs
        $('#pendLinkContain').removeClass('activeTab');
        $('#paidLinkContain').removeClass('activeTab');
        $('#allLinkContain').removeClass('activeTab');
        $('#cancelLinkContain').removeClass('activeTab');
        $('#ordPend').hide();
        $('#ordPaid').hide();
        $('#ordAll').hide();
        $('#ordCancel').hide();

        var daySelect= selectDay('4');

        daySelect.done(function (response) {
            console.log(response[0]);
            var valData = response;
            $.each(valData,function( index,value){
                $('select#dateDeliverFilter').append(
                    $('<option></option>').attr("value",value).text(value)
                );
            });
            $('select#dateDeliverFilter').material_select();
        });


        // show delivered tab
        $('#deliveredLinkContain').addClass('activeTab');
        $('#ordDelivered').show();
    });





    //unfinished code

    var datePick = $('#dateFilter').pickadate({

        today: '<i class="fa fa-calendar-check-o" aria-hidden="true"></i>',
        clear: 'Clear',
        close: '<i class="fa fa-check-circle" aria-hidden="true"></i>',

        //Formats
        format: 'yyyy-mm-dd',

        //Date limits
        max: Date.now(),

        //Dropdown selectors
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15// Creates a dropdown of 15 years to control year

        //set highlights

    });

    var picker = datePick.pickadate('picker');




    // daySelect.done(function (response) {
    //     var valData = response;
    //     // var dateArray = [];
    //     $.each(valData,function( index,value){
    //         var parts=value.split('-');
    //         var date = [parseInt(parts[0]),parseInt(parts[1]),parseInt(parts[2])];
    //         // dateArray.push(date);
    //         picker.set('highlight',date);
    //         console.log(picker.get('highlight'));
    //         // yearArray.push(parts[0]);
    //         // monthArray.push(parts[1]);
    //         // dayArray.push(parts[2]);
    //
    //         $('select#dateFilter').append(
    //             $('<option></option>').attr("value",value).text(value)
    //         );
    //     });
    // });



    // date filter all change

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

    //order filter all initialize

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

    //order filter all change

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


    //date filter pend change



    //order filter pend initialize



    //order filter pend change


    //date filter paid change



    //order filter paid initialize



    //order filter paid change


    //date filter cancel change



    //order filter cancel initialize



    //order filter cancel change



    //date filter deliver change



    //order filter deliver initialize



    //order filter deliver change



    //button click

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

function selectDay($val) {
    return $.ajax({
        url: '/chef/order/selectDay/' + $val
    });
}