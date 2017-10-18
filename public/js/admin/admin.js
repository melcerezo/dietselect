$(document).ready(function() {
    $(document).on("click", "#logout-link", function () {
        $('form#logout').submit();
    });

    // commissions page

    // initialize select of chefs

    var chefAjax = chooseChef();

    chefAjax.done(function (response) {
        // console.log(response);
        $('select#chefFilter').empty();
        $('select#chefFilter').append($('<option></option>').attr("value",'0').text('All'));
        var valData = JSON.parse(response);
        for(var i in valData){
            $('select#chefFilter').append($('<option></option>').attr("value",valData[i].id).text(valData[i].name));
        }

        $('select#chefFilter').val('0');

        $('select#chefFilter').material_select();

        //initialize all chef view
        // var value = $('select#chefFilter option:selected').val();
        //
        // var getComAjax = chefComAjax(value);
        //
        // getComAjax.done(function (response) {
        //     var valData = JSON.parse(response);
        //
        //     // console.log(valData);
        //     var chefArray = [];
        //
        //     for(var i in valData){
        //         if($.inArray(valData[i].name,chefArray)==-1){
        //             chefArray.push(valData[i].name);
        //         }
        //     }
        //
        //
        //     // console.log(chefArray);
        // $.each(chefArray,function () {
        //     var specChef
        //
        //
        //     var x = '<div class="card-panel">';
        //
        //     x += '<table>';
        //     x += '<thead>';
        //     x += '<tr>';
        //     x += '<th>ID</th>';
        //     x += '<th>Chef Name</th>';
        //     x += '<th>Date</th>';
        //     x += '<th>Amount</th>';
        //     x += '<th>Paid</th>';
        //     x += '<th>Update</th>';
        //     x += '</tr>';
        //     x += '</thead>';
        //     x += '<tbody>';
        //     for(var i in valData){
        //
        //     }
        //     x += '</tbody>';
        //     x += '</table>';
        //     x += '</div>';
        //
        // });
        //
        // });
    });

    $('#chefFilter').change(function () {

        var value = $('select#chefFilter option:selected').val();

        if(value==0){
            $('div.chefCard').show();
            $('#sumAll').show();
            $('.chefCom').hide();
        }else{
            $('div.chefCard').hide();
            $('div#cardCom'+value).show();
            $('#sumAll').hide();
            $('.chefCom').hide();
            $('#chef'+value).show();
        }

        console.log(value);


    });


    // refunds page

    var foodieAjax = chooseRefund();

    foodieAjax.done(function (response) {
        // console.log(response);
        $('select#foodieFilter').empty();
        $('select#foodieFilter').append($('<option></option>').attr("value",'0').text('All'));
        var valData = JSON.parse(response);
        for(var i in valData){
            $('select#foodieFilter').append($('<option></option>').attr("value",valData[i].id).text(valData[i].name));
        }

        $('select#foodieFilter').val('0');

        $('select#foodieFilter').material_select();

        //initialize all chef view
        // var value = $('select#chefFilter option:selected').val();
        //
        // var getComAjax = chefComAjax(value);
        //
        // getComAjax.done(function (response) {
        //     var valData = JSON.parse(response);
        //
        //     // console.log(valData);
        //     var chefArray = [];
        //
        //     for(var i in valData){
        //         if($.inArray(valData[i].name,chefArray)==-1){
        //             chefArray.push(valData[i].name);
        //         }
        //     }
        //
        //
        //     // console.log(chefArray);
        // $.each(chefArray,function () {
        //     var specChef
        //
        //
        //     var x = '<div class="card-panel">';
        //
        //     x += '<table>';
        //     x += '<thead>';
        //     x += '<tr>';
        //     x += '<th>ID</th>';
        //     x += '<th>Chef Name</th>';
        //     x += '<th>Date</th>';
        //     x += '<th>Amount</th>';
        //     x += '<th>Paid</th>';
        //     x += '<th>Update</th>';
        //     x += '</tr>';
        //     x += '</thead>';
        //     x += '<tbody>';
        //     for(var i in valData){
        //
        //     }
        //     x += '</tbody>';
        //     x += '</table>';
        //     x += '</div>';
        //
        // });
        //
        // });
    });

    $('#foodieFilter').change(function () {

        var value = $('select#foodieFilter option:selected').val();

        if(value==0){
            $('div.foodieCard').show();
            $('#refundAll').show();
            $('.refundTot').hide();
        }else{
            $('div.foodieCard').hide();
            $('div#cardRef'+value).show();
            $('#refundAll').hide();
            $('.refundTot').hide();
            $('#refund'+value).show();
        }

        console.log(value);


    });

    $('.updateRefund').click(function () {
        var id = $(this).attr('data-id');
        var info = refInfo(id);

        info.done(function (response) {
           var valData = JSON.parse(response);

            var x = '<ul class="collection">';
            x += '<li class="collection-item">Name: '+valData.name+'</li>';
            x += '<li class="collection-item">Plan: '+valData.plan+'</li>';
            x += '<li class="collection-item">Chef: '+valData.plan+'</li>';
            if(valData.method == 0){
                x += '<li class="collection-item">Method: Bank Deposit</li>';
                if(valData.bank_type==0){
                    x += '<li class="collection-item">Bank: BDO</li>';
                }
                x += '<li class="collection-item">Account Number: '+valData.bank_account+'</li>';
            }else if(valData.method==1){
                x += '<li class="collection-item">Method: Money Transfer</li>';
                if(valData.transfer_company==0){
                    x += '<li class="collection-item">Transfer Company: Cebuana Lhuillier</li>';
                }
            }
            x += '</ul>';

            $('div#infoRef').append(x);
        });

        $('#refund-id').val(id);
    });

    $.validator.addMethod('minImageWidth', function(value, element, minWidth) {
        return ($(element).data('imageWidth') || 0) > minWidth;
    }, function(minWidth, element) {
        var imageWidth = $(element).data('imageWidth');
        return (imageWidth)
            ? ("Your image's width must be greater than " + minWidth + "px")
            : "Selected file is not an image.";
    });

    $('form#refundForm').validate({
        rules: {
            code:{ required:true },
            cover:{
                required:true,
                accept:"image/jpg,image/jpeg,image/png,image/gif",
                minImageWidth:200
            }
        },
        messages: {
            cover:{
                required: 'Please upload proof photo!',
                accept: 'Images Only!'
            }
        },
        errorElement : 'div',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error);
            } else {
                error.insertAfter(element);
            }
        }
    });

    var $submitBtn = $('#refundForm').find('input:submit'),
        $photoInput = $('#refundPic'),
        $imgContainer = $('#refundContainer');

    $('#refundPic').change(function() {
        $photoInput.removeData('imageWidth');
        $imgContainer.hide().empty();

        var file = this.files[0];

        if (file.type.match(/image\/.*/)) {
            // $submitBtn.attr('disabled', true);

            var reader = new FileReader();

            reader.onload = function() {
                var $img = $('<img />').attr({ src: reader.result });

                $img.on('load', function() {
                    $imgContainer.append($img).show();
                    var imageWidth = $img.width();
                    $photoInput.data('imageWidth', imageWidth);
                    if (imageWidth < 500) {
                        $imgContainer.hide();
                    } else {
                        $img.css({ width: '200px', height: '200px' });
                    }
                    // $submitBtn.attr('disabled', false);

                    validator.element($photoInput);
                });
            };

            reader.readAsDataURL(file);
        } else {
            validator.element($photoInput);
        }
    });



    // $('#allCom').show();
    // $('#pendCom').hide();
    // $('#paidCom').hide();
    // $('#dayCom').hide();
    // $('#weekCom').hide();
    // $('#monthCom').hide();
    // $('#yearCom').hide();
    //
    // $('#allLinkContain').addClass('activeTab');
    //
    // $('#orderFilter').change(function () {
    //     var value = $('select#orderFilter option:selected').val();
    //     console.log(value);
    //     if(value==1){
    //         $('#comAll').hide();
    //         $('#pendCom').hide();
    //         $('#paidCom').hide();
    //         $('#dayCom').show();
    //         $('#weekCom').hide();
    //         $('#monthCom').hide();
    //         $('#yearCom').hide();
    //     }else if(value==2){
    //         $('#comAll').hide();
    //         $('#pendCom').hide();
    //         $('#paidCom').hide();
    //         $('#dayCom').hide();
    //         $('#weekCom').show();
    //         $('#monthCom').hide();
    //         $('#yearCom').hide();
    //     }else if(value==3){
    //         $('#comAll').hide();
    //         $('#pendCom').hide();
    //         $('#paidCom').hide();
    //         $('#dayCom').hide();
    //         $('#weekCom').hide();
    //         $('#monthCom').show();
    //         $('#yearCom').hide();
    //     }else if(value==4){
    //         $('#comAll').hide();
    //         $('#pendCom').hide();
    //         $('#paidCom').hide();
    //         $('#dayCom').hide();
    //         $('#weekCom').hide();
    //         $('#monthCom').hide();
    //         $('#yearCom').show();
    //     }else if(value==5){
    //         $('#comAll').show();
    //         $('#pendCom').hide();
    //         $('#paidCom').hide();
    //         $('#dayCom').hide();
    //         $('#weekCom').hide();
    //         $('#monthCom').hide();
    //         $('#yearCom').hide();
    //     }
    // });
    //
    // $('#pendOrderFilter').change(function () {
    //     var value = $('select#pendOrderFilter option:selected').val();
    //     if(value==1){
    //         $('#allCom').hide();
    //         $('#allPend').hide();
    //         $('#paidCom').hide();
    //         $('#dayCom').show();
    //         $('#pendweekCom').hide();
    //         $('#pendmonthCom').hide();
    //         $('#pendyearCom').hide();
    //     }else if(value==2){
    //         $('#allCom').hide();
    //         $('#allPend').hide();
    //         $('#paidCom').hide();
    //         $('#dayCom').hide();
    //         $('#pendweekCom').show();
    //         $('#pendmonthCom').hide();
    //         $('#pendyearCom').hide();
    //     }else if(value==3){
    //         $('#allCom').hide();
    //         $('#allPend').hide();
    //         $('#paidCom').hide();
    //         $('#dayCom').hide();
    //         $('#pendweekCom').hide();
    //         $('#pendmonthCom').show();
    //         $('#pendyearCom').hide();
    //     }else if(value==4){
    //         $('#allCom').hide();
    //         $('#allPend').hide();
    //         $('#paidCom').hide();
    //         $('#dayCom').hide();
    //         $('#pendweekCom').hide();
    //         $('#pendmonthCom').hide();
    //         $('#pendyearCom').show();
    //     }else if(value==5){
    //         $('#allCom').hide();
    //         $('#allPend').show();
    //         $('#paidCom').hide();
    //         $('#dayCom').hide();
    //         $('#pendweekCom').hide();
    //         $('#pendmonthCom').hide();
    //         $('#pendyearCom').hide();
    //     }
    // });
    // $('#paidOrderFilter').change(function () {
    //     var value = $('select#paidOrderFilter option:selected').val();
    //     if(value==1){
    //         $('#allCom').hide();
    //         $('#pendCom').hide();
    //         $('#allPaid').hide();
    //         $('#paiddayCom').show();
    //         $('#paidweekCom').hide();
    //         $('#paidmonthCom').hide();
    //         $('#paidyearCom').hide();
    //     }else if(value==2){
    //         $('#allCom').hide();
    //         $('#pendCom').hide();
    //         $('#allPaid').hide();
    //         $('#paiddayCom').hide();
    //         $('#paidweekCom').show();
    //         $('#paidmonthCom').hide();
    //         $('#paidyearCom').hide();
    //     }else if(value==3){
    //         $('#allCom').hide();
    //         $('#pendCom').hide();
    //         $('#allPaid').hide();
    //         $('#paiddayCom').hide();
    //         $('#paidweekCom').hide();
    //         $('#paidmonthCom').show();
    //         $('#paidyearCom').hide();
    //     }else if(value==4){
    //         $('#allCom').hide();
    //         $('#pendCom').hide();
    //         $('#allPaid').hide();
    //         $('#paiddayCom').hide();
    //         $('#paidweekCom').hide();
    //         $('#paidmonthCom').hide();
    //         $('#paidyearCom').show();
    //     }else if(value==5){
    //         $('#allCom').hide();
    //         $('#pendCom').hide();
    //         $('#allPaid').show();
    //         $('#paiddayCom').hide();
    //         $('#paidweekCom').hide();
    //         $('#paidmonthCom').hide();
    //         $('#paidyearCom').hide();
    //     }
    // });
    //
    // $('.allLink').click(function () {
    //     $('#allLinkContain').addClass('activeTab');
    //     $('#pendLinkContain').removeClass('activeTab');
    //     $('#paidLinkContain').removeClass('activeTab');
    //
    //     var value = $('select#orderFilter option:selected').val();
    //     console.log(value);
    //     if(value == 5){
    //         $('#allCom').show();
    //         $('#comAll').show();
    //         $('#pendCom').hide();
    //         $('#paidCom').hide();
    //         $('#dayCom').hide();
    //         $('#weekCom').hide();
    //         $('#monthCom').hide();
    //         $('#yearCom').hide();
    //     }else if(value == 2){
    //         $('#allCom').show();
    //         $('#comAll').hide();
    //         $('#pendCom').hide();
    //         $('#paidCom').hide();
    //         $('#dayCom').hide();
    //         $('#weekCom').show();
    //         $('#monthCom').hide();
    //         $('#yearCom').hide();
    //         console.log(value);
    //     }else if(value == 3){
    //         $('#allCom').show();
    //         $('#comAll').hide();
    //         $('#pendCom').hide();
    //         $('#paidCom').hide();
    //         $('#dayCom').hide();
    //         $('#weekCom').hide();
    //         $('#monthCom').show();
    //         $('#yearCom').hide();
    //     }else if(value == 4){
    //         $('#allCom').show();
    //         $('#comAll').hide();
    //         $('#pendCom').hide();
    //         $('#paidCom').hide();
    //         $('#dayCom').hide();
    //         $('#weekCom').hide();
    //         $('#monthCom').hide();
    //         $('#yearCom').show();
    //     }
    //
    //     // $('#allCom').show();
    //     // $('#comAll').show();
    //     // $('#pendCom').hide();
    //     // $('#paidCom').hide();
    //     // $('#dayCom').hide();
    //     // $('#weekCom').hide();
    //     // $('#monthCom').hide();
    //     // $('#yearCom').hide();
    // });
    // $('.pendLink').click(function () {
    //     $('#allLinkContain').removeClass('activeTab');
    //     $('#pendLinkContain').addClass('activeTab');
    //     $('#paidLinkContain').removeClass('activeTab');
    //
    //     var value = $('select#pendOrderFilter option:selected').val();
    //
    //     if(value==5){
    //         $('#allCom').hide();
    //         $('#pendCom').show();
    //         $('#allPend').show();
    //         $('#paidCom').hide();
    //         $('#penddayCom').hide();
    //         $('#pendweekCom').hide();
    //         $('#pendmonthCom').hide();
    //         $('#pendyearCom').hide();
    //     }else if(value==2){
    //         $('#allCom').hide();
    //         $('#pendCom').show();
    //         $('#allPend').hide();
    //         $('#paidCom').hide();
    //         $('#penddayCom').hide();
    //         $('#pendweekCom').show();
    //         $('#pendmonthCom').hide();
    //         $('#pendyearCom').hide();
    //     }else if(value==3){
    //         $('#allCom').hide();
    //         $('#pendCom').show();
    //         $('#allPend').hide();
    //         $('#paidCom').hide();
    //         $('#penddayCom').hide();
    //         $('#pendweekCom').hide();
    //         $('#pendmonthCom').show();
    //         $('#pendyearCom').hide();
    //     }else if(value==4){
    //         $('#allCom').hide();
    //         $('#pendCom').show();
    //         $('#allPend').hide();
    //         $('#paidCom').hide();
    //         $('#penddayCom').hide();
    //         $('#pendweekCom').hide();
    //         $('#pendmonthCom').hide();
    //         $('#pendyearCom').show();
    //     }
    //
    //
    // });
    // $('.paidLink').click(function () {
    //     $('#allLinkContain').removeClass('activeTab');
    //     $('#pendLinkContain').removeClass('activeTab');
    //     $('#paidLinkContain').addClass('activeTab');
    //
    //     var value = $('select#paidOrderFilter option:selected').val();
    //
    //     if(value==5){
    //         $('#allCom').hide();
    //         $('#pendCom').hide();
    //         $('#paidCom').show();
    //         $('#allPaid').show();
    //         $('#paiddayCom').hide();
    //         $('#paidweekCom').hide();
    //         $('#paidmonthCom').hide();
    //         $('#paidyearCom').hide();
    //     }else if(value==2){
    //         $('#allCom').hide();
    //         $('#pendCom').hide();
    //         $('#paidCom').show();
    //         $('#allPaid').hide();
    //         $('#paiddayCom').hide();
    //         $('#paidweekCom').show();
    //         $('#paidmonthCom').hide();
    //         $('#paidyearCom').hide();
    //     }else if(value==3){
    //         $('#allCom').hide();
    //         $('#pendCom').hide();
    //         $('#paidCom').show();
    //         $('#allPaid').hide();
    //         $('#paiddayCom').hide();
    //         $('#paidweekCom').hide();
    //         $('#paidmonthCom').show();
    //         $('#paidyearCom').hide();
    //     }else if(value==4){
    //         $('#allCom').hide();
    //         $('#pendCom').hide();
    //         $('#paidCom').show();
    //         $('#allPaid').hide();
    //         $('#paiddayCom').hide();
    //         $('#paidweekCom').hide();
    //         $('#paidmonthCom').hide();
    //         $('#paidyearCom').show();
    //     }
    //
    //
    //
    // });



    // orders page

    $('#orderPageAll').show();
    $('#orderPagePend').hide();
    $('#orderPagePaid').hide();
    $('#orderWeekPicker').hide();
    $('#orderMonthPicker').hide();
    $('#orderYearPicker').hide();
    $('#orderPageCancel').hide();


    $('#allOrderLinkContain').addClass('activeTab');

    // var orderAllTable= $('#orderAllTable');
    $('#orderAllTable').show();
    $('#orderWeekPicker').hide();
    $('#orderMonthPicker').hide();
    $('#orderYearPicker').hide();



    $('#orderPageFilter').change(function () {
        var value = $('select#orderPageFilter option:selected').val();
        if(value==1){
            $('#allCom').hide();
            $('#pendCom').hide();
            $('#allPaid').hide();
            $('#paiddayCom').show();
            $('#paidweekCom').hide();
            $('#paidmonthCom').hide();
            $('#paidyearCom').hide();
        }else if(value==2){
            $('#orderPageCancel').hide();
            $('#orderPagePaid').hide();
            $('#orderPagePend').hide();
            $('#orderAllTable').hide();
            $('#orderWeekPicker').show();
            $('#orderMonthPicker').hide();
            $('#orderYearPicker').hide();
        }else if(value==3){
            $('#orderPageCancel').hide();
            $('#orderPagePaid').hide();
            $('#orderPagePend').hide();
            $('#orderAllTable').hide();
            $('#orderWeekPicker').hide();
            $('#orderMonthPicker').show();
            $('#orderYearPicker').hide();
        }else if(value==4){
            $('#orderPageCancel').hide();
            $('#orderPagePaid').hide();
            $('#orderPagePend').hide();
            $('#orderAllTable').hide();
            $('#orderWeekPicker').hide();
            $('#orderMonthPicker').hide();
            $('#orderYearPicker').show();
        }else if(value==5){
            $('#orderPageCancel').hide();
            $('#orderPagePaid').hide();
            $('#orderPagePend').hide();
            $('#orderAllTable').show();
            $('#orderWeekPicker').hide();
            $('#orderMonthPicker').hide();
            $('#orderYearPicker').hide();
        }
    });

    $('#orderPendFilter').change(function () {
        var value = $('select#orderPendFilter option:selected').val();
        if(value==1){
            $('#allCom').hide();
            $('#pendCom').hide();
            $('#allPaid').hide();
            $('#paiddayCom').show();
            $('#paidweekCom').hide();
            $('#paidmonthCom').hide();
            $('#paidyearCom').hide();
        }else if(value==2){
            $('#orderPageCancel').hide();
            $('#orderPagePaid').hide();
            $('#orderPageAll').hide();
            $('#orderPendAllTable').hide();
            $('#orderPendWeekPicker').show();
            $('#orderPendMonthPicker').hide();
            $('#orderPendYearPicker').hide();
        }else if(value==3){
            $('#orderPageCancel').hide();
            $('#orderPagePaid').hide();
            $('#orderPageAll').hide();
            $('#orderPendAllTable').hide();
            $('#orderPendWeekPicker').hide();
            $('#orderPendMonthPicker').show();
            $('#orderPendYearPicker').hide();
        }else if(value==4){
            $('#orderPageCancel').hide();
            $('#orderPagePaid').hide();
            $('#orderPageAll').hide();
            $('#orderPendAllTable').hide();
            $('#orderPendWeekPicker').hide();
            $('#orderPendMonthPicker').hide();
            $('#orderPendYearPicker').show();
        }else if(value==5){
            $('#orderPageCancel').hide();
            $('#orderPagePaid').hide();
            $('#orderPageAll').hide();
            $('#orderPendAllTable').show();
            $('#orderPendWeekPicker').hide();
            $('#orderPendMonthPicker').hide();
            $('#orderPendYearPicker').hide();
        }
    });

    $('#orderPaidFilter').change(function () {
        var value = $('select#orderPaidFilter option:selected').val();
        if(value==1){
            $('#allCom').hide();
            $('#pendCom').hide();
            $('#allPaid').hide();
            $('#paiddayCom').show();
            $('#paidweekCom').hide();
            $('#paidmonthCom').hide();
            $('#paidyearCom').hide();
        }else if(value==2){
            $('#orderPageCancel').hide();
            $('#orderPagePend').hide();
            $('#orderPageAll').hide();
            $('#orderPaidAllTable').hide();
            $('#orderPaidWeekPicker').show();
            $('#orderPaidMonthPicker').hide();
            $('#orderPaidYearPicker').hide();
        }else if(value==3){
            $('#orderPageCancel').hide();
            $('#orderPagePend').hide();
            $('#orderPageAll').hide();
            $('#orderPaidAllTable').hide();
            $('#orderPaidWeekPicker').hide();
            $('#orderPaidMonthPicker').show();
            $('#orderPaidYearPicker').hide();
        }else if(value==4){
            $('#orderPageCancel').hide();
            $('#orderPagePend').hide();
            $('#orderPageAll').hide();
            $('#orderPaidAllTable').hide();
            $('#orderPaidWeekPicker').hide();
            $('#orderPaidMonthPicker').hide();
            $('#orderPaidYearPicker').show();
        }else if(value==5){
            $('#orderPageCancel').hide();
            $('#orderPagePend').hide();
            $('#orderPageAll').hide();
            $('#orderPaidAllTable').show();
            $('#orderPaidWeekPicker').hide();
            $('#orderPaidMonthPicker').hide();
            $('#orderPaidYearPicker').hide();
        }
    });

    $('#orderCancelFilter').change(function () {
        var value = $('select#orderCancelFilter option:selected').val();
        if(value==1){
            $('#allCom').hide();
            $('#pendCom').hide();
            $('#allPaid').hide();
            $('#paiddayCom').show();
            $('#paidweekCom').hide();
            $('#paidmonthCom').hide();
            $('#paidyearCom').hide();
        }else if(value==2){
            $('#orderPagePaid').hide();
            $('#orderPagePend').hide();
            $('#orderPageAll').hide();
            $('#orderCancelAllTable').hide();
            $('#orderCancelWeekPicker').show();
            $('#orderCancelMonthPicker').hide();
            $('#orderCancelYearPicker').hide();
        }else if(value==3){
            $('#orderPagePaid').hide();
            $('#orderPagePend').hide();
            $('#orderPageAll').hide();
            $('#orderCancelAllTable').hide();
            $('#orderCancelWeekPicker').hide();
            $('#orderCancelMonthPicker').show();
            $('#orderCancelYearPicker').hide();
        }else if(value==4){
            $('#orderPagePaid').hide();
            $('#orderPagePend').hide();
            $('#orderPageAll').hide();
            $('#orderCancelAllTable').hide();
            $('#orderCancelWeekPicker').hide();
            $('#orderCancelMonthPicker').hide();
            $('#orderCancelYearPicker').show();
        }else if(value==5){
            $('#orderPagePaid').hide();
            $('#orderPagePend').hide();
            $('#orderPageAll').hide();
            $('#orderCancelAllTable').show();
            $('#orderCancelWeekPicker').hide();
            $('#orderCancelMonthPicker').hide();
            $('#orderCancelYearPicker').hide();
        }
    });

    $('.allOrderLink').click(function () {
        $('#allOrderLinkContain').addClass('activeTab');
        $('#pendOrderLinkContain').removeClass('activeTab');
        $('#paidOrderLinkContain').removeClass('activeTab');
        $('#cancelledOrderLinkContain').removeClass('activeTab');

        $('select#orderPageFilter').val('0');
        $('select#orderPageFilter').material_select();
        $('#orderPageAll').show();
        $('#orderPageCancel').hide();
        $('#orderAllTable').show();
        $('#orderPagePend').hide();
        $('#orderPagePaid').hide();
        $('#orderWeekPicker').hide();
        $('#orderMonthPicker').hide();
        $('#orderYearPicker').hide();
    });

    $('.pendOrderLink').click(function () {
        $('#allOrderLinkContain').removeClass('activeTab');
        $('#pendOrderLinkContain').addClass('activeTab');
        $('#paidOrderLinkContain').removeClass('activeTab');
        $('#cancelledOrderLinkContain').removeClass('activeTab');

        $('select#orderPendFilter').val('0');
        $('select#orderPendFilter').material_select();
        $('#orderPageAll').hide();
        $('#orderPageCancel').hide();
        $('#orderPendAllTable').show();
        $('#orderPagePend').show();
        $('#orderPagePaid').hide();
        $('#orderPendWeekPicker').hide();
        $('#orderPendMonthPicker').hide();
        $('#orderPendYearPicker').hide();
    });



    $('.paidOrderLink').click(function () {
        $('#allOrderLinkContain').removeClass('activeTab');
        $('#pendOrderLinkContain').removeClass('activeTab');
        $('#paidOrderLinkContain').addClass('activeTab');
        $('#cancelledOrderLinkContain').removeClass('activeTab');

        $('select#orderPaidFilter').val('0');
        $('select#orderPaidFilter').material_select();
        $('#orderPageAll').hide();
        $('#orderPageCancel').hide();
        $('#orderPaidAllTable').show();
        $('#orderPagePend').hide();
        $('#orderPagePaid').show();
        $('#orderPaidWeekPicker').hide();
        $('#orderPaidMonthPicker').hide();
        $('#orderPaidYearPicker').hide();
    });

    $('.cancelledOrderLink').click(function () {
        $('#allOrderLinkContain').removeClass('activeTab');
        $('#pendOrderLinkContain').removeClass('activeTab');
        $('#paidOrderLinkContain').removeClass('activeTab');
        $('#cancelledOrderLinkContain').addClass('activeTab');

        $('select#orderCancelFilter').val('0');
        $('select#orderCancelFilter').material_select();
        $('#orderPageAll').hide();
        $('#orderCancelAllTable').show();
        $('#orderPagePend').hide();
        $('#orderPagePaid').hide();
        $('#orderPageCancel').show();
        $('#orderCancelWeekPicker').hide();
        $('#orderCancelMonthPicker').hide();
        $('#orderCancelYearPicker').hide();
    });

});


function chooseChef(){
    return $.ajax({
        url: '/admin/commissions/chef'

    });
}

function refInfo(value){
    return $.ajax({
        url: '/admin/refunds/info/'+ value

    });
}

function chooseRefund(){
    return $.ajax({
        url: '/admin/refunds/'

    });
}

function chefComAjax($val){
    return $.ajax({
        url: '/admin/commissions/get/'+ $val

    });
}
