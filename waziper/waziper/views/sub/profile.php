<!-- Start chats tab-pane -->
<div class="tab-pane h-100 show active" id="pills-chat" role="tabpanel" aria-labelledby="pills-chat-tab">
    <div class="px-4 pt-4">
        <h4 class="mb-4"><?php waziper_e('Profile')?></h4>
    </div> <!-- .p-4 -->

    <div class="chat-message-detail wa-scroll px-4 m-t-30 wz-p-b-25">
    	<div class="text-center">
    		<div class="mb-4 profile-user">
	    		<img src="<?php waziper_e( (isset($result->avatar) && $result->avatar)?$result->avatar:waziper_get_avatar($result->name))?>" alt="" class="rounded-circle avatar-lg img-thumbnail">
	    	</div>
	    	<h5 class="font-size-16 mb-1 text-truncate"> <?php waziper_e( $result->name )?> </h5>
	    	<p class="text-muted text-truncate mb-1"> <?php waziper_e( $result->id )?> </p>
	    	<p class="text-muted text-truncate mb-1"><i class="ri-record-circle-fill font-size-10 text-success mr-1 d-inline-block"></i> <?php waziper_e("Active")?> </p>
    	</div>
        <ul class="list-group wz-m-t-50">
		  	<li class="list-group-item justify-content-between align-items-center text-center">
		    	<p class="wz-m-b-5"><i class="fas fa-key"></i> <?php waziper_e("Access Token")?></p>
		    	<span class="text-success"><?php waziper_e( get_option( 'waziper_access_token' ) )?></span>
		  	</li>
		  	<li class="list-group-item d-flex justify-content-between align-items-center">
		    	<?php waziper_e("Instance ID")?>
		    	<span class="badge badge-success badge-pill text-white wz-fw-4 wz-p-5"><?php waziper_e($account->token)?></span>
		  	</li>
		</ul>
	    <div class="wz-m-t-15">
			<a class="btn btn-dark btn-block wz-w-100 wa-action-item wa-back-account wa-button-logout" href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=logout')?>" data-result-submenu="wa-submenu-data" data-result-content="wa-content">
	    		<?php waziper_e("Logout")?>
			</a>
	    </div>
    </div>

    <!-- End chat-message-list -->
</div>
<!-- End chats tab-pane -->