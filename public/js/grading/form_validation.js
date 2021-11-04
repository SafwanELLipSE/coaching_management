$('#courseForm').validate({
    rules: {
        grade: {
            required: true,
        },
        starting_range: {
            required: true,
        },
        ending_range: {
            required: true,
        },
        point: {
            required: true,
        },
    },
    messages: {
        grade: {
            required: "Please enter your Grade.",
        },
        starting_range: {
            required: "Please enter your Starting Mark.",
        },
        ending_range: {
            required: "Please enter your Ending Mark.",
        },
        point: {
            required: "Please enter your GPA Point.",
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