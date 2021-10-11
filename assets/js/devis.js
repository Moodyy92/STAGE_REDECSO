import '../styles/devis.scss';

let table= $('#dataTable').DataTable( {
    dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf'
    ]
} );

////////////////// ADD DEVIS //////////////////
$('.add_devis').on('click',function (){
console.log($(this).data('target'));
    $.get($(this).data('target'), function (html){
        $('#modal-body').html(html);
        let modal = new bootstrap.Modal(document.getElementById('modale'), {});
        modal.show();
    })
})
