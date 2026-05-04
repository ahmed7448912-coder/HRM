$(function () {

    $('#leaveTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/leave',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'employee' },
            { data: 'type' },
            { data: 'from_date' },
            { data: 'to_date' },
            { data: 'status' },
            { data: 'actions', orderable: false, searchable: false }
        ]
    });

});