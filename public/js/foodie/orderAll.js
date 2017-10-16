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
            var dateArray = [];
            dateArray.push(true);
            $.each(valData,function( index,value){
                var parts=value.split('-');
                var date = [parseInt(parts[0]),parseInt(parts[1])-1,parseInt(parts[2])];
                dateArray.push(date);
            });
            console.log(dateArray[dateArray.length-1]);
            $('#dateFilter').pickadate({

                today: '<i class="fa fa-calendar-check-o" aria-hidden="true"></i>',
                clear: 'Clear',
                close: '<i class="fa fa-check-circle" aria-hidden="true"></i>',

                //Formats
                format: 'yyyy-mm-dd',

                //Date limits
                min: dateArray[dateArray.length-1],
                max: Date.now(),

                //Dropdown selectors
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 2,// Creates a dropdown of 15 years to control year

                //disable
                disable: dateArray

            });
        });

        // daySelect.done(function (response) {
        //     var valData = response;
        //
        //     $.each(valData,function( index,value){
        //         var parts=value.split('-');
        //
        //         var stringDate = m_names[parseInt(parts[1])-1]+' '+parts[2]+', '+parts[0];
        //
        //         $('select#dateFilter').append(
        //             $('<option></option>').attr("value",value).text(stringDate)
        //         );
        //     });
        //
        //     $('select#dateFilter').material_select();
        // });

        // initialize order filter select all

        var startVal = $('select#orderFilter option:selected').val();

        var dateChange = dateChoose(startVal,'0');
        dateChange.done(function (response) {
            $('div#dayPick').empty();
            $('div#dayPick').append('<div><span>Orders For This Week</span></div>');
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
                    if(valData[i].is_paid == 'Pending'){
                        x += '<div class="row">';
                        x += '<div class="col s12 m2">';
                        x += '<a href="#!" data-id="' + valData[i].id + '" class="btnPay orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100;">Pay</a>';
                        x += '</div>';
                        x += '<div class="col s12 m2">';
                        x += '<button data-id="' + valData[i].id + '" class="btnCancel btn btn-primary waves-effect waves-light red modal-trigger" style="font-weight: 100;">Cancel</button>';
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
            var dateArray = [];
            dateArray.push(true);
            $.each(valData,function( index,value){
                var parts=value.split('-');
                var date = [parseInt(parts[0]),parseInt(parts[1])-1,parseInt(parts[2])];
                dateArray.push(date);
            });
            console.log(dateArray[dateArray.length-1]);
            $('#datePendFilter').pickadate({

                today: '<i class="fa fa-calendar-check-o" aria-hidden="true"></i>',
                clear: 'Clear',
                close: '<i class="fa fa-check-circle" aria-hidden="true"></i>',

                //Formats
                format: 'yyyy-mm-dd',

                //Date limits
                min: dateArray[dateArray.length-1],
                max: Date.now(),

                //Dropdown selectors
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 2,// Creates a dropdown of 15 years to control year

                //disable
                disable: dateArray

            });
        });

        // daySelect.done(function (response) {
        //     var valData = response;
        //
        //     $.each(valData,function( index,value){
        //         var parts=value.split('-');
        //
        //         var stringDate = m_names[parseInt(parts[1])-1]+' '+parts[2]+', '+parts[0];
        //
        //         $('select#datePendFilter').append(
        //             $('<option></option>').attr("value",value).text(stringDate)
        //         );
        //     });

        //     $('select#datePendFilter').material_select();
        // });

        // initialize order filter select all

        var startVal = $('select#orderPendFilter option:selected').val();

        var dateChange = dateChoose(startVal,'1');
        dateChange.done(function (response) {
            $('div#dayPendPick').empty();
            $('div#dayPendPick').append('<div><span>Pending Orders For This Week</span></div>');
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
                    if(valData[i].is_paid == 'Pending'){
                        x += '<div class="row">';
                        x += '<div class="col s12 m2">';
                        x += '<a href="#!" data-id="' + valData[i].id + '" class="btnPay orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100;">Pay</a>';
                        x += '</div>';
                        x += '<div class="col s12 m2">';
                        x += '<button data-id="' + valData[i].id + '" class="btnCancel btn btn-primary waves-effect waves-light red modal-trigger" style="font-weight: 100;">Cancel</button>';
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
            var dateArray = [];
            dateArray.push(true);
            $.each(valData,function( index,value){
                var parts=value.split('-');
                var date = [parseInt(parts[0]),parseInt(parts[1])-1,parseInt(parts[2])];
                dateArray.push(date);
            });
            console.log(dateArray[dateArray.length-1]);
            $('#datePaidFilter').pickadate({

                today: '<i class="fa fa-calendar-check-o" aria-hidden="true"></i>',
                clear: 'Clear',
                close: '<i class="fa fa-check-circle" aria-hidden="true"></i>',

                //Formats
                format: 'yyyy-mm-dd',

                //Date limits
                min: dateArray[dateArray.length-1],
                max: Date.now(),

                //Dropdown selectors
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 2,// Creates a dropdown of 15 years to control year

                //disable
                disable: dateArray

            });
        });

        // daySelect.done(function (response) {
        //     var valData = response;
        //
        //     $.each(valData,function( index,value){
        //         var parts=value.split('-');
        //
        //         var stringDate = m_names[parseInt(parts[1])-1]+' '+parts[2]+', '+parts[0];
        //
        //         $('select#datePaidFilter').append(
        //             $('<option></option>').attr("value",value).text(stringDate)
        //         );
        //     });
        //
        //     $('select#datePaidFilter').material_select();
        // });

        // initialize order filter select all

        var startVal = $('select#orderPaidFilter option:selected').val();

        var dateChange = dateChoose(startVal,'2');
        dateChange.done(function (response) {
            $('div#dayPaidPick').empty();
            $('div#dayPaidPick').append('<div><span>Paid Orders For This Week</span></div>');
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
            var dateArray = [];
            dateArray.push(true);
            $.each(valData,function( index,value){
                var parts=value.split('-');
                var date = [parseInt(parts[0]),parseInt(parts[1])-1,parseInt(parts[2])];
                dateArray.push(date);
            });
            console.log(dateArray[dateArray.length-1]);
            $('#dateCancelFilter').pickadate({

                today: '<i class="fa fa-calendar-check-o" aria-hidden="true"></i>',
                clear: 'Clear',
                close: '<i class="fa fa-check-circle" aria-hidden="true"></i>',

                //Formats
                format: 'yyyy-mm-dd',

                //Date limits
                min: dateArray[dateArray.length-1],
                max: Date.now(),

                //Dropdown selectors
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 2,// Creates a dropdown of 15 years to control year

                //disable
                disable: dateArray

            });
        });

        // daySelect.done(function (response) {
        //     var valData = response;
        //
        //     $.each(valData,function( index,value){
        //         var parts=value.split('-');
        //
        //         var stringDate = m_names[parseInt(parts[1])-1]+' '+parts[2]+', '+parts[0];
        //
        //         $('select#dateCancelFilter').append(
        //             $('<option></option>').attr("value",value).text(stringDate)
        //         );
        //     });
        //
        //     $('select#dateCancelFilter').material_select();
        // });

        // initialize order filter select all

        var startVal = $('select#orderCancelFilter option:selected').val();

        var dateChange = dateChoose(startVal,'3');
        dateChange.done(function (response) {
            $('div#dayCancelPick').empty();
            $('div#dayCancelPick').append('<div><span>Cancelled Orders For This Week</span></div>');
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

    }else if(from == 4){
        $('#refundLinkContain').addClass('activeTab');
        $('#ordRefund').show();

        var startVal = $('select#orderRefundFilter option:selected').val();

        var refundChange = refundChoose(startVal);
        refundChange.done(function (response) {
            $('div#dayRefundPick').empty();
            $('div#dayRefundPick').append('<div><span>Refunds For This Week</span></div>');
            if(response==''){
                $('div#dayRefundPick').append('<span>No Refunds!</span>');
            }else {
                var valData = JSON.parse(response);
                // console.log(JSON.parse(response));
                // console.log(response);
                for (var i in valData) {
                    var x = '<div class="card">';
                    x += '<div class="card-content" style="font-size: 18px;">';
                    x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                    x += ' <div class="col s12 m2">';
                    x += '<div>Plan Name</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].plan + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m3">';
                    x += '<div>Chef</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].chef + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m4">';
                    x += '<div>Type</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].type + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m3">';
                    x += '<div>Quantity</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].quantity+ '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                    x += '<div class="col s12 m6">';
                    x += '<div>Amount</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].amount + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                    x += '<div class="col s12 m6">';
                    x += '<div>Order Date</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].created_at + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '</div>';
                    $('div#dayRefundPick').append(x);
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
        $('#refundLinkContain').removeClass('activeTab');
        $('#ordRefund').hide();


        // show pending tab
        $('#allLinkContain').addClass('activeTab');
        $('#ordAll').show();

        // initialize day select all

        var daySelect= selectDay('0');

        daySelect.done(function (response) {
            var valData = response;
            var dateArray = [];
            dateArray.push(true);
            $.each(valData,function( index,value){
                var parts=value.split('-');
                var date = [parseInt(parts[0]),parseInt(parts[1])-1,parseInt(parts[2])];
                dateArray.push(date);
            });
            console.log(dateArray[dateArray.length-1]);
            $('#dateFilter').pickadate({

                today: '<i class="fa fa-calendar-check-o" aria-hidden="true"></i>',
                clear: 'Clear',
                close: '<i class="fa fa-check-circle" aria-hidden="true"></i>',

                //Formats
                format: 'yyyy-mm-dd',

                //Date limits
                min: dateArray[dateArray.length-1],
                max: Date.now(),

                //Dropdown selectors
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 2,// Creates a dropdown of 15 years to control year

                //disable
                disable: dateArray

            });
        });


        // daySelect.done(function (response) {
        //     var valData = response;
        //     $('select#dateFilter').empty();
        //     $.each(valData,function( index,value){
        //         var parts=value.split('-');
        //
        //         var stringDate = m_names[parseInt(parts[1])-1]+' '+parts[2]+', '+parts[0];
        //
        //         $('select#dateFilter').append(
        //             $('<option></option>').attr("value",value).text(stringDate)
        //         );
        //     });
        //
        //     $('select#dateFilter').material_select();
        // });

        // initialize order filter select all

        var startVal = $('select#orderFilter option:selected').val();

        var dateChange = dateChoose(startVal,'0');
        dateChange.done(function (response) {
            $('div#dayPick').empty();
            $('div#dayPick').append('<div><span>Orders For '+$('select#orderFilter option:selected').text()+'</span></div>');
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
                    if(valData[i].is_paid == 'Pending'){
                        x += '<div class="row">';
                        x += '<div class="col s12 m2">';
                        x += '<a href="#!" data-id="' + valData[i].id + '" class="btnPay orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100;">Pay</a>';
                        x += '</div>';
                        x += '<div class="col s12 m2">';
                        x += '<button data-id="' + valData[i].id + '" class="btnCancel btn btn-primary waves-effect waves-light red modal-trigger" style="font-weight: 100;">Cancel</button>';
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
        $('#refundLinkContain').removeClass('activeTab');
        $('#ordRefund').hide();

        // show pending tab
        $('#pendLinkContain').addClass('activeTab');
        $('#ordPend').show();

        // initialize day select all

        var daySelect= selectDay('1');


        daySelect.done(function (response) {
            var valData = response;
            var dateArray = [];
            dateArray.push(true);
            $.each(valData,function( index,value){
                var parts=value.split('-');
                var date = [parseInt(parts[0]),parseInt(parts[1])-1,parseInt(parts[2])];
                dateArray.push(date);
            });
            console.log(dateArray[dateArray.length-1]);
            $('#datePendFilter').pickadate({

                today: '<i class="fa fa-calendar-check-o" aria-hidden="true"></i>',
                clear: 'Clear',
                close: '<i class="fa fa-check-circle" aria-hidden="true"></i>',

                //Formats
                format: 'yyyy-mm-dd',

                //Date limits
                min: dateArray[dateArray.length-1],
                max: Date.now(),

                //Dropdown selectors
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 2,// Creates a dropdown of 15 years to control year

                //disable
                disable: dateArray

            });
        });

        // daySelect.done(function (response) {
        //     var valData = response;
        //     $('select#datePendFilter').empty();
        //     $.each(valData,function( index,value){
        //         var parts=value.split('-');
        //
        //         var stringDate = m_names[parseInt(parts[1])-1]+' '+parts[2]+', '+parts[0];
        //
        //         $('select#datePendFilter').append(
        //             $('<option></option>').attr("value",value).text(stringDate)
        //         );
        //     });
        //
        //     $('select#datePendFilter').material_select();
        // });

        // initialize order filter select all

        var startVal = $('select#orderPendFilter option:selected').val();

        var dateChange = dateChoose(startVal,'1');
        dateChange.done(function (response) {
            $('div#dayPendPick').empty();
            $('div#dayPendPick').append('<div><span>Pending Orders For '+$('select#orderPendFilter option:selected').text()+'</span></div>');
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
                    if(valData[i].is_paid == 'Pending'){
                        x += '<div class="row">';
                        x += '<div class="col s12 m2">';
                        x += '<a href="#!" data-id="' + valData[i].id + '" class="btnPay orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100;">Pay</a>';
                        x += '</div>';
                        x += '<div class="col s12 m2">';
                        x += '<button data-id="' + valData[i].id + '" class="btnCancel btn btn-primary waves-effect waves-light red modal-trigger" style="font-weight: 100;">Cancel</button>';
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
        $('#refundLinkContain').removeClass('activeTab');
        $('#ordRefund').hide();
        // show paid tab
        $('#paidLinkContain').addClass('activeTab');
        $('#ordPaid').show();

        // initialize day select all

        var daySelect= selectDay('2');

        daySelect.done(function (response) {
            var valData = response;
            var dateArray = [];
            dateArray.push(true);
            $.each(valData,function( index,value){
                var parts=value.split('-');
                var date = [parseInt(parts[0]),parseInt(parts[1])-1,parseInt(parts[2])];
                dateArray.push(date);
            });
            console.log(dateArray[dateArray.length-1]);
            $('#datePaidFilter').pickadate({

                today: '<i class="fa fa-calendar-check-o" aria-hidden="true"></i>',
                clear: 'Clear',
                close: '<i class="fa fa-check-circle" aria-hidden="true"></i>',

                //Formats
                format: 'yyyy-mm-dd',

                //Date limits
                min: dateArray[dateArray.length-1],
                max: Date.now(),

                //Dropdown selectors
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 2,// Creates a dropdown of 15 years to control year

                //disable
                disable: dateArray

            });
        });

        // daySelect.done(function (response) {
        //     var valData = response;
        //     $('select#datePaidFilter').empty();
        //     $.each(valData,function( index,value){
        //         var parts=value.split('-');
        //
        //         var stringDate = m_names[parseInt(parts[1])-1]+' '+parts[2]+', '+parts[0];
        //
        //         $('select#datePaidFilter').append(
        //             $('<option></option>').attr("value",value).text(stringDate)
        //         );
        //     });
        //
        //     $('select#datePaidFilter').material_select();
        // });

        // initialize order filter select all

        var startVal = $('select#orderPaidFilter option:selected').val();

        var dateChange = dateChoose(startVal,'2');
        dateChange.done(function (response) {
            $('div#dayPaidPick').empty();
            $('div#dayPaidPick').append('<div><span>Paid Orders For '+$('select#orderPaidFilter option:selected').text()+'</span></div>');
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
        $('#refundLinkContain').removeClass('activeTab');
        $('#paidLinkContain').removeClass('activeTab');
        $('#allLinkContain').removeClass('activeTab');
        $('#ordPend').hide();
        $('#ordPaid').hide();
        $('#ordAll').hide();
        $('#ordRefund').hide();

        // show pending tab
        $('#cancelLinkContain').addClass('activeTab');
        $('#ordCancel').show();

        // initialize day select all

        var daySelect= selectDay('3');

        daySelect.done(function (response) {
            var valData = response;
            var dateArray = [];
            dateArray.push(true);
            $.each(valData,function( index,value){
                var parts=value.split('-');
                var date = [parseInt(parts[0]),parseInt(parts[1])-1,parseInt(parts[2])];
                dateArray.push(date);
            });
            console.log(dateArray[dateArray.length-1]);
            $('#dateCancelFilter').pickadate({

                today: '<i class="fa fa-calendar-check-o" aria-hidden="true"></i>',
                clear: 'Clear',
                close: '<i class="fa fa-check-circle" aria-hidden="true"></i>',

                //Formats
                format: 'yyyy-mm-dd',

                //Date limits
                min: dateArray[dateArray.length-1],
                max: Date.now(),

                //Dropdown selectors
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 2,// Creates a dropdown of 15 years to control year

                //disable
                disable: dateArray

            });
        });

        // daySelect.done(function (response) {
        //     var valData = response;
        //     $('select#dateCancelFilter').empty();
        //     $.each(valData,function( index,value){
        //         var parts=value.split('-');
        //
        //         var stringDate = m_names[parseInt(parts[1])-1]+' '+parts[2]+', '+parts[0];
        //
        //         $('select#dateCancelFilter').append(
        //             $('<option></option>').attr("value",value).text(stringDate)
        //         );
        //     });
        //
        //     $('select#dateCancelFilter').material_select();
        // });

        // initialize order filter select all

        var startVal = $('select#orderCancelFilter option:selected').val();

        var dateChange = dateChoose(startVal,'3');
        dateChange.done(function (response) {
            $('div#dayCancelPick').empty();
            $('div#dayCancelPick').append('<div><span>Cancelled Orders For '+$('select#orderCancelFilter option:selected').text()+'</span></div>');
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

    $('.refundLink').on('click',function () {

        $('#pendLinkContain').removeClass('activeTab');
        $('#paidLinkContain').removeClass('activeTab');
        $('#cancelLinkContain').removeClass('activeTab');
        $('#ordPend').hide();
        $('#ordPaid').hide();
        $('#ordCancel').hide();
        $('#allLinkContain').removeClass('activeTab');
        $('#ordAll').hide();


        // show pending tab
        $('#refundLinkContain').addClass('activeTab');
        $('#ordRefund').show();

        var startVal = $('select#orderRefundFilter option:selected').val();

        var refundChange = refundChoose(startVal);
        refundChange.done(function (response) {
            $('div#dayRefundPick').empty();
            $('div#dayRefundPick').append('<div><span>Refunds For This Week</span></div>');
            if(response==''){
                $('div#dayRefundPick').append('<span>No Refunds!</span>');
            }else {
                var valData = JSON.parse(response);
                // console.log(JSON.parse(response));
                // console.log(response);
                for (var i in valData) {
                    var x = '<div class="card">';
                    x += '<div class="card-content" style="font-size: 18px;">';
                    x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                    x += ' <div class="col s12 m2">';
                    x += '<div>Plan Name</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].plan + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m3">';
                    x += '<div>Chef</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].chef + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m4">';
                    x += '<div>Type</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].type + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m3">';
                    x += '<div>Quantity</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].quantity+ '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                    x += '<div class="col s12 m6">';
                    x += '<div>Amount</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].amount + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                    x += '<div class="col s12 m6">';
                    x += '<div>Order Date</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].created_at + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '</div>';
                    $('div#dayRefundPick').append(x);
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



    $('#dateFilter').change(function () {
    // $('select#dateFilter').change(function () {
        var dayVal=$('#dateFilter').val();
        // var dayVal=$('select#dateFilter option:selected').val();
        var dateSplit = dayVal.split('-');
        var stringDate = m_names[parseInt(dateSplit[1])-1]+' '+dateSplit[2]+', '+dateSplit[0];
        var dayChange = dayChoose(dayVal,'0');
        dayChange.done(function (response) {
            console.log(response);
            $('div#dayPick').empty();
            $('div#dayPick').append('<div><span>Orders For '+stringDate+'</span></div>');
            // $('div#dayPick').append('<div><span>Orders For '+$('select#dateFilter option:selected').text()+'</span></div>');
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
                    if(valData[i].is_paid == 'Pending'){
                        x += '<div class="row">';
                        x += '<div class="col s12 m2">';
                        x += '<a href="#!" data-id="' + valData[i].id + '" class="btnPay orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100;">Pay</a>';
                        x += '</div>';
                        x += '<div class="col s12 m2">';
                        x += '<button data-id="' + valData[i].id + '" class="btnCancel btn btn-primary waves-effect waves-light red modal-trigger" style="font-weight: 100;">Cancel</button>';
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

        var dateChange = dateChoose(val,'0');
        dateChange.done(function (response) {
            console.log(response);
            $('div#dayPick').empty();
            $('div#dayPick').append('<div><span>Orders For '+$('select#orderFilter option:selected').text()+'</span></div>');
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
                if(valData[i].is_paid == 'Pending'){
                    x += '<div class="row">';
                    x += '<div class="col s12 m2">';
                    x += '<a href="#!" data-id="' + valData[i].id + '" class="btnPay orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100;">Pay</a>';
                    x += '</div>';
                    x += '<div class="col s12 m2">';
                    x += '<button data-id="' + valData[i].id + '" class="btnCancel btn btn-primary waves-effect waves-light red modal-trigger" style="font-weight: 100;">Cancel</button>';
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

    $('#datePendFilter').change(function () {
        var dayVal=$('#datePendFilter').val();
        var dateSplit = dayVal.split('-');
        var stringDate = m_names[parseInt(dateSplit[1])-1]+' '+dateSplit[2]+', '+dateSplit[0];
        // var dayVal=$('select#datePendFilter option:selected').val();
        var dayChange = dayChoose(dayVal,'1');
        dayChange.done(function (response) {
            console.log(response);
            $('div#dayPendPick').empty();
            $('div#dayPendPick').append('<div><span>Pending Orders For '+stringDate+'</span></div>');
            // $('div#dayPendPick').append('<div><span>Orders For '+$('select#datePendFilter option:selected').text()+'</span></div>');
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
                    if(valData[i].is_paid == 'Pending'){
                        x += '<div class="row">';
                        x += '<div class="col s12 m2">';
                        x += '<a href="#!" data-id="' + valData[i].id + '" class="btnPay orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100;">Pay</a>';
                        x += '</div>';
                        x += '<div class="col s12 m2">';
                        x += '<button data-id="' + valData[i].id + '" class="btnCancel btn btn-primary waves-effect waves-light red modal-trigger" style="font-weight: 100;">Cancel</button>';
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

        var dateChange = dateChoose(val,'1');
        dateChange.done(function (response) {
            console.log(response);
            $('div#dayPendPick').empty();
            $('div#dayPendPick').append('<div><span>Pending Orders For '+$('select#orderPendFilter option:selected').text()+'</span></div>');
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
                    if(valData[i].is_paid == 'Pending'){
                        x += '<div class="row">';
                        x += '<div class="col s12 m2">';
                        x += '<a href="#!" data-id="' + valData[i].id + '" class="btnPay orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100;">Pay</a>';
                        x += '</div>';
                        x += '<div class="col s12 m2">';
                        x += '<button data-id="' + valData[i].id + '" class="btnCancel btn btn-primary waves-effect waves-light red modal-trigger" style="font-weight: 100;">Cancel</button>';
                        x += '</div>';
                        x += '</div>';
                    }
                    x+= '</div>';
                    x+= '</div>';
                    $('div#dayPendPick').append(x);
                }
            }
        });
    });


    $('#datePaidFilter').change(function () {
        var dayVal=$('#datePaidFilter').val();
        // var dayVal=$('select#datePaidFilter option:selected').val();
        var dateSplit = dayVal.split('-');
        var stringDate = m_names[parseInt(dateSplit[1])-1]+' '+dateSplit[2]+', '+dateSplit[0];
        var dayChange = dayChoose(dayVal,'2');
        dayChange.done(function (response) {
            console.log(response);
            $('div#dayPaidPick').empty();
            $('div#dayPaidPick').append('<div><span>Paid Orders For '+stringDate+'</span></div>');
            // $('div#dayPaidPick').append('<div><span>Paid Orders For '+$('select#datePaidFilter option:selected').text()+'</span></div>');
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

        var dateChange = dateChoose(val,'2');
        dateChange.done(function (response) {
            console.log(response);
            $('div#dayPaidPick').empty();
            $('div#dayPaidPick').append('<div><span>Paid Orders For '+$('select#orderPaidFilter option:selected').text()+'</span></div>');
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


    $('#dateCancelFilter').change(function () {
        var dayVal=$('#dateCancelFilter').val();
        // var dayVal=$('select#dateCancelFilter option:selected').val();
        var dateSplit = dayVal.split('-');
        var stringDate = m_names[parseInt(dateSplit[1])-1]+' '+dateSplit[2]+', '+dateSplit[0];
        var dayChange = dayChoose(dayVal,'3');
        dayChange.done(function (response) {
            console.log(response);
            $('div#dayCancelPick').empty();
            $('div#dayCancelPick').append('<div><span>Cancelled Orders For '+stringDate+'</span></div>');
            // $('div#dayCancelPick').append('<div><span>Cancelled Orders For '+$('select#dateCancelFilter option:selected').text()+'</span></div>');
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

        var dateChange = dateChoose(val,'3');
        dateChange.done(function (response) {
            console.log(response);
            $('div#dayCancelPick').empty();
            $('div#dayCancelPick').append('<div><span>Cancelled Orders For '+$('select#orderCancelFilter option:selected').text()+'</span></div>');
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




    $('select#orderRefundFilter').change(function () {
        var val = $('select#orderRefundFilter option:selected').val();
        var refundChange = refundChoose(val);
        refundChange.done(function (response) {
            $('div#dayRefundPick').empty();
            $('div#dayRefundPick').append('<div><span>Refunds For This Week</span></div>');
            if(response==''){
                $('div#dayRefundPick').append('<span>No Refunds!</span>');
            }else {
                var valData = JSON.parse(response);
                // console.log(JSON.parse(response));
                // console.log(response);
                for (var i in valData) {
                    var x = '<div class="card">';
                    x += '<div class="card-content" style="font-size: 18px;">';
                    x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                    x += ' <div class="col s12 m2">';
                    x += '<div>Plan Name</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].plan + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m3">';
                    x += '<div>Chef</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].chef + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m4">';
                    x += '<div>Type</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].type + '</div>';
                    x += '</div>';
                    x += '<div class="col s12 m3">';
                    x += '<div>Quantity</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].quantity+ '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                    x += '<div class="col s12 m6">';
                    x += '<div>Amount</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].amount + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
                    x += '<div class="col s12 m6">';
                    x += '<div>Order Date</div>';
                    x += '<div style="font-size: 22px;">' + valData[i].created_at + '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '</div>';
                    x += '</div>';
                    $('div#dayRefundPick').append(x);
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

    $(document).on('click','.btnPay', function () {
        var id = $(this).attr('data-id');
        $.ajax({
            url:'/foodie/get/order/'+ id
        }).success(function () {
            window.location.href= this.url;
        });

    });

    $(document).on('click','.btnCancel', function () {
        var id = $(this).attr('data-id');
        $.ajax({
            url:'/foodie/order/cancelAll/'+ id
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
function refundChoose($type){
    return $.ajax({
        url: '/foodie/order/refundChange/' + $type

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