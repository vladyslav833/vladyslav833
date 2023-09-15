jQuery(document).ready(function($) {

    var table_read_only = $('#active_table').val() == 0 ;

    var reservation_key = 0;
    var tip_open = false;

    function markReserved(){
        if( reservation_key !== false ){

            var start_date = reservations[reservation_key].start;
            var end_date = reservations[reservation_key].end;

            if(
                typeof( reservations[reservation_key] ) !== 'undefined' &&
                typeof( start_date ) !== 'undefined' &&
                typeof( end_date ) !== 'undefined' &&
                pre_date( start_date ) > 0 &&
                pre_date( end_date ) > 0
            ){

                $.each( calendar_values , function(k,v){

                    if(
                        pre_date( $(this).data('date') ) > pre_date( start_date ) &&
                        pre_date( $(this).data('date') ) < pre_date( end_date )
                    ){
                        $(this).addClass('inner');
                    }
                    if(
                        pre_date( $(this).data('date') ) == pre_date( start_date ) ||
                        pre_date( $(this).data('date') ) == pre_date( end_date )
                    ){
                        $(this).addClass('borderend');
                    }
                });
            }
        }
    }

    function bindQtip(){
        $(".td-qtip-cell").qtip({
            position: {
                my: 'bottom center',
                at: 'top center',
                target: 'event'
            },
            style: {
                classes: 'qtip-tipsy qtip-shadow',
            },
            show:{
                event: 'click',
                solo: true
            },
            hide:{
                event: 'click unfocus'
            },
            events: {
                show: function(event, api) {
                    markReserved();
                    tip_open = true;
                },
                hide: function(){
                    reservation_key = false;
                    $.each( calendar_values , function(){
                        if( $(this).hasClass('already_reserved') ){
                            $(this).removeClass('borderend');
                            $(this).removeClass('inner');
                        }
                    });
                    tip_open = false;
                }
            }
        });
    }

    /*
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    $('#calendar').fullCalendar({
        header: {
            left: '',
            center: 'prev title next',
            right: ''
        },
        editable: true,
        events: [
            {
                title: 'All Day Event',
                start: new Date(y, m, 1)
            },
            {
                title: 'Long Event',
                start: new Date(y, m, d-5),
                end: new Date(y, m, d-2)
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: new Date(y, m, d-3, 16, 0),
                allDay: false
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: new Date(y, m, d+4, 16, 0),
                allDay: false
            },
            {
                title: 'Meeting',
                start: new Date(y, m, d, 10, 30),
                allDay: false
            },
            {
                title: 'Lunch',
                start: new Date(y, m, d, 12, 0),
                end: new Date(y, m, d, 14, 0),
                allDay: false
            },
            {
                title: 'Birthday Party',
                start: new Date(y, m, d+1, 19, 0),
                end: new Date(y, m, d+1, 22, 30),
                allDay: false
            },
            {
                title: 'Click for Google',
                start: new Date(y, m, 28),
                end: new Date(y, m, 29),
                url: 'http://google.com/'
            }
        ]
    });
    */

    function pre_date( date_param ){
        //return typeof date_param != "string" ? 1.0*date_param : (1.0*date_param.replace('-',''));
        return typeof date_param != "string" ? date_param : date_param.replace(/\-/g,'');
    }

    function ymd2mdy( date ){
        if( date ){
            return date.substr( 5, 2 ) + '-' + date.substr( -2 ) + '-' + date.substr( 0, 4 );
        }
        else{
            return '';
        }
    }

    function isBusy( date ){
        var result = false;
        $.each( reservations, function( k, v ){
            if( result !== false ){
                return result;
            }

            if( ( 1.0*pre_date( date ) >= 1.0*pre_date( v.start ) && 1.0*pre_date( date ) <= 1.0*pre_date( v.end ) ) ){
                result = k;
            }

        });
        return result;
    }

    var calendar_values = [];
    var start_value = 0;
    var end_value = 0;
    var disabled_dates = [];

    $('#datepicker').Zebra_DatePicker({
        onSelect: function( cur_format_date , ymd_date ){
            if( tip_open ) return false;

            reservation_key = false;
            var checkBusy = isBusy( ymd_date );

            if( checkBusy !== false ){
                reservation_key = checkBusy;
                //alert('Sorry, this equipment already scheduled for this day');
                return false;
            }
            else if( !table_read_only ){

                if( pre_date( start_value ) > pre_date( end_value ) ){
                    var temp = end_value;
                    end_value = start_value;
                    start_value = temp;
                }

                if( pre_date( start_value ) !== 0 && pre_date( end_value ) !== 0 ){

                    if(
                        pre_date( ymd_date ) == pre_date( start_value ) &&
                        pre_date( ymd_date ) == pre_date( end_value )
                    ){
                        start_value = 0;
                        end_value = 0;
                        ymd_date = 0;
                    }

                    if( pre_date( ymd_date ) == pre_date( start_value ) ){
                        start_value = end_value;
                    }
                    else if( pre_date( ymd_date ) == pre_date( end_value ) ){
                        end_value = start_value;
                    }
                    else if( pre_date( ymd_date ) < pre_date( start_value ) ) {
                        start_value = ymd_date;
                    }
                    else if( pre_date( ymd_date ) > pre_date( end_value ) ) {
                        end_value = ymd_date;
                    }

                }
                else{

                    if( pre_date( start_value ) == 0 && pre_date( end_value ) > 0 ){
                        start_value = end_value;
                    }

                }

                if( pre_date( start_value ) > pre_date( end_value ) ){
                    var temp = end_value;
                    end_value = start_value;
                    start_value = temp;
                }

                if( pre_date( start_value ) == 0 ){
                    start_value = ymd_date;
                }

                if( pre_date( end_value ) == 0 ){
                    end_value = start_value;
                }

                if( pre_date( ymd_date ) > pre_date( start_value ) ){
                    end_value = ymd_date;
                }


                // check for disables days
                var pre_value = 0;

                $.each( calendar_values , function( k, v ){

                    if(
                        pre_date( $(v).data('date') ) >= pre_date( start_value ) &&
                        pre_date( $(v).data('date') ) <= pre_date( end_value )
                    ){
                        if( pre_value == end_value ) return false;
                        if( $(v).hasClass('dp_disabled') || $(v).hasClass('already_reserved') ){
                            end_value = pre_value;
                        }
                        else{
                            pre_value = $(v).data('date');
                        }
                    }

                });

                // apply changes to datatable
                $.each( calendar_values , function( k, v ){

                    if(
                        pre_date( $(v).data('date') ) >= pre_date( start_value ) &&
                        pre_date( $(v).data('date') ) <= pre_date( end_value )
                    ){
                        if(
                            pre_date( $(v).data('date') ) == pre_date( start_value ) ||
                            pre_date( $(v).data('date') ) == pre_date( end_value )
                        ){
                            $(v).addClass('borderend');
                        }
                        else{
                            $(v).removeClass('borderend');
                        }

                        $(v).addClass('reserved');
                    }
                    else{
                        $(v).removeClass('reserved');
                        $(v).removeClass('borderend');
                    }

                });
            }

            if( pre_date( start_value ) > 0 && pre_date( end_value ) > 0 ){
                $('#save_reservation').show();
            }
            else{
                $('#save_reservation').hide();
            }
            $('#start_date').val( start_value );
            $('#end_date').val( end_value );
            $('#start_date_formated').val( ymd2mdy( start_value ) );
            $('#end_date_formated').val( ymd2mdy( end_value ) );

        },
        onClear: function( ){
            reservation_key = false;
            markReserved();
            $.each( calendar_values , function( k, v ){
                $(v).removeClass('reserved');
                $(v).removeClass('borderend');
                if( isBusy( $(v).data('date') !== false ) ){
                    $(v).addClass('already_reserved');
                    $(v).addClass('dp_disabled');
                }
            });

            start_value = end_value = 0;

            $('#save_reservation').hide();
            $('#start_date').val( start_value );
            $('#end_date').val( end_value );
            $('#start_date_formated').val( ymd2mdy( start_value ) );
            $('#end_date_formated').val( ymd2mdy( end_value ) );

        },
        onChange: function( view, elements ) {

            // on the "days" view...
            if (view == 'days') {
                // iterate through the active elements in the view

                elements.each(function() {
                    // to simplify searching for particular dates, each element gets a
                    // "date" data attribute which is the form of:
                    // - YYYY-MM-DD for elements in the "days" view
                    // - YYYY-MM for elements in the "months" view
                    // - YYYY for elements in the "years" view

                    var temp_key = isBusy( $(this).data('date') );
                    if( 0 && temp_key !== false ){
                        console.log( reservations[temp_key].name  );
                        return;
                    }

                    //if( temp_key ){
                    if( temp_key !== false ){
                        $(this).addClass('already_reserved');
                        $(this).addClass('td-qtip-cell');
                        $(this).attr('title', reservations[temp_key].name + '<br>' + reservations[temp_key].job );
                    }
                    else{

                        if(
                            pre_date( $(this).data('date') ) >= pre_date( start_value ) &&
                            pre_date( $(this).data('date') ) <= pre_date( end_value )
                        ){
                            if(
                                pre_date( $(this).data('date') ) == pre_date( start_value ) ||
                                pre_date( $(this).data('date') ) == pre_date( end_value )
                            ){
                                $(this).addClass('borderend');
                            }

                            $(this).addClass('reserved');
                        }
                        else if( $(this).hasClass( 'reserved' ) ){
                            $(this).removeClass('reserved');
                            $(this).removeClass('borderend');
                        }
                    }

                    calendar_values.push(this);
                });

            }
            bindQtip();
            reservation_key = false;
            markReserved();
        },
        always_visible: $('.datepicker_calendar_container'),
        direction: table_read_only ? 0 : true
    });


    if( !table_read_only ){
        $('#save_reservation').click(function(){
            if( pre_date( $('#start_date').val() ) > 0 && pre_date( $('#end_date').val() ) > 0 ){
                return true;
            }
            else{
                return false;
            }
        });
    }

    bindQtip();
});