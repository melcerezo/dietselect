$(document).ready(function() {
    $('#basicProfileLinkContainer').addClass('activePrfLink');
    $('#basic-profile-container').show();

    $(document).on('click','#basicProfileLink', function () {
        $('#addressLinkContainer,#allergiesLinkContainer,#preferenceLinkContainer').removeClass('activePrfLink');
        $('#basicProfileLinkContainer').addClass('activePrfLink');
        $('#basic-profile-container').show();
        $('#allergies-container,#addresses-container,#food-preferences-container').hide();
    });
    $(document).on('click','#addressLink', function () {
        $('#basicProfileLinkContainer,#allergiesLinkContainer,#preferenceLinkContainer').removeClass('activePrfLink');
        $('#addressLinkContainer').addClass('activePrfLink');
        $('#addresses-container').show();
        $('#basic-profile-container,#allergies-container,#food-preferences-container').hide();
    });
    $(document).on('click','#allergiesLink', function () {
        $('#basicProfileLinkContainer,#addressLinkContainer,#preferenceLinkContainer').removeClass('activePrfLink');
        $('#allergiesLinkContainer').addClass('activePrfLink');
        $('#allergies-container').show();
        $('#basic-profile-container,#addresses-container,#food-preferences-container').hide();
    });
    $(document).on('click','#preferenceLink', function () {
        $('#basicProfileLinkContainer,#addressLinkContainer,#allergiesLinkContainer').removeClass('activePrfLink');
        $('#preferenceLinkContainer').addClass('activePrfLink');
        $('#food-preferences-container').show();
        $('#basic-profile-container,#addresses-container,#allergies-container').hide();
    });

    date=new Date();
    // minus18=date.setFullYear(date.getFullYear()-18);
    console.log(date.getFullYear()+'/'+date.getMonth()+'/'+date.getDate());
    $('#birthday').pickadate({
        // Buttons
        // Buttons
        today: '<i class="fa fa-calendar-check-o" aria-hidden="true"></i>',
        clear: 'Clear',
        close: '<i class="fa fa-check-circle" aria-hidden="true"></i>',

        //Formats
        format: 'yyyy-mm-dd',

        //Date limits
        max: [date.getFullYear()-18,date.getMonth(),date.getDate()],

        //Dropdown selectors
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
    });

    $('form#basic-profile').validate({
        rules: {
            first_name: {
                required: true,
                minlength: 2
            },
            last_name: {
                required: true,
                minlength: 2
            },
            birthday: {
                required: true
            }

        },
        //For custom messages
        messages: {
            first_name: {
                required: "Enter your first name, please!",
                minlength: "You sure you're named with one letter?"
            },
            last_name: {
                required: "Enter your last name, please!",
                minlength: "You sure you're named with one letter?"
            },
            birthday: {
                required: "Enter your birthday, please!"
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

    $('form#address').validate({
        rules: {
            city: {
                required: true
            },
            unit: {
                required: true
            },
            street: {
                required: true
            },
            brgy: {
                required: true
            },
            type: {
                required: true
            }
        },
        messages: {
            city: {
                required: "Please select your city."
            },
            unit: {
                required: "Please enter the condo/apartment unit number or house street number."
            },
            street: {
                required: "Please enter your street."
            },
            brgy: {
                required: "Please enter your Barangay/Village."
            },
            type: {
                required: "Please select an address type."
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

    $('form.updateAddressForm').each(function(){
        $(this).validate({
            rules: {
                city: {
                    required: true
                },
                unit: {
                    required: true
                },
                street: {
                    required: true
                },
                brgy: {
                    required: true
                },
                type: {
                    required: true
                }
            },
            messages: {
                city: {
                    required: "Please select your city."
                },
                unit: {
                    required: "Please enter the condo/apartment unit number or house street number."
                },
                street: {
                    required: "Please enter your street."
                },
                brgy: {
                    required: "Please enter your Barangay/Village."
                },
                type: {
                    required: "Please select an address type."
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
    });

    $('form#food-preferences').validate({
        rules: {
            foodPref: {
                required: true
            }
        },
        messages: {
            foodPref: {
                required: "Please pick a preference."
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
    // console.log(otherValues);
    var lengthOtherValues = otherValues.length;
    $.each(otherValues, function (index,element) {
        // console.log(element);
        if(index != (lengthOtherValues - 1)){
            $('#allrg-others').val($('#allrg-others').val()+element+ ',');
        }else{
            $('#allrg-others').val($('#allrg-others').val()+element);
        }
    });
    function mobileAjax(mobile) {
        return $.ajax({
            url:'/foodie/mobile/'+mobile
        });
    }
    $('#mobile-num').blur(function () {
        var mobile = mobileAjax($(this).val());
        mobile.done(
            function (response) {
                console.log(response);
            }
        );
    });
        // $('input.allergyCheckbox:checkbox').each(function (){
        //     if($(this).attr('name')!=$this.attr('allergy')){
        //         $('#allrg-others').val($('#allrg-others').val()+$(this).attr('name'));
        //     }
        // });

    // $('#allergies').submit(function (event) {
    //     event.preventDefault();
    //     var checkAllergies = [];
    //     $('.allergyCheckbox').each(function () {
    //         if($(this).is(':checked')){
    //             checkAllergies.push($(this).attr('name'));
    //         }
    //     });
    //
    //     if(($.trim($('#allrg-others').val)) != ""){
    //         var otherAllergies= $('#allrg-others').val().split(',');
    //         checkAllergies.push(otherAllergies);
    //     }
    //     // $.each(otherAllergies,function () {
    //     //     checkAllergies.push($(this));
    //     // });
    //
    // });

});