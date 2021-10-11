import '../styles/client.scss';
////////////////// DATA TABLE //////////////////
let table= $('#dataTable').DataTable( {
    dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf'
    ],
    language: datatablefr
} );
////////////////// DETAILS CLIENT //////////////////
$(document).on('click','.client_show',function (){
// console.log($(this).data('target'));
    $.get($(this).data('target'), function (html){
        $('#modal-body').html(html);
        let modal = new bootstrap.Modal(document.getElementById('modale'), {});
        modal.show();
    })
})
////////////////// UPDATE CLIENT //////////////////
$(document).on('click','.client_edit',function (){
// console.log($(this).data('target'));
    $.get($(this).data('target'), function (html){
        $('#modal-body').html(html);
        let modal = new bootstrap.Modal(document.getElementById('modale'), {});
        modal.show();
    })
})
////////////////// ADD CLIENT //////////////////
$('.add_client').on('click',function (){
// console.log($(this).data('target'));
    $.get($(this).data('target'), function (html){
        $('#modal-body').html(html);
        let modal = new bootstrap.Modal(document.getElementById('modale'), {});
        modal.show();
    })
})
////////////////// DELETE CLIENT //////////////////
$(document).on('click','.client_delete',function (){
// console.log($(this).data('target'));
    $.get($(this).data('target'), function (html){
        $('#modal-body').html(html);
        let modal = new bootstrap.Modal(document.getElementById('modale'), {});
        modal.show();
    })
})
////////////////// BTN confirm delete PRODUIT //////////////////
$(document).on('submit','#form_delete_client', function (){
    return confirm('Êtes-vous sûr de vouloir supprimer LE PRODUIT et toutes les informations du produit ?');
})
////////////////// BTN EDIT MODALE //////////////////
$(document).on('click','.client_edit_modale',function (){
// console.log($(this).data('target'));
    $('#modal-body').slideToggle();
    $.get($(this).data('url'), function (html){
        $('#modal-body').html(html);
        $('#modal-body').slideToggle();
    })
})
////////////////// CASE MODALE ENTREPRISE //////////////////
$(document).on('change','#client_entreprise', function (){
    $('#client_civilite').toggle();
    $('#client_prenom').toggle();
})