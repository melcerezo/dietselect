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
        console.log(response);
    });


    // $('#datepick').pickadate({
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
    // $('#datepick').change(function () {
    //     var dayVal=$(this).val();
    //     var dayChange = dayChoose(dayVal);
    //     dayChange.done(function (response) {
    //         console.log(response);
    //         $('div#dayPick').empty();
    //         if(response==''){
    //             $('div#dayPick').append('<span>No Plans Ordered Yet!</span>');
    //         }else {
    //             var valData = JSON.parse(response);
    //             // console.log(JSON.parse(response));
    //             // console.log(response);
    //             for (var i in valData) {
    //                 var x = '<div class="card">';
    //                 x += '<div class="card-title" style="font-size: 18px;">';
    //                 x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
    //                 x += ' <div class="col s12 m2">';
    //                 x += '<div>For Week Of</div>';
    //                 x += '<div style="font-size: 22px;">' + valData[i].week + '</div>';
    //                 x += '</div>';
    //                 x += '<div class="col s12 m3">';
    //                 x += '<div>Total</div>';
    //                 x += '<div style="font-size: 22px;">' + valData[i].total + '</div>';
    //                 x += '</div>';
    //                 x += '<div class="col s12 m4">';
    //                 x += '<div>Address</div>';
    //                 x += '<div style="font-size: 22px;">' + valData[i].address + '</div>';
    //                 x += '</div>';
    //                 x += '<div class="col s12 m3">';
    //                 x += '<div>Status</div>';
    //                 x += '<div style="font-size: 22px;">' + valData[i].is_paid + '</div>';
    //                 x += '</div>';
    //                 x += '</div>';
    //                 x += '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">';
    //                 x += '<div class="col s12 m2">';
    //                 x += '<div>Order Date</div>';
    //                 x += '<div style="font-size: 22px;">' + valData[i].created_at + '</div>';
    //                 x += '</div>';
    //                 x += '</div>';
    //                 x += '</div>';
    //                 x += '<div class="divider" style="margin: 0 5px;"></div>';
    //                 x += '<div class="card-content">';
    //                 for (var j in valData[i].items) {
    //                     x += '<div class="row">';
    //                     x += '<div class="col s12 m3">';
    //                     x += ' <img src="/img/' + valData[i].items[j].planPic + '" class="img-responsive" style="max-width:150px;"/>';
    //                     x += '</div>';
    //                     x += '<div class="col s12 m4" style="font-size: 20px;">';
    //                     x += '<div>' + valData[i].items[j].plan + '</div>';
    //                     x += '<div>' + valData[i].items[j].chef + '</div>';
    //                     x += '<div>' + valData[i].items[j].type + '</div>';
    //                     x += '<div>' + valData[i].items[j].quantity + '</div>';
    //                     x += '<div>' + valData[i].items[j].price + '</div>';
    //                     x += '</div>';
    //                     x += '<div class="col s12 offset-m2 m2">';
    //                     x += '<a href="#!" data-id="' + valData[i].items[j].id + '" class="btnView orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100; width:100%;">Details</a>';
    //                     x += '</div>';
    //                     x += '</div>';
    //                 }
    //                 x += '</div>';
    //                 x += '</div>';
    //                 $('div#dayPick').append(x);
    //             }
    //         }
    //     });
    // });

    var startVal = $('select#orderFilter option:selected').val();

    var dateChange = dateChoose(startVal);
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
                x += '<div class="col s12 m2">';
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
                    x += '<div>' + valData[i].items[j].plan + '</div>';
                    x += '<div>' + valData[i].items[j].chef + '</div>';
                    x += '<div>' + valData[i].items[j].type + '</div>';
                    x += '<div>' + valData[i].items[j].quantity + '</div>';
                    x += '<div>' + valData[i].items[j].price + '</div>';
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
                x += '<div class="col s12 m2">';
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
                        x += '<div>' + valData[i].items[j].plan + '</div>';
                        x += '<div>' + valData[i].items[j].chef + '</div>';
                        x += '<div>' + valData[i].items[j].type + '</div>';
                        x += '<div>' + valData[i].items[j].quantity + '</div>';
                        x += '<div>' + valData[i].items[j].price + '</div>';
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
    
        $(document).on('click','.btnView', function () {
            var id = $(this).attr('data-id');
            $.ajax({
                url:'/foodie/order/viewSingle/'+ id
            }).success(function () {
                window.location.href= this.url;
            });

        });
});

function dateChoose($val){
    return $.ajax({
        url: '/foodie/order/dateChange/' + $val

    });
}
function dayChoose($val){
    return $.ajax({
        url: '/foodie/order/dayChange/' + $val

    });
}

function selectDay() {
    return $.ajax({
       url: '/foodie/order/selectDay'
    });
}