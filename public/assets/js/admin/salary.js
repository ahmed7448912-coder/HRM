$(function () {
    $('#salaryTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: window.location.href,
        columns: [
            { data: 'employee',     name: 'employee' },
            { data: 'month',        name: 'month' },
            { data: 'amount',       name: 'amount' },
            { data: 'status',       name: 'status' },
            { data: 'paid_at',      name: 'paid_at' },
            { data: 'email_status', name: 'email_status', orderable: false, searchable: false },
            { data: 'actions',      name: 'actions',      orderable: false, searchable: false, className: 'text-end' },
        ],
        pageLength: 15,
        order: [[0, 'asc']],
    });
});
