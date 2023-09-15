jQuery(document).ready(function($){

    $('#category').change(function(){
        $('#step2').hide();
        $('#step3').hide();

        $("#equipment").html( $('#equipment_storage').html() );

        var cat_id = $(this).val();

        if( '0' !== $(this).val() ){

            $('#equipment .equip_item').each(function(){
                if( !$(this).hasClass('cat'+cat_id ) ){
                    $(this).remove();
                }
            });

            $('#step2').show();

        }

         $('#step2').show();

    });

    $('select[name=equip_id]').change(function(){
        $('#step3').hide();
        if( '0' !== $(this).val() ){
            $('#step3').show();
        }
    });

});