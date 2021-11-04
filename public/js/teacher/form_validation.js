$('#teacherForm').validate({
    rules: {
        teacher_name: {
            required: true,
        },
        teacher_email: {
            required: true,
            email: true
        },
        teacher_phone: {
            required: true,
        },
        national_id: {
            required: true,
            number: true,
            digits: true,
            min: 0,
        },
        teacher_gender: {
            required: true,
        },
        teacher_dob:{
            required: true,
        },
        teacher_experience: {
            required: true,
        },
        teacher_qualification: {
            required: true,
        },
        teacher_institute: {
            required: true,
        },
        teacher_image:{
            required: true,
        },
        teacher_salary:{
            required: true,
            number: true,
            digits: true,
            min: 0,
        },
        teacher_designation:{
            required: true,
        },
        teacher_subject:{
            required: true,
        },
        teacher_address: {
            required: true,
        },
    },
    messages: {
        teacher_name: {
            required: "Please enter your Teacher Name.",
        },
        teacher_email: {
            required: "Please enter your Teacher Email.",
            email: "Please enter a valid email address."
        },
        teacher_phone: {
            required: "Please enter your Teacher Phone.",
        },
        national_id: {
            required: "Please enter your National ID.",
            number: "Only can use Number",
            digits: "Only can use Digit",
            min: "please provide value greater than or equal to 0",
        },
        teacher_gender: {
            required: "Select a Gender.",
        },
        teacher_dob: {
            required: "Please enter your Date of Birth",
        },
        teacher_experience: {
            required: "Please enter your Experience",
        },
        teacher_qualification: {
            required: "Please enter your Teacher's Qualification",
        },
        teacher_institute: {
            required: "Please enter your Teacher's Institute",
        },
        teacher_image:{
            required: "Please Upload your Image",
        },
        teacher_salary: {
            required: "Please enter your Teacher's Salary",
            number: "Only can use Number",
            digits: "Only can use Digit",
            min: "please provide value greater than or equal to 0",
        },
        teacher_designation:{
            required: "Please enter your Designation",
        },
        teacher_subject:{
            required: "Please enter your Subject for Teaching",
        },
        teacher_address: {
            required: "Please enter your Address",
        },
    },
        errorElement: 'span',
        errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    }
});