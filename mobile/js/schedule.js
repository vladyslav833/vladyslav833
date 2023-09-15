jQuery(document).ready(function($) {
    $(".prev-btn").click(function(){
        var delta = parseInt($("#delta").val());
        delta--;
        $("#delta").val(delta);
        $("#schedule_form").submit();
    });

    $(".next-btn").click(function(){
        var delta = parseInt($("#delta").val());
        delta++;
        $("#delta").val(delta);
        $("#schedule_form").submit();
    });

    $(".show-file").click(function(){
        var dataId = $(this).attr("data-id");
        $("#" + dataId + "projectFile").show();
        $("#" + dataId + "showFile").hide();
    });

    $(".close-preview").click(function(){
        var dataId = $(this).attr("data-id");
        $("#" + dataId + "projectFile").hide();
        $("#" + dataId + "showFile").show();
    });

    $(".card-notes").click(function(){
        var dataId = $(this).attr("data-id");
        $("#" + dataId + "noteSection").show();
        $("#" + dataId + "notes").hide();
    });

    $(".cancel-btn").click(function(){
        var dataId = $(this).attr("data-id");
        $("#" + dataId + "noteSection").hide();
        $("#" + dataId + "notes").show();
        $("#" + dataId + "noteContent").text("");
    });
});