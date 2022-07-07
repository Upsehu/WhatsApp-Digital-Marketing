<!-- Start chats tab-pane -->
<div class="tab-pane h-100 show active" id="pills-chat" role="tabpanel" aria-labelledby="pills-chat-tab">
    <div class="px-4 pt-4">
        <h4 class="mb-4"><?php waziper_e('Bulk messaging')?></h4>
    </div> <!-- .p-4 -->

    <div class="chat-message-detail wa-scroll px-2">
        <ul class="list-unstyled chat-list chat-user-list">
            <li class="unread wa-submenu-item">
                <a class="wa-action-item wa-open-content wa-contact-group-menu" data-result-content="wa-content" href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=contact_group')?>">
                    <div class="d-flex">
                        <div class="chat-user-img away align-self-center wz-m-r-15 ms-0">
                            <div class="icon bg-success"><i class="ri-contacts-book-2-line"></i></div>
                        </div>
                        <div class="flex-1 overflow-hidden">
                            <h5 class="text-truncate wz-fs-15 mb-1"><?php waziper_e("Contact group")?></h5>
                            <p class="chat-user-message text-truncate wz-fs-11 mb-0"><?php waziper_e("Manage all your contacts")?></p>
                        </div>
                    </div>
                </a>
            </li>
            <li class="unread wa-submenu-item wa-contact-group-create">
                <a class="wa-action-item wa-open-content" data-result-content="wa-content" href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=contact_create_campaign')?>">
                    <div class="d-flex">
                        <div class="chat-user-img away align-self-center wz-m-r-15 ms-0">
                            <div class="icon bg-success"><i class="ri-add-circle-line"></i></div>
                        </div>
                        <div class="flex-1 overflow-hidden">
                            <h5 class="text-truncate wz-fs-15 mb-1"><?php waziper_e("Create campaign")?></h5>
                            <p class="chat-user-message text-truncate wz-fs-11 mb-0"><?php waziper_e("Start your bulk messaging plan")?></p>
                        </div>
                    </div>
                </a>
            </li>
            <li class="unread wa-submenu-item wa-contact-group-shedule">
                <a class="wa-action-item wa-open-content" data-result-content="wa-content" href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=contact_schedules')?>">
                    <div class="d-flex">
                        <div class="chat-user-img away align-self-center wz-m-r-15 ms-0">
                            <div class="icon bg-success"><i class="ri-calendar-2-line"></i></div>
                        </div>
                        <div class="flex-1 overflow-hidden">
                            <h5 class="text-truncate wz-fs-15 mb-1"><?php waziper_e("Schedules")?></h5>
                            <p class="chat-user-message text-truncate wz-fs-11 mb-0"><?php waziper_e("Manage all bulk messaging campaigns")?></p>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
    <!-- End chat-message-list -->
</div>
<!-- End chats tab-pane -->