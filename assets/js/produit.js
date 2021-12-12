import '../styles/produit.scss';

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
////////////////// BTN confirm delete PRODUIT //////////////////
$(document).on('submit','#form_delete_produit', function (){
    return confirm('Êtes-vous sûr de vouloir supprimer LE PRODUIT et toutes les informations du produit ?');
})
////////////////// BTN EDIT MODALE //////////////////
$(document).on('click','.produit_edit_modale',function (){
console.log($(this).data('target'));
    $('#modal-body').slideToggle();
    $.get($(this).data('url'), function (html){
        $('#modal-body').html(html);
        $('#modal-body').slideToggle();
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
////////////////// BTN VALIDER MARQUE//////////////////
$(document).on('click','#add_marque',function (e){  //au clic sur le btn de validation de marque
    e.preventDefault();                                                                                     //on empeche l'execution normal du btn (envoie du formulaire)
    let form=$('#div_marque_new').children('form');                                             //on récupère le formulaire dans le html
    $.post({                                                                                       //envoi en type POST
        url:form.attr('action'),                                                                             //a L'URL de l'action du formulaire
        data:form.serialize(),                                                                               // on envoie les données sérializees (transformer en chaine de caractère) du formulaire
        success:function (data){                                                                             //en cas de succes de la requete, on stock la réponse dans une variable (data)
            let option= $(document.createElement('option'));                                        //on crée une new option html
            option.val(data.id)                                                                             //on lui donne l'id de la marque crée en valeur
                .text(data.libelle);                                                                        //on lui rentre le libellé de la marque crée en text
            $('#produit_marque').append(option)                                                        //on insère option dans le select
                                     .val(data.id);                                                         // et on séléctionne la nouvelle option
        },
        error:function (error) {                                                                     //en cas d'erreur on stock la réponse dans une variable "error"
            $('#error-message').slideDown();                                                          //on affiche le message d'erreur
        }
    })
})
$(document).on('click','#error-close', function (){
    $('#error-message').slideUp();
})


////////////////// BTN NEW MARQUE //////////////////
$(document).on('change','#btn_marque_new', function (){
    $('#div_marque_new').slideToggle();
})

