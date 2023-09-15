jQuery(document).ready(function($){

    $('.add-worker-btn').click(function(){
        var temp_section = $(".temp-section").clone();
        temp_section.removeClass("temp-section");
        var selectElement = temp_section.find("select");
        $(".worker").each(function(){
            if(!$(this).hasClass("hide-dropdown")) {
                var selected_worker = $(this).val();
                if(selected_worker != 0) {
                    selectElement.find("option").each(function(){
                        if($(this).val() == selected_worker){
                            $(this).remove();
                            return false;
                        }
                    });
                }
            }
        });
        selectElement.removeClass("hide-dropdown");
        temp_section.find("h4").removeClass("hide-dropdown");
        var padding_element = document.createElement('div');
        padding_element.className = "clr10";
        $(".workers")[0].append(padding_element);
        $(".workers")[0].append(temp_section[0]);
    });

    $('#task_id').change(function(){
        if($(this).val() == "new") {
            $("#newJobName").removeClass("hide-dropdown");
        } else {
            $("#newJobName").addClass("hide-dropdown");
        }
    });

    $('body').on('click', '.delete-btn', function() {
        var countWorkers = $(".worker-selection").length;
        if(countWorkers == 2) {
            alert("Can't delete last one.");
            return;
        } else {
            if($(this).parent().prev().hasClass("clr10"))
                $(this).parent().prev().remove();
            $(this).parent().remove();
        }
    });


    var previous;
    $('body').on('focus', '.worker', function() {
        previous = $(this).val();
    });

    $('body').on('change', '.worker', function() {
        var workerId = $(this).val();
        if(workerId == 0){
            if($(this).next().next() && $(this).next().next().hasClass("errmsg-box")){
                $(this).next().next().html("");
                $(this).next().next().hide();
            }
            return;
        }
        if($(this).next() && $(this).next().hasClass("delete-btn")){
            $(this).next().show();
        }
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        var selectedEle = $(this);
        if(start_date > end_date){
            alert("Start date can't be great than end date");
            $(this).val(previous);
            return;
        }
        if(start_date != "" && end_date != "" && workerId) {
            var ajaxUrl = $("#siteUrl").val() + "admin/ajax";
            $.ajax({
                url: ajaxUrl,
                type: "POST",
                data: {action: "checkSchedule", userid: workerId, start_date: start_date, end_date:end_date},
                dataType: "json",
                success: function(res) {
                    if(res.status) {
                        if(res.jobs.length > 0 || res.timeoff && Object.keys(res.timeoff).length > 0){
                            var message = "";
                            if(res.jobs.length > 0){
                                for(var jindex = 0; jindex < res.jobs.length; jindex++) {
                                    if(message == ""){
                                        message = res.jobs[jindex].name + " (" + res.jobs[jindex].start_date + " to " + res.jobs[jindex].end_date + ")";
                                    } else {
                                        message += ", " + res.jobs[jindex].name + " (" + res.jobs[jindex].start_date + " to " + res.jobs[jindex].end_date + ")";
                                    }
                                }
                            }

                            if (res.timeoff && Object.keys(res.timeoff).length > 0) {
                                if(message == ""){
                                    message = "Time Off" + " (" + res.timeoff.start_date + " to " + res.timeoff.end_date + ")";
                                } else {
                                    message += ", " + "Time Off" + " (" + res.timeoff.start_date + " to " + res.timeoff.end_date + ")";
                                }
                            }

                            if(message != "" && selectedEle.next().next() && selectedEle.next().next().hasClass("errmsg-box")){
                                selectedEle.next().next().html("<span>"+message+"</span>");
                                selectedEle.next().next().show();
                            }
                        } else {
                            if(selectedEle.next().next() && selectedEle.next().next().hasClass("errmsg-box")){
                                selectedEle.next().next().hide();
                            }
                        }
                    } else {
                        alert("Failed to pull worker's schedule info.");
                    }
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    console.log(errorMessage);
                }
            });
        } else {
            alert("Please select start and date time");
            $(this).val(previous);
        }
    });
});

function validateForm() {
    if($("#task_id").val() == "new" && $("#newName").val() == ""){
        alert("Please enter new job name");
        return false;
    }

    if ($("#start_date").val() == "") {
        alert("Start date must be filled out");
        return false;
    }

    if ($("#end_date").val() == "") {
        alert("End date must be filled out");
        return false;
    }

    if($("#alert_check").prop('checked') && $("#alert_text").val() == "") {
        alert("please enter alert text");
        return false;
    }
}