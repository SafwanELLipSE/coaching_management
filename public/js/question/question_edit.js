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

$("#myOption").ready(function(){
    $('#demo').empty();
    var x = document.getElementById("myOption").value;
    var options = document.getElementById("list_options").value;
    var y = options.split(",");
    var count = 1;
    for(i=0; i<x; i++){
        if(y[i] != null){
            $("#demo").append('<div class="col-3"><div class="form-group"><label for="question">Answer Option '+count+'</label><input type="text" name="option'+count+'" class="form-control form-control-border border-width-2" value="'+y[i]+'" id="option'+count+'" placeholder="Enter Option '+count+'"></div></div>');
        }
        else{
            $("#demo").append('<div class="col-3"><div class="form-group"><label for="question">Answer Option '+count+'</label><input type="text" name="option'+count+'" class="form-control form-control-border border-width-2" value="" id="option'+count+'" placeholder="Enter Option '+count+'"></div></div>');
        }    
        count++;
    }
});

function myFunction() {
    // $('#myOption').change
    $('#demo').empty();
    var x = document.getElementById("myOption").value;
    var options = document.getElementById("list_options").value;
    var y = options.split(",");
    var count = 1;

    for(i=0; i<x; i++){
        if(y[i] != null){
            $("#demo").append('<div class="col-3"><div class="form-group"><label for="question">Answer Option '+count+'</label><input type="text" name="option'+count+'" class="form-control form-control-border border-width-2" value="'+y[i]+'" id="option'+count+'" placeholder="Enter Option '+count+'"></div></div>');
        }
        else{
            $("#demo").append('<div class="col-3"><div class="form-group"><label for="question">Answer Option '+count+'</label><input type="text" name="option'+count+'" class="form-control form-control-border border-width-2" value="" id="option'+count+'" placeholder="Enter Option '+count+'"></div></div>');
        }    
        count++;
    }
}