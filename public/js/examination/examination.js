$("#select_classroom").change(function() {
    var _token = $('meta[name="_token"]').attr('content');
    var x = document.getElementById("select_classroom").value;
    var ssl = $('meta[name="ssl"]').attr('content');

    $.ajax({
        url: ssl + window.location.hostname + "/exam/status-exam-count",
        type: 'POST',
        data: {
            id: x,
            _token
        },
        success: function (data) {
            $("#statusClassroom").show(500);
            document.getElementById("writtenQuestion").innerHTML = data.countWritten; 
            document.getElementById("mcqQuestion").innerHTML = data.countMcq;
            document.getElementById("totalMarks").innerHTML = data.totalMarks;
        },
    });
});



let el = document.getElementById("exam_marks");
el.addEventListener("input", function() {
    var _token = $('meta[name="_token"]').attr('content');
    var x = document.getElementById("select_classroom").value;
    var y = document.getElementById("exam_marks").value;
    var ssl = $('meta[name="ssl"]').attr('content');

    $.ajax({
        url: ssl + window.location.hostname + "/exam/mark-checker",
        type: 'POST',
        data: {
            id: x,
            numbers: y,
            _token
        },
        success: function (data) {
            document.getElementById("markDiffer").innerHTML = "("+data+")"; 
        },
    });
});