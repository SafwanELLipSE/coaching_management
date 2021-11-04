$('#classroomForm').validate({
    rules: {
        classroom_name: {
            required: true,
        },
        select_class: {
            required: true,
        },
        select_course: {
            required: true,
        },
        select_teacher: {
            required: true,
        },
        student_capacity:{
            required: true,
            number: true,
            digits: true,
            min: 0,
        },
        list_days:{
            required: true,
        },
        start_time: {
            required: true,
        },
        end_time: {
            required: true,
        },
        starting_date: {
            required: true,
        },
        ending_date:{
            required: true,
        },
    },
    messages: {
        classroom_name: {
            required: "Please enter your Classroom Name.",
        },
        select_class: {
            required: "Select a Class.",
        },
        select_course: {
            required: "Select a Course.",
        },
        select_teacher: {
            required: "Select a Teacher.",
        },
        student_capacity: {
            required: "Please enter your Capacity of Student",
            number: "Only can use Number",
            digits: "Only can use Digit",
            min: "please provide value greater than or equal to 0",
        },
        "list_days[]": {
            required: "Please enter your Days",
        },
        start_time: {
            required: "Please enter Starting Time",
        },
        end_time: {
            required: "Please enter Ending Time",
        },
        starting_date: {
            required: "Please enter your Starting Date",
        },
        ending_date:{
            required: "Please Upload your Ending Date",
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