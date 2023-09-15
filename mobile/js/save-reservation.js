jQuery(document).ready(function($){

    var lastValue = '';

    function split( val ) {
        return val.split( /,\s*/ );
    }

    function extractLast( term ) {
        return split( term ).pop();
    }

    $( "#job_name" )
        .bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&  $( this ).data( "ui-autocomplete" ).menu.active ) {
                event.preventDefault();
            }
        })

        .autocomplete({

            source: function( request, response ) {
                response( $.ui.autocomplete.filter( available_jobs, extractLast( request.term ) ) );
            },

            focus: function() {
                return false;
            },
            select: function( event, ui ) {

                lastValue = ui.item.label;

                $('#job_name').val( ui.item.label );
                $('#job_id').val( ui.item.value );

                return false;
            }

        })

        .change( function(){
            if( $( this ).val() !== lastValue ){
                $('#job_id').val( 0 );
            }
        })
        .change()

        .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li>" )
            .append( "<a>" + item.label +"</a>" )
            .appendTo( ul );
        }
    ;
});