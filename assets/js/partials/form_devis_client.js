import '../../styles/partials/form_devis_client.scss';

//TODO : Afficher prix du produit selectionné dans le tableau
//TODO : Envoyer la modifi dun input de categorie & Tache en backend
//TODO : Cree un produit directement sur la vue du devis

$(".choice-search").select2({
});


////////////////// ETAPE 1 BTN FORM NEXT 1 //////////////////
$(document).on('click','#js-next-1', function (e){
    e.preventDefault()
    $('#js-form-1').toggle(0);
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
    $('#js-tableau').show();
    $('#js-form-2').hide();
    let form = $('form[name="devis"]');

////////////////// Affichage infos client  //////////////////
    //jquery "compacté"
    $.post(form.attr('action'),form.serialize(),function (response){
        console.log(response);
    })
    $('#js-form-etape-2').show();
})



////////////////// Affichage de la categorie  //////////////////
$(document).on('submit','form[name="categorie"]',function(e){
    e.preventDefault()
    let form = $(this);
    //jquery "décomposer"
    $.ajax({
        url: form.attr('action'),
        method: 'POST',
        data: form.serialize(),
        success: function(categorie) {
            let tr = $(document.createElement('tr'))
            tr.attr('id', categorie.id)

            let td = $(document.createElement("td"))
            td.attr('colspan', 1)
                .text(categorie.libelle + ' :')
                .css('font-weight', 'bold');
            td.attr('id','categorie' +categorie.id)
            td.attr('class', 'js-edit-categorie')

            tr.append(td);
            tr.insertBefore($('#js-form-categorie'))
            $('#categorie_libelle').val('')
            console.log(categorie)
        },
        error: function() {
            $('#categorie_libelle').css('border-color', 'red')
            setTimeout(function() {
                $('#categorie_libelle').css('border-color', '-internal-light-dark(rgb(118, 118, 118), rgb(133, 133, 133));')
            }, 10)
        }
    })
})

////////////////// Affichage des infos d'une tache  //////////////////
$(document).on('submit','form[name="tache"]',function(e){
    e.preventDefault()
    let form = $(this);
    //jquery "décomposer"
    $.ajax({
        url: form.attr('action'),
        method: 'POST',
        data: form.serialize(),
        success: function(tache) {
            console.log(tache)
            let tr = $(document.createElement('tr'))
            tr.attr('id', tache.id)

            let td = $(document.createElement("td"))
            tr.append(td);
            td = $(document.createElement("td"))
            td.text(tache.id)

            tr.append(td);
            td.attr('class', 'js-edit-description')
            td.attr('id','tache' +tache.id)

            td = $(document.createElement("td"))
            td.text(tache.produit.libelle)
            td.attr('class', 'js-edit-produit')
            td.attr('id','produit' +tache.id)
            tr.append(td);

            td = $(document.createElement("td"))
            td.text(tache.nbProduit)
            td.attr('class', 'js-edit-quantite')
            td.attr('id','quantite' +tache.id)
            tr.append(td);

            td = $(document.createElement("td"))
            td.text(tache.prix)
            td.attr('class', 'js-edit-prix')
            td.attr('id','prix' +tache.id)
            tr.append(td);


            tr.insertBefore($('#js-form-categorie'))
            $('#tache_libelle').val('')
            $('#tache_produit').val('')
            $('#tache_nbProduit').val('')
            $('#tache_prix').val('')
        },
        error: function() {
            $('#categorie_libelle').css('border-color', 'red')
            setTimeout(function() {
                $('#categorie_libelle').css('border-color', '-internal-light-dark(rgb(118, 118, 118), rgb(133, 133, 133));')
            }, 10)
        }
    })
})



////////////////// Edit html categorie //////////////////
$(document).on('click', '.js-edit-categorie', function() {
    $(this).removeClass('js-edit-categorie')
    let input = $(document.createElement('input'))
    input.attr('id', $(this).attr('id'))
        .attr('type', 'text')
        .val($(this).text())
        .on('focusout', function() {
            $(this).parent('td').text($(this).val())
                .addClass('js-edit-categorie')
        })
    $(this).html(input)    //nameId423
})
////////////////// Edit html tache descritpion //////////////////
$(document).on('click', '.js-edit-description', function() {
    $(this).removeClass('js-edit-description')
    let input = $(document.createElement('input'))
    input.attr('id', $(this).attr('id'))
        .attr('type', 'text')
        .val($(this).text())
        .on('focusout', function() {
            $(this).parent('td').text($(this).val())
                .addClass('js-edit-description')
        })
    $(this).html(input)
})
////////////////// Edit html tache produit //////////////////
$(document).on('click', '.js-edit-produit', function() {
    $(this).removeClass('js-edit-produit')
    let input = $(document.createElement('input'))
    input.attr('id', $(this).attr('id'))
        .attr('type', 'text')
        .val($(this).text())
        .on('focusout', function() {
            $(this).parent('td').text($(this).val())
                .addClass('js-edit-produit')
        })
    $(this).html(input)
})
////////////////// Edit html tache quantité //////////////////
$(document).on('click', '.js-edit-quantite', function() {
    $(this).removeClass('js-edit-quantite')
    let input = $(document.createElement('input'))
    input.attr('id', $(this).attr('id'))
        .attr('type', 'text')
        .val($(this).text())
        .on('focusout', function() {
            $(this).parent('td').text($(this).val())
                .addClass('js-edit-quantite')
        })
    $(this).html(input)
})
////////////////// Edit html tache prix //////////////////
$(document).on('click', '.js-edit-prix', function() {
    $(this).removeClass('js-edit-prix')
    let input = $(document.createElement('input'))
    input.attr('id', $(this).attr('id'))
        .attr('type', 'text')
        .val($(this).text())
        .on('focusout', function() {
            $(this).parent('td').text($(this).val())
                .addClass('js-edit-prix')
        })
    $(this).html(input)
})



////////////////// CONFIG SHOW HIDE VIEW  //////////////////
$(document).on('click','#js-btn-show-tache', function (){
    $('#js-form-tache').show();
    $('#js-form-categorie').hide();
})
$(document).on('click','#js-btn-back-form', function (){
    $('#js-form-2').show();
    $('#js-form-etape-2').hide();

})
$(document).on('click','#js-btn-add-html', function (){
    let tr = document.createElement("tr")
    let th = document.createElement("th")
    let div = document.createElement("div")
    div.classList.add('d-flex')
    div.classList.add('justify-content-center')

    //JS pure
    fetch('/devis/get_forms')
        .then(response => response.json())
        .then(data => console.log(data));
})




////////////////// choice catégorie / Tache //////////////////
$(document).on('click','#js-btn-show-Categorie', function (){
    $('#js-form-categorie').show();
    $('#js-form-tache').hide();
})