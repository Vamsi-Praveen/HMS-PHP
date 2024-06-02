$(document).ready(function() {
    $('#dataTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'csv',
                exportOptions: {
                    columns: ':not(.no-export)' 
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':not(.no-export)'
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: ':not(.no-export)'
                },
                customize: function (doc) {
                    doc.pageSize = 'A4';
                    doc.pageMargins = [40, 60, 40, 60];
                }
            }
        ],
        columnDefs: [
            { 
                targets: $('.no-export'),
                visible: false,
                searchable: false
            }
        ]
    });
});
