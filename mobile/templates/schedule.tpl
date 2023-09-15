<script type="text/javascript" src="{$homeUrl}js/schedule.js"></script>
<div class="view-reservation container">
    <div class="row">
        <div class="col-xs-12">
            <form id="schedule_form" method="POST" action="{$siteUrl}schedule">
                <input name="delta" id="delta" value="{$delta}" hidden>
                <div class="subpadding20 text-center">
                    <div class="clr30"></div>
                    <h2 class="white text-center bold">My Schedule</h2>
                    <h4 class="white text-center"><a class="prev-btn"><<</a> {$today} <a class="next-btn">>></a></h4>
                    {foreach from=$sdata item=data}
                    <div class="card-box">
                        <span class="card-date">{$data.name}</span>
                        {if $data.alert == 1}<span class="card-afp-name">ALERT! MUST WEAR AFP10 MASK!!!</span>{/if}
                        <span class="card-task-name detail-align">Tasks: {$data.description}</span>
                        {if $data.address1}<span class="card-prj-name detail-align detail-font">Address:  <span style="font-weight: 500">{$data.address1}</span></span>{/if}
                        <span class="card-prj-name detail-align detail-font" style="padding-left: 95px">{if $data.city}{$data.city}{","}{/if} {if $data.state}{$data.state}{/if} {if $data.zip}{$data.zip}{/if}</span>
                        {if $data.notes}<span class="card-prj-name detail-align detail-font">Project Notes:  <span style="font-weight: 500">{$data.notes}</span></span>{/if}
                        {if $data.manager_name}<span class="card-prj-name detail-align detail-font">Proj. Mgr:  <span style="font-weight: 500">{$data.manager_name}</span></span>{/if}
                        {if $data.contact}<span class="card-prj-name detail-align detail-font">On-site Contact Person:  <span style="font-weight: 500">{$data.contact}</span></span>{/if}
                        {if $data.phone}<span class="card-prj-name detail-align detail-font">Contact Person's #:  <span style="font-weight: 500">{$data.phone}</span></span>{/if}
                        {if $data.link}
                            <div class="file-action">
                                <button type="button" class="show-file" id="{$data.tid}showFile" data-id="{$data.tid}">VIEW PROJECT FILE</button>
                            </div>
                            <div class="project-file" id="{$data.tid}projectFile">
                                <div class="preview-header">
                                    <span>Project Files</span>
                                    <img class="close-preview" src="{$siteUrl}img/close-preview.png" data-id="{$data.tid}">
                                </div>
                                <div class="preview-section">
                                    <iframe src="{$data.link}" class="preview-content">
                                        <p>Your browser does not support iframe</p>
                                    </iframe>
                                </div>
                                <div class="preview-footer"></div>
                            </div>
                        {/if}
                        <span class="card-notes border-round" id="{$data.tid}notes" data-id="{$data.tid}">ADD NOTES</span>
                        <div class="notes-section" id="{$data.tid}noteSection">
                            <div class="note-header">NOTES</div>
                            <div class="notes-content">
                                <textarea rows="5" class="notes" id="{$data.tid}noteContent"></textarea>
                            </div>
                            <div class="note-action">
                                <button class="btn btn-danger btn-lg btn-span cancel-btn" type="button" id="{$data.tid}Cancel" data-id="{$data.tid}">CANCEL</button>
                                <button class="btn btn-success btn-lg btn-span" type="button">SAVE</button>
                            </div>
                        </div>
                    </div>
                    {/foreach}
                </div>
            </form>
        </div>
    </div>
</div>