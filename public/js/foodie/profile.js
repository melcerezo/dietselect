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

    $.validator.addMethod('minImageWidth', function(value, element, minWidth) {
        return ($(element).data('imageWidth') || 0) > minWidth;
    }, function(minWidth, element) {
        var imageWidth = $(element).data('imageWidth');
        return (imageWidth)
            ? ("Your image's width must be greater than " + minWidth + "px")
            : "Selected file is not an image.";
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
            },
            avatar:{
                accept: "image/jpg,image/jpeg,image/png,image/gif",
                minImageWidth:200
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
            },
            avatar:{
                accept: "Images only!"
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
                required: true,
                maxlength: 255
            },
            unit: {
                required: true,
                maxlength: 255
            },
            street: {
                required: true,
                maxlength: 255
            },
            brgy: {
                required: true,
                maxlength: 255
            },
            type: {
                required: true,
                maxlength: 255
            },
            remarks:{
                maxlength: 255
            }
        },
        messages: {
            city: {
                required: "Please select your city.",
                maxlength:"No more than 255 characters please."
            },
            unit: {
                required: "Please enter the condo/apartment unit number or house street number.",
                maxlength:"No more than 255 characters please."
            },
            street: {
                required: "Please enter your street.",
                maxlength:"No more than 255 characters please."
            },
            brgy: {
                required: "Please enter your Barangay/Village.",
                maxlength:"No more than 255 characters please."
            },
            type: {
                required: "Please select an address type.",
                maxlength:"No more than 255 characters please."
            },
            remarks: {
                maxlength:"No more than 255 characters please."
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
                },
                remarks:{
                    maxlength: 255
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
                },
                remarks: {
                    maxlength:"No more than 255 characters please."
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
    function nameAjax(name){
        return $.ajax({
            url: '/foodie/username/'+name
        });
    }
    $('#mobile-num').on('keydown keyup', function(e){
        if ($(this).val().length >= 10
            && e.keyCode != 46 // delete
            && e.keyCode != 8 // backspace
            && e.keyCode != 9 // tab
        ) {
            e.preventDefault();
            // $(this).val(100);
        }else{
            if(e.shiftKey && ((e.keyCode >=48 && e.keyCode <=57)
                || (e.keyCode >=186 &&  e.keyCode <=222))){
                // Ensure that it is a number and stop the Special chars
                e.preventDefault();
            }
            else if ((e.shiftKey || e.ctrlKey) && (e.keyCode > 34 && e.keyCode < 40)){
                // let it happen, don't do anything
            }
            else{
                // Allow only backspace , delete, numbers
                if (e.keyCode == 9 || e.keyCode == 46 || e.keyCode == 8 || e.keyCode == 39 ||e.keyCode == 37
                    || (e.keyCode >=48 && e.keyCode <=57)) {
                    // let it happen, don't do anything
                }
                else {
                    // Ensure that it is a number and stop the key press
                    e.preventDefault();
                }
            }
        }
    });
    // $('#address-remarks').on('keydown keyup', function(e) {
    //     if ($(this).val().length >= 255
    //         && e.keyCode != 46 // delete
    //         && e.keyCode != 8 // backspace
    //         && e.keyCode != 9 // tab
    //     ) {
    //         e.preventDefault();
    //         // $(this).val(100);
    //     }
    // });
    $('#allrg-others').on('keydown keyup', function(e) {
        if ($(this).val().length >= 255
            || e.keyCode == 32 // space
        ) {
            e.preventDefault();
            // $(this).val(100);
        }
    });

    var $photoInput = $('#avatar'),
        $imgContainer = $('#imgContainer');

    $('#avatar').change(function() {
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
                    if (imageWidth < 200) {
                        $('#avatarBefore').show();
                        $imgContainer.hide();
                    } else {
                        $('#avatarBefore').hide();
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
    $('#prfSvBtn').on('click',function () {
        var fileInput = $('#basic-profile').find("input[type=file]")[0],
            file = fileInput.files && fileInput.files[0];
        if(!(file)){
            $('#avatar').rules('remove','minImageWidth');
        }
        if($('#mobile-num').val()!=foodiePhone && $('#username').val()!=username) {
            var mobile = mobileAjax($('#mobile-num').val());
            if($('#username').val()==null){
                var name = nameAjax('n');
            }else{
                var name = nameAjax($('#username').val());
            }
            $.when(
                mobile.done(function (response) {
                    mobiletruth = response;
                }),
                name.done(function (response) {
                    nametruth = response;
                })
            ).then(function () {
                if (mobiletruth == "true" && nametruth == "true") {
                    $('.error-msg-mobile-num').empty();
                    $('.error-msg-mobile-num').append('<span>This mobile number exists already.</span>');
                    $('.error-username').empty();
                    $('.error-username').append('<span>This username exists already.</span>');
                } else if (mobiletruth == "true") {
                    $('.error-msg-mobile-num').empty();
                    $('.error-msg-mobile-num').append('<span>This mobile number exists already.</span>');
                } else if (nametruth == "true") {
                    $('.error-username').empty();
                    $('.error-username').append('<span>This username exists already.</span>');
                } else {
                    $('#basic-profile').unbind('submit').submit();
                }

            });
        }else if($('#mobile-num').val()!=foodiePhone){
            var mobile = mobileAjax($('#mobile-num').val());
            mobile.done(
                function (response) {
                    if (response == "true") {
                        $('.error-msg-mobile-num').empty();
                        $('.error-msg-mobile-num').append('<span>This mobile number exists already.</span>');
                        console.log(response);
                    } else if (response == "false" && $('#basic-profile').valid()) {
                        $('.error-msg-mobile-num').empty();
                        console.log($('#mobile-num').val());
                        $('#basic-profile').unbind('submit').submit();
                    }
                }
            );
        }else if($('#username').val()!=username){
            if($('#username').val()==""){
                var name = nameAjax('n');
            }else{
                var name = nameAjax($('#username').val());
            }
            name.done(
                function (response) {
                    if (response == "true") {
                        $('.error-username').empty();
                        $('.error-username').append('<span>This username exists already.</span>');
                        // console.log(response);
                    } else if (response == "false" && $('#basic-profile').valid()) {
                        $('.error-username').empty();
                        // console.log($('#mobile-num').val());
                        $('#basic-profile').unbind('submit').submit();
                    }
                }
            );
        }else{
            if($('#basic-profile').valid()){
                $('#basic-profile').submit();
            }
        }
       // if($('.error-msg-mobile-num').children().length > 0 && !($('#basic-profile').valid())){
       //     e.preventDefault();
       // }
    }
    );


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