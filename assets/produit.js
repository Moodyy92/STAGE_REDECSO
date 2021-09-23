import './styles/produit.scss';

let table= $('#dataTable').DataTable( {
    dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf'
    ],
    language: datatablefr
} );
////////////////// DETAILS PRODUIT //////////////////
$(document).on('click','.produit_show',function (){
// console.log($(this).data('target'));
    $.get($(this).data('target'), function (html){
        $('#modal-body').html(html);
        let modal = new bootstrap.Modal(document.getElementById('modale'), {});
        modal.show();
    })
})
////////////////// UPDATE PRODUIT //////////////////
$(document).on('click','.produit_edit',function (){
    console.log($(this).data('target'));
    $.get($(this).data('target'), function (html){
        $('#modal-body').html(html);
        let modal = new bootstrap.Modal(document.getElementById('modale'), {});
        modal.show();
    })
})
////////////////// ADD PRODUIT //////////////////
$('.add_produit').on('click',function (){
// console.log($(this).data('target'));
    $.get($(this).data('target'), function (html){
        $('#modal-body').html(html);
        let modal = new bootstrap.Modal(document.getElementById('modale'), {});
        modal.show();
    })
})
////////////////// DELETE PRODUIT //////////////////
$(document).on('click','.produit_delete',function (){
// console.log($(this).data('target'));
    $.get($(this).data('target'), function (html){
        $('#modal-body').html(html);
        let modal = new bootstrap.Modal(document.getElementById('modale'), {});
        modal.show();
    })
})
////////////////// btn  PRODUIT //////////////////
$(document).on('submit','#form_delete_produit', function (){
    return confirm('Êtes-vous sûr de vouloir supprimer LE PRODUIT et toutes les informations du produit ?');
})


$(document).on('click','#add_toto',function (){
    let toto= $(document.createElement('option'));
    toto.val('toto')
        .text('toto');
  $('#produit_marque').append(toto);
})


