<style>
#wpcontent {
    padding-left: 0!important;
    padding-bottom: 0!important;
    height: 100%!important;
    position: fixed;
    width: 100%;
    z-index: 1;
}

#wpcontent #wpbody #wpbody-content{
    height: 100%!important;
}

#wpcontent #wpbody{
    height: 100%!important;
}

[dir="rtl"] #wpcontent {
    padding-right: 0 !important;
}

@media screen and (max-width: 782px){
    #wpbody-content {
        padding-bottom: 0px!important;
    }

    .auto-fold #wpcontent{
        position: absolute!important;
    }
}

@media screen and (max-width: 782px){
    .wp-responsive-open #wpbody {
        right: -190px;
    }

    #wpcontent {
        position: relative;
        z-index: inherit;
    }

    html #wpadminbar{
    }

}

body {
    background: #f3f7fa !important;
}
</style>

<div class="waziper-loading-overplay" id="waziper-loading-overplay"><div class='waziper-loader waziper-loader1'><div><div><div><div></div></div></div></div></div></div>

<div class="waziper d-lg-flex">
    <div class="wa-menu flex-lg-column d-flex justify-content-center overflow-hidden">
        <div class="navbar-brand-box">
            <a href="<?php echo admin_url('admin.php?page=waziper')?>" class="logo">
                <span class="logo-sm wz-fs-30">
                    <i class="fab fa-whatsapp"></i>
                </span>
            </a>
        </div>
        <div class="flex-lg-column wa-actions">
            <div class="wa-menu-nav">
                <div class="nav-item">
                    <a class="nav-link wa-action-item wa-back-account" href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=add_account')?>" title="Add Whatsapp account" data-result-submenu="wa-submenu-data" data-result-content="wa-content">
                        <i class="ri-add-circle-line"></i>
                    </a>
                </div>
            </div> 
        </div>
        <div class="flex-lg-column wa-actions">
            <div class="wa-menu-nav">
                <div class="nav-item">
                    <a class="nav-link wa-action-item wa-back-account" href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=dashboard')?>" title="Chart" data-result-submenu="wa-submenu-data" data-result-content="wa-content">
                        <i class="ri-bar-chart-box-fill"></i>
                    </a>
                </div>
            </div> 
        </div>
        <div class="flex-lg-column my-auto overflow-hidden wa-account-wrapper">
            <div class="d-lg-flex h-100">
                <div class="wa-menu-nav wa-accounts nav nav-pills justify-content-center my-auto overflow-hidden wa-scroll" id="wa-accounts">
                    <?php if( !empty($accounts) ){?>
                    
                        <?php foreach ($accounts as $key => $value): ?>
                        <div class="nav-item">
                            <a class="nav-link" href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=menu')?>" data-instance-id="<?php waziper_e( $value->token )?>" data-access-token="<?php waziper_e( get_option( 'waziper_access_token' ) )?>" data-placement="auto" title="<?php waziper_e($value->name)?>">
                                <img src="<?php waziper_e( $value->avatar )?>">
                            </a>
                        </div>
                        <?php endforeach ?>
                    <?php }?>
                </div>
                <div class="wa-pages overflow-hidden wa-scroll h-100" id="wa-pages"></div>
            </div>
        </div>
        <div class="flex-lg-column d-lg-block wa-settings">
            <ul class="nav wa-menu-nav justify-content-center">
                <li class="nav-item w-100">
                    <a class="nav-link wa-reset-scroll wa-action-item wa-back-account" href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=empty')?>" data-result-submenu="wa-submenu-data" data-result-content="wa-content">
                        <i class="ri-arrow-left-s-line"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="flex-lg-column wa-settings">
            <ul class="nav wa-menu-nav justify-content-center">
                <?php if(is_dir(ABSPATH."api")){ ?>
                <li class="nav-item w-100">
                    <a class="nav-link wa-reset-scroll wa-action-item" href="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=api')?>" data-result-submenu="wa-submenu-data" data-result-content="wa-content" title="API">
                        <i class="ri-plug-2-line"></i>
                    </a>
                </li>
                <?php }?>
                <li class="nav-item w-100">
                    <a class="nav-link wa-reset-scroll" href="<?php echo admin_url('admin.php?page=waziper&go=settings')?>">
                        <i class="ri-settings-2-line"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="wa-submenu wa-scroll">
        <div class="tab-content wa-submenu-data" id="nav-tabs">
            <?php include plugin_dir_path( __FILE__ ) . '/sub/start.php'; ?>
        </div>
    </div>
    
    <div class="wa-content w-100 overflow-hidden wa-scroll d-flex">
        <?php include plugin_dir_path( __FILE__ ) . '/sub/empty.php'; ?>
    </div>
</div>