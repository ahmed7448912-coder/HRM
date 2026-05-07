$(document).ready(function () {

    // ── DataTable ──────────────────────────────────────────────
    $('#payrollTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/payroll',          // hits index() via AJAX
        columns: [
            { data: 'DT_RowIndex',  name: 'DT_RowIndex',  orderable: false, searchable: false },
            { data: 'employee',     name: 'employee' },
            { data: 'month',        name: 'month' },
            { data: 'basic_salary', name: 'basic_salary' },
            { data: 'absents',      name: 'absents' },
            { data: 'deductions',   name: 'deductions' },
            { data: 'net_salary',   name: 'net_salary' },
            { data: 'actions',      name: 'actions', orderable: false, searchable: false },
        ]
    });

});