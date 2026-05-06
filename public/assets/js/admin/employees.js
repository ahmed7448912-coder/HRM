$(document).ready(function () {
    const tableId = '#employeesTable';
    
    if ($(tableId).length > 0) {
        $(tableId).DataTable({
            processing: true,
            serverSide: true,
            ajax: '/admin/employees',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'image', name: 'image', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'department', name: 'department' },
                { data: 'salary', name: 'salary' },
                { data: 'joining_date', name: 'joining_date' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false, className: 'text-center' }
            ]
        });
    }

    // Delete
    $(document).on('click', '.deleteBtn', function () {
        let id = $(this).data('id');
        let url = '/admin/employees/' + id;

        Swal.fire({
            title: 'Are you sure?',
            text: "All data related to this employee will be deleted!",
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
                        Swal.fire('Deleted!', 'Employee has been removed.', 'success');
                        $(tableId).DataTable().ajax.reload();
                    },
                    error: function() {
                        Swal.fire('Error!', 'Could not delete the employee.', 'error');
                    }
                });
            }
        });
    });
});