$(document).ready(function () {
    const tableId = '#departments-table';
    
    if ($(tableId).length > 0) {
        $(tableId).DataTable({
            ajax: '/admin/departments',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'code', name: 'code' },
                { data: 'description', name: 'description' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false, className: 'text-end' }
            ]
        });
    }

    // Delete
    $(document).on('click', '.deleteBtn', function () {
        let id = $(this).data('id');
        let url = '/admin/departments/' + id;

        Swal.fire({
            title: 'Are you sure?',
            text: "All employees in this department will be affected!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        Swal.fire('Deleted!', 'Department has been removed.', 'success');
                        $(tableId).DataTable().ajax.reload();
                    },
                    error: function() {
                        Swal.fire('Error!', 'Could not delete the department.', 'error');
                    }
                });
            }
        });
    });
});
