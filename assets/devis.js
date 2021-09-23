import './styles/devis.scss';

let table= $('#dataTable').DataTable( {
    dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf'
    ]
} );