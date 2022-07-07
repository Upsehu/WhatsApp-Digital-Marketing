<!-- Start chats tab-pane -->
<div class="tab-pane h-100 show active wa-chatbot" id="pills-chat" role="tabpanel" aria-labelledby="pills-chat-tab">
    <div class="px-4 pt-4">
        <h4 class="mb-4"><?php waziper_e('Chatbot')?>
            <div class="option float-right position-relative">
                <a class="btn btn-sm btn-success p-t-1 p-r-5 p-l-5 p-b-1 wa-action-item wa-open-content" data-result-content="wa-content" href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=chatbot_update&instance_id='.$instance_id)?>" ><i class="fas fa-plus"></i> <?php waziper_e("Add new")?></a>
            </div>
        </h4>
        <div class="search-box chat-search-box">            
            <div class="input-group mb-3 rounded-3">
                <span class="input-group-text text-muted bg-white pe-1 ps-3">
                    <i class="ri-search-line search-icon wz-wz-fs-18"></i>
                </span>
                <input type="text" class="form-control search-input" placeholder="<?php waziper_e('Search messages or users')?>">
            </div> 
        </div> <!-- Search Box-->
    </div> <!-- .p-4 -->

    <!-- Start chat-message-list -->
    <div class="px-2">
        <h5 class="mb-3 px-3 wz-fs-16">
            <?php waziper_e('List')?>

            <?php if(!empty($result)){?>
            <div class="wa-cb-option float-right">
                <label class="i-switch i-switch--outline i-switch--success" data-toggle="tooltip" data-placement="top" title="<?php waziper_e("Turn on/off chatbot")?>">
                    <input type="checkbox" name="chatbot_status" class="action-save" data-action="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=chatbot_status&instance_id='.$instance_id."&ids=".$value->ids)?>" data-type="like" <?php waziper_e( $result[0]->run?'checked="true"':"" )?> value="<?php waziper_e( $instance_id )?>">
                    <span></span>
                </label>
            </div>
            <?php }?>
        </h5>
    </div>
    <div class="chat-message-list wa-scroll px-2">

        <?php if(!empty($result)){?>
        <ul class="list-unstyled chat-list chat-user-list">
            <?php foreach ($result as $key => $value): ?>
            <li class="wa-submenu-item unread search-list position-relative">
                <a href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=chatbot_update&instance_id='.$instance_id."&ids=".$value->ids)?>" class="wa-action-item wa-open-content" data-result-content="wa-content" >
                    <div class="d-flex">                            
                        <div class="chat-user-img online align-self-center mr-3 ms-0">
                            <img src="<?php waziper_e( waziper_get_avatar($value->name) )?>" class="rounded-circle avatar-xs" alt="">
                            <span class="user-status"></span>
                        </div>

                        <div class="flex-1 overflow-hidden">
                            <h5 class="text-truncate wz-fs-15 mb-1"><?php waziper_e( $value->name )?></h5>
                            <p class="chat-user-message text-truncate wz-fs-11 mb-0"><?php waziper_e( $value->keywords )?></p>
                        </div>
                        <div class="wz-fs-11">
                            <?php waziper_e( waziper_time_elapsed_string( $value->changed ) )?>
                        </div>
                    </div>
                </a>
                <div class="wz-fs-12 text-right position-absolute wz-r-21 wz-t-40 ">
                    <a href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=chatbot_delete&instance_id='.$instance_id."&ids=".$value->ids)?>" data-id="<?php waziper_e($value->ids)?>" class="p-0 text-danger Waziper_actionItem" data-remove="wa-submenu-item">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </div>
            </li>
            <?php endforeach ?>
        </ul>
        <?php }else{?>
            <div class="wz-h-100">
                <div class="waziper-empty p-t-30 wz-h-200">
                    <div class="icon"></div>
                </div>
            </div>
        <?php }?>
    </div>
    <!-- End chat-message-list -->
</div>
<!-- End chats tab-pane -->