<div class="waziper modal fade wa-contact-group-import-modal" id="wa-contact-group-import-modal" tabindex="-1"
    role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title wz-fs-16"><i class="ri-contacts-book-fill"></i> <?php waziper_e("Contacts")?></h4>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body wz-p-1">
            	<form>
	            	<div class="wz-p-l-20 wz-p-r-20 wz-p-t-10 wz-p-b-5">
	            		<div class="row">
	            			<div class="col-6">
		            			<label class="i-checkbox i-checkbox--tick i-checkbox--success position-relative t-7 wz-fs-13">
									<input type="checkbox" class="check-all">
									<span></span>
									<b><?php waziper_e("Check All")?></b>
								</label>
		            		</div>
		            		<div class="col-6">
		            			<a class="btn btn-label-danger btn-sm float-right m-r-20 position-relative m-b-10 Waziper_actionMultiItem" href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=delete_phone&ids='.$ids)?>" data-confirm="<?php waziper_e('Are you sure to delete this items?')?>" data-call-after="WaziperJs.phone_numbers();"><i class="far fa-trash-alt"></i></a>
		            		</div>
	            		</div>
	            	</div>
	            	<ul class="wa-contact-group-import-items ajax-load-log list-group list-group-flush wa-scroll" data-id="<?php waziper_e( $ids )?>" data-url="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=load_contact_group_list&ids='.$ids)?>" data-page="0" data-load-type="scroll" data-scroll=".wa-contact-group-import-items">
	            		<div class="fa-2x m-auto wz-p-40">
						  <i class="fas fa-spinner fa-spin text-info"></i>
						</div>
					</ul>
				</form>
            </div>

        </div>
    </div>
</div>