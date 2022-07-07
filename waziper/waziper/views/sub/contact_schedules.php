<div class="wa-bulk-schedules container wz-p-25">
	
	<h4 class="mb-4 d-flex">
		<div class="d-block d-lg-none mr-2">
			<a href="javascript:void(0);" class="user-chat-remove wa-back-submenu text-muted wz-fs-16 p-2">
				<i class="ri-arrow-left-s-line"></i>
			</a>
		</div>
		<div>
			<?php waziper_e('Schedules')?>
		</div>
			
	</h4>

	<div class="wa-contact-schedule-items ajax-load-log wa-scroll row" data-id="<?php waziper_e( $instance_id )?>" data-url="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=load_contact_schedules&instance_id='.$instance_id)?>" data-page="0" data-load-type="scroll" data-scroll=".wa-content">
		<div class="fa-2x m-auto wz-p-40">
		  <i class="fas fa-spinner fa-spin text-info"></i>
		</div>
	</div>
</div>


<script type="text/javascript">
	jQuery(function(){
		WaziperJs.ajax_load_start();
		jQuery(".page-link").addClass("wa-action-item").attr('data-result-content', 'wa-content');
	});
</script>