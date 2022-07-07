<div class="container">
	<div class="row wz-p-t-25 wz-p-b-25">
		<div class="col-12">

			<div class="alert bg-solid-success wz-p-20 wz-m-b-30" role="alert">
				<?php waziper_e("Your Access Token:")?> <strong><?php waziper_e( get_option("waziper_access_token") )?></strong>
			</div>			

			<h5 class="wz-m-b-30 wz-p-b-20 text-dark text-uppercase"><?php waziper_e("Instance Api")?></h5>
			<h6 class="border-bottom wz-m-b-30 wz-p-b-20 wz-p-t-20" id="create-instance"><span class="text-success fw-6 m-r-5"><?php waziper_e("POST")?></span> <?php waziper_e("Create Instance")?></h6>
			<div class="alert alert-dark bg-dark" role="alert">
				<code class="text-white fs-12">
					<?php waziper_e( get_site_url()."/api/createinstance.php?access_token=".get_option("waziper_access_token") )?>
				</code>
			</div>

			<div class="text">
				<?php waziper_e("Create a new Instance ID")?>
			</div>

			<div class="text-uppercase wz-fs-16 border-bottom wz-m-b-15 wz-p-b-10 wz-m-t-30"><?php waziper_e("Params")?></div>

			<table class="table table-striped table-borderless">
			  	<tbody>
				    <tr>
				      	<td class="fw-6">access_token</td>
				      	<td><?php echo get_option("waziper_access_token"); ?></td>
				    </tr>
			  	</tbody>
			</table>

			<h6 class="border-bottom wz-m-b-30 wz-p-b-20 wz-m-t-40 wz-p-t-20" id="get-qr-code"><span class="text-success fw-6 m-r-5"><?php waziper_e("POST")?></span> <?php waziper_e("Get QR Code")?></h6>
			<div class="alert alert-dark bg-dark" role="alert">
				<code class="text-white fs-12">
					<?php waziper_e( get_site_url()."/api/getqrcode.php?instance_id=609ACF283XXXX&access_token=".get_option("waziper_access_token") )?>
				</code>
			</div>

			<div class="text"><?php waziper_e("Display QR code to login to Whatsapp web. You can get the results returned via Webhook")?></div>

			<div class="text-uppercase wz-fs-16 border-bottom wz-m-b-15 wz-p-b-10 wz-m-t-30"><?php waziper_e("Params")?></div>

			<table class="table table-striped table-borderless">
			  	<tbody>
				    <tr>
				      	<td class="fw-6">instance_id</td>
				      	<td>609ACF283XXXX</td>
				    </tr>
				    <tr>
				      	<td class="fw-6">access_token</td>
				      	<td><?php echo get_option("waziper_access_token"); ?></td>
				    </tr>
			  	</tbody>
			</table>

			<h6 class="border-bottom wz-m-b-30 wz-p-b-20 wz-m-t-40 wz-p-t-20" id="set-receving-webhook"><span class="text-success fw-6 m-r-5"><?php waziper_e("POST")?></span> <?php waziper_e("Set Receving Webhook")?></h6>
			<div class="alert alert-dark bg-dark" role="alert">
				<code class="text-white fs-12">
					<?php waziper_e( get_site_url()."/api/setwebhook.php?webhook_url=https://webhook.site/1b25464d6833784f96eef4xxxxxxxxxx&enable=true&instance_id=609ACF283XXXX&access_token=".get_option("waziper_access_token") )?>
				</code>
			</div>

			<div class="text"><?php waziper_e("Get all return values from Whatsapp. Like connection status, Incoming message, Outgoing message, Disconnected, Change Battery,...")?></div>

			<div class="text-uppercase wz-fs-16 border-bottom wz-m-b-15 wz-p-b-10 wz-m-t-30"><?php waziper_e("Params")?></div>

			<table class="table table-striped table-borderless">
			  	<tbody>
			  		<tr>
				      	<td class="fw-6">webhook_url</td>
				      	<td>https://webhook.site/1b25464d6833784f96eef4xxxxxxxxxx</td>
				    </tr>
				    <tr>
				      	<td class="fw-6">enable</td>
				      	<td>true</td>
				    </tr>
				    <tr>
				      	<td class="fw-6">instance_id</td>
				      	<td>609ACF283XXXX</td>
				    </tr>
				    <tr>
				      	<td class="fw-6">access_token</td>
				      	<td><?php echo get_option("waziper_access_token"); ?></td>
				    </tr>
			  	</tbody>
			</table>

			<h6 class="border-bottom wz-m-b-30 wz-p-b-20 wz-m-t-40 wz-p-t-20" id="reboot-instance"><span class="text-success fw-6 m-r-5"><?php waziper_e("POST")?></span> <?php waziper_e("Reboot Instance")?></h6>
			<div class="alert alert-dark bg-dark" role="alert">
				<code class="text-white fs-12">
					<?php waziper_e( get_site_url()."/api/reboot.php?instance_id=609ACF283XXXX&access_token=".get_option("waziper_access_token") )?>
				</code>
			</div>

			<div class="text">
				<?php waziper_e("Logout Whatsapp web and do a fresh scan")?>
			</div>

			<div class="text-uppercase wz-fs-16 border-bottom wz-m-b-15 wz-p-b-10 wz-m-t-30"><?php waziper_e("Params")?></div>

			<table class="table table-striped table-borderless">
			  	<tbody>
				    <tr>
				      	<td class="fw-6">instance_id</td>
				      	<td>609ACF283XXXX</td>
				    </tr>
				    <tr>
				      	<td class="fw-6">access_token</td>
				      	<td><?php echo get_option("waziper_access_token"); ?></td>
				    </tr>
			  	</tbody>
			</table>

			<h6 class="border-bottom wz-m-b-30 wz-p-b-20 wz-m-t-40 wz-p-t-20" id="reset-instance"><span class="text-success fw-6 m-r-5"><?php waziper_e("POST")?></span> <?php waziper_e("Reset Instance")?></h6>
			<div class="alert alert-dark bg-dark" role="alert">
				<code class="text-white fs-12">
					<?php waziper_e( get_site_url()."/api/resetinstance.php?instance_id=609ACF283XXXX&access_token=".get_option("waziper_access_token") )?>
				</code>
			</div>

			<div class="text">
				<?php waziper_e("This will logout Whatsapp web, Change Instance ID, Delete all old instance data")?>
			</div>

			<div class="text-uppercase wz-fs-16 border-bottom wz-m-b-15 wz-p-b-10 wz-m-t-30"><?php waziper_e("Params")?></div>

			<table class="table table-striped table-borderless">
			  	<tbody>
				    <tr>
				      	<td class="fw-6">instance_id</td>
				      	<td>609ACF283XXXX</td>
				    </tr>
				    <tr>
				      	<td class="fw-6">access_token</td>
				      	<td><?php echo get_option("waziper_access_token"); ?></td>
				    </tr>
			  	</tbody>
			</table>

			<h6 class="border-bottom wz-m-b-30 wz-p-b-20 wz-m-t-40 wz-p-t-20" id="reconnect"><span class="text-success fw-6 m-r-5"><?php waziper_e("POST")?></span> <?php waziper_e("Reconnect")?></h6>
			<div class="alert alert-dark bg-dark" role="alert">
				<code class="text-white fs-12">
					<?php waziper_e( get_site_url()."/api/reconnect.php?instance_id=609ACF283XXXX&access_token=".get_option("waziper_access_token") )?>
				</code>
			</div>

			<div class="text">
				<?php waziper_e("Re-initiate connection from app to Whatsapp web when lost connection")?>
			</div>

			<div class="text-uppercase wz-fs-16 border-bottom wz-m-b-15 wz-p-b-10 wz-m-t-30"><?php waziper_e("Params")?></div>

			<table class="table table-striped table-borderless">
			  	<tbody>
				    <tr>
				      	<td class="fw-6">instance_id</td>
				      	<td>609ACF283XXXX</td>
				    </tr>
				    <tr>
				      	<td class="fw-6">access_token</td>
				      	<td><?php echo get_option("waziper_access_token"); ?></td>
				    </tr>
			  	</tbody>
			</table>
		</div>
	</div>

	<div class="row wz-p-t-25 wz-p-b-25">
		<div class="col-12">
			<h5 class="border-bottom wz-m-b-30 wz-p-b-20 text-dark text-uppercase"><?php waziper_e("Send Direct Message Api")?></h5>
			<h6 class="border-bottom wz-m-b-30 wz-p-b-20 wz-p-t-20" id="send-text"><span class="text-success fw-6 m-r-5"><?php waziper_e("POST")?></span> <?php waziper_e("Send Text")?></h6>
			<div class="alert alert-dark bg-dark" role="alert">
				<code class="text-white fs-12">
			  		<?php waziper_e( get_site_url()."/api/send.php?number=84933313xxx&type=text&message=test%20message&instance_id=609ACF283XXXX&access_token=".get_option("waziper_access_token") )?>
				</code>
			</div>

			<div class="text"><?php waziper_e("Send a text message to a phone number through the app")?></div>

			<div class="text-uppercase wz-fs-16 border-bottom wz-m-b-15 wz-p-b-10 wz-m-t-30"><?php waziper_e("Params")?></div>

			<table class="table table-striped table-borderless">
			  	<tbody>
				    <tr>
				      	<td class="fw-6">number</td>
				      	<td>84933313xxx</td>
				    </tr>
			  		<tr>
				      	<td class="fw-6">type</td>
				      	<td>text</td>
				    </tr>
				    <tr>
				      	<td class="fw-6">message</td>
				      	<td>test message</td>
				    </tr>
				    <tr>
				      	<td class="fw-6">instance_id</td>
				      	<td>609ACF283XXXX</td>
				    </tr>
				    <tr>
				      	<td class="fw-6">access_token</td>
				      	<td><?php echo get_option("waziper_access_token"); ?></td>
				    </tr>
			  	</tbody>
			</table>

			<h6 class="border-bottom wz-m-b-30 wz-p-b-20 wz-m-t-40 wz-p-t-20" id="send-media"><span class="text-success fw-6 m-r-5"><?php waziper_e("POST")?></span> <?php waziper_e("Send Media & File")?></h6>
			<div class="alert alert-dark bg-dark" role="alert">
				<code class="text-white fs-12">
					<?php waziper_e( get_site_url()."/api/send.php?number=84933313xxx&type=media&message=test%20message&media_url=https://i.pravatar.cc&filename=file_test.jpg&instance_id=609ACF283XXXX&access_token=".get_option("waziper_access_token") )?>
				</code>
			</div>

			<div class="text"><?php waziper_e("Send a media or file with message to a phone number through the app")?></div>

			<div class="text-uppercase wz-fs-16 border-bottom wz-m-b-15 wz-p-b-10 wz-m-t-30"><?php waziper_e("Params")?></div>

			<table class="table table-striped table-borderless">
			  	<tbody>
			  		<tr>
				      	<td class="fw-6">number</td>
				      	<td>84933313xxx</td>
				    </tr>
			  		<tr>
				      	<td class="fw-6">type</td>
				      	<td>media</td>
				    </tr>
				    <tr>
				      	<td class="fw-6">message</td>
				      	<td>test message</td>
				    </tr>
				    <tr>
				      	<td class="fw-6">media_url</td>
				      	<td>https://i.pravatar.cc</td>
				    </tr>
				    <tr>
				      	<td class="fw-6">filename <span class="text-danger small">(Just use for send document)</span></td>
				      	<td>file_test.pdf</td>
				    </tr>
				    <tr>
				      	<td class="fw-6">instance_id</td>
				      	<td>609ACF283XXXX</td>
				    </tr>
				    <tr>
				      	<td class="fw-6">access_token</td>
				      	<td><?php echo get_option("waziper_access_token"); ?></td>
				    </tr>
			  	</tbody>
			</table>
		</div>
	</div>

	<div class="row wz-p-t-25 wz-p-b-25">
		<div class="col-12">
			<h5 class="border-bottom wz-m-b-30 wz-p-b-20 text-dark text-uppercase"><?php waziper_e("Group Api")?></h5>
			<h6 class="border-bottom wz-m-b-30 wz-p-b-20 wz-p-t-20" id="send-text-message-group"><span class="text-success fw-6 m-r-5"><?php waziper_e("POST")?></span> <?php waziper_e("Send Text Message Group")?></h6>
			<div class="alert alert-dark bg-dark" role="alert">
				<code class="text-white fs-12">
					<?php waziper_e( get_site_url()."/api/sendgroupmsg.php?group_id=84987694574-1618740914@g.us&type=text&message=test%20message&instance_id=609ACF283XXXX&access_token=".get_option("waziper_access_token") )?>
				</code>
			</div>

			<div class="text"><?php waziper_e("Send a text message to a group through the app")?></div>

			<div class="text-uppercase wz-fs-16 border-bottom wz-m-b-15 wz-p-b-10 wz-m-t-30"><?php waziper_e("Params")?></div>

			<table class="table table-striped table-borderless">
			  	<tbody>
				    <tr>
				      	<td class="fw-6">group_id</td>
				      	<td>84987694574-1618740914@g.us</td>
				    </tr>
			  		<tr>
				      	<td class="fw-6">type</td>
				      	<td>text</td>
				    </tr>
				    <tr>
				      	<td class="fw-6">message</td>
				      	<td>test message</td>
				    </tr>
				    <tr>
				      	<td class="fw-6">instance_id</td>
				      	<td>609ACF283XXXX</td>
				    </tr>
				    <tr>
				      	<td class="fw-6">access_token</td>
				      	<td><?php echo get_option("waziper_access_token"); ?></td>
				    </tr>
			  	</tbody>
			</table>

			<h6 class="border-bottom wz-m-b-30 wz-p-b-20 wz-m-t-40 wz-p-t-20" id="send-media-message-group"><span class="text-success fw-6 m-r-5"><?php waziper_e("POST")?></span> <?php waziper_e("Send Media & File Message Group")?></h6>
			<div class="alert alert-dark bg-dark" role="alert">
				<code class="text-white fs-12">
					<?php waziper_e( get_site_url()."/api/sendgroupmsg.php?group_id=84987694574-1618740914@g.us&type=media&message=test%20message&media_url=https://i.pravatar.cc&filename=file_test.jpg&instance_id=609ACF283XXXX&access_token=".get_option("waziper_access_token") )?>
				</code>
			</div>

			<div class="text"><?php waziper_e("Send a media or file with message to a group through the app")?></div>

			<div class="text-uppercase wz-fs-16 border-bottom wz-m-b-15 wz-p-b-10 wz-m-t-30"><?php waziper_e("Params")?></div>

			<table class="table table-striped table-borderless">
			  	<tbody>
			  		<tr>
				      	<td class="fw-6">group_id</td>
				      	<td>84987694574-1618740914@g.us</td>
				    </tr>
			  		<tr>
				      	<td class="fw-6">type</td>
				      	<td>media</td>
				    </tr>
				    <tr>
				      	<td class="fw-6">message</td>
				      	<td>test message</td>
				    </tr>
				    <tr>
				      	<td class="fw-6">media_url</td>
				      	<td>https://i.pravatar.cc</td>
				    </tr>
				    <tr>
				      	<td class="fw-6">filename <span class="text-danger small">(Just use for send document)</span></td>
				      	<td>file_test.pdf</td>
				    </tr>
				    <tr>
				      	<td class="fw-6">instance_id</td>
				      	<td>609ACF283XXXX</td>
				    </tr>
				    <tr>
				      	<td class="fw-6">access_token</td>
				      	<td><?php echo get_option("waziper_access_token"); ?></td>
				    </tr>
			  	</tbody>
			</table>
		</div>
	</div>
</div>

