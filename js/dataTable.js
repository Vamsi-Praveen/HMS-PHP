$(document).ready(function() {
    $('#dataTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
        'csv', 'excel', 'pdf'
        ],
    });
});