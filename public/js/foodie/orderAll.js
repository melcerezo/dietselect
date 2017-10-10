$(document).ready(function () {

    var m_names = ["January", "February", "March",
        "April", "May", "June", "July", "August", "September",
        "October", "November", "December"];

    if(from == 0){
        $('#allLinkContain').addClass('activeTab');
        $('#ordAll').show();

        // initialize day select all

        var daySelect= selectDay('0');

        daySelect.done(function (response) {
            var valData = response;

            $.each(valData,function( index,value){
                var parts=value.split('-');

                var stringDate = m_names[parseInt(parts[1])-1]+' '+parts[2]+', '+parts[0];

                $('select#dateFilter').append(
                    $('<option></option>').attr("value",value).text(stringDate)
                );
            });

            $('select#dateFilter').material_select();
        });

        // initialize order filter select all

        var startVal = $('select#orderFilter option:selected').val();

        var dateChange = dateChoose(startVal,'0');
        dateChange.done(function (response) {
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
                    x += '<div class="col s12 m3">';
                    x += '<div>Total</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].total + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m4">';
                    x += '<div>Address</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].address + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m3">';
                    x += '<div>Status</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].is_paid + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                    x += '<div class="col s12 m6">';
                    x += '<div>Order Date</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].created_at + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="divider" style="margin: 0 5px;"></div>';
                    x += '<div class="card-content">';
                    for (var j in valData[i].items) {
                        x += '<div class="row">';
                        x += '<div class="col s12 m3">';
                        x += ' <img src="/img/' + valData[i].items[j].planPic + '" class="img-responsive" style="max-width:150px;"/>';
                        x += '</div>';
                        x += '<div class="col s12 m4" style="font-size: 20px;">';
                        x += '<div>Plan: ' + valData[i].items[j].plan + '</div>';
                        x += '<div>Chef: ' + valData[i].items[j].chef + '</div>';
                        x += '<div>Type: ' + valData[i].items[j].type + '</div>';
                        x += '<div>Quantity: ' + valData[i].items[j].quantity + '</div>';
                        x += '<div>Price: ' + valData[i].items[j].price + '</div>';
                        if(valData[i].items[j].delivery==0){
                            x += '<div>Delivery: Pending</div>';
                        }else if(valData[i].items[j].delivery==1){
                            x += '<div>Delivery: Delivered</div>';
                        }
                        x += '</div>';
                        x += '<div class="col s12 offset-m2 m2">';
                        x += '<a href="#!" data-id="' + valData[i].items[j].id + '" class="btnView orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100; width:100%;">Details</a>';
                        x += '</div>';
                        x += '</div>';
                    }
                    x += '</div>';
                    x += '</div>';
                    $('div#dayPick').append(x);
                }
            }
        });

    }else if(from == 1){
        $('#pendLinkContain').addClass('activeTab');
        $('#ordPend').show();

        // initialize day select all

        var daySelect= selectDay('1');

        daySelect.done(function (response) {
            var valData = response;

            $.each(valData,function( index,value){
                var parts=value.split('-');

                var stringDate = m_names[parseInt(parts[1])-1]+' '+parts[2]+', '+parts[0];

                $('select#datePendFilter').append(
                    $('<option></option>').attr("value",value).text(stringDate)
                );
            });

            $('select#datePendFilter').material_select();
        });

        // initialize order filter select all

        var startVal = $('select#orderPendFilter option:selected').val();

        var dateChange = dateChoose(startVal,'1');
        dateChange.done(function (response) {
            $('div#dayPendPick').empty();
            if(response==''){
                $('div#dayPendPick').append('<span>No Plans Ordered Yet!</span>');
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
                    x += '<div class="col s12 m3">';
                    x += '<div>Total</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].total + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m4">';
                    x += '<div>Address</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].address + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m3">';
                    x += '<div>Status</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].is_paid + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                    x += '<div class="col s12 m6">';
                    x += '<div>Order Date</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].created_at + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="divider" style="margin: 0 5px;"></div>';
                    x += '<div class="card-content">';
                    for (var j in valData[i].items) {
                        x += '<div class="row">';
                        x += '<div class="col s12 m3">';
                        x += ' <img src="/img/' + valData[i].items[j].planPic + '" class="img-responsive" style="max-width:150px;"/>';
                        x += '</div>';
                        x += '<div class="col s12 m4" style="font-size: 20px;">';
                        x += '<div>Plan: ' + valData[i].items[j].plan + '</div>';
                        x += '<div>Chef: ' + valData[i].items[j].chef + '</div>';
                        x += '<div>Type: ' + valData[i].items[j].type + '</div>';
                        x += '<div>Quantity: ' + valData[i].items[j].quantity + '</div>';
                        x += '<div>Price: ' + valData[i].items[j].price + '</div>';
                        if(valData[i].items[j].delivery==0){
                            x += '<div>Delivery: Pending</div>';
                        }else if(valData[i].items[j].delivery==1){
                            x += '<div>Delivery: Delivered</div>';
                        }
                        x += '</div>';
                        x += '<div class="col s12 offset-m2 m2">';
                        x += '<a href="#!" data-id="' + valData[i].items[j].id + '" class="btnView orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100; width:100%;">Details</a>';
                        x += '</div>';
                        x += '</div>';
                    }
                    x += '</div>';
                    x += '</div>';
                    $('div#dayPendPick').append(x);
                }
            }
        });

    }else if(from == 2){
        $('#paidLinkContain').addClass('activeTab');
        $('#ordPaid').show();

        // initialize day select all

        var daySelect= selectDay('2');

        daySelect.done(function (response) {
            var valData = response;

            $.each(valData,function( index,value){
                var parts=value.split('-');

                var stringDate = m_names[parseInt(parts[1])-1]+' '+parts[2]+', '+parts[0];

                $('select#datePaidFilter').append(
                    $('<option></option>').attr("value",value).text(stringDate)
                );
            });

            $('select#datePaidFilter').material_select();
        });

        // initialize order filter select all

        var startVal = $('select#orderPaidFilter option:selected').val();

        var dateChange = dateChoose(startVal,'2');
        dateChange.done(function (response) {
            $('div#dayPaidPick').empty();
            if(response==''){
                $('div#dayPaidPick').append('<span>No Plans Ordered Yet!</span>');
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
                    x += '<div class="col s12 m3">';
                    x += '<div>Total</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].total + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m4">';
                    x += '<div>Address</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].address + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m3">';
                    x += '<div>Status</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].is_paid + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                    x += '<div class="col s12 m6">';
                    x += '<div>Order Date</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].created_at + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="divider" style="margin: 0 5px;"></div>';
                    x += '<div class="card-content">';
                    for (var j in valData[i].items) {
                        x += '<div class="row">';
                        x += '<div class="col s12 m3">';
                        x += ' <img src="/img/' + valData[i].items[j].planPic + '" class="img-responsive" style="max-width:150px;"/>';
                        x += '</div>';
                        x += '<div class="col s12 m4" style="font-size: 20px;">';
                        x += '<div>Plan: ' + valData[i].items[j].plan + '</div>';
                        x += '<div>Chef: ' + valData[i].items[j].chef + '</div>';
                        x += '<div>Type: ' + valData[i].items[j].type + '</div>';
                        x += '<div>Quantity: ' + valData[i].items[j].quantity + '</div>';
                        x += '<div>Price: ' + valData[i].items[j].price + '</div>';
                        if(valData[i].items[j].delivery==0){
                            x += '<div>Delivery: Pending</div>';
                        }else if(valData[i].items[j].delivery==1){
                            x += '<div>Delivery: Delivered</div>';
                        }
                        x += '</div>';
                        x += '<div class="col s12 offset-m2 m2">';
                        x += '<a href="#!" data-id="' + valData[i].items[j].id + '" class="btnView orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100; width:100%;">Details</a>';
                        x += '</div>';
                        x += '</div>';
                    }
                    x += '</div>';
                    x += '</div>';
                    $('div#dayPaidPick').append(x);
                }
            }
        });

    }else if(from == 3){
        $('#cancelLinkContain').addClass('activeTab');
        $('#ordCancel').show();

        // initialize day select all

        var daySelect= selectDay('3');

        daySelect.done(function (response) {
            var valData = response;

            $.each(valData,function( index,value){
                var parts=value.split('-');

                var stringDate = m_names[parseInt(parts[1])-1]+' '+parts[2]+', '+parts[0];

                $('select#dateCancelFilter').append(
                    $('<option></option>').attr("value",value).text(stringDate)
                );
            });

            $('select#dateCancelFilter').material_select();
        });

        // initialize order filter select all

        var startVal = $('select#orderCancelFilter option:selected').val();

        var dateChange = dateChoose(startVal,'3');
        dateChange.done(function (response) {
            $('div#dayCancelPick').empty();
            if(response==''){
                $('div#dayCancelPick').append('<span>No Plans Ordered Yet!</span>');
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
                    x += '<div class="col s12 m3">';
                    x += '<div>Total</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].total + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m4">';
                    x += '<div>Address</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].address + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m3">';
                    x += '<div>Status</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].is_paid + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                    x += '<div class="col s12 m6">';
                    x += '<div>Order Date</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].created_at + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="divider" style="margin: 0 5px;"></div>';
                    x += '<div class="card-content">';
                    for (var j in valData[i].items) {
                        x += '<div class="row">';
                        x += '<div class="col s12 m3">';
                        x += ' <img src="/img/' + valData[i].items[j].planPic + '" class="img-responsive" style="max-width:150px;"/>';
                        x += '</div>';
                        x += '<div class="col s12 m4" style="font-size: 20px;">';
                        x += '<div>Plan: ' + valData[i].items[j].plan + '</div>';
                        x += '<div>Chef: ' + valData[i].items[j].chef + '</div>';
                        x += '<div>Type: ' + valData[i].items[j].type + '</div>';
                        x += '<div>Quantity: ' + valData[i].items[j].quantity + '</div>';
                        x += '<div>Price: ' + valData[i].items[j].price + '</div>';
                        if(valData[i].items[j].delivery==0){
                            x += '<div>Delivery: Pending</div>';
                        }else if(valData[i].items[j].delivery==1){
                            x += '<div>Delivery: Delivered</div>';
                        }
                        x += '</div>';
                        x += '<div class="col s12 offset-m2 m2">';
                        x += '<a href="#!" data-id="' + valData[i].items[j].id + '" class="btnView orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100; width:100%;">Details</a>';
                        x += '</div>';
                        x += '</div>';
                    }
                    x += '</div>';
                    x += '</div>';
                    $('div#dayCancelPick').append(x);
                }
            }
        });

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

        // initialize day select all

        var daySelect= selectDay('0');

        daySelect.done(function (response) {
            var valData = response;

            $.each(valData,function( index,value){
                var parts=value.split('-');

                var stringDate = m_names[parseInt(parts[1])-1]+' '+parts[2]+', '+parts[0];

                $('select#dateFilter').append(
                    $('<option></option>').attr("value",value).text(stringDate)
                );
            });

            $('select#dateFilter').material_select();
        });

        // initialize order filter select all

        var startVal = $('select#orderFilter option:selected').val();

        var dateChange = dateChoose(startVal,'0');
        dateChange.done(function (response) {
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
                    x += '<div class="col s12 m3">';
                    x += '<div>Total</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].total + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m4">';
                    x += '<div>Address</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].address + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m3">';
                    x += '<div>Status</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].is_paid + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                    x += '<div class="col s12 m6">';
                    x += '<div>Order Date</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].created_at + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="divider" style="margin: 0 5px;"></div>';
                    x += '<div class="card-content">';
                    for (var j in valData[i].items) {
                        x += '<div class="row">';
                        x += '<div class="col s12 m3">';
                        x += ' <img src="/img/' + valData[i].items[j].planPic + '" class="img-responsive" style="max-width:150px;"/>';
                        x += '</div>';
                        x += '<div class="col s12 m4" style="font-size: 20px;">';
                        x += '<div>Plan: ' + valData[i].items[j].plan + '</div>';
                        x += '<div>Chef: ' + valData[i].items[j].chef + '</div>';
                        x += '<div>Type: ' + valData[i].items[j].type + '</div>';
                        x += '<div>Quantity: ' + valData[i].items[j].quantity + '</div>';
                        x += '<div>Price: ' + valData[i].items[j].price + '</div>';
                        if(valData[i].items[j].delivery==0){
                            x += '<div>Delivery: Pending</div>';
                        }else if(valData[i].items[j].delivery==1){
                            x += '<div>Delivery: Delivered</div>';
                        }
                        x += '</div>';
                        x += '<div class="col s12 offset-m2 m2">';
                        x += '<a href="#!" data-id="' + valData[i].items[j].id + '" class="btnView orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100; width:100%;">Details</a>';
                        x += '</div>';
                        x += '</div>';
                    }
                    x += '</div>';
                    x += '</div>';
                    $('div#dayPick').append(x);
                }
            }
        });

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

        // initialize day select all

        var daySelect= selectDay('1');

        daySelect.done(function (response) {
            var valData = response;

            $.each(valData,function( index,value){
                var parts=value.split('-');

                var stringDate = m_names[parseInt(parts[1])-1]+' '+parts[2]+', '+parts[0];

                $('select#datePendFilter').append(
                    $('<option></option>').attr("value",value).text(stringDate)
                );
            });

            $('select#datePendFilter').material_select();
        });

        // initialize order filter select all

        var startVal = $('select#orderPendFilter option:selected').val();

        var dateChange = dateChoose(startVal,'1');
        dateChange.done(function (response) {
            $('div#dayPendPick').empty();
            if(response==''){
                $('div#dayPendPick').append('<span>No Plans Ordered Yet!</span>');
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
                    x += '<div class="col s12 m3">';
                    x += '<div>Total</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].total + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m4">';
                    x += '<div>Address</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].address + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m3">';
                    x += '<div>Status</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].is_paid + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                    x += '<div class="col s12 m6">';
                    x += '<div>Order Date</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].created_at + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="divider" style="margin: 0 5px;"></div>';
                    x += '<div class="card-content">';
                    for (var j in valData[i].items) {
                        x += '<div class="row">';
                        x += '<div class="col s12 m3">';
                        x += ' <img src="/img/' + valData[i].items[j].planPic + '" class="img-responsive" style="max-width:150px;"/>';
                        x += '</div>';
                        x += '<div class="col s12 m4" style="font-size: 20px;">';
                        x += '<div>Plan: ' + valData[i].items[j].plan + '</div>';
                        x += '<div>Chef: ' + valData[i].items[j].chef + '</div>';
                        x += '<div>Type: ' + valData[i].items[j].type + '</div>';
                        x += '<div>Quantity: ' + valData[i].items[j].quantity + '</div>';
                        x += '<div>Price: ' + valData[i].items[j].price + '</div>';
                        if(valData[i].items[j].delivery==0){
                            x += '<div>Delivery: Pending</div>';
                        }else if(valData[i].items[j].delivery==1){
                            x += '<div>Delivery: Delivered</div>';
                        }
                        x += '</div>';
                        x += '<div class="col s12 offset-m2 m2">';
                        x += '<a href="#!" data-id="' + valData[i].items[j].id + '" class="btnView orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100; width:100%;">Details</a>';
                        x += '</div>';
                        x += '</div>';
                    }
                    x += '</div>';
                    x += '</div>';
                    $('div#dayPendPick').append(x);
                }
            }
        });

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

        // initialize day select all

        var daySelect= selectDay('2');

        daySelect.done(function (response) {
            var valData = response;

            $.each(valData,function( index,value){
                var parts=value.split('-');

                var stringDate = m_names[parseInt(parts[1])-1]+' '+parts[2]+', '+parts[0];

                $('select#datePaidFilter').append(
                    $('<option></option>').attr("value",value).text(stringDate)
                );
            });

            $('select#datePaidFilter').material_select();
        });

        // initialize order filter select all

        var startVal = $('select#orderPaidFilter option:selected').val();

        var dateChange = dateChoose(startVal,'2');
        dateChange.done(function (response) {
            $('div#dayPaidPick').empty();
            if(response==''){
                $('div#dayPaidPick').append('<span>No Plans Ordered Yet!</span>');
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
                    x += '<div class="col s12 m3">';
                    x += '<div>Total</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].total + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m4">';
                    x += '<div>Address</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].address + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m3">';
                    x += '<div>Status</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].is_paid + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                    x += '<div class="col s12 m6">';
                    x += '<div>Order Date</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].created_at + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="divider" style="margin: 0 5px;"></div>';
                    x += '<div class="card-content">';
                    for (var j in valData[i].items) {
                        x += '<div class="row">';
                        x += '<div class="col s12 m3">';
                        x += ' <img src="/img/' + valData[i].items[j].planPic + '" class="img-responsive" style="max-width:150px;"/>';
                        x += '</div>';
                        x += '<div class="col s12 m4" style="font-size: 20px;">';
                        x += '<div>Plan: ' + valData[i].items[j].plan + '</div>';
                        x += '<div>Chef: ' + valData[i].items[j].chef + '</div>';
                        x += '<div>Type: ' + valData[i].items[j].type + '</div>';
                        x += '<div>Quantity: ' + valData[i].items[j].quantity + '</div>';
                        x += '<div>Price: ' + valData[i].items[j].price + '</div>';
                        if(valData[i].items[j].delivery==0){
                            x += '<div>Delivery: Pending</div>';
                        }else if(valData[i].items[j].delivery==1){
                            x += '<div>Delivery: Delivered</div>';
                        }
                        x += '</div>';
                        x += '<div class="col s12 offset-m2 m2">';
                        x += '<a href="#!" data-id="' + valData[i].items[j].id + '" class="btnView orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100; width:100%;">Details</a>';
                        x += '</div>';
                        x += '</div>';
                    }
                    x += '</div>';
                    x += '</div>';
                    $('div#dayPaidPick').append(x);
                }
            }
        });

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

        // initialize day select all

        var daySelect= selectDay('3');

        daySelect.done(function (response) {
            var valData = response;

            $.each(valData,function( index,value){
                var parts=value.split('-');

                var stringDate = m_names[parseInt(parts[1])-1]+' '+parts[2]+', '+parts[0];

                $('select#dateCancelFilter').append(
                    $('<option></option>').attr("value",value).text(stringDate)
                );
            });

            $('select#dateCancelFilter').material_select();
        });

        // initialize order filter select all

        var startVal = $('select#orderCancelFilter option:selected').val();

        var dateChange = dateChoose(startVal,'3');
        dateChange.done(function (response) {
            $('div#dayCancelPick').empty();
            if(response==''){
                $('div#dayCancelPick').append('<span>No Plans Ordered Yet!</span>');
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
                    x += '<div class="col s12 m3">';
                    x += '<div>Total</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].total + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m4">';
                    x += '<div>Address</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].address + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m3">';
                    x += '<div>Status</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].is_paid + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                    x += '<div class="col s12 m6">';
                    x += '<div>Order Date</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].created_at + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="divider" style="margin: 0 5px;"></div>';
                    x += '<div class="card-content">';
                    for (var j in valData[i].items) {
                        x += '<div class="row">';
                        x += '<div class="col s12 m3">';
                        x += ' <img src="/img/' + valData[i].items[j].planPic + '" class="img-responsive" style="max-width:150px;"/>';
                        x += '</div>';
                        x += '<div class="col s12 m4" style="font-size: 20px;">';
                        x += '<div>Plan: ' + valData[i].items[j].plan + '</div>';
                        x += '<div>Chef: ' + valData[i].items[j].chef + '</div>';
                        x += '<div>Type: ' + valData[i].items[j].type + '</div>';
                        x += '<div>Quantity: ' + valData[i].items[j].quantity + '</div>';
                        x += '<div>Price: ' + valData[i].items[j].price + '</div>';
                        if(valData[i].items[j].delivery==0){
                            x += '<div>Delivery: Pending</div>';
                        }else if(valData[i].items[j].delivery==1){
                            x += '<div>Delivery: Delivered</div>';
                        }
                        x += '</div>';
                        x += '<div class="col s12 offset-m2 m2">';
                        x += '<a href="#!" data-id="' + valData[i].items[j].id + '" class="btnView orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100; width:100%;">Details</a>';
                        x += '</div>';
                        x += '</div>';
                    }
                    x += '</div>';
                    x += '</div>';
                    $('div#dayCancelPick').append(x);
                }
            }
        });

    });

    // var daySelect= selectDay();

    // $('#dateFilter').pickadate({
    //
    //     today: '<i class="fa fa-calendar-check-o" aria-hidden="true"></i>',
    //     clear: 'Clear',
    //     close: '<i class="fa fa-check-circle" aria-hidden="true"></i>',
    //
    //     //Formats
    //     format: 'yyyy-mm-dd',
    //
    //     //Date limits
    //     max: Date.now(),
    //
    //     //Dropdown selectors
    //     selectMonths: true, // Creates a dropdown to control month
    //     selectYears: 15,// Creates a dropdown of 15 years to control year
    //
    //     //set highlights
    //     onRender: function () {
    //         daySelect.done(function (response) {
    //             var valData = response;
    //             // var dateArray = [];
    //             $.each(valData,function( index,value){
    //                 var parts=value.split('-');
    //                 var date = [parts[0],parts[1],parts[2]];
    //                 dateArray.push(date);
    //                 console.log(date);
    //                 // yearArray.push(parts[0]);
    //                 // monthArray.push(parts[1]);
    //                 // dayArray.push(parts[2]);
    //
    //                 $('select#dateFilter').append(
    //                     $('<option></option>').attr("value",value).text(value)
    //                 );
    //             });
    //         });
    //     }
    //
    // });




    // $('#dateFilter').pickadate({
    //
    //     today: '<i class="fa fa-calendar-check-o" aria-hidden="true"></i>',
    //     clear: 'Clear',
    //     close: '<i class="fa fa-check-circle" aria-hidden="true"></i>',
    //
    //     //Formats
    //     format: 'yyyy-mm-dd',
    //
    //     //Date limits
    //     max: Date.now(),
    //
    //     //Dropdown selectors
    //     selectMonths: true, // Creates a dropdown to control month
    //     selectYears: 15// Creates a dropdown of 15 years to control year
    //
    // });
    //



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
                    x += '<div class="col s12 m3">';
                    x += '<div>Total</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].total + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m4">';
                    x += '<div>Address</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].address + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m3">';
                    x += '<div>Status</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].is_paid + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                    x += '<div class="col s12 m6">';
                    x += '<div>Order Date</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].created_at + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="divider" style="margin: 0 5px;"></div>';
                    x += '<div class="card-content">';
                    for (var j in valData[i].items) {
                        x += '<div class="row">';
                        x += '<div class="col s12 m3">';
                        x += ' <img src="/img/' + valData[i].items[j].planPic + '" class="img-responsive" style="max-width:150px;"/>';
                        x += '</div>';
                        x += '<div class="col s12 m4" style="font-size: 20px;">';
                        x += '<div>Plan: ' + valData[i].items[j].plan + '</div>';
                        x += '<div>Chef: ' + valData[i].items[j].chef + '</div>';
                        x += '<div>Type: ' + valData[i].items[j].type + '</div>';
                        x += '<div>Quantity: ' + valData[i].items[j].quantity + '</div>';
                        x += '<div>Price: ' + valData[i].items[j].price + '</div>';
                        if(valData[i].items[j].delivery==0){
                            x += '<div>Delivery: Pending</div>';
                        }else if(valData[i].items[j].delivery==1){
                            x += '<div>Delivery: Delivered</div>';
                        }
                        x += '</div>';
                        x += '<div class="col s12 offset-m2 m2">';
                        x += '<a href="#!" data-id="' + valData[i].items[j].id + '" class="btnView orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100; width:100%;">Details</a>';
                        x += '</div>';
                        x += '</div>';
                    }
                    x += '</div>';
                    x += '</div>';
                    $('div#dayPick').append(x);
                }
            }
        });
    });

    $('#orderFilter').change(function () {
        var val = $('select#orderFilter option:selected').val();

        var dateChange = dateChoose(val);
        dateChange.done(function (response) {
            console.log(response);
            $('div#dayPick').empty();
            if(response==''){
                $('div#dayPick').append('<span>No Plans Ordered Yet!</span>');
            }else{

            var valData = JSON.parse(response);
            // console.log(JSON.parse(response));
            // console.log(response);
            for(var i in valData){
                var x = '<div class="card">';
                x += '<div class="card-title" style="font-size: 18px;">';
                x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                x += ' <div class="col s12 m2">';
                x += '<div>For Week Of</div>';
                x += '<div style="font-size: 22px;">'+valData[i].week+'</div>';
                x += '</div>';
                x += '<div class="col s12 m3">';
                x += '<div>Total</div>';
                x += '<div style="font-size: 22px;">'+valData[i].total+'</div>';
                x += '</div>';
                x += '<div class="col s12 m4">';
                x += '<div>Address</div>';
                x += '<div style="font-size: 22px;">'+valData[i].address+'</div>';
                x += '</div>';
                x += '<div class="col s12 m3">';
                x += '<div>Status</div>';
                x += '<div style="font-size: 22px;">'+valData[i].is_paid+'</div>';
                x += '</div>';
                x += '</div>';
                x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                x += '<div class="col s12 m6">';
                x += '<div>Order Date</div>';
                x += '<div style="font-size: 22px;">'+valData[i].created_at+'</div>';
                x += '</div>';
                x += '</div>';
                x += '</div>';
                x += '<div class="divider" style="margin: 0 5px;"></div>';
                x += '<div class="card-content">';
                    for(var j in valData[i].items) {
                        x += '<div class="row">';
                        x += '<div class="col s12 m3">';
                        x += ' <img src="/img/' + valData[i].items[j].planPic + '" class="img-responsive" style="max-width:150px;"/>';
                        x += '</div>';
                        x += '<div class="col s12 m4" style="font-size: 20px;">';
                        x += '<div>Plan: ' + valData[i].items[j].plan + '</div>';
                        x += '<div>Chef: ' + valData[i].items[j].chef + '</div>';
                        x += '<div>Type: ' + valData[i].items[j].type + '</div>';
                        x += '<div>Quantity: ' + valData[i].items[j].quantity + '</div>';
                        x += '<div>Price: ' + valData[i].items[j].price + '</div>';
                        if(valData[i].items[j].delivery==0){
                            x += '<div>Delivery: Pending</div>';
                        }else if(valData[i].items[j].delivery==1){
                            x += '<div>Delivery: Delivered</div>';
                        }
                        x += '</div>';
                        x += '<div class="col s12 offset-m2 m2">';
                        x += '<a href="#!" data-id="'+valData[i].items[j].id+'" class="btnView orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100; width:100%;">Details</a>';
                        x += '</div>';
                        x += '</div>';
                    }
                x+= '</div>';
                x+= '</div>';
                $('div#dayPick').append(x);
                }
            }

            });
        });

    $('select#datePendFilter').change(function () {
        var dayVal=$('select#datePendFilter option:selected').val();
        var dayChange = dayChoose(dayVal);
        dayChange.done(function (response) {
            console.log(response);
            $('div#dayPendPick').empty();
            if(response==''){
                $('div#dayPendPick').append('<span>No Plans Ordered Yet!</span>');
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
                    x += '<div class="col s12 m3">';
                    x += '<div>Total</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].total + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m4">';
                    x += '<div>Address</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].address + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m3">';
                    x += '<div>Status</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].is_paid + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                    x += '<div class="col s12 m6">';
                    x += '<div>Order Date</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].created_at + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="divider" style="margin: 0 5px;"></div>';
                    x += '<div class="card-content">';
                    for (var j in valData[i].items) {
                        x += '<div class="row">';
                        x += '<div class="col s12 m3">';
                        x += ' <img src="/img/' + valData[i].items[j].planPic + '" class="img-responsive" style="max-width:150px;"/>';
                        x += '</div>';
                        x += '<div class="col s12 m4" style="font-size: 20px;">';
                        x += '<div>Plan: ' + valData[i].items[j].plan + '</div>';
                        x += '<div>Chef: ' + valData[i].items[j].chef + '</div>';
                        x += '<div>Type: ' + valData[i].items[j].type + '</div>';
                        x += '<div>Quantity: ' + valData[i].items[j].quantity + '</div>';
                        x += '<div>Price: ' + valData[i].items[j].price + '</div>';
                        if(valData[i].items[j].delivery==0){
                            x += '<div>Delivery: Pending</div>';
                        }else if(valData[i].items[j].delivery==1){
                            x += '<div>Delivery: Delivered</div>';
                        }
                        x += '</div>';
                        x += '<div class="col s12 offset-m2 m2">';
                        x += '<a href="#!" data-id="' + valData[i].items[j].id + '" class="btnView orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100; width:100%;">Details</a>';
                        x += '</div>';
                        x += '</div>';
                    }
                    x += '</div>';
                    x += '</div>';
                    $('div#dayPendPick').append(x);
                }
            }
        });
    });

    $('#orderPendFilter').change(function () {
        var val = $('select#orderPendFilter option:selected').val();

        var dateChange = dateChoose(val);
        dateChange.done(function (response) {
            console.log(response);
            $('div#dayPendPick').empty();
            if(response==''){
                $('div#dayPendPick').append('<span>No Plans Ordered Yet!</span>');
            }else{

                var valData = JSON.parse(response);
                // console.log(JSON.parse(response));
                // console.log(response);
                for(var i in valData){
                    var x = '<div class="card">';
                    x += '<div class="card-title" style="font-size: 18px;">';
                    x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                    x += ' <div class="col s12 m2">';
                    x += '<div>For Week Of</div>';
                    x += '<div style="font-size: 22px;">'+valData[i].week+'</div>';
                    x += '</div>';
                    x += '<div class="col s12 m3">';
                    x += '<div>Total</div>';
                    x += '<div style="font-size: 22px;">'+valData[i].total+'</div>';
                    x += '</div>';
                    x += '<div class="col s12 m4">';
                    x += '<div>Address</div>';
                    x += '<div style="font-size: 22px;">'+valData[i].address+'</div>';
                    x += '</div>';
                    x += '<div class="col s12 m3">';
                    x += '<div>Status</div>';
                    x += '<div style="font-size: 22px;">'+valData[i].is_paid+'</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                    x += '<div class="col s12 m6">';
                    x += '<div>Order Date</div>';
                    x += '<div style="font-size: 22px;">'+valData[i].created_at+'</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="divider" style="margin: 0 5px;"></div>';
                    x += '<div class="card-content">';
                    for(var j in valData[i].items) {
                        x += '<div class="row">';
                        x += '<div class="col s12 m3">';
                        x += ' <img src="/img/' + valData[i].items[j].planPic + '" class="img-responsive" style="max-width:150px;"/>';
                        x += '</div>';
                        x += '<div class="col s12 m4" style="font-size: 20px;">';
                        x += '<div>Plan: ' + valData[i].items[j].plan + '</div>';
                        x += '<div>Chef: ' + valData[i].items[j].chef + '</div>';
                        x += '<div>Type: ' + valData[i].items[j].type + '</div>';
                        x += '<div>Quantity: ' + valData[i].items[j].quantity + '</div>';
                        x += '<div>Price: ' + valData[i].items[j].price + '</div>';
                        if(valData[i].items[j].delivery==0){
                            x += '<div>Delivery: Pending</div>';
                        }else if(valData[i].items[j].delivery==1){
                            x += '<div>Delivery: Delivered</div>';
                        }
                        x += '</div>';
                        x += '<div class="col s12 offset-m2 m2">';
                        x += '<a href="#!" data-id="'+valData[i].items[j].id+'" class="btnView orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100; width:100%;">Details</a>';
                        x += '</div>';
                        x += '</div>';
                    }
                    x+= '</div>';
                    x+= '</div>';
                    $('div#dayPendPick').append(x);
                }
            }
Pend
        });
    });


    $('select#datePaidFilter').change(function () {
        var dayVal=$('select#datePaidFilter option:selected').val();
        var dayChange = dayChoose(dayVal);
        dayChange.done(function (response) {
            console.log(response);
            $('div#dayPaidPick').empty();
            if(response==''){
                $('div#dayPaidPick').append('<span>No Plans Ordered Yet!</span>');
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
                    x += '<div class="col s12 m3">';
                    x += '<div>Total</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].total + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m4">';
                    x += '<div>Address</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].address + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m3">';
                    x += '<div>Status</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].is_paid + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                    x += '<div class="col s12 m6">';
                    x += '<div>Order Date</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].created_at + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="divider" style="margin: 0 5px;"></div>';
                    x += '<div class="card-content">';
                    for (var j in valData[i].items) {
                        x += '<div class="row">';
                        x += '<div class="col s12 m3">';
                        x += ' <img src="/img/' + valData[i].items[j].planPic + '" class="img-responsive" style="max-width:150px;"/>';
                        x += '</div>';
                        x += '<div class="col s12 m4" style="font-size: 20px;">';
                        x += '<div>Plan: ' + valData[i].items[j].plan + '</div>';
                        x += '<div>Chef: ' + valData[i].items[j].chef + '</div>';
                        x += '<div>Type: ' + valData[i].items[j].type + '</div>';
                        x += '<div>Quantity: ' + valData[i].items[j].quantity + '</div>';
                        x += '<div>Price: ' + valData[i].items[j].price + '</div>';
                        if(valData[i].items[j].delivery==0){
                            x += '<div>Delivery: Pending</div>';
                        }else if(valData[i].items[j].delivery==1){
                            x += '<div>Delivery: Delivered</div>';
                        }
                        x += '</div>';
                        x += '<div class="col s12 offset-m2 m2">';
                        x += '<a href="#!" data-id="' + valData[i].items[j].id + '" class="btnView orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100; width:100%;">Details</a>';
                        x += '</div>';
                        x += '</div>';
                    }
                    x += '</div>';
                    x += '</div>';
                    $('div#dayPaidPick').append(x);
                }
            }
        });
    });

    $('#orderPaidFilter').change(function () {
        var val = $('select#orderPaidFilter option:selected').val();

        var dateChange = dateChoose(val);
        dateChange.done(function (response) {
            console.log(response);
            $('div#dayPaidPick').empty();
            if(response==''){
                $('div#dayPaidPick').append('<span>No Plans Ordered Yet!</span>');
            }else{

                var valData = JSON.parse(response);
                // console.log(JSON.parse(response));
                // console.log(response);
                for(var i in valData){
                    var x = '<div class="card">';
                    x += '<div class="card-title" style="font-size: 18px;">';
                    x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                    x += ' <div class="col s12 m2">';
                    x += '<div>For Week Of</div>';
                    x += '<div style="font-size: 22px;">'+valData[i].week+'</div>';
                    x += '</div>';
                    x += '<div class="col s12 m3">';
                    x += '<div>Total</div>';
                    x += '<div style="font-size: 22px;">'+valData[i].total+'</div>';
                    x += '</div>';
                    x += '<div class="col s12 m4">';
                    x += '<div>Address</div>';
                    x += '<div style="font-size: 22px;">'+valData[i].address+'</div>';
                    x += '</div>';
                    x += '<div class="col s12 m3">';
                    x += '<div>Status</div>';
                    x += '<div style="font-size: 22px;">'+valData[i].is_paid+'</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                    x += '<div class="col s12 m6">';
                    x += '<div>Order Date</div>';
                    x += '<div style="font-size: 22px;">'+valData[i].created_at+'</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="divider" style="margin: 0 5px;"></div>';
                    x += '<div class="card-content">';
                    for(var j in valData[i].items) {
                        x += '<div class="row">';
                        x += '<div class="col s12 m3">';
                        x += ' <img src="/img/' + valData[i].items[j].planPic + '" class="img-responsive" style="max-width:150px;"/>';
                        x += '</div>';
                        x += '<div class="col s12 m4" style="font-size: 20px;">';
                        x += '<div>Plan: ' + valData[i].items[j].plan + '</div>';
                        x += '<div>Chef: ' + valData[i].items[j].chef + '</div>';
                        x += '<div>Type: ' + valData[i].items[j].type + '</div>';
                        x += '<div>Quantity: ' + valData[i].items[j].quantity + '</div>';
                        x += '<div>Price: ' + valData[i].items[j].price + '</div>';
                        if(valData[i].items[j].delivery==0){
                            x += '<div>Delivery: Pending</div>';
                        }else if(valData[i].items[j].delivery==1){
                            x += '<div>Delivery: Delivered</div>';
                        }
                        x += '</div>';
                        x += '<div class="col s12 offset-m2 m2">';
                        x += '<a href="#!" data-id="'+valData[i].items[j].id+'" class="btnView orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100; width:100%;">Details</a>';
                        x += '</div>';
                        x += '</div>';
                    }
                    x+= '</div>';
                    x+= '</div>';
                    $('div#dayPaidPick').append(x);
                }
            }

        });
    });


    $('select#dateCancelFilter').change(function () {
        var dayVal=$('select#dateCancelFilter option:selected').val();
        var dayChange = dayChoose(dayVal);
        dayChange.done(function (response) {
            console.log(response);
            $('div#dayCancelPick').empty();
            if(response==''){
                $('div#dayCancelPick').append('<span>No Plans Ordered Yet!</span>');
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
                    x += '<div class="col s12 m3">';
                    x += '<div>Total</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].total + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m4">';
                    x += '<div>Address</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].address + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m3">';
                    x += '<div>Status</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].is_paid + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                    x += '<div class="col s12 m6">';
                    x += '<div>Order Date</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].created_at + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="divider" style="margin: 0 5px;"></div>';
                    x += '<div class="card-content">';
                    for (var j in valData[i].items) {
                        x += '<div class="row">';
                        x += '<div class="col s12 m3">';
                        x += ' <img src="/img/' + valData[i].items[j].planPic + '" class="img-responsive" style="max-width:150px;"/>';
                        x += '</div>';
                        x += '<div class="col s12 m4" style="font-size: 20px;">';
                        x += '<div>Plan: ' + valData[i].items[j].plan + '</div>';
                        x += '<div>Chef: ' + valData[i].items[j].chef + '</div>';
                        x += '<div>Type: ' + valData[i].items[j].type + '</div>';
                        x += '<div>Quantity: ' + valData[i].items[j].quantity + '</div>';
                        x += '<div>Price: ' + valData[i].items[j].price + '</div>';
                        if(valData[i].items[j].delivery==0){
                            x += '<div>Delivery: Pending</div>';
                        }else if(valData[i].items[j].delivery==1){
                            x += '<div>Delivery: Delivered</div>';
                        }
                        x += '</div>';
                        x += '<div class="col s12 offset-m2 m2">';
                        x += '<a href="#!" data-id="' + valData[i].items[j].id + '" class="btnView orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100; width:100%;">Details</a>';
                        x += '</div>';
                        x += '</div>';
                    }
                    x += '</div>';
                    x += '</div>';
                    $('div#dayCancelPick').append(x);
                }
            }
        });
    });

    $('#orderCancelFilter').change(function () {
        var val = $('select#orderCancelFilter option:selected').val();

        var dateChange = dateChoose(val);
        dateChange.done(function (response) {
            console.log(response);
            $('div#dayCancelPick').empty();
            if(response==''){
                $('div#dayCancelPick').append('<span>No Plans Ordered Yet!</span>');
            }else{

                var valData = JSON.parse(response);
                // console.log(JSON.parse(response));
                // console.log(response);
                for(var i in valData){
                    var x = '<div class="card">';
                    x += '<div class="card-title" style="font-size: 18px;">';
                    x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                    x += ' <div class="col s12 m2">';
                    x += '<div>For Week Of</div>';
                    x += '<div style="font-size: 22px;">'+valData[i].week+'</div>';
                    x += '</div>';
                    x += '<div class="col s12 m3">';
                    x += '<div>Total</div>';
                    x += '<div style="font-size: 22px;">'+valData[i].total+'</div>';
                    x += '</div>';
                    x += '<div class="col s12 m4">';
                    x += '<div>Address</div>';
                    x += '<div style="font-size: 22px;">'+valData[i].address+'</div>';
                    x += '</div>';
                    x += '<div class="col s12 m3">';
                    x += '<div>Status</div>';
                    x += '<div style="font-size: 22px;">'+valData[i].is_paid+'</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                    x += '<div class="col s12 m6">';
                    x += '<div>Order Date</div>';
                    x += '<div style="font-size: 22px;">'+valData[i].created_at+'</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="divider" style="margin: 0 5px;"></div>';
                    x += '<div class="card-content">';
                    for(var j in valData[i].items) {
                        x += '<div class="row">';
                        x += '<div class="col s12 m3">';
                        x += ' <img src="/img/' + valData[i].items[j].planPic + '" class="img-responsive" style="max-width:150px;"/>';
                        x += '</div>';
                        x += '<div class="col s12 m4" style="font-size: 20px;">';
                        x += '<div>Plan: ' + valData[i].items[j].plan + '</div>';
                        x += '<div>Chef: ' + valData[i].items[j].chef + '</div>';
                        x += '<div>Type: ' + valData[i].items[j].type + '</div>';
                        x += '<div>Quantity: ' + valData[i].items[j].quantity + '</div>';
                        x += '<div>Price: ' + valData[i].items[j].price + '</div>';
                        if(valData[i].items[j].delivery==0){
                            x += '<div>Delivery: Pending</div>';
                        }else if(valData[i].items[j].delivery==1){
                            x += '<div>Delivery: Delivered</div>';
                        }
                        x += '</div>';
                        x += '<div class="col s12 offset-m2 m2">';
                        x += '<a href="#!" data-id="'+valData[i].items[j].id+'" class="btnView orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100; width:100%;">Details</a>';
                        x += '</div>';
                        x += '</div>';
                    }
                    x+= '</div>';
                    x+= '</div>';
                    $('div#dayCancelPick').append(x);
                }
            }

        });
    });


    
        $(document).on('click','.btnView', function () {
            var id = $(this).attr('data-id');
            $.ajax({
                url:'/foodie/order/viewSingle/'+ id
            }).success(function () {
                window.location.href= this.url;
            });

        });
});

function dateChoose($val,$type){
    return $.ajax({
        url: '/foodie/order/dateChange/' + $val +'/'+ $type

    });
}
function dayChoose($val,$type){
    return $.ajax({
        url: '/foodie/order/dayChange/' + $val +'/'+ $type

    });
}

function selectDay($type) {
    return $.ajax({
       url: '/foodie/order/selectDay/' + $type
    });
}