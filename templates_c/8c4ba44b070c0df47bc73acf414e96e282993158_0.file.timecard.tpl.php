<?php
/* Smarty version 3.1.30, created on 2022-08-14 17:41:27
  from "/home/equipmen/public_html/templates/timecard.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_62f925b7780a17_82423539',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8c4ba44b070c0df47bc73acf414e96e282993158' => 
    array (
      0 => '/home/equipmen/public_html/templates/timecard.tpl',
      1 => 1642789399,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62f925b7780a17_82423539 (Smarty_Internal_Template $_smarty_tpl) {
?>

<?php echo '<script'; ?>
>

$(document).ready(function(){

    $('.remove_confirm').click(function(){
        var link = $(this).attr('href');
        var cat_name = $(this).parent().next().html();

        BootstrapDialog.confirm( 'Delete job', 'Are your sure you want to delete<br><b>'+ cat_name +'<b>?' , function( result ){
            if( result ) {
                window.location = link;
            }
        });
        return false;
    });

    $("#week").change(function() {
        let timestamp = $(this).val();
        window.location = "timecard?timestamp=" + timestamp;
    });

    $("#example-select-all").click(function() {
        var all = document.querySelectorAll("input[type='checkbox'][class='tc-checkbox']");
        all.forEach((sub, i) => {
            if($("#example-select-all").is(":checked"))
            sub.checked = true;
        else
        sub.checked = false;
    });
});


$(".detail-add-job").click(function() {
    let uid = $(this).attr("data-id");
    let newRow = document.createElement('tr');
    newRow.className = "detail-content new-content";

    let select = document.createElement("select");
    select.className = "new-job";
    select.style.outline = "none";
    select.style.width = "100%";
    let option = document.createElement('option');
    option.value = "";
    option.text = "Select Job";
    select.appendChild(option);
    let new_td = document.createElement('td');
    new_td.className = "detail-desc";
    new_td.appendChild(select);
    newRow.appendChild(new_td);

    let ajaxUrl = $("#siteUrl").val() + "admin/ajax";
    let selected_time = $("#selected_time").val();

    $.ajax({
        url: ajaxUrl,
        type: "POST",
        data: {action: "get_jobs", selected_time: selected_time},
        dataType: "json",
        success: function(res) {
            if(res.jobs.length > 0) {
                for(let jobIndex = 0; jobIndex < res.jobs.length; jobIndex++) {
                    let option = document.createElement('option');
                    option.value = res.jobs[jobIndex].id;
                    option.text = res.jobs[jobIndex].name;
                    select.appendChild(option);
                    new_td.appendChild(select);
                }
            }

            for(let index = 0; index < 7; index++) {
                let input_field = document.createElement('input');
                input_field.className = "detail-td-input";
                input_field.style.width = "100%";
                input_field.style.textAlign = "center";
                input_field.style.color = "#003f6e";
                input_field.style.fontWeight = "bold";
                let td_element = document.createElement('td');
                td_element.dataset.time = res.data_time[index];
                td_element.appendChild(input_field);
                let noteElement = document.createElement('textarea');
                noteElement.className = "detail-description";
                noteElement.placeholder = "Notes";
                td_element.append(noteElement);
                newRow.appendChild(td_element);
            }
            $("." + uid + "_subtable" + " tr:last").before(newRow);
        },
        error: function (jqXhr, textStatus, errorMessage) {
            console.log(errorMessage);
        }
    });
});

$(".view-timecard").click(function() {
    let card_id = $(this).attr("data-id");
    if(card_id && card_id != "" && !$("#" + card_id + "DetailView").hasClass('show-detil-table')) {
        $("#" + card_id + "DetailView").removeClass('hide-detail-table').addClass('show-detil-table');
    } else {
        $("#" + card_id + "DetailView").removeClass('show-detil-table').addClass('hide-detail-table');
    }
});

$(".view-card-btn").click(function (){
    let timecard_table = $(".timecard-table");
    let detailTables = timecard_table.find(".detail-table");
    detailTables.each(function() {
        $(this).removeClass('hide-detail-table').addClass('show-detil-table');
    });
});

$(".edit-timecard").click(function() {
    let card_id = $(this).attr("data-id");
    let detailView = $("#" + card_id + "DetailView");
    if(card_id && card_id != "" && !detailView.hasClass('show-detil-table')) {
        detailView.removeClass('hide-detail-table').addClass('show-detil-table');
        detailView.find(".detail-edit").trigger('click');
    } else {
        detailView.removeClass('show-detil-table').addClass('hide-detail-table');
        detailView.find(".detail-cancel").trigger('click');
    }
});

$(".detail-edit").click(function() {
    if($(this).hasClass("detail-edit")) {
        $(this).removeClass("detail-edit").addClass("detail-cancel");
        $(this).text("Cancel");
        let uid = $(this).attr("data-id");
        $("#" + uid + "_add_job").show();
        $("#" + uid + "_detail_finalize").text("Save");
        $("#" + uid + "_detail_finalize").show();
        $("." + uid + "-detail-td").each(function() {
            let input_field = document.createElement('input');
            input_field.className = "detail-td-input " + uid + "-detail-input";
            let description = "";
            if($(this).children().length > 1) {
                description = $(this).children()[1].innerText;
            }
            let hour = "";
            if($(this).children().length > 0)
                hour = $(this).children()[0].innerText;
            input_field.value = hour;
            input_field.style.width = "100%";
            input_field.style.textAlign = "center";
            input_field.style.color = "#003f6e";
            input_field.style.fontWeight = "bold";
            $(this).html(input_field);

            let noteElement = document.createElement('textarea');
            noteElement.className = "detail-description";
            noteElement.value = description;
            noteElement.placeholder = "Notes";
            $(this).append(noteElement);
        });

        /*$("." + uid + "-afp-td").each(function() {
            let input_field = document.createElement('input');
            input_field.className = "afp-td-input " + uid + "-afp-input";
            input_field.value = $(this).text();
            input_field.style.width = "100%";
            input_field.style.textAlign = "center";
            input_field.style.color = "#ff0000";
            input_field.style.fontWeight = "bold";
            $(this).html(input_field);
        });*/
    } else {
        $(this).removeClass("detail-cancel").addClass("detail-edit");
        $(this).text("Edit");
        let uid = $(this).attr("data-id");
        $("#" + uid + "_add_job").hide();
        $("#" + uid + "_detail_finalize").text("FINALIZE");
        if($("#thisweek").val() == "y")
            $("#" + uid + "_detail_finalize").hide();
        $("." + uid + "-detail-input").each(function() {
            let input_value = $(this).val();
            let description = "";
            if($(this).next().val() != "") {
                description = $(this).next().val();
            }
            let hourSpan = document.createElement("span");
            hourSpan.innerHTML = input_value;
            hourSpan.className = "hour-span";
            var parentElement = $(this).parent();
            parentElement.html(hourSpan);
            if(description != "") {
                let noteElement = document.createElement("span");
                noteElement.innerHTML = description;
                parentElement.append(noteElement);
            }
        });

        /*$("." + uid + "-afp-input").each(function() {
            let input_value = $(this).val();
            $(this).parent().html(input_value);
        });*/
        $(".new-content").remove();
    }
});

$("#exportdata").click(function(){
    let selected_time = $("#selected_time").val();
    let selected_weekend_day = $("#selected_weekend_day").val();
    if(!selected_time || selected_time == "") {
        alert("Please select date and user");
        return;
    }
    let users = $(".tc-checkbox").map(function() {
        if($(this).is(":checked")){
            return $(this).val();
        }
    }).get();

    let tableData = "";
    let header = "<img src='http://equipment-scheduler.eckingerdigital.com/img/header-logo.png' style='max-width: 250px; margin: auto;'><br /><h3 style='color: #15253E;'>2500 Krisko Circle SW, Canton, Ohio 44706 &bull; 330-452-6500</h3>";
    for(let k = 0; k < users.length; k++) {
        let userid = users[k];
        let subtable = $("." + userid + "_subtable");
        if(tableData != ""){
            tableData += "<div style='page-break-before:always;'>";
            tableData += header;
        } else {
            tableData = header;
        }
        tableData += "<table style='width: 100%; border-collapse: collapse;'>";
        tableData += "<tr><td colspan='2'>NAME: " + $("." + userid + "_username").text() + "</td><td colspan='7'>WEEK ENDING: " + selected_weekend_day + "</td></tr>";
        tableData += "<tr><td colspan='9' style='height: 20px;'></td></tr>" +
                "<tr><td colspan='1' style='border-right: 0;'></td>" +
                "<td colspan='8' style='text-align: center;border-left: 0;'>MARK TIME DAILY</td></tr>" +
                "<tr><td colspan='2' style='width: 60%'>JOB NAME, DESCRIPTION</td>" +
                "<td>SUN</td>" +
                "<td>MON</td>" +
                "<td>TUE</td>" +
                "<td>WED</td>" +
                "<td>THU</td>" +
                "<td>FRI</td>" +
                "<td>SAT</td>" +
                "</tr>";
        for (let i = 0; i < subtable[0].rows.length; i++) {

            // GET THE CELLS COLLECTION OF THE CURRENT ROW.
            if(subtable[0].rows.item(i).className == "afp-header" || subtable[0].rows.item(i).className == "detail-header" || subtable[0].rows.item(i).className == "")
                continue;
            var objCells = subtable[0].rows.item(i).cells;
            tableData += "<tr>";
            let job_id = 0;
            if(subtable[0].rows.item(i).className == "afp-content")
                tableData += "<td colspan='2' style='width: 50%; text-align: left;color: #D23642;font-size: 14px;'>Hours worked that an AFP10 Mask is required. Mark in 1/4 hrs. Mark day with zero if not required.</td>";
            else
                tableData += "<td style='width: 50%;'>" + objCells.item(0).innerHTML + "</td>";
            if(subtable[0].rows.item(i).className == "detail-content")
                tableData += "<td style='width: 35%'>JOB #" + subtable[0].rows.item(i).dataset.prjid + "</td>";
            // LOOP THROUGH EACH CELL OF THE CURENT ROW TO READ CELL VALUES.
            for (let j = 1; j < objCells.length; j++) {
                tableData += "<td style='text-align: center'>" + objCells.item(j).innerHTML + "</td>";
            }
            tableData += "</tr>";
        }
        tableData += "<tr><td colspan='2' style='text-align: left;'>TOTAL HOURS</td><td colspan='7'> " + $("." + userid + "_totalHours").text() +" </td></tr>";
        tableData += "</table>";
        if(tableData != "")
            tableData += "</div>";
    }

    if(users.length > 0) {
        let ajaxUrl = $("#siteUrl").val() + "admin/ajax";
        $.ajax({
            url: ajaxUrl,
            type: "POST",
            data: {action: "download", tableData:tableData},
            dataType: "json",
            success: function(res) {
                if(res.status) {
                    let downloadtag = document.getElementById("download_link");
                    downloadtag.setAttribute('href', res.data);
                    downloadtag.click();
                    //console.log(res.data);
                } else {
                    alert("Failed to download the data.");
                }
            },
            error: function (jqXhr, textStatus, errorMessage) {
                console.log(errorMessage);
            }
        });
    } else {
        alert("Please select users to download");
    }
});

$(".finalize-btn").click(function (){
    let timecard_table = $(".timecard-table");
    let detailTables = timecard_table.find(".detail-table");

    let timecard_ids = [];
    detailTables.each(function() {
        let detailContents = $(this).find(".detail-td");
        let afpContents = $(this).find(".afp-td");
        detailContents.each(function() {
            if($(this).attr("data-id") && timecard_ids.indexOf($(this).attr("data-id")) < 0)
                timecard_ids.push($(this).attr("data-id"));
        });
        afpContents.each(function() {
            if($(this).attr("data-id") && timecard_ids.indexOf($(this).attr("data-id")) < 0)
                timecard_ids.push($(this).attr("data-id"));
        });
    });

    if(timecard_ids.length > 0){
        let ajaxUrl = $("#siteUrl").val() + "admin/ajax";
        $.ajax({
            url: ajaxUrl,
            type: "POST",
            data: {action: "finalize", tids: timecard_ids},
            dataType: "json",
            success: function(res) {
                if(res.status)
                    window.location.reload();
                else
                    alert("Failed to finalize the data.");
            },
            error: function (jqXhr, textStatus, errorMessage) {
                console.log(errorMessage);
            }
        });
    }
});

$(".detail-finalize").click(function() {
    let btnText = $(this).text();
    let uid = $(this).attr("data-id");
    let subtable = $("." + uid + "_subtable");
    if(btnText === "FINALIZE") {
        let timecard_ids = [];
        let detailContents = subtable.find(".detail-td");
        let afpContents = subtable.find(".afp-td");
        detailContents.each(function() {
            if($(this).attr("data-id") && timecard_ids.indexOf($(this).attr("data-id")) < 0)
                timecard_ids.push($(this).attr("data-id"));
        });
        afpContents.each(function() {
            if($(this).attr("data-id") && timecard_ids.indexOf($(this).attr("data-id")) < 0)
                timecard_ids.push($(this).attr("data-id"));
        });
        if(timecard_ids.length > 0){
            let ajaxUrl = $("#siteUrl").val() + "admin/ajax";
            $.ajax({
                url: ajaxUrl,
                type: "POST",
                data: {action: "finalize", tids: timecard_ids},
                dataType: "json",
                success: function(res) {
                    if(res.status)
                        window.location.reload();
                    else
                        alert("Failed to finalize the data.");
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    console.log(errorMessage);
                }
            });
        }
    } else if(btnText === "Save") {
        let timecard_ids = [];
        let detailContents = subtable.find(".detail-td-input");
        let afpContents = subtable.find(".afp-td-input");
        detailContents.each(function() {
            let td = $(this).parent().parent();
            let job_id = 0;
            if(!td.attr("data-jid")) {
                let new_job_id = td.find(".new-job").val();
                if(!new_job_id || new_job_id == "") {
                    return;
                }
                job_id = new_job_id;
            } else {
                job_id = td.attr("data-jid");
            }
            let job_name = td.find('.detail-desc').text();
            let newVal = $(this).val();
            if(newVal && newVal != "") {
                let oldId = "";
                let timestamp = "";
                let parent_td = $(this).parent();
                if(parent_td.attr("data-id")) {
                    oldId = parent_td.attr("data-id");
                } else {
                    timestamp = parent_td.attr("data-time");
                }
                job_name = "";
                let description = $(this).next().val();
                timecard_ids.push({id: oldId, val: newVal, timestamp: timestamp, jobid: job_id, job_name: job_name, description: description, afp: 0});
            }
        });
        /*afpContents.each(function() {
            let td = $(this).parent().parent();
            let job_id = 0;
            if(!td.attr("data-jid")) {
                let new_job_id = td.find(".new-job").val();
                if(!new_job_id || new_job_id == "") {
                    return;
                }
                job_id = new_job_id;
            } else {
                job_id = td.attr("data-jid");
            }
            let job_name = td.find('.afp-desc').text();
            let newVal = $(this).val();
            if(newVal && newVal != "") {
                let oldId = "";
                let timestamp = "";
                let parent_td = $(this).parent();
                if(parent_td.attr("data-id")) {
                    oldId = parent_td.attr("data-id");
                } else {
                    timestamp = parent_td.attr("data-time");
                }
                timecard_ids.push({id: oldId, val: newVal, timestamp: timestamp, jobid: job_id, job_name: job_name, afp: 1});
            }
        });*/
        if(timecard_ids.length > 0){
            let ajaxUrl = $("#siteUrl").val() + "admin/ajax";
            $.ajax({
                url: ajaxUrl,
                type: "POST",
                data: {action: "saveCard", tids: timecard_ids, userid: uid},
                dataType: "json",
                success: function(res) {
                    if(res.status)
                        window.location.reload();
                    else
                        alert("Failed to save the data.");
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    console.log(errorMessage);
                }
            });
        }
    }
});


<?php if ($_smarty_tpl->tpl_vars['timecards']->value) {?>

let example = $('#example').dataTable( {
    "bLengthChange": false,
    "bFilter": false,
    "bInfo": false,
    "aoColumns": [
        { "bSortable": false },
        { "bSortable": false },
        { "bSortable": false },
        { "bSortable": false },
        { "bSortable": false },
        { "bSortable": false }
    ],
    "sPaginationType": "full_numbers"
} );
<?php }?>
$('#subtable').dataTable( {
    "bLengthChange": false,
    "bFilter": false,
    "bInfo": false,
    "aoColumns": [
        { "bSortable": false },
        { "bSortable": false },
        { "bSortable": false },
        { "bSortable": false },
        { "bSortable": false },
        { "bSortable": false },
        { "bSortable": false },
        { "bSortable": false }
    ],
    "sPaginationType": "full_numbers"
} );



});
<?php echo '</script'; ?>
>


<div class="row">
    <div class="col-sm-12">
        <div class="subpadding20">
            <div class="card-header-text">
                <p>Timecards</p>
                <?php if ($_smarty_tpl->tpl_vars['timestamp']->value != 0) {?>
                    <span>Displaying timecards for week of Sunday, <?php echo $_smarty_tpl->tpl_vars['selected_time_str']->value;?>
</span>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['thisweek']->value == "n") {?>
                    <button class="btn finalize-btn">Finalize All</button>
                <?php }?>
                <input type="hidden" id="selected_time" name="selected_time" value="<?php echo $_smarty_tpl->tpl_vars['timestamp']->value;?>
">
                <input type="hidden" id="thisweek" name="thisweek" value="<?php echo $_smarty_tpl->tpl_vars['thisweek']->value;?>
">
                <input type="hidden" id="selected_weekend_day" name="selected_weekend_day" value="<?php echo $_smarty_tpl->tpl_vars['selected_wkend']->value;?>
">
                <input id="siteUrl" value="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
" hidden>
                <button class="btn view-card-btn">View All <img class="viewcard-icon" src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/viewcard-icon.png"></button>
                <select class="form-control week-select float-right" name="week" id="week" required >
                    <option value="">Select Week</option>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['prev_week_days']->value, 'weekday');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['weekday']->value) {
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['weekday']->value['week_day_value'];?>
"<?php if ($_smarty_tpl->tpl_vars['timestamp']->value == $_smarty_tpl->tpl_vars['weekday']->value['week_day_value']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['weekday']->value['week_day_label'];?>
</option>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                </select>
            </div>
            <a href="#" id="download_link" style="display: none" target="_blank" download="Timecard.pdf" download></a>
            <table class="display table table-hover timecard-table" id="example">
                <thead>
                <tr>
                    <th class="es-th-check text-center"><input type="checkbox" name="select_all" value="1" id="example-select-all"></th>
                    <th class="es-th-worker">Worker</th>
                    <th class="es-th-hours text-center">Hours<br> Worked</th>
                    <th class="es-th-days text-center">Days<br> Worked</th>
                    <th class="es-th-job text-center">Jobs Worked</th>
                    <th class="es-th es-th-delete es-end text-center">View/Edit</th>
                </tr>
                </thead>
                <tbody>
                <?php if ($_smarty_tpl->tpl_vars['timecards']->value) {?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['timecards']->value, 'timecard', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['timecard']->value) {
?>
                        <tr>
                            <td class="text-center">
                                <input class="tc-checkbox" type="checkbox" name="id[]" value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
">
                            </td>
                            <td class="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
_username"><?php echo $_smarty_tpl->tpl_vars['timecard']->value['worker'];?>
</td>
                            <td class="text-center <?php echo $_smarty_tpl->tpl_vars['key']->value;?>
_totalHours"><?php echo $_smarty_tpl->tpl_vars['timecard']->value['total_hours'];?>
</td>
                            <td class="text-center"><?php echo count($_smarty_tpl->tpl_vars['timecard']->value['days_worked']);?>
</td>
                            <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['timecard']->value['job_name'];?>
</td>
                            <td class="text-center">
                                <a href="javascript:void(0)" data-id="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" class="view-timecard">
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/view-icon.png" alt="View TimeCard" />
                                </a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="javascript:void(0)" data-id="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" class="edit-timecard">
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/edit-icon.png" alt="Edit TimeCard" />
                                </a>
                            </td>
                        </tr>
                        <tr id="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
DetailView" class="hide-dropdown detail-table">
                            <td colspan="6">
                                <table class="display table table-hover <?php echo $_smarty_tpl->tpl_vars['key']->value;?>
_subtable" id="subtable">
                                        <?php if ((array_key_exists('su',$_smarty_tpl->tpl_vars['timecard']->value) || array_key_exists('mo',$_smarty_tpl->tpl_vars['timecard']->value) || array_key_exists('tu',$_smarty_tpl->tpl_vars['timecard']->value) || array_key_exists('we',$_smarty_tpl->tpl_vars['timecard']->value) || array_key_exists('th',$_smarty_tpl->tpl_vars['timecard']->value) || array_key_exists('fr',$_smarty_tpl->tpl_vars['timecard']->value) || array_key_exists('sa',$_smarty_tpl->tpl_vars['timecard']->value))) {?>
                                            <tr class="afp-header">
                                                <th class="sub-job-name"></th>
                                                <th class="es-th">Sunday</th>
                                                <th class="es-th">Monday</th>
                                                <th class="es-th">Tuesday</th>
                                                <th class="es-th">Wednesday</th>
                                                <th class="es-th">Thursday</th>
                                                <th class="es-th">Friday</th>
                                                <th class="es-th">Saturday</th>
                                            </tr>
                                            <tr class="afp-content" data-id="<?php echo $_smarty_tpl->tpl_vars['detail']->value['tid'];?>
" data-jid="<?php echo $_smarty_tpl->tpl_vars['jobkey']->value;?>
">
                                                <td class="afp-desc">Hours worked that an AFP10 Mask is required. Mark in 1/4 hrs. Mark day wih zero if not required.</td>

                                                <td class="afp-td <?php echo $_smarty_tpl->tpl_vars['key']->value;?>
-afp-td" data-time="<?php if ($_smarty_tpl->tpl_vars['timestamp']->value != '') {
echo $_smarty_tpl->tpl_vars['timestamp']->value;
}?>"><?php if (array_key_exists('su',$_smarty_tpl->tpl_vars['timecard']->value)) {
echo $_smarty_tpl->tpl_vars['timecard']->value['su'];
}?></td>
                                                <td class="afp-td <?php echo $_smarty_tpl->tpl_vars['key']->value;?>
-afp-td" data-time="<?php if ($_smarty_tpl->tpl_vars['timestamp']->value != '') {
echo date("Y-m-d",strtotime("+1 day",strtotime($_smarty_tpl->tpl_vars['timestamp']->value)));
}?>"><?php if (array_key_exists('mo',$_smarty_tpl->tpl_vars['timecard']->value)) {
echo $_smarty_tpl->tpl_vars['timecard']->value['mo'];
}?></td>
                                                <td class="afp-td <?php echo $_smarty_tpl->tpl_vars['key']->value;?>
-afp-td" data-time="<?php if ($_smarty_tpl->tpl_vars['timestamp']->value != '') {
echo date("Y-m-d",strtotime("+2 day",strtotime($_smarty_tpl->tpl_vars['timestamp']->value)));
}?>"><?php if (array_key_exists('tu',$_smarty_tpl->tpl_vars['timecard']->value)) {
echo $_smarty_tpl->tpl_vars['timecard']->value['tu'];
}?></td>
                                                <td class="afp-td <?php echo $_smarty_tpl->tpl_vars['key']->value;?>
-afp-td" data-time="<?php if ($_smarty_tpl->tpl_vars['timestamp']->value != '') {
echo date("Y-m-d",strtotime("+3 day",strtotime($_smarty_tpl->tpl_vars['timestamp']->value)));
}?>"><?php if (array_key_exists('we',$_smarty_tpl->tpl_vars['timecard']->value)) {
echo $_smarty_tpl->tpl_vars['timecard']->value['we'];
}?></td>
                                                <td class="afp-td <?php echo $_smarty_tpl->tpl_vars['key']->value;?>
-afp-td" data-time="<?php if ($_smarty_tpl->tpl_vars['timestamp']->value != '') {
echo date("Y-m-d",strtotime("+4 day",strtotime($_smarty_tpl->tpl_vars['timestamp']->value)));
}?>"><?php if (array_key_exists('th',$_smarty_tpl->tpl_vars['timecard']->value)) {
echo $_smarty_tpl->tpl_vars['timecard']->value['th'];
}?></td>
                                                <td class="afp-td <?php echo $_smarty_tpl->tpl_vars['key']->value;?>
-afp-td" data-time="<?php if ($_smarty_tpl->tpl_vars['timestamp']->value != '') {
echo date("Y-m-d",strtotime("+5 day",strtotime($_smarty_tpl->tpl_vars['timestamp']->value)));
}?>"><?php if (array_key_exists('fr',$_smarty_tpl->tpl_vars['timecard']->value)) {
echo $_smarty_tpl->tpl_vars['timecard']->value['fr'];
}?></td>
                                                <td class="afp-td <?php echo $_smarty_tpl->tpl_vars['key']->value;?>
-afp-td" data-time="<?php if ($_smarty_tpl->tpl_vars['timestamp']->value != '') {
echo date("Y-m-d",strtotime("+6 day",strtotime($_smarty_tpl->tpl_vars['timestamp']->value)));
}?>"><?php if (array_key_exists('sa',$_smarty_tpl->tpl_vars['timecard']->value)) {
echo $_smarty_tpl->tpl_vars['timecard']->value['sa'];
}?></td>
                                            </tr>
                                        <?php }?>
                                    <?php $_smarty_tpl->_assignInScope('header', false);
?>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['details']->value, 'detailitem', false, 'jobkey');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['jobkey']->value => $_smarty_tpl->tpl_vars['detailitem']->value) {
?>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['detailitem']->value, 'detail', false, 'uid');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['uid']->value => $_smarty_tpl->tpl_vars['detail']->value) {
?>
                                            <?php if ($_smarty_tpl->tpl_vars['key']->value == $_smarty_tpl->tpl_vars['uid']->value) {?>
                                                <?php if (!$_smarty_tpl->tpl_vars['header']->value) {?>
                                                    <?php $_smarty_tpl->_assignInScope('header', true);
?>
                                                    <tr class="detail-header">
                                                        <th class="sub-job-name">Job/Task</th>
                                                        <th class="es-th">Sunday</th>
                                                        <th class="es-th">Monday</th>
                                                        <th class="es-th">Tuesday</th>
                                                        <th class="es-th">Wednesday</th>
                                                        <th class="es-th">Thursday</th>
                                                        <th class="es-th">Friday</th>
                                                        <th class="es-th">Saturday</th>
                                                    </tr>
                                                <?php }?>
                                                <tr class="detail-content" data-id="<?php echo $_smarty_tpl->tpl_vars['detail']->value['tid'];?>
" data-prjid="<?php echo $_smarty_tpl->tpl_vars['detail']->value['job_number'];?>
" data-jid="<?php echo $_smarty_tpl->tpl_vars['jobkey']->value;?>
">
                                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['detail']->value['job_name'], 'jitem', false, 'jkey');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['jkey']->value => $_smarty_tpl->tpl_vars['jitem']->value) {
?>
                                                        <td class="detail-desc" data-id="<?php echo $_smarty_tpl->tpl_vars['detail']->value['tid'];?>
"><?php echo $_smarty_tpl->tpl_vars['jitem']->value;?>
</td>
                                                        <td class="detail-td <?php echo $_smarty_tpl->tpl_vars['key']->value;?>
-detail-td" data-time="<?php if ($_smarty_tpl->tpl_vars['timestamp']->value != '') {
echo $_smarty_tpl->tpl_vars['timestamp']->value;
}?>" data-id="<?php if (array_key_exists('su',$_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value])) {
echo $_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value]['su'][1];
}?>">
                                                            <?php if (array_key_exists('su',$_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value])) {?><span class="hour-span"><?php echo $_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value]['su'][0];?>
</span>
                                                                <?php if ($_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value]['su'][4] != '') {?>
                                                                    <span><?php echo $_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value]['su'][4];?>
</span>
                                                                <?php }?>
                                                            <?php }?>
                                                        </td>
                                                        <td class="detail-td <?php echo $_smarty_tpl->tpl_vars['key']->value;?>
-detail-td" data-time="<?php if ($_smarty_tpl->tpl_vars['timestamp']->value != '') {
echo date("Y-m-d",strtotime("+1 day",strtotime($_smarty_tpl->tpl_vars['timestamp']->value)));
}?>" data-id="<?php if (array_key_exists('mo',$_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value])) {
echo $_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value]['mo'][1];
}?>">
                                                            <?php if (array_key_exists('mo',$_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value])) {?><span class="hour-span"><?php echo $_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value]['mo'][0];?>
</span>
                                                                <?php if ($_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value]['mo'][4] != '') {?>
                                                                    <span><?php echo $_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value]['mo'][4];?>
</span>
                                                                <?php }?>
                                                            <?php }?>
                                                        </td>
                                                        <td class="detail-td <?php echo $_smarty_tpl->tpl_vars['key']->value;?>
-detail-td" data-time="<?php if ($_smarty_tpl->tpl_vars['timestamp']->value != '') {
echo date("Y-m-d",strtotime("+2 day",strtotime($_smarty_tpl->tpl_vars['timestamp']->value)));
}?>" data-id="<?php if (array_key_exists('tu',$_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value])) {
echo $_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value]['tu'][1];
}?>">
                                                            <?php if (array_key_exists('tu',$_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value])) {?><span class="hour-span"><?php echo $_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value]['tu'][0];?>
</span>
                                                                <?php if ($_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value]['tu'][4] != '') {?>
                                                                    <span><?php echo $_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value]['tu'][4];?>
</span>
                                                                <?php }?>
                                                            <?php }?>
                                                        </td>
                                                        <td class="detail-td <?php echo $_smarty_tpl->tpl_vars['key']->value;?>
-detail-td" data-time="<?php if ($_smarty_tpl->tpl_vars['timestamp']->value != '') {
echo date("Y-m-d",strtotime("+3 day",strtotime($_smarty_tpl->tpl_vars['timestamp']->value)));
}?>" data-id="<?php if (array_key_exists('we',$_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value])) {
echo $_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value]['we'][1];
}?>">
                                                            <?php if (array_key_exists('we',$_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value])) {?><span class="hour-span"><?php echo $_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value]['we'][0];?>
</span>
                                                                <?php if ($_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value]['we'][4] != '') {?>
                                                                    <span><?php echo $_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value]['we'][4];?>
</span>
                                                                <?php }?>
                                                            <?php }?>
                                                        </td>
                                                        <td class="detail-td <?php echo $_smarty_tpl->tpl_vars['key']->value;?>
-detail-td" data-time="<?php if ($_smarty_tpl->tpl_vars['timestamp']->value != '') {
echo date("Y-m-d",strtotime("+4 day",strtotime($_smarty_tpl->tpl_vars['timestamp']->value)));
}?>" data-id="<?php if (array_key_exists('th',$_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value])) {
echo $_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value]['th'][1];
}?>">
                                                            <?php if (array_key_exists('th',$_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value])) {?><span class="hour-span"><?php echo $_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value]['th'][0];?>
</span>
                                                                <?php if ($_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value]['th'][4] != '') {?>
                                                                    <span><?php echo $_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value]['th'][4];?>
</span>
                                                                <?php }?>
                                                            <?php }?>
                                                        </td>
                                                        <td class="detail-td <?php echo $_smarty_tpl->tpl_vars['key']->value;?>
-detail-td" data-time="<?php if ($_smarty_tpl->tpl_vars['timestamp']->value != '') {
echo date("Y-m-d",strtotime("+5 day",strtotime($_smarty_tpl->tpl_vars['timestamp']->value)));
}?>" data-id="<?php if (array_key_exists('fr',$_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value])) {
echo $_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value]['fr'][1];
}?>">
                                                            <?php if (array_key_exists('fr',$_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value])) {?><span class="hour-span"><?php echo $_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value]['fr'][0];?>
</span>
                                                                <?php if ($_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value]['fr'][4] != '') {?>
                                                                    <span><?php echo $_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value]['fr'][4];?>
</span>
                                                                <?php }?>
                                                            <?php }?>
                                                        </td>
                                                        <td class="detail-td <?php echo $_smarty_tpl->tpl_vars['key']->value;?>
-detail-td" data-time="<?php if ($_smarty_tpl->tpl_vars['timestamp']->value != '') {
echo date("Y-m-d",strtotime("+6 day",strtotime($_smarty_tpl->tpl_vars['timestamp']->value)));
}?>" data-id="<?php if (array_key_exists('sa',$_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value])) {
echo $_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value]['sa'][1];
}?>">
                                                            <?php if (array_key_exists('sa',$_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value])) {?><span class="hour-span"><?php echo $_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value]['sa'][0];?>
</span>
                                                                <?php if ($_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value]['sa'][4] != '') {?>
                                                                    <span><?php echo $_smarty_tpl->tpl_vars['detail']->value[$_smarty_tpl->tpl_vars['jkey']->value]['sa'][4];?>
</span>
                                                                <?php }?>
                                                            <?php }?>
                                                        </td>
                                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                                </tr>
                                            <?php }?>
                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                    <?php if ($_smarty_tpl->tpl_vars['header']->value) {?>
                                        <tr>
                                            <td>
                                                <button class="btn detail-add-job" id="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
_add_job" data-id="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
">+ Add Job</button>
                                            </td>
                                            <td colspan="5"></td>
                                            <td>
                                                <button class="btn detail-finalize" style="display:<?php echo $_smarty_tpl->tpl_vars['thisweek']->value == "y" ? "none" : "block";?>
" id="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
_detail_finalize" data-id="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
">FINALIZE</button>
                                            </td>
                                            <td>
                                                <button class="btn detail-edit" data-id="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
_edit_job">EDIT</button>
                                            </td>
                                        </tr>
                                    <?php }?>
                                </table>
                            </td>
                        </tr>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                <?php } else { ?>
                    <?php if ($_smarty_tpl->tpl_vars['timestamp']->value) {?>
                        <tr><td colspan="6">Not match found.</td></tr>
                    <?php } else { ?>
                        <tr><td colspan="6">Please select week.</td></tr>
                    <?php }?>
                <?php }?>
                </tbody>
            </table>

            <div class="clr30"></div>
            <button class="btn btn-theme" id="exportdata">Download Timecard</button>
        </div>
    </div>
</div><?php }
}
