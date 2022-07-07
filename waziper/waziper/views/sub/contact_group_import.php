<div class="waziper modal fade wa-contact-group-import-modal" id="wa-contact-group-import-modal" tabindex="-1"
    role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">

        	<form class="Waziper_actionForm" action="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=ajax_add_phone&ids='.$ids)?>" data-call-after="WaziperJs.reload_contact_group();">
            <div class="modal-header">
                <h4 class="modal-title wz-fs-16"><i class="ri-user-add-line"></i> <?php waziper_e("Import contact")?></h4>
                <button type="button" class="close bg-white border-0" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
					
			    	<label for="phone_numbers">
			    		<?php waziper_e('Add multiple phone numbers')?>
			    		<ul class="text-success small wz-m-b-0 wz-p-l-0">
			    			<li><?php waziper_e("Every phone number must be all one with it's dial code. Each phone number is separated by break line")?></li>
			    			<li><?php waziper_e("E.g. (+84) 1234567890 must me 841234567890")?></li>
			    		</ul>
			    	</label>
			    	<textarea class="form-control" name="phone_numbers" id="phone_numbers" rows="20" placeholder="<?php waziper_e("Validate exapmle:")?>

841234567890
840123456789
+840123456798"></textarea>
            </div>
	        <div class="modal-footer">
	        	<button type="button" class="btn btn-dark" data-dismiss="modal"><?php waziper_e('Close')?></button>
			  	<button type="submit" class="btn btn-success"><?php waziper_e('Submit')?></button>
	        </div>
        </div>
		</form>
    </div>
</div>