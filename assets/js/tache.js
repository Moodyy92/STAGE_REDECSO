import '../styles/tache.scss';
////////////////// DATA TABLE //////////////////
let table= $('#dataTable').DataTable( {
    dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf'
    ],
    language: datatablefr
} );