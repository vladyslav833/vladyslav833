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

    $("#datefilter").change(function(){
        if($(this).val() == "range") {
            $(".calendar-line-4").show();
        } else {
            $(".calendar-line-4").hide();
        }
    });

    $("#prjselect").change(function(){
        if($(this).val() == 0) {
            $("#prj-name").text("");
        } else {
            var selectedText = $( "#prjselect option:selected" ).text();
            $("#prj-name").text(selectedText);
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

    if($("#prjselect").val() == 0) {
        alert("Please select project to view.");
        return false;
    }
    return true;
}