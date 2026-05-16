$(document).ready(function() {
    let table = $('#performanceTable').DataTable({
        ajax: '/admin/performance',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'employee' },
            { data: 'rating' },
            { data: 'review' },
            { data: 'formatted_date', name: 'review_date' },
            { data: 'actions', orderable: false, searchable: false, className: 'text-end' }
        ]
    });
    // toast message for success and error
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });
   // add performance review
    $('#addPerformance').click(function() {
        $('#performanceForm')[0].reset();
        $('#performanceId').val('');
        $('input[name="rating"]').prop('checked', false);
        $('#modalTitle').text('Add Performance Review');
        $('#performanceModal').modal('show');
    });
    // edit performance review
    $(document).on('click', '.editBtn', function() {
        let id = $(this).data('id');
        $('#performanceId').val(id);
        $('#employee_id').val($(this).data('employee_id'));
        let rating = $(this).data('rating');
        $(`input[name="rating"][value="${rating}"]`).prop('checked', true);
        $('#review').val($(this).data('review'));
        $('#review_date').val($(this).data('review_date'));
        $('#modalTitle').text('Edit Performance Review');
        $('#performanceModal').modal('show');
    });
      // save performance review
    $('#performanceForm').submit(function(e) {
        e.preventDefault();
        let id = $('#performanceId').val();
        let url = id ? `/admin/performance/${id}` : '/admin/performance';
        let method = id ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            type: method,
            data: $(this).serialize(),
            success: function(response) {
                $('#performanceModal').modal('hide');
                Toast.fire({
                    icon: 'success',
                    title: response.message
                });
                table.ajax.reload();
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                let errorMsg = '';
                $.each(errors, function(key, value) {
                    errorMsg += value[0] + '\n';
                });
                Swal.fire('Error!', errorMsg, 'error');
            }
        });
    });
    // delete performance review
    $(document).on('click', '.deleteBtn', function() {
        let id = $(this).data('id');
        
        Swal.fire({
            title: 'Are you sure?',
            text: "This performance review will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/performance/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Toast.fire({
                            icon: 'success',
                            title: response.message
                        });
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