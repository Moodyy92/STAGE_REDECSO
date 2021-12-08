import '../../styles/devis/devis_show.scss';
$('.add_produit').hide();
$('.js-btn-add-html').hide();
$('#js-info-client').hide();



$(document).on('click','#js-next-2', function(){
    $('#js-form-etape-2').hide();
    $('#js-info-client').show();
})
