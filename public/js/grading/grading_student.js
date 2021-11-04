$("#totalMarkCalculation").click(function(){
    let countExam = $('#numberOfExam').val();
    let per=[], obt = [], examMark = [], calculation = [], totalMarks = 0;
    for(var i=0; i<=countExam; i++){
        obt[i-1] = $("#obtain"+i).val();
        per[i-1] = $("#percentage"+i).val();
        examMark[i-1] = $("#examMark"+i).val();

        if(obt[i-1] && per[i-1] && examMark[i-1]){
            calculation[i-1] = (obt[i-1] / examMark[i-1]) * per[i-1] ;
            totalMarks += calculation[i-1];
            $("#markCalulation"+i).empty();
            $("#markCalulation"+i).append('<input type="text" valve="" class="form-control form-control-border border-width-2 mx-auto" value="'+calculation[i-1]+'" style="width:60%;">');
        }
    }
    document.getElementById("calculatedTotal").setAttribute("value",totalMarks)
})

function gradeCalculation(){
    var _token = $('meta[name="_token"]').attr('content');
    var ssl = $('meta[name="ssl"]').attr('content');
    $('#viewGradeLayer').show(500);
    var wholeMarks = $("#calculatedTotal").val();
    document.getElementById("total_mark").setAttribute("value",wholeMarks);

    $.ajax({
        url: ssl + window.location.hostname + "/studentGrade/determine-grade",
        type: 'POST',
        data: {
            marks: wholeMarks,
            _token
        },
        success: function(response) {
            
        },
        error: function (response) {
            Swal.fire({
                title: "ERROR!",
                text: response.responseJSON,
                type: "error",
            });
        },
    });
}