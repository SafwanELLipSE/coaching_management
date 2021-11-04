$(function () {
    bsCustomFileInput.init();
    //Initialize Select2 Elements
    $('.select2').select2({
        theme: 'bootstrap4'
    })
    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
    $('#reservationdate').datetimepicker({
        format: 'D-M-Y',
    });
})
// ----- Image View ----- //
$(document).ready(function(){
    $(".student_image").change(function(data){
        var imageFile = data.target.files[0];
        var reader = new FileReader();
        reader.readAsDataURL(imageFile);
        reader.onload = function(evt){
            $('#imagePreview').attr('src', evt.target.result);
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }		
    });
});
// --- Wizard Form ----//
(function() {
    // 'use strict';
    var options = {
        mode: 'wizard',
        autoButtonsNextClass: 'btn btn-dark-moon float-right',
        autoButtonsPrevClass: 'btn btn-dark-red',
        stepNumberClass: 'badge badge-pill badge-dark-blue mr-1',
        beforeNextStep:function(currentStep){
            if(currentStep == 1){
                if($('#student_name').val().length < 4){
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'Student Name Error',
                        subtitle: 'Recheck',
                        body: 'Name of Student is less than four words.'
                    })
                    return false;
                }
                if(validateEmail($('#student_email').val()) == false){
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'Student Email Error',
                        subtitle: 'Recheck',
                        body: 'Name of Student is less than four words.'
                    })
                    return false;
                }
                if(validateMobileNumber($('#student_phone').val()) == false){
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'Student Mobile Error',
                        subtitle: 'Recheck',
                        body: 'Mobile of Student is wrong.'
                    })
                    return false;
                }
                if($('#student_dob').val() == ""){
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'Birth Date Error',
                        subtitle: '',
                        body: 'You have to give your Birth date'
                    })
                    return false;
                }
                if($('#student_gender').val() == null){
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'Student Gender Error',
                        subtitle: '',
                        body: 'You have select a Gender.'
                    })
                    return false;
                }
                return true;
            }
            if(currentStep == 2){
                if($('#select_class').val() == null){
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'Student Class Error',
                        subtitle: '',
                        body: 'You have select a Class.'
                    })
                    return false;
                }
                if($('#list_courses').val().length == 0){
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'Student Course Error',
                        subtitle: '',
                        body: 'You have select a Course.'
                    })
                    return false;
                }
                return true;
            }
            if(currentStep == 3){
                if($('#father_name').val().length == 0){
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'Father Name Error',
                        subtitle: '',
                        body: 'You have enter your father name.'
                    })
                    return false;
                }
                if($('#father_nid').val().length == 0){
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'Father NID Error',
                        subtitle: '',
                        body: 'You have enter your father National ID.'
                    })
                    return false;
                }
                if(isNumeric($('#father_nid').val()) == false){
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'Father NID Error',
                        subtitle: '',
                        body: 'National ID only have to be consist of numbers or digits'
                    })
                    return false;
                }
                if($('#father_occupation').val() == null){
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'Father NID Error',
                        subtitle: '',
                        body: 'You have enter your father Occupation.'
                    })
                    return false;
                }
                if($('#mother_name').val().length == 0){
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'Mother Name Error',
                        subtitle: '',
                        body: 'You have enter your mother name.'
                    })
                    return false;
                }
                if($('#mother_nid').val().length == 0){
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'Mother NID Error',
                        subtitle: '',
                        body: 'You have enter your mother National ID.'
                    })
                    return false;
                }
                if(isNumeric($('#mother_nid').val()) == false){
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'Mother NID Error',
                        subtitle: '',
                        body: 'National ID only have to be consist of numbers or digits'
                    })
                    return false;
                }
                if($('#mother_occupation').val() == null){
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'Mother NID Error',
                        subtitle: '',
                        body: 'You have enter your mother Occupation.'
                    })
                    return false;
                }
                if(validateEmail($('#guidance_email').val()) == false){
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'Guidance Email Error',
                        subtitle: '',
                        body: 'You have problem with your Guidance Email.'
                    })
                    return false;
                }
                if(validateMobileNumber($('#guidance_phone').val()) == false){
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'Guidance Phone Error',
                        subtitle: '',
                        body: 'You have problem with your Guidance Phone.'
                    })
                    return false;
                }
                return true;
            }
        }
    }

    $("#formStudent").accWizard(options);
})();

function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
function validateMobileNumber(mobile) {
    var mobileNumber = /(^(\+8801|8801|01|008801))[1|3-9]{1}(\d){8}$/;
    if(mobile.match(mobileNumber)){
	    return true
	}else{
        return false;
    }
}
function isNumeric(str) {
    return !isNaN(str)
}
