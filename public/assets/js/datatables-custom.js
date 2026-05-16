/**
 * PeopleDesk HRM — Global DataTables Configuration
 * Sets defaults to match the "HomeHives" theme.
 */

$.extend(true, $.fn.dataTable.defaults, {
    responsive: true,
    autoWidth: false,
    pageLength: 10,
    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
    language: {
        search: "",
        searchPlaceholder: "Search...",
        lengthMenu: "Show _MENU_ entries",
        info: "Showing _START_ to _END_ of _TOTAL_ entries",
        paginate: {
            next: '<i class="bi bi-chevron-right"></i>',
            previous: '<i class="bi bi-chevron-left"></i>'
        },
        processing: '<div class="spinner-border text-primary spinner-border-sm" role="status"></div>'
    },
    // Updated DOM to separate Length and Filter (Buttons moved to header tools via JS)
    dom: "<'row mb-4 align-items-center'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6 d-flex justify-content-md-end align-items-center'f>>" +
         "<'row'<'col-sm-12'tr>>" +
         "<'row mt-4 align-items-center'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 d-flex justify-content-md-end'p>>",
    buttons: [
        {
            extend: 'collection',
            text: '<i class="bi bi-download"></i> Export',
            className: 'btn btn-export shadow-sm',
            fade: 0,
            autoClose: true,
            buttons: [
                {
                    extend: 'copy',
                    text: '<i class="bi bi-clipboard"></i> Copy',
                    className: 'dropdown-item'
                },
                {
                    extend: 'excel',
                    text: '<i class="bi bi-file-earmark-excel text-success"></i> Excel',
                    className: 'dropdown-item'
                },
                {
                    extend: 'csv',
                    text: '<i class="bi bi-file-earmark-text text-primary"></i> CSV',
                    className: 'dropdown-item'
                },
                {
                    extend: 'pdf',
                    text: '<i class="bi bi-file-earmark-pdf text-danger"></i> PDF',
                    className: 'dropdown-item'
                },
                {
                    extend: 'print',
                    text: '<i class="bi bi-printer"></i> Print',
                    className: 'dropdown-item'
                }
            ]
        }
    ],
    initComplete: function() {
        let api = this.api();
        
        // Move Export buttons to card-tools for consistent alignment with "Add" button
        let $cardTools = $(this).closest('.card').find('.card-tools');
        if ($cardTools.length) {
            api.buttons().container().prependTo($cardTools);
            $cardTools.addClass('d-flex align-items-center gap-2');
        }

        // Style the search input
        $('.dataTables_filter input').removeClass('form-control-sm').addClass('form-control');
        $('.dataTables_length select').removeClass('form-select-sm').addClass('form-select');
    },
    drawCallback: function() {
        $('.dataTables_paginate > .pagination').addClass('pagination-sm mb-0');
    }
});

// Initialize tooltips if any
$(function() {
    $('[data-bs-toggle="tooltip"]').tooltip();
});
