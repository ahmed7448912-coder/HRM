$(document).ready(function() {
    const tableId = '#departments-table';
    if ($(tableId).length > 0) {
        $(tableId).DataTable({
            processing: true,
            serverSide: true,
            ajax: $(tableId).data('url'),
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'code', name: 'code', render: function(data) {
                    return '<span class="badge text-bg-info">' + data + '</span>';
                }},
                { data: 'description', name: 'description', render: function(data) {
                    if (data && data.length > 50) {
                        return data.substring(0, 50) + '...';
                    }
                    return data || '';
                }},
                { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
            ],
            language: {
                paginate: {
                    previous: "<i class='bi bi-chevron-left'></i>",
                    next: "<i class='bi bi-chevron-right'></i>"
                }
            }
        });
    }
});
