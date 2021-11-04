$(document).ready(function() {
    var _token = $('meta[name="_token"]').attr('content');
    var ssl = $('meta[name="ssl"]').attr('content');

    function populate_students() {
        dataTable = $('#student_table').DataTable({
            "serverSide": true,
            "processing": false,
            "pageLength": 20,
            "order": [],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
            "ajax": {
                url: ssl + window.location.hostname + "/student/list",
                type: "POST",
                data: {
                    'class': $("#class").val(),
                    'status': $("#status").val(),
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
    populate_students();

    $("#status").on("change", function() {
        dataTable.destroy();
        populate_students();
    });

    $("#class").on("change", function() {
        dataTable.destroy();
        populate_students();
    });

    $("#student_table").on("click", '#delete-student', function() {
        var student_id = $(this).attr("data-student-id");
        $.ajax({
            url: ssl + window.location.hostname + "/student/delete",
            type: "POST",
            data: {
                'id': student_id,
                _token
            },
            success: function(response) {
                $('#student_table').DataTable().destroy();
                populate_students();
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