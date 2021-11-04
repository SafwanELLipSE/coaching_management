function studentList(){
    var _token = $('meta[name="_token"]').attr('content');
    var classroom_id = document.getElementById("select-classroom").value;
    var ssl = $('meta[name="ssl"]').attr('content');
    $('exam_table_data').empty();
    if(classroom_id == ""){
        Swal.fire({
            title: "ERROR!",
            text: "Please Select a Classroom",
            type: "error",
        });
    }
    else{
        $.ajax({
            url: ssl + window.location.hostname + "/attendance/student-list",
            type: 'POST',
            data: {
                id: classroom_id,
                _token
            },
            success: function(response) {
                document.getElementById('student-attendance').style.display = 'block';
                document.getElementById('exam_table').style.display = 'table';
                $('#exam_table_data').html(response);
            },
            error: function (response) {
                Swal.fire({
                    title: "ERROR!",
                    text: response.responseJSON,
                    type: "error",
                });
            },
        });
        $.ajax({
            url: ssl + window.location.hostname + "/attendance/classroom-detail",
            type: 'POST',
            data: {
                id: classroom_id,
                _token
            },
            success: function(response) {
                document.getElementById('onPickClass').style.display = 'block';
                document.getElementById('onPickClass2').style.display = 'block';
                classroom = JSON.parse(response);
                
                document.getElementById('classroomClass').innerHTML = classroom.nameClass;
                document.getElementById('classroomCourse').innerHTML = classroom.nameCourse;
                document.getElementById('startTime').innerHTML = classroom.start_time;
                document.getElementById('daysOfWeek').innerHTML = classroom.days;
                document.getElementById('enrolledStudent').innerHTML = `${classroom.enrolled}/${classroom.capacity}`;
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
};