import '../../styles/devis/form_devis_client.scss';
import {error} from "jquery";

//TODO : Afficher prix du produit selectionné dans le tableau
//TODO : Cree un produit directement sur la vue du devis

$(".choice-search").select2({});
$(".choice-search-produit").select2({
    ajax : {
        url : '/produit/search',
        data: function(params) {
            let query = {
                term: params.term,
            }
            return query;
        },
        dataType: 'json',
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    console.log(item)
                    return {
                        text: item.text,
                        id: item.id,
                        prix: item.prix
                    }
                })
            };
        }
    }
});

$('.choice-search-produit').on('select2:select', function(e) {
    console.log(e.params.data)
    $('#tache_prix').val(e.params.data.prix)
})

$('#js-form-2').hide();
$('#js-btn-add-html').hide();

////////////////// ETAPE 1 BTN FORM NEXT 1 //////////////////
$(document).on('click','#js-next-1', function (e){
    e.preventDefault()
    $('#js-form-1').toggle(0);
    $('#js-back-1').show();
    $('#js-form-2').show();
})

////////////////// BTN BACK 1 //////////////////
$(document).on('click','#js-back-1', function (e){
    e.preventDefault()
    $('#js-form-1').toggle(0);
    $('#js-back-1').hide();
    $('#js-form-2').hide();
    $('#js-form-1').show();
})

$(document).on('click','#js-next-2', function
    (e){
    e.preventDefault()
    $('#js-tableau').show();
    $('#js-form-2').hide();
    $('#js-btn-add-html').show();
    let form = $('form[name="devis"]');

    ////////////////// Affichage infos client  //////////////////
    //jquery "compacté"
    $.post(form.attr('action'),form.serialize(),function (response){
        console.log(response)

        const devis_id = response.id;
        let devis_id_input = $(document.createElement('input'));
        devis_id_input.attr('type', 'hidden')
                      .attr('name','categorie_devis_id')
                       .val(response.id);

        $('form').append(devis_id_input);

        let client_div = $('#js-client_div');
        let span_prenom = $(document.createElement('h1'));
        span_prenom.addClass('js-inline-editable')
            .addClass('col-5')
            .addClass('fs-5');

        let adresse_div = $('#js-adresse_div');
        let span_adresse = $(document.createElement('h1'));
        span_adresse.addClass('js-inline-editable')
            .addClass('col-5')
            .addClass('fs-5');

        let cp_ville_div = $('#js-cp_ville_div');
        let cp_ville_inline = $(document.createElement('h1'));
        cp_ville_inline.addClass('d-flex pl-3')
            .addClass('col-5')
            .addClass('fs-5');

        let span_cp = $(document.createElement('h1'));
        span_cp.addClass('js-inline-editable');

        let span_ville = $(document.createElement('h2'));
        span_ville.addClass('js-inline-editable')
            .addClass('ps-2');

        let js_objet_div = $('#js-objet_div');
        let js_objet_inline = $(document.createElement('div'));
        js_objet_inline.addClass('d-flex pl-5')
            .addClass('col-5');


        let js_reference_div = $('#js-reference_div');
        let js_reference_inline = $(document.createElement('div'));
        js_reference_inline.addClass('d-flex pl-5')
            .addClass('col-5');

        if(!response.client.entreprise) {
            span_prenom.text(response.client.civilite + ' ' + response.client.nom + ' ' + response.client.prenom);
        } else {
            span_prenom.text(response.client.nom.toUpperCase())
        }
        client_div.append(span_prenom);
        span_adresse.text(response.client.adresse);
        adresse_div.append(span_adresse);
        span_cp.text(response.client.codePostal);
        span_ville.text(response.client.ville);
        cp_ville_inline.append(span_cp)
            .append(span_ville);
        cp_ville_div.append(cp_ville_inline);
        js_reference_div.html('<span> <strong> REFERENCE : </strong> ' + response.ref + '</span>');
        js_objet_div.html('<span> <strong> OBJET : </strong>  ' + response.objet + '</span>');
    })
    $('#js-form-etape-2').show();
})

////////////////// Affichage de la categorie  //////////////////
let last_categorie=false
$(document).on('submit','form[name="categorie"]',function(e){
    e.preventDefault()
    let form = $(this);
    console.log(form);
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
            td.attr('id','categorie-' +categorie.id)
            td.attr('class', 'js-edit-categorie')

            tr.append(td);
            tr.insertBefore($('#js-form-categorie'))
            $('#categorie_libelle').val('')
            last_categorie = categorie;

            console.log(last_categorie)

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
    let data = form.serializeArray();
    data.push({
        name:'categorie_id',
        value:last_categorie.id ?? null, //si last_categorie.id existe il envoie, sinon il renvoie null
    })
    //jquery "décomposer"
    // alert(last_categorie.id)
    $.ajax({
        url: form.attr('action'),
        method: 'POST',
        data: $.param(data),
        success: function(tache) {
            let td = $(document.createElement("td"))
            let td_description = $(document.createElement("td"))
            let td_produit = $(document.createElement("td"))
            let td_nbProduit = $(document.createElement("td"))
            let td_prix = $(document.createElement("td"))
            let tr = $(document.createElement('tr'))

            tr.attr('id', tache.id)
            tr.append(td);


            td_description.text(tache.libelle)
            td_description.attr('class', 'js-edit-description')
            td_description.attr('id','tache-' +tache.id)
            tr.append(td_description);

            td_produit.text(tache.produit.libelle)
            td_produit.attr('class', 'js-edit-produit')
            td_produit.attr('id','produit-' +tache.id)
            tr.append(td_produit);

            td_nbProduit.text(tache.nbProduit)
            td_nbProduit.attr('class', 'js-edit-quantite')
            td_nbProduit.attr('id','quantite-' +tache.id)
            tr.append(td_nbProduit);

            td_prix.text(tache.prix)
            td_prix.attr('class', 'js-edit-prix')
            td_prix.attr('id','prix-' +tache.id)
            tr.append(td_prix);

            tr.insertBefore($('#js-form-categorie'))

            //vide le formulaire
            $('form[name="tache"]').trigger('reset')
            calcul_prix_total()
        },
        error: function(error) {
            console.log(error)
            alert(error.responseJSON.message)
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
        .on('focusout', function () {

            let datas = {
                'id': $(this).attr('id').split('-')[1],
                'libelle': $(this).val()
            }
            $.post('/categorie/' + datas.id + '/edit', datas, function (categorie){
                input.parent('td').text(categorie.libelle)
                    .addClass('js-edit-categorie')
                input.html(input)    //nameId423
            })
        })
    $(this).html(input)
})

////////////////// Edit html tache descritpion //////////////////
    $(document).on('click', '.js-edit-description', function () {
        $(this).removeClass('js-edit-description')
        let input = $(document.createElement('input'))

        input.attr('id', $(this).attr('id'))
            .attr('type', 'text')
            .val($(this).text())
            .on('focusout', function () {

                let datas = {
                    'id': $(this).attr('id').split('-')[1],
                    'libelle': $(this).val()
                }

                console.log($(this).attr('id'))


                $.post('/tache/' + datas.id + '/edit', datas, function (tache){
                    input.parent('td').text(tache.libelle)
                        .addClass('js-edit-description')
                    input.html(input)
                })
            })
        $(this).html(input)
    })

////////////////// Edit html tache produit //////////////////
    $(document).on('click', '.js-edit-produit', function () {
        $(this).removeClass('js-edit-produit')
        let input = $(document.createElement('input'))
        input.attr('id', $(this).attr('id'))
            .attr('type', 'text')
            .val($(this).text())
            .on('focusout', function () {

                let datas = {
                    'id': $(this).attr('id').split('-')[1],
                    'libelle': $(this).val()
                }
                console.log($(this).attr('id'))

                $.post('/produit/' + datas.id + '/edit', datas, function (produit){
                    input.parent('td').text(produit.libelle)
                        .addClass('js-edit-produit')
                    input.html(input)
                })
            })
        $(this).html(input)
    })

////////////////// Edit html tache quantité //////////////////
    $(document).on('click', '.js-edit-quantite', function () {
        $(this).removeClass('js-edit-quantite')
        let input = $(document.createElement('input'))
        input.attr('id', $(this).attr('id'))
            .attr('type', 'text')
            .val($(this).text())
            .on('focusout', function () {
                //todo: ecrire la requette pour envoyer en bdd la modifiquation
                $(this).parent('td').text($(this).val())
                    .addClass('js-edit-quantite')
            })
        $(this).html(input)
    })

////////////////// Edit html tache prix //////////////////
    $(document).on('click', '.js-edit-prix', function () {
        $(this).removeClass('js-edit-prix')
        let input = $(document.createElement('input'))
        input.attr('id', $(this).attr('id'))
            .attr('type', 'text')
            .val($(this).text())
            .on('focusout', function () {
                //todo: ecrire la requette pour envoyer en bdd la modifiquation
                $(this).parent('td').text($(this).val())
                    .addClass('js-edit-prix')
            })
        $(this).html(input)
    })

////////////////// affichage html prix //////////////////
function calcul_prix_total() {
    let cells = document.getElementsByClassName('js-edit-prix')
    let cellsQuantite = document.getElementsByClassName('js-edit-quantite')
    let total = 0
    console.log(cells)
    Array.from(cells).forEach(function(el){
        console.log(el)
        let prix = parseInt(el.innerText)
        total += prix
    })
    let cell_total = document.getElementById('js-prix-total')
    cell_total.innerText = total
}

////////////////// CONFIG SHOW HIDE VIEW  //////////////////
    $(document).on('click', '#js-btn-show-tache', function () {
        $('#js-form-tache').show();
        $('#js-form-categorie').hide();
    })

    $(document).on('click', '#js-btn-back-form', function () {
        $('#js-form-2').show();
        $('#js-form-etape-2').hide();

    })

    $(document).on('click', '#js-btn-add-html', function () {
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
    $(document).on('click', '#js-btn-show-Categorie', function () {
        $('#js-form-categorie').show();
        $('#js-form-tache').hide();
    })

////////////////// MODALE ADD PRODUIT //////////////////
    $('.add_produit').on('click', function () {
// console.log($(this).data('target'));
        $.get($(this).data('target'), function (html) {
            $('#modal-body').html(html);
            let modal = new bootstrap.Modal(document.getElementById('modale'), {});
            modal.show()
            $(document).on('submit','form[name="produit"]', function (e){
                e.preventDefault()
                let form = $(this)
                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: form.serialize(),
                    success: function(produit) {
                        modal.hide()
                    }
                })
            })
        })
    })


