$(function () {
    $("#examination").change(function() {
        var _token = $('meta[name="_token"]').attr('content');
        var x = document.getElementById("examination").value;
        var ssl = $('meta[name="ssl"]').attr('content');

        $.ajax({
            url: ssl + window.location.hostname + "/question/count",
            type: 'POST',
            data: {
                id: x,
                _token
            },
            success: function (data) {
                document.getElementById("countExam").innerHTML = "("+data+")"; 
            },
        });
    });
    $("#mark").change(function() {
        var _token = $('meta[name="_token"]').attr('content');
        var mark = document.getElementById("mark").value;
        var exam_id = document.getElementById("examination").value;
        var ssl = $('meta[name="ssl"]').attr('content');

        $.ajax({
            url: ssl + window.location.hostname + "/question/remainer-mark",
            type: 'POST',
            data: {
                id: exam_id,
                mark: mark,
                _token
            },
            success: function (data) {
                document.getElementById("restOfMarks").innerHTML = "("+data+")"; 
            },
        });
    });
    
    bsCustomFileInput.init();
        //Initialize Select2 Elements
    $('.select2').select2({
        theme: 'bootstrap4'
    })
    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
    // Summernote
    $('#summernote').summernote({
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['table', ['table']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['view', ['fullscreen', 'codeview', 'help']],
    ]
    })
})

function myFunction() {
    $('#demo').empty();
    var x = document.getElementById("myOption").value;
    var count = 1;
    for(i=0; i<x; i++){
        $("#demo").append('<div class="col-3"><div class="form-group"><label for="question">Answer Option '+count+'</label><input type="text" name="option'+count+'" class="form-control form-control-border border-width-2" id="option'+count+'" placeholder="Enter Option '+count+'"></div></div>');
        count++;
    }
}