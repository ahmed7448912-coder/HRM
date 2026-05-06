$(document).ready(function() {
    let table = $('#leaveTable').DataTable({
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

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });

    // Handle Status Update via Dropdown
    $(document).on('change', '.statusDropdown', function() {
        let id = $(this).data('id');
        let status = $(this).val();
        
        Swal.fire({
            title: 'Change Status?',
            text: `Are you sure you want to set this leave to ${status}?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, change it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/leave/${id}`,
                    type: 'PATCH',
                    data: {
                        status: status,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Status updated and email sent!'
                        });
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        Swal.fire('Error!', 'Something went wrong while updating.', 'error');
                        table.ajax.reload();
                    }
                });
            } else {
                table.ajax.reload();
            }
        });
    });

    // Handle Delete
    $(document).on('click', '.deleteBtn', function() {
        let id = $(this).data('id');
        
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/leave/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire('Deleted!', 'Leave request has been deleted.', 'success');
                        table.ajax.reload();
                    },
                    error: function() {
                        Swal.fire('Error!', 'Could not delete the record.', 'error');
                    }
                });
            }
        });
    });
});