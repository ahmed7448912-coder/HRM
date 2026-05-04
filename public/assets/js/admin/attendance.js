$(document).ready(function () {
    const tableId = '#attendanceTable';
    
    if ($(tableId).length > 0) {
        $(tableId).DataTable({
            processing: true,
            serverSide: true,
            ajax: $(tableId).data('url'),
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'employee', name: 'employee' },
                { data: 'date', name: 'date' },
                { data: 'check_in', name: 'check_in' },
                { data: 'check_out', name: 'check_out' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false, className: 'text-center' }
            ],
            language: {
                paginate: {
                    previous: "<i class='bi bi-chevron-left'></i>",
                    next: "<i class='bi bi-chevron-right'></i>"
                }
            }
        });
    }

    // Delete
    $(document).on('click', '.deleteBtn', function () {
        let id = $(this).data('id');
        let url = $(tableId).data('url') + '/' + id;

        if (confirm('Are you sure you want to delete this record?')) {
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.success) {
                        $(tableId).DataTable().ajax.reload();
                    }
                },
                error: function() {
                    alert('Error deleting record.');
                }
            });
        }
    });
});