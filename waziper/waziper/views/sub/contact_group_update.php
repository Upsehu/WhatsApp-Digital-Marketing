<div class="waziper modal fade wa-contact-group-import-modal" id="wa-contact-group-import-modal" tabindex="-1"
    role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">

        	<form class="Waziper_actionForm" action="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=save_contact_group&ids='.waziper_get_data($result, 'ids'))?>" data-call-after="WaziperJs.reload_contact_group();">
	            <div class="modal-header">
	                <h4 class="modal-title wz-fs-16"><i class="ri-edit-box-line"></i> <?php waziper_e("Update")?></h4>
	                <button type="button" class="close bg-white border-0" data-dismiss="modal"
	                    aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <div class="modal-body">
		
					<div class="form-group wz-m-b-15">
				    	<label for="status"><?php waziper_e('Status')?></label>
				    	<div>
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
				  	<div class="form-group wz-m-b-15 wz-m-b-0">
				    	<label for="name"><?php waziper_e('Group contact name')?></label>
				    	<input type="text" class="form-control" id="name" name="name" value="<?php waziper_e( waziper_get_data($result, 'name') )?>">
				  	</div>

	            </div>
	            <div class="modal-footer">
		        	<button type="button" class="btn btn-dark" data-dismiss="modal"><?php waziper_e('Close')?></button>
				  	<button type="submit" class="btn btn-success"><?php waziper_e('Submit')?></button>
		        </div>

			</form>
        </div>
    </div>
</div>