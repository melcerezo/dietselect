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

    $('#orderFilter').change(function () {
        var val = $('select#orderFilter option:selected').val();
        var dateChange = dateChoose(val);
        dateChange.done(function (response) {
            var valData = JSON.parse(response);
            // console.log(JSON.parse(response));
            // console.log(response);
            for(var i in valData){
                $('div#dayPick').append(
                    '<div class="card">' +
                    '<div class="card-title" style="font-size: 18px;">' +
                    '<div class="row" style="margin: 0 0 20px 0; padding: 5px;">' +
                    '' +
                    '</div>' +
                    '<div class="row">' +
                    '' +
                    '</div>' +
                    '</div>' +
                    '<div class="divider" style="margin: 0 5px;"></div>' +
                    '<div class="card-content">'
                );
                for(var j in valData[i].items){
                    $('div#dayPick').append(
                        '<div class="row">' +
                        '<div class="col s12 m3">' +
                        ' <img src="/img/'+valData[i].items[j].planPic+'" class="img-responsive" style="max-width:150px;"/>' +
                        '</div>' +
                        '<div class="col s12 m4" style="font-size: 20px;">' +
                        '<div>'+valData[i].items[j].plan+'</div>' +
                        '<div>'+valData[i].items[j].chef+'</div>' +
                        '<div>'+valData[i].items[j].type+'</div>' +
                        '<div>'+valData[i].items[j].quantity+'</div>' +
                        '<div>'+valData[i].items[j].price+'</div>' +
                        '</div>' +
                        '<div class="col s12 offset-m2 m2">' +
                        '<a href="{{route(\'foodie.order.single\', '+valData[i].items[j].id+' )}}" class="orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100; width:100%;">Details</a>' +
                        '</div>' +
                        '</div>'
                    );
                }
                $('div#dayPick').append(
                    '</div>' +
                    '</div>'
                );
            }

        });
    });

});

function dateChoose($val){
    return $.ajax({
        url: '/foodie/order/dateChange/' + $val

    });
}