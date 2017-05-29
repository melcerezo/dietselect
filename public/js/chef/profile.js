$(document).ready(function() {
    $('#basicProfileLinkContainer').addClass('activePrfLink');
    $('#basic-profile-container').show();

    $(document).on('click','#basicProfileLink', function () {
        $('#addressLinkContainer,#allergiesLinkContainer,#preferenceLinkContainer').removeClass('activePrfLink');
        $('#basicProfileLinkContainer').addClass('activePrfLink');
        $('#basic-profile-container').show();
        $('#allergies-container,#addresses-container,#food-preferences-container').hide();
    });
    $('div.input-field').on('focus', '#website', function(){
        var url = $('#website').val();
        if (url == '') {
            $('#website').val('http://');
        }
    }).on('blur', '#website', function(){
        var url = $('#website').val();
        if (url == 'http://' || url.length < 7) {
            $('#website').val('');
        }
    });
    $('form#basic-profile').validate({
        rules: {
            company_name: {
                required: true,
                minlength: 2
            },
            mobile_number: {
                required: true,
                min: 9000000000,
                max: 9999999999,
                digits: true
            },
            email: {
                required: true,
                email: true
            },
            website: {
                url: true,
                minlength: 10
            }

        },
        //For custom messages
        messages: {
            company_name: {
                required: "Enter your company name, please!",
                minlength: "You sure you're named with one letter?"
            },
            mobile_number: {
                required: "Enter your company number, please!",
                min: "Enter a valid PH mobile number, please.",
                max: "Enter a valid PH mobile number, please.",
                digits: "Enter a valid PH mobile number, please."
            },
            email: {
                required: "Enter your email address, please!",
                email: "Enter a valid email address, please."
            },
            website: {
                url: "Enter a valid website link, please!",
                minlength: "Sorry, website link must be at least 10 characters."
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

    var allergiesList = JSON.parse(allergies.replace(/&quot;/g,'"'));
    var checkboxValues = [];


    $('input.allergyCheckbox:checkbox').each(function () {
        var $this=$(this);
        checkboxValues.push($(this).attr('name'));
        $.each(allergiesList,function () {
            if($this.attr('name')==$(this).attr('allergy')){
                // console.log($(this).attr('allergy'));
                $this.prop('checked',true);
            }
        });
    });
    console.log(checkboxValues);
    var otherValues=[];
    $.each(allergiesList, function () {
        // console.log($(this).attr('allergy'));
        if($.inArray($(this).attr('allergy'), checkboxValues) === -1){
            otherValues.push($(this).attr('allergy'));
        }
    });
    console.log(otherValues);
    var lengthOtherValues = otherValues.length;
    $.each(otherValues, function (index,element) {
        console.log(element);
        if(index != (lengthOtherValues - 1)){
            $('#allrg-others').val($('#allrg-others').val()+element+ ',');
        }else{
            $('#allrg-others').val($('#allrg-others').val()+element);
        }
    });
});