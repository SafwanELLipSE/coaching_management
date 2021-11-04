$(document).ready(function() {
    var _token = $('meta[name="_token"]').attr('content');
    var ssl = $('meta[name="ssl"]').attr('content');

    function populate_classrooms() {

        dataTable = $('#classroom_table').DataTable({
            "serverSide": true,
            "processing": false,
            "pageLength": 20,
            "order": [],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
            ],
            "ajax": {
                url: ssl + window.location.hostname + "/classroom/list",
                type: "POST",
                data: {
                    'class': $("#class").val(),
                    'course': $("#course").val(),
                    'teacher': $("#teacher").val(),
                    'status': $("#status_teacher").val(),
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
    populate_classrooms();

    $("#status_teacher").on("change", function() {
        dataTable.destroy();
        populate_classrooms();
    });

    $("#course").on("change", function() {
        dataTable.destroy();
        populate_classrooms();
    });

    $("#teacher").on("change", function() {
        dataTable.destroy();
        populate_classrooms();
    });

    $("#class").on("change", function() {
        dataTable.destroy();
        populate_classrooms();
    });

    $("#classroom_table").on("click", '#delete-classroom', function() {
        var classroom_id = $(this).attr("data-classroom-id");
        $.ajax({
            url: ssl + window.location.hostname + "/classroom/delete",
            type: "POST",
            data: {
                'id': classroom_id,
                _token
            },
            success: function(response) {
                $('#classroom_table').DataTable().destroy();
                populate_classrooms();
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