<style>
#wpcontent {
    padding-left: 0!important;
    padding-bottom: 0!important;
    height: 100%!important;
    position: fixed;
    width: 100%;
    z-index: 100;

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

body {
    background: #f3f7fa !important;
}
</style>
        
<div class="waziper-loading-overplay" id="waziper-loading-overplay"><div class='waziper-loader waziper-loader1'><div><div><div><div></div></div></div></div></div></div>

<div class="waziper d-lg-flex">

    <div class="wa-content waziper-settings w-100 overflow-hidden wa-scroll d-flex wz-p-30">
        
        <div class="text-center justify-content-center align-self-center wz-w-100 wz-p-25">
            <div class="icon wz-fs-100 text-success"><i class="fas fa-cogs"></i></div>
            <div class="detail wz-m-b-40">
                <div class="title wz-fs-25 wz-fw-6"><?php waziper_e("General Settings")?></div>
                <div class="desc wz-fs-16"><?php waziper_e("Please configure one of the requirements below to get started.")?></div>
            </div>

            <form class="Waziper_actionForm post-create wz-p-t-10 text-left" action="<?php echo admin_url('admin-ajax.php?action=waziper_pages&page=settings_save&instance_id='.$instance_id)?>" data-redirect="<?php echo admin_url('admin.php?page=waziper')?>">
                <div class="wz-m-t-15">
                    <label for="purchase_code">Enter your purchase code (<span class="text-danger">*</span>)</label>
                    <input type="text" class="form-control" id="purchase_code" name="purchase_code" placeholder="Enter your purchase code" value="<?php waziper_e( $purchase_code )?>">
                </div>
                <?php if(is_dir(ABSPATH."api")){ ?>
                <div class="wz-m-t-15">
                    <label for="waziper_api_purchase_code">Enter your purchase code for Whatsapp REST API for Waziper Wordpress</label>
                    <input type="text" class="form-control" id="waziper_api_purchase_code" name="waziper_api_purchase_code" placeholder="Enter your purchase code" value="<?php waziper_e( $waziper_api_purchase_code )?>">
                </div>
                <?php }?>
                <div class="wz-m-t-25">
                    <label for="whatsapp_server">Whatsapp server (<span class="text-danger">*</span>)</label>
                    <input type="text" class="form-control" id="whatsapp_server" name="whatsapp_server" placeholder="Example: https://api.domain.com/" value="<?php waziper_e( $server_url )?>">
                </div>
                <div class="wz-m-t-25 text-center">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>

    </div>
    
</div>