<?php if(!empty($schedules)){?>
    <?php foreach ($schedules as $key => $row): ?>

    <?php
        switch ($row->status) {
            case 0:
                $color = "danger";
                break;

            case 1:
                $color = "primary";
                break;
            
            default:
                $color = "success";
                break;
        }        
    ?>

    <div class="col-lg-6 col-md-6 wz-m-b-30 item">
        
        <div class="card border-<?php waziper_e($color)?> wz-p-0">
            <div class="card-header bg-white">
                <h3 class="card-title wz-fs-14 wz-m-b-0">
                    <?php waziper_e( waziper_get_data($row, 'name') )?>
                    <div class="small wz-fs-12"><?php waziper_e( waziper_get_data($row, 'account_name')." | ".waziper_get_data($row, 'account_username') )?></div>
                </h3>

                <div class="options">
                	<?php if($row->status == 0){?>
                		<a href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=bulk_schedule_action&ids='.$row->ids.'&status=1')?>" class="btn-wa-schedule-action btn-play text-primary"><i class="ri-play-fill" title="<?php waziper_e("Play")?>"></i></a>
                	<?php }else if($row->status == 1){?>
                		<a href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=bulk_schedule_action&ids='.$row->ids.'&status=0')?>" class="btn-wa-schedule-action btn-pause text-danger"><i class="ri-pause-circle-line" title="<?php waziper_e("Pause")?>"></i></a>
                	<?php }else{?>
	                	<div class="text-success"><i class="ri-check-double-line" title="<?php waziper_e("Complete")?>"></i></div>
                	<?php }?>
                </div>
            </div>
            <div class="card-body wz-h-150 wa-scroll no-update overflow-hidden">
                <div class="card-toolbar">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle wz-p-0" type="button" data-toggle="dropdown">
                            <i class="ri-arrow-down-s-fill"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right dropdown-menu-fit dropdown-menu-anim dropdown-menu-top-unround">
                            <li><a class="wa-action-item" data-result-content="wa-content" href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=contact_create_campaign&ids='.$row->ids)?>"><i class="far fa-edit"></i> <?php waziper_e('Edit')?></a></li>
                            <li><a href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=bulk_delete&ids='.$row->ids)?>" class="Waziper_actionItem" data-remove="item" data-confirm="<?php waziper_e("Are you sure to delete this items?")?>"><i class="far fa-trash-alt"></i> <?php waziper_e('Delete')?></a></li>
                        </ul>
                    </div>
                </div>
                <?php waziper_e( nl2br( waziper_get_data($row, 'data') ) , false)?>
            </div>
            <div class="card-footer bg-solid-<?php waziper_e($color)?>">
                <div class="row fs-12 wa-info bg-<?php waziper_e($color)?> text-white">
                    <div class="col-6">
                    	<div class="wz-fs-10"><?php waziper_e("Group")?></div>
                    	<div><?php waziper_e( waziper_get_data($row, 'group') )?></div>
                    </div>
                    <div class="col-6 text-right">
                    	<div class="wz-fs-10"><?php waziper_e("Next action")?></div>
                    	<div><?php waziper_e( waziper_datetime_show( waziper_get_data($row, 'time_post') ) )?></div>
                    </div>
                </div>
                <div class="row wz-m-t-50">
                    <div class="col-4 text-center">
                        <div class="number wz-fw-6 wz-fs-20 text-success"><?php waziper_e( waziper_get_data($row, 'sent') )?></div>
                        <div class="text text-uppercase"><?php waziper_e("Sent")?></div>
                    </div>
                    <div class="col-4 text-center">
                        <div class="number wz-fw-6 wz-fs-20 text-primary"><?php waziper_e( waziper_get_data($row, 'total_phone_number') - waziper_get_data($row, 'sent') - waziper_get_data($row, 'failed') )?></div>
                        <div class="text text-uppercase"><?php waziper_e("Pending")?></div>
                    </div>
                    <div class="col-4 text-center">
                        <div class="number wz-fw-6 wz-fs-20 text-danger"><?php waziper_e( waziper_get_data($row, 'failed') )?></div>
                        <div class="text text-uppercase"><?php waziper_e("Failed")?></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php endforeach ?>
<?php }else{?>
    <?php if($page == 0){?>
    <div class="waziper-wrap-m wz-h-500 text-center wz-w-100">
    	<div class="waziper-empty">
    		<div class="icon"></div>
    		<a class="wa-action-item btn btn-success" data-result-content="wa-content" href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=contact_create_campaign')?>" data-call-after="">
        		<i class="fas fa-plus"></i> <?php waziper_e('Add new')?>
        	</a>
    	</div>
    </div>
    <?php }?>
<?php }?>