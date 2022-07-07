<div class="container wz-p-25">
		<?php if ( !empty($result) ) {?>
		<div class="row">
			<div class="col-md-12 wz-m-b-15">
				<a href="javascript:void(0);" class="btn btn-sm btn-dark d-inline-block d-lg-none mr-2 wa-back-submenu" data-result="html"><i class="ri-arrow-left-s-line"></i> <?php waziper_e("Back")?></a>
				<a href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=contact_group_update')?>" class="action-contact-group-import btn btn-sm btn-success float-right" data-result="html"><i class="ri-contacts-book-line"></i> <?php waziper_e("Add new")?></a>
			</div>
            <?php foreach ($result as $key => $value): ?>
            <div class="col-sm-4 col-md-4 item-contact-group">
				<div class="card mb-4 box-shadow">
					<div class="card-body">
						<div class="d-flex justify-content-center wz-m-b-15">
							<div class="wz-fs-30 rounded-circle bg-success wz-w-50 wz-h-50 text-white text-center wz-p-t-4"><i class="ri-contacts-book-fill"></i></div>
						</div>
						<p class="card-text">
							<h5 class="wz-fs-14 text-center"><?php waziper_e( $value->name )?></h5>
							<div class="text-muted text-center wz-fs-12"><?php waziper_e(  sprintf( __('%d contacts'), $value->count) )?></div>
						</p>
						<div class="d-flex justify-content-center align-items-center text-center">
							<div class="btn-group">
								<a href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=contact_group_list&ids='.$value->ids)?>" class="action-contact-group-import btn btn-sm btn-solid-success" data-result="html"><i class="ri-contacts-book-line" title="<?php waziper_e("Contact")?>"></i></a>
								<a href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=contact_group_import&ids='.$value->ids)?>" class="action-contact-group-import btn btn-sm btn-solid-success" data-result="html"><i class="ri-user-add-line" title="<?php waziper_e("Import contact")?>"></i></a>
								<a href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=contact_group_update&ids='.$value->ids)?>" class="action-contact-group-import btn btn-sm btn-solid-success" data-result="html"><i class="ri-edit-line" title="<?php waziper_e("Edit contact group")?>"></i></a>
								<a href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=delete_contact_group&ids='.$value->ids)?>" data-id="<?php waziper_e( $value->ids )?>" class="Waziper_actionItem btn btn-sm btn-solid-success" data-remove="item-contact-group" data-confirm="<?php waziper_e("Are you sure to delete this items?")?>"><i class="ri-delete-bin-6-line"></i></a>
							</div>
							
						</div>
					</div>
				</div>
			</div>
            <?php endforeach ?>
        </div>
        <?php }else{?>
		<div class="wrap-m h-100 text-center wz-p-t-50">
			<div class="empty">
				<div class="icon"></div>
				<a href="javascript:void(0);" class="btn btn-sm btn-info d-inline-block d-lg-none mr-2 wa-back-submenu" data-result="html"><i class="ri-arrow-left-s-line"></i> <?php waziper_e("Back")?></a>
				<a href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=contact_group_update')?>" class="action-contact-group-import btn btn-success" data-result="html"><i class="ri-contacts-book-line"></i> <?php waziper_e("Add new")?></a>
			</div>
		</div>
        <?php }?>
	</div>

	<nav class="m-t-30">
    <?php waziper_e( $result['pagination'], false)?>
    </nav>
</div>

<script type="text/javascript">
	jQuery(function(){
		jQuery(".page-link").addClass("wa-action-item").attr('data-result-content', 'wa-content');
	});
</script>