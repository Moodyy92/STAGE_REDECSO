import '../../styles/partials/form_devis_client.scss';

$(".choice-search").select2({
    // minimumResultsForSearch: Infinity
});

$('#js-back-1').hide();
$('#js-form-categorie').hide();
$('#js-form-tache').hide();
$('#js-form-produit').hide();

//TODO: NE FONCTIONNE PAS , RAISON : INCONUE
$('#js-form-etape-2').hide();


////////////////// ETAPE 1 BTN FORM NEXT 1 //////////////////
$(document).on('click','#js-next-1', function (e){
    e.preventDefault()
    $('#js-form-1').toggle(0,);
    $('#js-back-1').show();
    $('#js-form-2').show();
})
$(document).on('click','#js-back-1', function (e){
    e.preventDefault()
    $('#js-form-1').toggle(0);
    $('#js-back-1').hide();
    $('#js-next-1').show();
    $('#js-form-2').hide();
})
$('#js-form-2').hide();
$(document).on('click','#js-next-2', function
    (e){
    e.preventDefault()
    $('#js-form-2').hide();
    let form = $('form[name="devis"]');
    $.post(form.attr('action'),form.serialize(),function (response){
        console.log(response);
    })
    $('#js-form-etape-2').show();
})

////////////////// ETAPE 2 choice catégorie / Tache //////////////////
$(document).on('click','#js-btn-show-Categorie', function (){
    $('#js-form-categorie').show();
    $('#js-form-tache').hide();
})

$(document).on('click','#js-btn-show-tache', function (){
    $('#js-form-tache').show();
    $('#js-form-categorie').hide();
})

$(document).on('click','#js-btn-back-form', function (){
    $('#js-form-2').show();
    $('#js-form-etape-2').hide();

})
////////////////// ETAPE 3 choice CREATE PRODUIT ? //////////////////
//TODO : continué etape 3 pour crée un produit ou non

////////////////// ADD HTML //////////////////
//TODO : générer le html pour afficher ligne par ligne le résultat d'une categorie/tache
$(document).on('click','#js-btn-add-html', function (){
    let tr = document.createElement("tr")
    // addHtml.innerHTML = `
    // <th scope="row">
    //     <div class="d-flex justify-content-center ">
    //         {{ include('categorie/_form.html.twig') }}
    //     </div>
    //
    //     <div class="d-flex justify-content-center">
    //         {{ include('tache/_form.html.twig') }}
    //     </div>
    // </th>
    // <td></td>
    // <td></td>
    // <td></td>
    // <td></td>`
    let th = document.createElement("th")
    let div = document.createElement("div")
    div.classList.add('d-flex')
    div.classList.add('justify-content-center')
    fetch('/devis/get_forms')
        .then(response => response.json())
        .then(data => console.log(data));
})


