$(document).ready(function () {

    var m_names = ["January", "February", "March",
        "April", "May", "June", "July", "August", "September",
        "October", "November", "December"];

    if(from == 0){
        $('#allLinkContain').addClass('activeTab');
        $('#ordAll').show();

        //initialize day select all
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
        //     console.log(response[0]);
        //     var valData = response;
        //     $('select#dateFilter').empty();
        //     $.each(valData,function(index,value){
        //
        //         var dateSplit = value.split('-');
        //         var stringDate = m_names[parseInt(dateSplit[1])-1]+' '+dateSplit[2]+', '+dateSplit[0];
        //         console.log(dateSplit);
        //         $('select#dateFilter').append(
        //             $('<option></option>').attr("value",value).text(stringDate)
        //         );
        //     });
        //     $('select#dateFilter').material_select();
        // });

        //order filter all initialize

        var startVal = $('select#orderFilter option:selected').val();

        var dateChange = dateChoose(startVal,'0');
        dateChange.done(function (response) {
            console.log(response);
            $('div#dayPick').empty();
            $('div#dayTotal').empty();
            $('div#dayPick').append('<div><span>All Orders for This Week</span></div>');
            if(response==''){
                $('div#dayPick').append('<span>No Plans Ordered Yet!</span>');
            }else {
                var valData = JSON.parse(response);
                // console.log(JSON.parse(response));
                // console.log(response);
                var orderIntervalTotal = 0;
                var pendTotal = 0;
                var paidTotal = 0;
                var pendDeliverTotal = 0;
                var deliverTotal = 0;
                for (var i in valData) {
                    orderIntervalTotal += 1;
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
                        pendTotal += valData[i].amount;
                    }else if(valData[i].is_paid==1){
                        x += '<div>Paid</div>';
                        paidTotal += valData[i].amount;
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
                        pendDeliverTotal += 1;
                    }else if(valData[i].is_delivered==1){
                        x += '<div>Delivered</div>';
                        deliverTotal += 1;
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
                $('div#dayTotal').append('<table>' +
                    '<tr>' +
                    '<th>Total Orders</th>' +
                    '<th>Pending Delivery</th>' +
                    '<th>Delivered</th>' +
                    '<th>Total Paid</th>' +
                    '<th>Total Unpaid</th>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>'+orderIntervalTotal+' orders</td>' +
                    '<td>'+pendDeliverTotal+' orders</td>' +
                    '<td>'+deliverTotal+' orders</td>' +
                    '<td>PHP '+addCommas(paidTotal.toFixed(2))+'</td>' +
                    '<td>PHP '+addCommas(pendTotal.toFixed(2))+'</td>' +
                    '</tr>' +
                    '</table>');
            }
        });

    }else if(from == 1){
        $('#pendLinkContain').addClass('activeTab');
        $('#ordPend').show(1);

        //initialize day select pending
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
                // min:,
                max: Date.now(),

                //Dropdown selectors
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 15,// Creates a dropdown of 15 years to control year

                //disable
                disable: dateArray

            });
        });

        // daySelect.done(function (response) {
        //     console.log(response[0]);
        //     var valData = response;
        //     $('select#datePendFilter').empty();
        //     $.each(valData,function( index,value){
        //         var dateSplit = value.split('-');
        //         var stringDate = m_names[parseInt(dateSplit[1])-1]+' '+dateSplit[2]+', '+dateSplit[0];
        //         $('select#datePendFilter').append(
        //
        //             $('<option></option>').attr("value",value).text(stringDate)
        //         );
        //     });
        //     $('select#datePendFilter').material_select();
        // });

        //order filter all initialize

        var startVal = $('select#orderPendFilter option:selected').val();

        var dateChange = dateChoose(startVal,'1');
        dateChange.done(function (response) {
            console.log(response);
            $('div#dayPendPick').empty();
            $('div#dayPendTotal').empty();
            $('div#dayPendPick').append('<div><span>Pending Orders for This Week</span></div>');
            if(response==''){
                $('div#dayPendPick').append('<span>No Pending Plans!</span>');
            }else {
                var valData = JSON.parse(response);
                // console.log(JSON.parse(response));
                // console.log(response);
                var orderIntervalTotal = 0;
                var pendTotal = 0;
                var paidTotal = 0;
                var pendDeliverTotal = 0;
                var deliverTotal = 0;
                for (var i in valData) {
                    orderIntervalTotal += 1;
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
                        pendTotal += valData[i].amount;
                    }else if(valData[i].is_paid==1){
                        x += '<div>Paid</div>';
                        paidTotal += valData[i].amount;
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
                        pendDeliverTotal += 1;
                    }else if(valData[i].is_delivered==1){
                        x += '<div>Delivered</div>';
                        deliverTotal += 1;
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
                    $('div#dayPendPick').append(x);
                }
                $('div#dayPendTotal').append('<table>' +
                    '<tr>' +
                    '<th>Total Orders</th>' +
                    '<th>Pending Delivery</th>' +
                    '<th>Delivered</th>' +
                    '<th>Total Paid</th>' +
                    '<th>Total Unpaid</th>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>'+orderIntervalTotal+' orders</td>' +
                    '<td>'+pendDeliverTotal+' orders</td>' +
                    '<td>'+deliverTotal+' orders</td>' +
                    '<td>PHP '+addCommas(paidTotal.toFixed(2))+'</td>' +
                    '<td>PHP '+addCommas(pendTotal.toFixed(2))+'</td>' +
                    '</tr>' +
                    '</table>');
            }
        });

    }else if(from == 2){
        $('#paidLinkContain').addClass('activeTab');
        $('#ordPaid').show(2);

        //initialize day select paid
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
                // min:,
                max: Date.now(),

                //Dropdown selectors
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 15,// Creates a dropdown of 15 years to control year

                //disable
                disable: dateArray

            });
        });

        // daySelect.done(function (response) {
        //     console.log(response[0]);
        //     var valData = response;
        //     $('select#datePaidFilter').empty();
        //     $.each(valData,function( index,value){
        //         var dateSplit = value.split('-');
        //         var stringDate = m_names[parseInt(dateSplit[1])-1]+' '+dateSplit[2]+', '+dateSplit[0];
        //         $('select#datePaidFilter').append(
        //             $('<option></option>').attr("value",value).text(stringDate)
        //         );
        //     });
        //     $('select#datePaidFilter').material_select();
        // });

        //order filter all initialize

        var startVal = $('select#orderPaidFilter option:selected').val();

        var dateChange = dateChoose(startVal,'2');
        dateChange.done(function (response) {
            console.log(response);
            $('div#dayPaidPick').empty();
            $('div#dayPaidPick').append('<div><span>Paid Orders for This Week</span></div>');

            if(response==''){
                $('div#dayPaidPick').append('<span>No Paid Plans!</span>');
            }else {
                var valData = JSON.parse(response);
                // console.log(JSON.parse(response));
                // console.log(response);
                var orderIntervalTotal = 0;
                var pendTotal = 0;
                var paidTotal = 0;
                var pendDeliverTotal = 0;
                var deliverTotal = 0;
                for (var i in valData) {
                    orderIntervalTotal += 1;
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
                        pendTotal += valData[i].amount;
                    }else if(valData[i].is_paid==1){
                        x += '<div>Paid</div>';
                        paidTotal += valData[i].amount;
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
                        pendDeliverTotal += 1;
                    }else if(valData[i].is_delivered==1){
                        x += '<div>Delivered</div>';
                        deliverTotal += 1;
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
                    $('div#dayPaidPick').append(x);
                }
                $('div#dayPaidTotal').append('<table>' +
                    '<tr>' +
                    '<th>Total Orders</th>' +
                    '<th>Pending Delivery</th>' +
                    '<th>Delivered</th>' +
                    '<th>Total Paid</th>' +
                    '<th>Total Unpaid</th>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>'+orderIntervalTotal+' orders</td>' +
                    '<td>'+pendDeliverTotal+' orders</td>' +
                    '<td>'+deliverTotal+' orders</td>' +
                    '<td>PHP '+addCommas(paidTotal.toFixed(2))+'</td>' +
                    '<td>PHP '+addCommas(pendTotal.toFixed(2))+'</td>' +
                    '</tr>' +
                    '</table>');
            }
        });

    }else if(from == 3){
        $('#cancelLinkContain').addClass('activeTab');
        $('#ordCancel').show();

        //initialize day select cancel
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
                // min:,
                max: Date.now(),

                //Dropdown selectors
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 15,// Creates a dropdown of 15 years to control year

                //disable
                disable: dateArray

            });
        });

        // daySelect.done(function (response) {
        //     console.log(response[0]);
        //     var valData = response;
        //     $('select#dateCancelFilter').empty();
        //     $.each(valData,function( index,value){
        //         var dateSplit = value.split('-');
        //         var stringDate = m_names[parseInt(dateSplit[1])-1]+' '+dateSplit[2]+', '+dateSplit[0];
        //         $('select#dateCancelFilter').append(
        //             $('<option></option>').attr("value",value).text(stringDate)
        //         );
        //     });
        //     $('select#dateCancelFilter').material_select();
        // });

        //order filter all initialize

        var startVal = $('select#orderCancelFilter option:selected').val();

        var dateChange = dateChoose(startVal,'3');
        dateChange.done(function (response) {
            console.log(response);
            $('div#dayCancelPick').empty();
            $('div#dayCancelPick').append('<div><span>Cancelled Orders for This Week</span></div>');

            if(response==''){
                $('div#dayCancelPick').append('<span>No Cancelled Plans!</span>');
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
                    x += '<div>Cancelled</div>';
                    // if(valData[i].is_paid==0){
                    //     x += '<div>Pending</div>';
                    // }else if(valData[i].is_paid==1){
                    //     x += '<div>Paid</div>';
                    // }
                    x += '</div>';
                    x += ' <div class="col s12 m2">';
                    x += '<div>Order Date:</div>';
                    x += '<div>' + valData[i].created_at + '</div>';
                    x += '</div>';
                    x += ' <div class="col s12 m2">';
                    x += '<div>Delivery:</div>';
                    x += '<div>Cancelled</div>';
                    // if(valData[i].is_delivered==0){
                    //     x += '<div>Pending</div>';
                    // }else if(valData[i].is_delivered==1){
                    //     x += '<div>Delivered</div>';
                    // }
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
                    $('div#dayCancelPick').append(x);
                }

            }
        });

    }else if(from==4){
        $('#deliveredLinkContain').addClass('activeTab');
        $('#ordDelivered').show();

        //initialize day select delivered
        var daySelect= selectDay('4');

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
            $('#dateDeliverFilter').pickadate({

                today: '<i class="fa fa-calendar-check-o" aria-hidden="true"></i>',
                clear: 'Clear',
                close: '<i class="fa fa-check-circle" aria-hidden="true"></i>',

                //Formats
                format: 'yyyy-mm-dd',

                //Date limits
                // min:,
                max: Date.now(),

                //Dropdown selectors
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 15,// Creates a dropdown of 15 years to control year

                //disable
                disable: dateArray

            });
        });

        // daySelect.done(function (response) {
        //     console.log(response[0]);
        //     var valData = response;
        //     $('select#dateDeliverFilter').empty();
        //     $.each(valData,function( index,value){
        //         var dateSplit = value.split('-');
        //         var stringDate = m_names[parseInt(dateSplit[1])-1]+' '+dateSplit[2]+', '+dateSplit[0];
        //         $('select#dateDeliverFilter').append(
        //             $('<option></option>').attr("value",value).text(stringDate)
        //         );
        //     });
        //     $('select#dateDeliverFilter').material_select();
        // });

        //order filter all initialize

        var startVal = $('select#orderDeliverFilter option:selected').val();

        var dateChange = dateChoose(startVal,'4');
        dateChange.done(function (response) {
            console.log(response);
            $('div#dayDeliverPick').empty();
            $('div#dayDeliverPick').append('<div><span>Delivered Orders for This Week</span></div>');

            if(response==''){
                $('div#dayDeliverPick').append('<span>No Plans Delivered!</span>');
            }else {
                var valData = JSON.parse(response);
                // console.log(JSON.parse(response));
                // console.log(response);
                var orderIntervalTotal = 0;
                var pendTotal = 0;
                var paidTotal = 0;
                var pendDeliverTotal = 0;
                var deliverTotal = 0;
                for (var i in valData) {
                    orderIntervalTotal += 1;
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
                        pendTotal += valData[i].amount;
                    }else if(valData[i].is_paid==1){
                        x += '<div>Paid</div>';
                        paidTotal += valData[i].amount;
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
                        pendDeliverTotal += 1;
                    }else if(valData[i].is_delivered==1){
                        x += '<div>Delivered</div>';
                        deliverTotal += 1;
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
                    $('div#dayDeliverPick').append(x);
                }
                $('div#dayDeliverTotal').append('<table>' +
                    '<tr>' +
                    '<th>Total Orders</th>' +
                    '<th>Pending Delivery</th>' +
                    '<th>Delivered</th>' +
                    '<th>Total Paid</th>' +
                    '<th>Total Unpaid</th>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>'+orderIntervalTotal+' orders</td>' +
                    '<td>'+pendDeliverTotal+' orders</td>' +
                    '<td>'+deliverTotal+' orders</td>' +
                    '<td>PHP '+addCommas(paidTotal.toFixed(2))+'</td>' +
                    '<td>PHP '+addCommas(pendTotal.toFixed(2))+'</td>' +
                    '</tr>' +
                    '</table>');
            }
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
        //     console.log(response[0]);
        //     var valData = response;
        //     $('select#dateFilter').empty();
        //     $.each(valData,function( index,value){
        //         var dateSplit = value.split('-');
        //         var stringDate = m_names[parseInt(dateSplit[1])-1]+' '+dateSplit[2]+', '+dateSplit[0];
        //         $('select#dateFilter').append(
        //             $('<option></option>').attr("value",value).text(stringDate)
        //         );
        //     });
        //     $('select#dateFilter').material_select();
        // });

        //initialize order all select again tab click

        var startVal = $('select#orderFilter option:selected').val();

        var dateChange = dateChoose(startVal,'0');
        dateChange.done(function (response) {
            console.log(response);
            $('div#dayPick').empty();
            $('div#dayTotal').empty();
            $('div#dayPick').append('<div><span>All Orders for '+$('select#orderFilter option:selected').text()+'</span></div>');
            if(response==''){
                $('div#dayPick').append('<span>No Plans Ordered Yet!</span>');
            }else {
                var valData = JSON.parse(response);
                // console.log(JSON.parse(response));
                // console.log(response);
                var orderIntervalTotal = 0;
                var pendTotal = 0;
                var paidTotal = 0;
                var pendDeliverTotal = 0;
                var deliverTotal = 0;
                for (var i in valData) {
                    orderIntervalTotal += 1;
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
                        pendTotal += valData[i].amount;
                    }else if(valData[i].is_paid==1){
                        x += '<div>Paid</div>';
                        paidTotal += valData[i].amount;
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
                        pendDeliverTotal += 1;
                    }else if(valData[i].is_delivered==1){
                        x += '<div>Delivered</div>';
                        deliverTotal += 1;
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
                $('div#dayTotal').append('<table>' +
                    '<tr>' +
                    '<th>Total Orders</th>' +
                    '<th>Pending Delivery</th>' +
                    '<th>Delivered</th>' +
                    '<th>Total Paid</th>' +
                    '<th>Total Unpaid</th>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>'+orderIntervalTotal+' orders</td>' +
                    '<td>'+pendDeliverTotal+' orders</td>' +
                    '<td>'+deliverTotal+' orders</td>' +
                    '<td>PHP '+addCommas(paidTotal.toFixed(2))+'</td>' +
                    '<td>PHP '+addCommas(pendTotal.toFixed(2))+'</td>' +
                    '</tr>' +
                    '</table>');
            }
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
        //     console.log(response[0]);
        //     var valData = response;
        //     $('select#datePendFilter').empty();
        //     $.each(valData,function( index,value){
        //         var dateSplit = value.split('-');
        //         var stringDate = m_names[parseInt(dateSplit[1])-1]+' '+dateSplit[2]+', '+dateSplit[0];
        //         $('select#datePendFilter').append(
        //             $('<option></option>').attr("value",value).text(stringDate)
        //         );
        //     });
        //     $('select#datePendFilter').material_select();
        // });

        var startVal = $('select#orderPendFilter option:selected').val();

        var dateChange = dateChoose(startVal,'1');
        dateChange.done(function (response) {
            console.log(response);
            $('div#dayPendPick').empty();
            $('div#dayPendTotal').empty();
            $('div#dayPendPick').append('<div><span>Pending Orders for ' +$('select#orderPendFilter option:selected').text()+'</span></div>');
            if(response==''){
                $('div#dayPendPick').append('<span>No Pending Plans!</span>');
            }else {
                var valData = JSON.parse(response);
                // console.log(JSON.parse(response));
                // console.log(response);
                var orderIntervalTotal = 0;
                var pendTotal = 0;
                var paidTotal = 0;
                var pendDeliverTotal = 0;
                var deliverTotal = 0;
                for (var i in valData) {
                    orderIntervalTotal += 1;
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
                        pendTotal += valData[i].amount;
                    }else if(valData[i].is_paid==1){
                        x += '<div>Paid</div>';
                        paidTotal += valData[i].amount;
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
                        pendDeliverTotal += 1;
                    }else if(valData[i].is_delivered==1){
                        x += '<div>Delivered</div>';
                        deliverTotal += 1;
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
                    $('div#dayPendPick').append(x);
                }
                $('div#dayPendTotal').append('<table>' +
                    '<tr>' +
                    '<th>Total Orders</th>' +
                    '<th>Pending Delivery</th>' +
                    '<th>Delivered</th>' +
                    '<th>Total Paid</th>' +
                    '<th>Total Unpaid</th>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>'+orderIntervalTotal+' orders</td>' +
                    '<td>'+pendDeliverTotal+' orders</td>' +
                    '<td>'+deliverTotal+' orders</td>' +
                    '<td>PHP '+addCommas(paidTotal.toFixed(2))+'</td>' +
                    '<td>PHP '+addCommas(pendTotal.toFixed(2))+'</td>' +
                    '</tr>' +
                    '</table>');
            }
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
        //     console.log(response[0]);
        //     var valData = response;
        //     $('select#datePaidFilter').empty();
        //     $.each(valData,function( index,value){
        //         var dateSplit = value.split('-');
        //         var stringDate = m_names[parseInt(dateSplit[1])-1]+' '+dateSplit[2]+', '+dateSplit[0];
        //         $('select#datePaidFilter').append(
        //             $('<option></option>').attr("value",value).text(stringDate)
        //         );
        //     });
        //     $('select#datePaidFilter').material_select();
        // });

        var startVal = $('select#orderPaidFilter option:selected').val();

        var dateChange = dateChoose(startVal,'2');
        dateChange.done(function (response) {
            console.log(response);
            $('div#dayPaidPick').empty();
            $('div#dayPaidTotal').empty();
            $('div#dayPaidPick').append('<div><span>Paid Orders for ' +$('select#orderPaidFilter option:selected').text()+'</span></div>');
            if(response==''){
                $('div#dayPaidPick').append('<span>No Paid Plans!</span>');
            }else {
                var valData = JSON.parse(response);
                // console.log(JSON.parse(response));
                // console.log(response);
                var orderIntervalTotal = 0;
                var pendTotal = 0;
                var paidTotal = 0;
                var pendDeliverTotal = 0;
                var deliverTotal = 0;
                for (var i in valData) {
                    orderIntervalTotal += 1;
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
                        pendTotal += valData[i].amount;
                    }else if(valData[i].is_paid==1){
                        x += '<div>Paid</div>';
                        paidTotal += valData[i].amount;
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
                        pendDeliverTotal += 1;
                    }else if(valData[i].is_delivered==1){
                        x += '<div>Delivered</div>';
                        deliverTotal += 1;
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
                    $('div#dayPaidPick').append(x);
                }
                $('div#dayPaidTotal').append('<table>' +
                    '<tr>' +
                    '<th>Total Orders</th>' +
                    '<th>Pending Delivery</th>' +
                    '<th>Delivered</th>' +
                    '<th>Total Paid</th>' +
                    '<th>Total Unpaid</th>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>'+orderIntervalTotal+' orders</td>' +
                    '<td>'+pendDeliverTotal+' orders</td>' +
                    '<td>'+deliverTotal+' orders</td>' +
                    '<td>PHP '+addCommas(paidTotal.toFixed(2))+'</td>' +
                    '<td>PHP '+addCommas(pendTotal.toFixed(2))+'</td>' +
                    '</tr>' +
                    '</table>');
            }
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
        //     console.log(response[0]);
        //     var valData = response;
        //     $('select#dateCancelFilter').empty();
        //     $.each(valData,function( index,value){
        //         var dateSplit = value.split('-');
        //         var stringDate = m_names[parseInt(dateSplit[1])-1]+' '+dateSplit[2]+', '+dateSplit[0];
        //         $('select#dateCancelFilter').append(
        //             $('<option></option>').attr("value",value).text(stringDate)
        //         );
        //     });
        //     $('select#dateCancelFilter').material_select();
        // });

        var startVal = $('select#orderCancelFilter option:selected').val();

        var dateChange = dateChoose(startVal,'3');
        dateChange.done(function (response) {
            console.log(response);
            $('div#dayCancelPick').empty();
            $('div#dayCancelPick').append('<div><span>Cancelled Orders for ' +$('select#orderCancelFilter option:selected').text()+'</span></div>');
            if(response==''){
                $('div#dayCancelPick').append('<span>No Cancelled Plans!</span>');
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
                    x += '<div>Cancelled</div>';
                    // if(valData[i].is_paid==0){
                    //     x += '<div>Pending</div>';
                    // }else if(valData[i].is_paid==1){
                    //     x += '<div>Paid</div>';
                    // }
                    x += '</div>';
                    x += ' <div class="col s12 m2">';
                    x += '<div>Order Date:</div>';
                    x += '<div>' + valData[i].created_at + '</div>';
                    x += '</div>';
                    x += ' <div class="col s12 m2">';
                    x += '<div>Delivery:</div>';
                    x += '<div>Cancelled</div>';
                    // if(valData[i].is_delivered==0){
                    //     x += '<div>Pending</div>';
                    // }else if(valData[i].is_delivered==1){
                    //     x += '<div>Delivered</div>';
                    // }
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
                    $('div#dayCancelPick').append(x);
                }
            }
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
            var valData = response;
            var dateArray = [];
            dateArray.push(true);
            $.each(valData,function( index,value){
                var parts=value.split('-');
                var date = [parseInt(parts[0]),parseInt(parts[1])-1,parseInt(parts[2])];
                dateArray.push(date);
            });
            console.log(dateArray[dateArray.length-1]);
            $('#dateDeliverFilter').pickadate({

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
        //     console.log(response[0]);
        //     var valData = response;
        //     $('select#dateDeliverFilter').empty();
        //     $.each(valData,function( index,value){
        //         var dateSplit = value.split('-');
        //         var stringDate = m_names[parseInt(dateSplit[1])-1]+' '+dateSplit[2]+', '+dateSplit[0];
        //         $('select#dateDeliverFilter').append(
        //             $('<option></option>').attr("value",value).text(stringDate)
        //         );
        //     });
        //     $('select#dateDeliverFilter').material_select();
        // });

        var startVal = $('select#orderDeliverFilter option:selected').val();

        var dateChange = dateChoose(startVal,'4');
        dateChange.done(function (response) {
            console.log(response);
            $('div#dayDeliverPick').empty();
            $('div#dayDeliverTotal').empty();
            $('div#dayDeliverPick').append('<div><span>Delivered Orders for ' +$('select#orderDeliverFilter option:selected').text()+'</span></div>');
            if(response==''){
                $('div#dayDeliverPick').append('<span>No Delivered Plans!</span>');
            }else {
                var valData = JSON.parse(response);
                // console.log(JSON.parse(response));
                // console.log(response);
                var orderIntervalTotal = 0;
                var pendTotal = 0;
                var paidTotal = 0;
                var pendDeliverTotal = 0;
                var deliverTotal = 0;
                for (var i in valData) {
                    orderIntervalTotal += 1;
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
                        pendTotal += valData[i].amount;
                    }else if(valData[i].is_paid==1){
                        x += '<div>Paid</div>';
                        paidTotal += valData[i].amount;
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
                        pendDeliverTotal += 1;
                    }else if(valData[i].is_delivered==1){
                        x += '<div>Delivered</div>';
                        deliverTotal += 1;
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
                    $('div#dayDeliverPick').append(x);
                }
                $('div#dayDeliverTotal').append('<table>' +
                    '<tr>' +
                    '<th>Total Orders</th>' +
                    '<th>Pending Delivery</th>' +
                    '<th>Delivered</th>' +
                    '<th>Total Paid</th>' +
                    '<th>Total Unpaid</th>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>'+orderIntervalTotal+' orders</td>' +
                    '<td>'+pendDeliverTotal+' orders</td>' +
                    '<td>'+deliverTotal+' orders</td>' +
                    '<td>PHP '+addCommas(paidTotal.toFixed(2))+'</td>' +
                    '<td>PHP '+addCommas(pendTotal.toFixed(2))+'</td>' +
                    '</tr>' +
                    '</table>');
            }
        });

        // show delivered tab
        $('#deliveredLinkContain').addClass('activeTab');
        $('#ordDelivered').show();
    });





    //unfinished code










    // date filter all change

    $('#dateFilter').change(function () {
    // $('select#dateFilter').change(function () {
        var dayVal=$('#dateFilter').val();
        var dateSplit = dayVal.split('-');
        var stringDate = m_names[parseInt(dateSplit[1])-1]+' '+dateSplit[2]+', '+dateSplit[0];
        // var dayVal=$('select#dateFilter option:selected').val();
        var dayChange = dayChoose(dayVal,'0');
        dayChange.done(function (response) {
            console.log(response);
            $('div#dayPick').empty();
            $('div#dayTotal').empty();
            $('div#dayPick').append('<div><span>All Orders for '+stringDate+'</span></div>');
            // $('div#dayPick').append('<div><span>All Orders for '+$('select#dateFilter option:selected').text()+'</span></div>');
            if(response==''){
                $('div#dayPick').append('<span>No Plans Ordered Yet!</span>');
            }else {
                var valData = JSON.parse(response);
                // console.log(JSON.parse(response));
                // console.log(response);
                var orderIntervalTotal = 0;
                var pendTotal = 0;
                var paidTotal = 0;
                var pendDeliverTotal = 0;
                var deliverTotal = 0;
                for (var i in valData) {
                    orderIntervalTotal += 1;
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
                        pendTotal += valData[i].amount;
                    }else if(valData[i].is_paid==1){
                        x += '<div>Paid</div>';
                        paidTotal += valData[i].amount;
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
                        pendDeliverTotal += 1;
                    }else if(valData[i].is_delivered==1){
                        x += '<div>Delivered</div>';
                        deliverTotal += 1;
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
                $('div#dayTotal').append('<table>' +
                    '<tr>' +
                    '<th>Total Orders</th>' +
                    '<th>Pending Delivery</th>' +
                    '<th>Delivered</th>' +
                    '<th>Total Paid</th>' +
                    '<th>Total Unpaid</th>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>'+orderIntervalTotal+' orders</td>' +
                    '<td>'+pendDeliverTotal+' orders</td>' +
                    '<td>'+deliverTotal+' orders</td>' +
                    '<td>PHP '+addCommas(paidTotal.toFixed(2))+'</td>' +
                    '<td>PHP '+addCommas(pendTotal.toFixed(2))+'</td>' +
                    '</tr>' +
                    '</table>');
            }
        });
    });


    //order filter all change

    $('#orderFilter').change(function () {
        var val = $('select#orderFilter option:selected').val();

        var dateChange = dateChoose(val,'0');
        dateChange.done(function (response) {
            console.log(response);
            $('div#dayPick').empty();
            $('div#dayTotal').empty();
            $('div#dayPick').append('<div><span>All Orders for '+$('select#orderFilter option:selected').text()+'</span></div>');
            if(response==''){
                $('div#dayPick').append('<span>No Plans Ordered Yet!</span>');
            }else {
                var valData = JSON.parse(response);
                // console.log(JSON.parse(response));
                // console.log(response);
                var orderIntervalTotal = 0;
                var pendTotal = 0;
                var paidTotal = 0;
                var pendDeliverTotal = 0;
                var deliverTotal = 0;
                for (var i in valData) {
                    orderIntervalTotal += 1;
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
                        pendTotal += valData[i].amount;
                    }else if(valData[i].is_paid==1){
                        x += '<div>Paid</div>';
                        paidTotal += valData[i].amount;
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
                        pendDeliverTotal += 1;
                    }else if(valData[i].is_delivered==1){
                        x += '<div>Delivered</div>';
                        deliverTotal += 1;
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
                $('div#dayTotal').append('<table>' +
                    '<tr>' +
                    '<th>Total Orders</th>' +
                    '<th>Pending Delivery</th>' +
                    '<th>Delivered</th>' +
                    '<th>Total Paid</th>' +
                    '<th>Total Unpaid</th>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>'+orderIntervalTotal+' orders</td>' +
                    '<td>'+pendDeliverTotal+' orders</td>' +
                    '<td>'+deliverTotal+' orders</td>' +
                    '<td>PHP '+addCommas(paidTotal.toFixed(2))+'</td>' +
                    '<td>PHP '+addCommas(pendTotal.toFixed(2))+'</td>' +
                    '</tr>' +
                    '</table>');
            }
        });
    });


    //date filter pend change

    $('#datePendFilter').change(function () {
    // $('select#datePendFilter').change(function () {
        var dayVal=$('#datePendFilter').val();
        // var dayVal=$('select#datePendFilter option:selected').val();
        var dateSplit = dayVal.split('-');
        var stringDate = m_names[parseInt(dateSplit[1])-1]+' '+dateSplit[2]+', '+dateSplit[0];
        var dayChange = dayChoose(dayVal,'1');
        $('#ordPendAll').hide();
        dayChange.done(function (response) {
            console.log(response);
            $('div#dayPendPick').empty();
            $('div#dayPendTotal').empty();
            $('div#dayPendPick').append('<div><span>Pending Orders for '+stringDate+'</span></div>');
            // $('div#dayPendPick').append('<div><span>Pending Orders for '+$('select#datePendFilter option:selected').text()+'</span></div>');
            if(response==''){
                $('div#dayPendPick').append('<span>No Pending Plans!</span>');
            }else {
                var valData = JSON.parse(response);
                // console.log(JSON.parse(response));
                // console.log(response);
                var orderIntervalTotal = 0;
                var pendTotal = 0;
                var paidTotal = 0;
                var pendDeliverTotal = 0;
                var deliverTotal = 0;
                for (var i in valData) {
                    orderIntervalTotal += 1;
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
                        pendTotal += valData[i].amount;
                    }else if(valData[i].is_paid==1){
                        x += '<div>Paid</div>';
                        paidTotal += valData[i].amount;
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
                        pendDeliverTotal += 1;
                    }else if(valData[i].is_delivered==1){
                        x += '<div>Delivered</div>';
                        deliverTotal += 1;
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
                    $('div#dayPendPick').append(x);
                }
                $('div#dayPendTotal').append('<table>' +
                    '<tr>' +
                    '<th>Total Orders</th>' +
                    '<th>Pending Delivery</th>' +
                    '<th>Delivered</th>' +
                    '<th>Total Paid</th>' +
                    '<th>Total Unpaid</th>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>'+orderIntervalTotal+' orders</td>' +
                    '<td>'+pendDeliverTotal+' orders</td>' +
                    '<td>'+deliverTotal+' orders</td>' +
                    '<td>PHP '+addCommas(paidTotal.toFixed(2))+'</td>' +
                    '<td>PHP '+addCommas(pendTotal.toFixed(2))+'</td>' +
                    '</tr>' +
                    '</table>');
            }
        });
    });

    //order filter pend change

    $('#orderPendFilter').change(function () {
        var val = $('select#orderPendFilter option:selected').val();

        var dateChange = dateChoose(val,'1');
        dateChange.done(function (response) {
            console.log(response);
            $('div#dayPendPick').empty();
            $('div#dayPendTotal').empty();
            $('div#dayPendPick').append('<div><span>Pending Orders for '+$('select#orderPendFilter option:selected').text()+'</span></div>');
            if(response==''){
                $('div#dayPendPick').append('<span>No Pending Plans!</span>');
            }else {
                var valData = JSON.parse(response);
                // console.log(JSON.parse(response));
                // console.log(response);
                var orderIntervalTotal = 0;
                var pendTotal = 0;
                var paidTotal = 0;
                var pendDeliverTotal = 0;
                var deliverTotal = 0;
                for (var i in valData) {
                    orderIntervalTotal += 1;
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
                        pendTotal += valData[i].amount;
                    }else if(valData[i].is_paid==1){
                        x += '<div>Paid</div>';
                        paidTotal += valData[i].amount;
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
                        pendDeliverTotal += 1;
                    }else if(valData[i].is_delivered==1){
                        x += '<div>Delivered</div>';
                        deliverTotal += 1;
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
                    $('div#dayPendPick').append(x);
                }
                $('div#dayPendTotal').append('<table>' +
                    '<tr>' +
                    '<th>Total Orders</th>' +
                    '<th>Pending Delivery</th>' +
                    '<th>Delivered</th>' +
                    '<th>Total Paid</th>' +
                    '<th>Total Unpaid</th>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>'+orderIntervalTotal+' orders</td>' +
                    '<td>'+pendDeliverTotal+' orders</td>' +
                    '<td>'+deliverTotal+' orders</td>' +
                    '<td>PHP '+addCommas(paidTotal.toFixed(2))+'</td>' +
                    '<td>PHP '+addCommas(pendTotal.toFixed(2))+'</td>' +
                    '</tr>' +
                    '</table>');
            }
        });
    });

    //date filter paid change

    $('#datePaidFilter').change(function () {
    // $('select#datePaidFilter').change(function () {
        var dayVal=$('#datePaidFilter').val();
        // var dayVal=$('select#datePaidFilter option:selected').val();
        var dateSplit = dayVal.split('-');
        var stringDate = m_names[parseInt(dateSplit[1])-1]+' '+dateSplit[2]+', '+dateSplit[0];
        var dayChange = dayChoose(dayVal,'2');
        $('#ordPaidAll').hide();
        dayChange.done(function (response) {
            console.log(response);
            $('div#dayPaidPick').empty();
            $('div#dayPaidTotal').empty();
            $('div#dayPaidPick').append('<div><span>Paid Orders for '+stringDate+'</span></div>');
            // $('div#dayPaidPick').append('<div><span>Paid Orders for '+$('select#datePaidFilter option:selected').text()+'</span></div>');
            if(response==''){
                $('div#dayPaidPick').append('<span>No Paid Plans!</span>');
            }else {
                var valData = JSON.parse(response);
                // console.log(JSON.parse(response));
                // console.log(response);
                var orderIntervalTotal = 0;
                var pendTotal = 0;
                var paidTotal = 0;
                var pendDeliverTotal = 0;
                var deliverTotal = 0;
                for (var i in valData) {
                    orderIntervalTotal += 1;
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
                        pendTotal += valData[i].amount;
                    }else if(valData[i].is_paid==1){
                        x += '<div>Paid</div>';
                        paidTotal += valData[i].amount;
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
                        pendDeliverTotal += 1;
                    }else if(valData[i].is_delivered==1){
                        x += '<div>Delivered</div>';
                        deliverTotal += 1;
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
                    $('div#dayPaidPick').append(x);
                }
                $('div#dayPaidTotal').append('<table>' +
                    '<tr>' +
                    '<th>Total Orders</th>' +
                    '<th>Pending Delivery</th>' +
                    '<th>Delivered</th>' +
                    '<th>Total Paid</th>' +
                    '<th>Total Unpaid</th>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>'+orderIntervalTotal+' orders</td>' +
                    '<td>'+pendDeliverTotal+' orders</td>' +
                    '<td>'+deliverTotal+' orders</td>' +
                    '<td>PHP '+addCommas(paidTotal.toFixed(2))+'</td>' +
                    '<td>PHP '+addCommas(pendTotal.toFixed(2))+'</td>' +
                    '</tr>' +
                    '</table>');
            }
        });
    });

    //order filter paid change

    $('#orderPaidFilter').change(function () {
        var val = $('select#orderPaidFilter option:selected').val();

        var dateChange = dateChoose(val,'2');
        dateChange.done(function (response) {
            console.log(response);
            $('div#dayPaidPick').empty();
            $('div#dayPaidTotal').empty();
            $('div#dayPaidPick').append('<div><span>Paid Orders for '+$('select#orderPaidFilter option:selected').text()+'</span></div>');
            if(response==''){
                $('div#dayPaidPick').append('<span>No Paid Plans!</span>');
            }else {
                var valData = JSON.parse(response);
                // console.log(JSON.parse(response));
                // console.log(response);
                var orderIntervalTotal = 0;
                var pendTotal = 0;
                var paidTotal = 0;
                var pendDeliverTotal = 0;
                var deliverTotal = 0;
                for (var i in valData) {
                    orderIntervalTotal += 1;
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
                        pendTotal += valData[i].amount;
                    }else if(valData[i].is_paid==1){
                        x += '<div>Paid</div>';
                        paidTotal += valData[i].amount;
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
                        pendDeliverTotal += 1;
                    }else if(valData[i].is_delivered==1){
                        x += '<div>Delivered</div>';
                        deliverTotal += 1;
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
                    $('div#dayPaidPick').append(x);
                }
                $('div#dayPaidTotal').append('<table>' +
                    '<tr>' +
                    '<th>Total Orders</th>' +
                    '<th>Pending Delivery</th>' +
                    '<th>Delivered</th>' +
                    '<th>Total Paid</th>' +
                    '<th>Total Unpaid</th>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>'+orderIntervalTotal+' orders</td>' +
                    '<td>'+pendDeliverTotal+' orders</td>' +
                    '<td>'+deliverTotal+' orders</td>' +
                    '<td>PHP '+addCommas(paidTotal.toFixed(2))+'</td>' +
                    '<td>PHP '+addCommas(pendTotal.toFixed(2))+'</td>' +
                    '</tr>' +
                    '</table>');
            }
        });
    });

    //date filter cancel change

    $('#dateCancelFilter').change(function () {
    // $('select#dateCancelFilter').change(function () {
        var dayVal=$('#dateCancelFilter').val();
        // var dayVal=$('select#dateCancelFilter option:selected').val();
        var dateSplit = dayVal.split('-');
        var stringDate = m_names[parseInt(dateSplit[1])-1]+' '+dateSplit[2]+', '+dateSplit[0];
        var dayChange = dayChoose(dayVal,'3');
        $('#ordCancelAll').hide();
        dayChange.done(function (response) {
            console.log(response);
            $('div#dayCancelPick').empty();
            $('div#dayCancelPick').append('<div><span>Cancelled Orders for '+stringDate+'</span></div>');
            // $('div#dayCancelPick').append('<div><span>Cancelled Orders for '+$('select#dateCancelFilter option:selected').text()+'</span></div>');
            if(response==''){
                $('div#dayCancelPick').append('<span>No Cancelled Plans!</span>');
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
                    x += '<div>Cancelled</div>';
                    // if(valData[i].is_paid==0){
                    //     x += '<div>Pending</div>';
                    // }else if(valData[i].is_paid==1){
                    //     x += '<div>Paid</div>';
                    // }
                    x += '</div>';
                    x += ' <div class="col s12 m2">';
                    x += '<div>Order Date:</div>';
                    x += '<div>' + valData[i].created_at + '</div>';
                    x += '</div>';
                    x += ' <div class="col s12 m2">';
                    x += '<div>Delivery:</div>';
                    x += '<div>Cancelled</div>';
                    // if(valData[i].is_delivered==0){
                    //     x += '<div>Pending</div>';
                    // }else if(valData[i].is_delivered==1){
                    //     x += '<div>Delivered</div>';
                    // }
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
                    $('div#dayCancelPick').append(x);
                }
            }
        });
    });


    //order filter cancel change

    $('#orderCancelFilter').change(function () {
        var val = $('select#orderCancelFilter option:selected').val();

        var dateChange = dateChoose(val,'3');
        dateChange.done(function (response) {
            console.log(response);
            $('div#dayCancelPick').empty();
            $('div#dayCancelPick').append('<div><span>Cancelled Orders for '+$('select#orderCancelFilter option:selected').text()+'</span></div>');
            if(response==''){
                $('div#dayCancelPick').append('<span>No Cancelled Plans!</span>');
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
                    x += '<div>Cancelled</div>';
                    // if(valData[i].is_paid==0){
                    //     x += '<div>Pending</div>';
                    // }else if(valData[i].is_paid==1){
                    //     x += '<div>Paid</div>';
                    // }
                    x += '</div>';
                    x += ' <div class="col s12 m2">';
                    x += '<div>Order Date:</div>';
                    x += '<div>' + valData[i].created_at + '</div>';
                    x += '</div>';
                    x += ' <div class="col s12 m2">';
                    x += '<div>Delivery:</div>';
                    x += '<div>Cancelled</div>';
                    // if(valData[i].is_delivered==0){
                    //     x += '<div>Pending</div>';
                    // }else if(valData[i].is_delivered==1){
                    //     x += '<div>Delivered</div>';
                    // }
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
                    $('div#dayCancelPick').append(x);
                }
            }
        });
    });


    //date filter deliver change

    $('#dateDeliverFilter').change(function () {
    // $('select#dateDeliverFilter').change(function () {
        var dayVal=$('#dateDeliverFilter').val();
        // var dayVal=$('select#dateDeliverFilter option:selected').val();
        var dateSplit = dayVal.split('-');
        var stringDate = m_names[parseInt(dateSplit[1])-1]+' '+dateSplit[2]+', '+dateSplit[0];
        var dayChange = dayChoose(dayVal,'4');
        $('#ordDeliverAll').hide();
        dayChange.done(function (response) {
            console.log(response);
            $('div#dayDeliverPick').empty();
            $('div#dayDeliverTotal').empty();
            $('div#dayDeliverPick').append('<div><span>Delivered Orders for '+stringDate+'</span></div>');
            // $('div#dayDeliverPick').append('<div><span>Pending Orders for '+$('select#dateDeliverFilter option:selected').text()+'</span></div>');

            if(response==''){
                $('div#dayDeliverPick').append('<span>No Delivered Plans!</span>');
            }else {
                var valData = JSON.parse(response);
                // console.log(JSON.parse(response));
                // console.log(response);
                var orderIntervalTotal = 0;
                var pendTotal = 0;
                var paidTotal = 0;
                var pendDeliverTotal = 0;
                var deliverTotal = 0;
                for (var i in valData) {
                    orderIntervalTotal += 1;
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
                        pendTotal += valData[i].amount;
                    }else if(valData[i].is_paid==1){
                        x += '<div>Paid</div>';
                        paidTotal += valData[i].amount;
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
                        pendDeliverTotal += 1;
                    }else if(valData[i].is_delivered==1){
                        x += '<div>Delivered</div>';
                        deliverTotal += 1;
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
                    $('div#dayDeliverPick').append(x);
                }
                $('div#dayDeliverTotal').append('<table>' +
                    '<tr>' +
                    '<th>Total Orders</th>' +
                    '<th>Pending Delivery</th>' +
                    '<th>Delivered</th>' +
                    '<th>Total Paid</th>' +
                    '<th>Total Unpaid</th>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>'+orderIntervalTotal+' orders</td>' +
                    '<td>'+pendDeliverTotal+' orders</td>' +
                    '<td>'+deliverTotal+' orders</td>' +
                    '<td>PHP '+addCommas(paidTotal.toFixed(2))+'</td>' +
                    '<td>PHP '+addCommas(pendTotal.toFixed(2))+'</td>' +
                    '</tr>' +
                    '</table>');
            }
        });
    });


    //order filter deliver change

    $('#orderDeliverFilter').change(function () {
        var val = $('select#orderDeliverFilter option:selected').val();

        var dateChange = dateChoose(val,'4');
        dateChange.done(function (response) {
            console.log(response);
            $('div#dayDeliverPick').empty();
            $('div#dayDeliverTotal').empty();
            $('div#dayDeliverPick').append('<div><span>Delivered Orders for '+$('select#orderDeliverFilter option:selected').text()+'</span></div>');
            if(response==''){
                $('div#dayDeliverPick').append('<span>No Delivered Plans!</span>');
            }else {
                var valData = JSON.parse(response);
                // console.log(JSON.parse(response));
                // console.log(response);
                var orderIntervalTotal = 0;
                var pendTotal = 0;
                var paidTotal = 0;
                var pendDeliverTotal = 0;
                var deliverTotal = 0;
                for (var i in valData) {
                    orderIntervalTotal += 1;
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
                        pendTotal += valData[i].amount;
                    }else if(valData[i].is_paid==1){
                        x += '<div>Paid</div>';
                        paidTotal += valData[i].amount;
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
                        pendDeliverTotal += 1;
                    }else if(valData[i].is_delivered==1){
                        x += '<div>Delivered</div>';
                        deliverTotal += 1;
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
                    $('div#dayDeliverPick').append(x);
                }
                $('div#dayDeliverTotal').append('<table>' +
                    '<tr>' +
                    '<th>Total Orders</th>' +
                    '<th>Pending Delivery</th>' +
                    '<th>Delivered</th>' +
                    '<th>Total Paid</th>' +
                    '<th>Total Unpaid</th>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>'+orderIntervalTotal+' orders</td>' +
                    '<td>'+pendDeliverTotal+' orders</td>' +
                    '<td>'+deliverTotal+' orders</td>' +
                    '<td>PHP '+addCommas(paidTotal.toFixed(2))+'</td>' +
                    '<td>PHP '+addCommas(pendTotal.toFixed(2))+'</td>' +
                    '</tr>' +
                    '</table>');
            }
        });
    });



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

function dateChoose($val,$type){
    return $.ajax({
        url: '/chef/order/dateChange/' + $val +'/' + $type

    });
}

function dayChoose($val,$type){
    return $.ajax({
        url: '/chef/order/dayChange/' + $val +'/' + $type

    });
}

function selectDay($val) {
    return $.ajax({
        url: '/chef/order/selectDay/' + $val
    });
}

function addCommas(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}