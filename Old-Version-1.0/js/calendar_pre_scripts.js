jQuery(document).ready(function($){

    $('#start_date_formated').Zebra_DatePicker({
        onSelect: function( cur_format_date , ymd_date ){
            $('#start_date').val( ymd_date );
        },
        onClear: function( ){
            $('#start_date_formated').val( '' );
        },
        format: 'm-d-Y',
        inside: true,
        readonly_element: true,
        pair: $('#end_date_formated')
    });
    $('#end_date_formated').Zebra_DatePicker({
        onSelect: function( cur_format_date , ymd_date ){
            $('#end_date').val( ymd_date );
        },
        onClear: function( ){
            $('#end_date').val( '' );
        },
        format: 'm-d-Y',
        inside: true,
        readonly_element: true
    });

    $('button[type=submit]').click(function(){

        if( '' == $('input[name=calendar]').val() ){
            alert( 'Please select calendar type' );
            return false;
        }

        if( $('input[name=use_date]:checked').val() == '1' ){
            var start_date = $('input[name=start_date]').val();
            var end_date = $('input[name=end_date]').val();
            if( '' == start_date && '' == end_date ){
                alert( 'Please select start or/and end date' );
                return false;
            }
        }
    });

    $('select[name=calendar]').change(function(){

        $('.calendar-line-1').hide();
        $('.calendar-line-2').hide();
        $('.calendar-line-3').hide();
        $('.calendar-line-4').hide();
        $('.calendar-line-5').hide();

        if( '' !== $(this).val() ){

            $('.calendar-line-1 select').hide();
            $('select[name='+$(this).val()+']').show();
            $('.calendar-line-1').show();

        }

    }).change();

// EQUIPMENT SELECTION 4-STEPS
    $('select[name=category]').change(function(){

        $("#equipment").html( $('#equipment_storage').html() );
        var cat_id = $(this).val();

        if( '' == $(this).val() ){
            $('.calendar-line-2').hide();
            $('#view_all').html('View All');
        }
        else{

            var cat_name = $(this).children("option").filter(":selected").text();
            $('#view_all').html('View All '+ cat_name );
            cat_name = cat_name.match(/.*?ies$/g) ? cat_name.replace(/ies$/,'y') : cat_name;
            cat_name = cat_name.match(/.*?s$/g) ? cat_name.replace(/s$/,'') : cat_name;
            $('#view_single').html('View Individual '+ cat_name );

            $('#equipment .equip_item').each(function(){
                if( !$(this).hasClass('cat'+cat_id ) ){
                    $(this).remove();
                }
            });

            $('.calendar-line-2').show();

        }
    });

    $('select[name=view_equip_option]').change(function(){

        $('select[name=user_id]').hide();
        $('select[name=job_id]').hide();
        $('.calendar-line-3').hide();

        if( 'all' == $(this).val() ){
            $('.calendar-line-3').show();
            return;
        }

        if( 'single' == $(this).val() ){
            $('#equipment').show();
        }
        else{
            $('#equipment').hide();


            if( '' !== $(this).val() ){
                $('select[name='+$(this).val()+'_id]').show();
            }
            else{
                $('.calendar-line-3').hide();
            }

        }
    });

    $('#equipment').change(function(){
        if( '' == $(this).val() ){
            $('.calendar-line-3').hide();
        }
        else{
            $('.calendar-line-3').show();
        }
    });

    $('select[name=user_id]').change(function(){
        if( '' == $(this).val() ){
            $('.calendar-line-3').hide();
        }
        else{
            $('.calendar-line-3').show();
        }
    });

    $('select[name=job_id]').change(function(){
        if( '' == $(this).val() ){
            $('.calendar-line-3').hide();
        }
        else{
            $('.calendar-line-3').show();
        }
    });



// ALL OTHER OPTIONS
    $('select[name=user]').change(function(){
        if( '' == $(this).val() ){
            $('.calendar-line-3').hide();
        }
        else{
            $('.calendar-line-3').show();
        }
    });

    $('select[name=job]').change(function(){
        if( '' == $(this).val() ){
            $('.calendar-line-3').hide();
        }
        else{
            $('.calendar-line-3').show();
        }
    });

    $('input[name=use_date]').change(function(){

        if( '1' == $(this).val() ){
            $('.calendar-line-4').show();
            $('.calendar-line-5').show();
        }
        if( '0' == $(this).val() ){
            $('.calendar-line-4').hide();
            $('.calendar-line-5').show();
        }
    });

});