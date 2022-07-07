<ul class="nav wa-menu-nav justify-content-center nav-tabs m-auto" id="nav-tab" role="tablist">
    
    <li class="nav-item" title="<?php waziper_e("Profile")?>" aria-selected="false" data-toggle="" data-placement="right">
        <a class="nav-link wa-reset-scrolll wa-action-item menu-item-profile" id="pills-user-tab" href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=profile')?>" data-result-submenu="wa-submenu-data" data-result-content="wa-content" role="tab" data-toggle="tab">
            <i class="ri-user-2-line"></i>
        </a>
    </li>
    <li class="nav-item d-none" title="<?php waziper_e("Contacts")?>" aria-selected="false" data-toggle="" data-placement="right">
        <a class="nav-link wa-reset-scrolll wa-action-item menu-item-contact" id="pills-contacts-tab" href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=contact')?>" data-result-submenu="wa-submenu-data" data-result-content="wa-content" role="tab" data-toggle="tab">
            <i class="ri-contacts-line"></i>
        </a>
    </li>
    <li class="nav-item" title="<?php waziper_e("Autoresponder")?>" aria-selected="false" data-toggle="" data-placement="right">
        <a class="nav-link wa-reset-scrolll wa-action-item menu-item-autoresponder" id="pills-autoresponder-tab" href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=autoresponder')?>" data-result-submenu="wa-submenu-data" data-result-content="wa-content" role="tab" data-toggle="tab">
            <i class="ri-reply-all-line"></i>
        </a>
    </li>
    <li class="nav-item" title="<?php waziper_e("Bulk messaging")?>" aria-selected="false" data-toggle="" data-placement="right">
        <a class="nav-link wa-reset-scrolll wa-action-item menu-item-bulk" id="pills-bulk-tab" href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=bulk')?>" data-result-submenu="wa-submenu-data" data-result-content="wa-content" role="tab" data-toggle="tab">
            <i class="ri-question-answer-line"></i>
        </a>
    </li>
    <li class="nav-item" title="<?php waziper_e("Chatbot")?>" aria-selected="false" data-toggle="" data-placement="right">
        <a class="nav-link wa-reset-scrolll wa-action-item menu-item-chatbot" id="pills-bot-tab" href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=chatbot')?>" data-result-submenu="wa-submenu-data" data-result-content="wa-content" role="tab" data-toggle="tab">
            <i class="ri-robot-line"></i>
        </a>
    </li>
    <li class="nav-item" title="<?php waziper_e("Export participants in a group")?>" aria-selected="false" data-toggle="" data-placement="right">
        <a class="nav-link wa-reset-scrolll wa-action-item" id="pills-bot-tab" href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=export_participants')?>" data-result-submenu="wa-submenu-data" data-result-content="wa-content" role="tab" data-toggle="tab">
            <i class="ri-group-2-line"></i>
        </a>
    </li>
</ul>