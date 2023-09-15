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

    $("#datefilter").change(function(){
        if($(this).val() == "range") {
            $(".calendar-line-4").show();
        } else {
            $(".calendar-line-4").hide();
        }
    });

});

function validate() {
    if($("#datefilter").val() == "range") {
        if($("#start_date").val() == "") {
            alert("Please enter start date");
            return false;
        }
        if($("#end_date").val() == ""){
            alert("Please enter end date");
            return false;
        }
    }
    return true;
}