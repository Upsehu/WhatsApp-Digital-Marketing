<div class="wz-p-25 wa-chatbot-update">
	<h4 class="mb-4 align-items-center d-flex">
		<div class="d-block d-lg-none mr-2">
			<a href="javascript:void(0);" class="user-chat-remove wa-back-submenu text-muted fs-16 p-2">
				<i class="ri-arrow-left-s-line"></i>
			</a>
		</div>
		<div><?php waziper_e("Update")?></div>
	</h4>

	<div class="row">
		<div class="col-md-12 post">
			<form class="Waziper_actionForm post-create wz-p-t-10" action="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=chatbot_save&instance_id='.$instance_id)?>" data-call-after="WaziperJs.reload_chatbot(result);">
				<div class="post-content wz-m-b-15">
		            <h5 class="mb-3 wz-fs-14"><?php waziper_e('Status')?></h5>
		            <div class="mb-2">
		                <label class="i-radio i-radio--tick i-radio--success wz-m-r-10">
		                    <input type="radio" name="status" checked="true" value="1" <?php waziper_e( waziper_get_data($result, 'status', 'radio', 1) )?> > <?php waziper_e('Enable')?>
		                    <span></span>
		                </label>
		                <label class="i-radio i-radio--tick i-radio--success wz-m-r-10">
		                    <input type="radio" name="status" value="0" <?php waziper_e( waziper_get_data($result, 'status', 'radio', 0) )?> > <?php waziper_e('Disable')?>
		                    <span></span>
		                </label>
		            </div>

		            <div class="mb-2">
		                <h5 class="mb-3 wz-fs-14"><?php waziper_e('Sent to')?></h5>
		                <div class="mb-2">
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

		            <h5 class="mb-3 wz-fs-14"><?php waziper_e('Type')?></h5>
		            <div class="mb-2">
		                <label class="i-radio i-radio--tick i-radio--success wz-m-r-10">
		                    <input type="radio" name="type" checked="true" value="1" <?php waziper_e( waziper_get_data($result, 'type', 'radio', 1) )?> > <?php waziper_e('Message contains the keyword')?>
		                    <span></span>
		                </label>
		                <label class="i-radio i-radio--tick i-radio--success wz-m-r-10">
		                    <input type="radio" name="type" value="2" <?php waziper_e( waziper_get_data($result, 'type', 'radio', 2) )?> > <?php waziper_e('Message contains whole keyword')?>
		                    <span></span>
		                </label>
		            </div>

					<?php if(!empty($result)){?>
						<input type="hidden" class="form-control" name="ids" required="" value="<?php waziper_e( $result->ids )?>">
					<?php }?>
					<input type="hidden" class="form-control" name="instance_id" required="" value="<?php waziper_e( $instance_id )?>">
					<div class="form-group">
						<input class="form-control" name="name" required="" placeholder="<?php waziper_e("Name")?>" value="<?php waziper_e( waziper_get_data($result, 'name') )?>">
					</div>
					<div class="form-group">
						<input class="form-control tagsinput" type="text" name="keywords" data-role="tagsinput" placeholder="<?php waziper_e("Enter keywords")?>" value="<?php waziper_e( waziper_get_data($result, 'keywords') )?>">
					</div>
				    <div class="mt-3 wz-m-b-20">
		                <div class="waziper-file-manager bg-white">
		                    <input type="hidden" class="waziper-input-image" name="media[]">
		                    <div class="waziper-box-image wz-m-b-15 text-center ">
		                        
		                    </div>
		                    <div class="btn-group wz-w-100" role="group">
		                        <button class="btn btn-success wz-w-100 waziper_media_manager"><?php waziper_e('Select file')?></button>
		                        <button type="button" class="btn btn-dark waziper_media_remove"><i class="fas fa-trash-alt"></i></button>
		                    </div>
		                </div>
			        </div>
					<div class="post">
				        <div class="post-content">
			                <div class="waziper-caption wz-m-t-15">
		                        <textarea name="caption" class="form-control post-message" placeholder="<?php waziper_e('Enter your caption')?>"></textarea>
		                        <div class="waziper-caption-toolbar">
		                            <div class="item">
		                                <div class="count-word"><i class="fas fa-text-width"></i> <span>0</span></div>          
		                            </div>
		                        </div>
		                    </div>
			                <ul class="text-success small wz-m-b-15 wz-m-t-5">
	                            <li><?php waziper_e("Random message by Spintax")?></li>
	                            <li><?php waziper_e("Ex: {Hi|Hello|Hola}")?></li>
	                        </ul>
				        </div>
				    </div>
					
				</div>

			  	<button type="submit" class="btn btn-success wz-m-b-25"><?php waziper_e('Save')?></a>
			</form>
		</div>
	</div>

</div>
<?php if(!empty($result)){?>
    <script type="text/javascript">
        var caption = `<?php waziper_e($result->caption)?>`;

        <?php if($result->media != NULL){?>
        var medias = <?php waziper_e($result->media)?>;
    	<?php }else{?>
		var medias = [];
    	<?php }?>

        jQuery(function(){

            setTimeout(function(){
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
<?php }?>