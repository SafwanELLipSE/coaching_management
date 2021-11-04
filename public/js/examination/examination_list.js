$(document).ready(function() {
    var _token = $('meta[name="_token"]').attr('content');
    var ssl = $('meta[name="ssl"]').attr('content');

    function populate_exams() {
        dataTable = $('#exam_table').DataTable({
            "serverSide": true,
            "processing": false,
            "pageLength": 20,
            "order": [],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
            "ajax": {
                url: ssl + window.location.hostname + "/exam/list",
                type: "POST",
                data: {
                    'classroom': $("#classroom").val(),
                    'status': $("#status_exam").val(),
                    'type': $("#type_exam").val(),
                    _token
                },
            },
            "language": {
                "paginate": {
                    "previous": "&#706",
                    "next": "&#707"
                }
            }
        });

    }
    populate_exams();

    $("#type_exam").on("change", function() {
        dataTable.destroy();
        populate_exams();
    });

    $("#status_exam").on("change", function() {
        dataTable.destroy();
        populate_exams();
    });

    $("#classroom").on("change", function() {
        dataTable.destroy();
        populate_exams();
    });

    $("#exam_table").on("click", '#delete-exam', function() {
        var student_id = $(this).attr("data-exam-id");
        $.ajax({
            url: ssl + window.location.hostname + "/exam/delete",
            type: "POST",
            data: {
                'id': exam_id,
                _token
            },
            success: function(response) {
                $('#exam_table').DataTable().destroy();
                populate_exams();
                Swal.fire({
                    title: "SUCCESS!!",
                    text: response,
                    type: "success",
                });
            },
            error: function(response) {
                Swal.fire({
                    title: "ERROR!",
                    text: response.responseJSON,
                    type: "error",
                });
            }
        });
    });

});