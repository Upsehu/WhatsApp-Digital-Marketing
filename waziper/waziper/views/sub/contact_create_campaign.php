<div class="wa-bulk-update wz-p-25">
	<h4 class="mb-4 d-flex">
		<div class="d-block d-lg-none mr-2">
			<a href="javascript:void(0);" class="user-chat-remove wa-back-submenu text-muted fs-16 p-2">
				<i class="ri-arrow-left-s-line"></i>
			</a>
		</div>
		<div><?php waziper_e('Create campaign')?></div>
	</h4>

	<div class="row">
		<div class="col-md-12 post">
			<form class="Waziper_actionForm post-create wz-p-t-10" action="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=bulk_save')?>" data-call-after="WaziperJs.reload_bulk_schedules(result);">
				<div class="post-content m-b-15">
					<?php if(!empty($item)){?>
						<input type="hidden" class="form-control" name="ids" required="" value="<?php waziper_e( $item->ids )?>">
					<?php }?>
					<input type="hidden" class="form-control" name="instance_id" required="" value="<?php waziper_e( $instance_id )?>">
					<div class="form-group">
						<input class="form-control" name="name" required="" placeholder="<?php waziper_e("Campaign name")?>">
					</div>
					<div class="form-group">
						<select class="form-control wz-w-100" name="group" required="">
							<option value=""><?php waziper_e("Select contact group")?></option>
							<?php if(!empty($groups)){
								foreach ($groups as $key => $value) {
							?>
							<option value="<?php waziper_e($value->id)?>"><?php waziper_e($value->name)?></option>
							<?php }}?>
						</select>
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

				<div class="post-schedule wz-m-b-15 active">
					<input type="hidden" name="is_schedule" value="1" >
					<div class="post-schedule-content">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label><?php waziper_e('Time post')?></label>
									<input type="text" class="form-control datetime" autocomplete="off" name="time_post" value="">
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label><?php waziper_e('Random message interval by minimum (second)')?></label>
									<input type="number" class="form-control" autocomplete="off" name="min_interval_per_post" value="60">
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label><?php waziper_e('Random message interval by maximum (second)')?></label>
									<input type="number" class="form-control" autocomplete="off" name="max_interval_per_post" value="300">
								</div>
							</div>
						</div>
					</div>
				</div>

			  	<button type="submit" class="btn btn-success wz-m-b-25"><?php waziper_e('Schedule')?></a>
			</form>
		</div>
	</div>

</div>
<?php if(!empty($item)){?>
    <script type="text/javascript">
        
        var contact_group_id = `<?php waziper_e($item->contact_group_id)?>`;
        var name = `<?php waziper_e($item->name)?>`;
        var caption = `<?php waziper_e($item->data)?>`;

        <?php if($item->media != NULL){?>
        var medias = <?php waziper_e($item->media)?>;
    	<?php }else{?>
		var medias = [];
    	<?php }?>
        var time_post = '<?php waziper_e( date("d/m/Y H:i", $item->time_post) )?>';
        var min_delay = '<?php waziper_e( $item->min_delay )?>';
        var max_delay = '<?php waziper_e( $item->max_delay )?>';

        jQuery(function(){

            setTimeout(function(){
                jQuery("[name=name]").val(name);
                jQuery("[name=min_interval_per_post]").val(min_delay);
                jQuery("[name=max_interval_per_post]").val(max_delay);
                jQuery("[name=time_post]").val(time_post);
                jQuery("[name=group]").val(contact_group_id);

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