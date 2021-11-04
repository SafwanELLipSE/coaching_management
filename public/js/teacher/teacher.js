$(function () {
    bsCustomFileInput.init();
    $('#reservationdate').datetimepicker({
        format: 'D-M-Y',
    });
})

$(document).ready(function(){
    $(".teacher_image").change(function(data){

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