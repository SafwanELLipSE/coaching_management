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
    $('#reservationdate2').datetimepicker({
        format: 'D-M-Y',
    });
        //Timepicker
    $('#timepicker').datetimepicker({
        format: 'LT'
    })
    $('#timepicker2').datetimepicker({
        format: 'LT'
    })
})