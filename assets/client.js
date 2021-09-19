import './styles/client.scss';

let table= $('#dataTable').DataTable( {
    dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf'
    ]
} );

table.buttons().container().insertBefore('#dataTable_filter');
