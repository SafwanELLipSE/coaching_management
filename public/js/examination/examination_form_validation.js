$('#examForm').validate({
    rules: {
        exam_name:{
            required: true,
        },
        select_exam_type:{
            required: true,
        },
        select_classroom:{
            required: true,
        },
        exam_date:{
            required: true,
        },
        exam_start_time:{
            required: true,
        },
        exam_end_time:{
            required: true,
        },
        exam_marks:{
            required: true,
            number: true,
            digits: true,
            min: 0,
        },
    },
    messages: {
        exam_name: {
            required: "Please enter your Examination Name.",
        },
        select_exam_type: {
            required: "Select a Examination Type.",
        },
        select_classroom: {
            required: "Select a Classroom.",
        },
        exam_date: {
            required: "Please enter your Starting Date",
        },
        exam_start_time: {
            required: "Please enter Starting Time",
        },
        exam_end_time: {
            required: "Please enter your Ending Time",
        },
        exam_marks: {
            required: "Please enter Examination Marks",
            number: "Only can use Number",
            digits: "Only can use Digit",
            min: "please provide value greater than or equal to 0",
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