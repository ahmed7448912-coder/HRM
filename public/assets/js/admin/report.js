$(document).ready(function() {
    
    // Toast configuration
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });

    let attendanceTable = $('#attendanceTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/admin/reports',
            data: function (d) {
                d.type = 'attendance';
                d.from_date = $('#from_date').val();
                d.to_date = $('#to_date').val();
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'employee', name: 'employee.name' },
            { data: 'date', name: 'date' },
            { data: 'status', name: 'status' }
        ]
    });

    $('#filterAttendance').click(function() {
        attendanceTable.ajax.reload(function() {
            Toast.fire({
                icon: 'success',
                title: 'Report filtered successfully'
            });
        });
    });
});