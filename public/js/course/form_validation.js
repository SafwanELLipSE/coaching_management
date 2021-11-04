$('#courseForm').validate({
    rules: {
        course_name: {
            required: true,
        },
        course_code: {
            required: true,
        },
        course_mark: {
            required: true,
        },
    },
    messages: {
        course_name: {
            required: "Please enter your Course Name.",
        },
        course_code: {
            required: "Please enter your Course Code.",
        },
        course_mark: {
            required: "Please enter your Course Mark.",
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