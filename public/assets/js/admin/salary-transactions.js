$(function () {
    $('#transactionsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: window.location.href,
        columns: [
            { data: 'DT_RowIndex',    name: 'DT_RowIndex',   orderable: false, searchable: false },
            { data: 'employee',       name: 'employee' },
            { data: 'month',          name: 'month',          orderable: false },
            { data: 'amount',         name: 'amount' },
            { data: 'payment_method', name: 'payment_method', orderable: false },
            { data: 'status',         name: 'status' },
            { data: 'transaction_id', name: 'transaction_id', orderable: false },
            { data: 'created_at',     name: 'created_at' },
        ],
        pageLength: 15,
        order: [[7, 'desc']],
    });
});
