
$(document).on('click','#add_marque',function (){
    let toto= $(document.createElement('option'));
    toto.val('toto')
        .text('toto');
    $('#produit_marque').append(toto);
})