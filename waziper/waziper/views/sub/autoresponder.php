<!-- Start chats tab-pane -->
<div class="tab-pane h-100 show active autoresponder" id="pills-chat" role="tabpanel post" aria-labelledby="pills-chat-tab">
    <div class="px-4 pt-4">
        <h4 class="mb-4"><?php waziper_e('Auto responder')?></h4>
    </div>

    <div class="chat-message-detail wa-scroll px-2 wz-p-b-15">
        <form class="Waziper_actionForm post-create p-t-10 position-relative" action="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=autoresponder_save')?>">
        <div class="px-2">
            <div class="px-3">
                <input type="hidden" class="form-control" name="instance_id" value="<?php waziper_e( $instance_id )?>">
            </div>
        </div>
        <!-- Start chat-message-list -->
        <div class="px-2">
            <h5 class="mb-2 px-3 wz-fs-14"><?php waziper_e('Status')?></h5>
            <div class="px-3">
                <label class="i-radio i-radio--tick i-radio--success wz-m-r-10">
                    <input type="radio" name="status" checked="true" value="1" <?php waziper_e( waziper_get_data($result, 'status', 'radio', 1) )?> > <?php waziper_e('Enable')?>
                    <span></span>
                </label>
                <label class="i-radio i-radio--tick i-radio--success wz-m-r-10">
                    <input type="radio" name="status" value="0" <?php waziper_e( waziper_get_data($result, 'status', 'radio', 0) )?> > <?php waziper_e('Disable')?>
                    <span></span>
                </label>
            </div>
        </div>
        <div class="px-2 wz-m-t-15">
            <h5 class="mb-2 px-3 wz-fs-14"><?php waziper_e('Sent to')?></h5>
            <div class="px-3">
                <label class="i-radio i-radio--tick i-radio--success wz-m-r-10">
                    <input type="radio" name="send_to" checked="true" value="1" <?php waziper_e( waziper_get_data($result, 'send_to', 'radio', 1) )?> > <?php waziper_e('All')?>
                    <span></span>
                </label>
                <label class="i-radio i-radio--tick i-radio--success wz-m-r-10">
                    <input type="radio" name="send_to" value="2" <?php waziper_e( waziper_get_data($result, 'send_to', 'radio', 2) )?> > <?php waziper_e('Individual')?>
                    <span></span>
                </label>
                <label class="i-radio i-radio--tick i-radio--success wz-m-r-10">
                    <input type="radio" name="send_to" value="3" <?php waziper_e( waziper_get_data($result, 'send_to', 'radio', 3) )?> > <?php waziper_e('Group only')?>
                    <span></span>
                </label>
            </div>
        </div>
        <div class="px-2 mt-3 wz-m-b-20">
            <div class="px-3">
                <div class="waziper-file-manager">
                    <input type="hidden" class="waziper-input-image" name="media[]">
                    <div class="waziper-box-image wz-m-b-15 text-center ">
                        
                    </div>
                    <div class="btn-group wz-w-100" role="group">
                        <button class="btn btn-success wz-w-100 waziper_media_manager"><?php waziper_e('Select file')?></button>
                        <button type="button" class="btn btn-dark waziper_media_remove"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="post">
            <div class="px-2 post-content">
                <div class="px-3">
                    <div class="waziper-caption m-t-15">
                        <textarea name="caption" class="form-control post-message" placeholder="<?php waziper_e('Enter your caption')?>"></textarea>
                        <div class="waziper-caption-toolbar">
                            <div class="item">
                                <div class="count-word"><i class="fas fa-text-width"></i> <span>0</span></div>          
                            </div>
                        </div>
                    </div>
                    <ul class="text-success small wz-m-b-0 wz-m-t-3 wz-p-l-0">
                        <li><?php waziper_e("Random message by Spintax")?></li>
                        <li><?php waziper_e("Ex: {Hi|Hello|Hola}")?></li>
                    </ul>
                </div>

            </div> 
        </div>
        <div class="px-4 mt-3">
            <h5 for="delay" class="wz-fs-14"><?php waziper_e('Resubmit message only after (minute)')?></h5>
            <select class="form-control" id="delay" name="delay">
                <?php for ($i=1; $i <= 4; $i++) {?>
                    <option value="<?php waziper_e($i)?>" <?php waziper_e( !empty($result) && $result->delay == $i ? "selected":"" )?> ><?php waziper_e($i)?></option>
                <?php } ?>
                <?php 
                    for ($i=1; $i <= 3600; $i++) { 
                        if($i%5 == 0){
                ?>
                    <option value="<?php waziper_e($i)?>" <?php waziper_e( !empty($result) && $result->delay == $i ? "selected":"" )?>><?php waziper_e($i)?></option>
                <?php
                        }       
                    }
                ?>
            </select>
        </div>
        <div class="px-4 mt-3">
            <h5 for="delay" class="wz-fs-14"><?php waziper_e("Except contacts")?></h5>
            <div id="ms1" class="form-control wz-p-0"></div>
            <div class="small text-success">
                <?php waziper_e("Validate exapmle:")?> 
                841234567890, 
                840123456789
            </div>
        </div>
        <div class="px-4 mt-3 wz-m-b-10">
            <button type="submit" class="btn btn-success"><?php waziper_e('Submit')?></button>
            <button type="button" class="btn btn-success wa-btn-open-content d-block d-lg-none float-right"><?php waziper_e('Preview')?></button>
        </div>
        </form>
    </div>
</div>
    <!-- End chat-message-list -->


<?php if($result){?>
    <script type="text/javascript">

        var caption = `<?php waziper_e($result->data)?>`;
        var delay = `<?php waziper_e( $result->delay )?>`;

        <?php if($result->media != NULL){?>
        var medias = <?php waziper_e($result->media)?>;
        <?php }else{?>
        var medias = [];
        <?php }?>

        <?php 
            if($result->except != NULL){
                $except_data = [];
                $excepts = json_decode($result->except);
                if(!empty($excepts)){
                    foreach ($excepts as $value) {
                        $arr = explode("{|}", $value);
                        $except_data[] = [
                            "id" => $value,
                            "name" => $value
                        ];
                    }
                }
                $except_data = json_encode($except_data);
            }else{
                $except_data = "[]";
            }
        ?>

        jQuery(function(){
            WaziperJs.search_contact(<?php waziper_e($except_data)?>);

            setTimeout(function(){
                jQuery("[name=delay]").val(delay);

                var el = jQuery("textarea[name=caption]").emojioneArea();
                el[0].emojioneArea.setText(caption);

                if(medias != null){
                    for (var i = 0; i < medias.length; i++) {
                        if(medias[i] != ""){
                            WaziperJs.file_preview(medias[i]);
                        }
                    }
                }
            }, 1000);

        });



    </script> 
<?php }else{?>
<script type="text/javascript">
    jQuery(function(){
        WaziperJs.search_contact([]);
    });
</script>
<?php }?>


