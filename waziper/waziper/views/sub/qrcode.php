<div class="tab-pane h-100 show active" id="pills-chat" role="tabpanel" aria-labelledby="pills-chat-tab">
    <div class="px-4 pt-4">
        <h4 class="mb-4">Scan QRCode</h4>
    </div> <!-- .p-4 -->

    <div class="chat-message-detail wa-scroll px-4 m-t-30 p-b-25" >
    	<h5 class="wz-fs-16 mb-1 text-truncate text-success"> Instance ID: <?php waziper_e( $instance_id )?> </h5>
    	<p class="text-muted text-truncate mb-1"> <?php waziper_e("Scan the QR Code on your Whatsapp app")?> </p>
    	<div class="text-center wz-m-t-20">
    		<div class="mb-4 profile-user">
	    		<img class="w-100" src="<?php waziper_e( $qrcode, false )?>">
	    	</div>
    	</div>
	    <ul class="list-group wz-m-b-25">
			<li class="list-group-item  bg-success text-white text-uppercase"><i class="far fa-question-circle"></i> <?php waziper_e("To start using tool you need to connect your phone number.")?></li>
			<li class="list-group-item"><?php waziper_e("Step 1: Open WhatsApp on your phone") ?></li>
			<li class="list-group-item"><?php waziper_e("Step 2: Tap Menu or Settings and select WhatsApp Web") ?></li>
			<li class="list-group-item"><?php waziper_e("Step 3: Point your phone at this screen and capture the code above") ?></li>
			<li class="list-group-item text-danger">
				<video width="100%" height="220" autoplay muted loop>
				  <source src="<?php waziper_e( plugins_url( '/waziper/assets/img/scan.mp4' ) )?>" type="video/mp4">
				</video> 
			</li>
		</ul>
		<script type="text/javascript">
			var INSTANCE_ID = '<?php waziper_e( $instance_id )?>';
			WaziperJs.check_login( "<?php waziper_e( admin_url('admin-ajax.php?action=waziper_pages&page=check_login&instance_id='.$instance_id) )?>" );
		</script>
    </div>

</div>

