<style type="text/css">
    .waziper .wa-submenu{
        background-color: #fff!important;
        min-width: calc(100% - 110px)!important;
    }
</style>

<div class="container">
    <div class="m-auto wz-m-t-50 wz-m-b-50">
        <div class="row">
            <div class="col-md-12 wz-m-b-25">
                <div class="wz-p-25 bg-solid-success rounded">
                    <div class="wz-wrap-m">
                        <div>
                            <h3 class="success wz-w-100"><?php _e( $wa_message_sent_today )?></h3>
                            <div><?php _e('Messages')?></div>
                        </div>
                        <div class="wz-wrap-c">
                            <i class="fas fa-paper-plane float-right text-success wz-fs-45"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12"><h5 class="wz-m-t-50 wz-m-b-20 text-success"><?php _e("Bulk messaging")?></h5></div>
            <div class="col-md-4 wz-m-b-25">
                <div class="wz-p-25 bg-solid-success rounded">
                    <div class="wz-wrap-m">
                        <div>
                            <h3 class="primary"><?php _e( $wa_bulk_total_count )?></h3>
                            <span><?php _e('Total')?></span>
                        </div>
                        <div class="wz-wrap-c">
                            <i class="fas fa-calendar-check float-right text-success wz-fs-45"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 wz-m-b-25">
                <div class="wz-p-25 bg-solid-primary rounded">
                    <div class="wz-wrap-m">
                        <div>
                            <h3 class="success wz-w-100"><?php _e( $wa_bulk_sent_count )?></h3>
                            <div><?php _e('Sent')?></div>
                        </div>
                        <div class="wz-wrap-c">
                            <i class="fas fa-paper-plane float-right text-primary wz-fs-45"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 wz-m-b-25">
                <div class="wz-p-25 bg-solid-danger rounded">
                    <div class="wz-wrap-m">
                        <div>
                            <h3 class="danger"><?php _e( $wa_bulk_failed_count )?></h3>
                            <span><?php _e('Failed')?></span>
                        </div>
                        <div class="wz-wrap-c">
                            <i class="fas fa-exclamation-triangle float-right text-danger wz-fs-45"></i>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(!empty($bulk_data)){?>
            <div class="col-md-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col"><?php _e("Whatsapp account")?></th>
                            <th scope="col"><?php _e("Sent")?></th>
                            <th scope="col"><?php _e("Failed")?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bulk_data as $key => $value): ?>
                        <tr>
                            <td><?php _e( $value->account_name . " (".$value->account_username.")" )?></td>
                            <td><?php _e( $value->sent )?></td>
                            <td><?php _e( $value->failed )?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>  
            <?php }?>
        </div>

        <div class="row">
            <div class="col-md-12"><h5 class="wz-m-t-50 wz-m-b-20 text-success"><?php _e("Autoresponder")?></h5></div>
            <div class="col-md-12 wz-m-b-25">
                <div class="wz-p-25 bg-solid-success rounded">
                    <div class="wz-wrap-m">
                        <div>
                            <h3 class="success wz-w-100"><?php _e( $wa_autoresponder_count )?></h3>
                            <div><?php _e('Sent')?></div>
                        </div>
                        <div class="wz-wrap-c">
                            <i class="fas fa-paper-plane float-right text-success wz-fs-45"></i>
                        </div>
                    </div>
                </div>
            </div>
            <?php if( !empty($autoresponders) ){?>
            <div class="col-md-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col"><?php _e("Whatsapp account")?></th>
                            <th scope="col"><?php _e("Sent")?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($autoresponders as $key => $value): ?>
                        <tr>
                            <td><?php _e( $value->account_name . " (".$value->account_username.")" )?></td>
                            <td><?php _e( (int)$value->sent )?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>  
            <?php }?>
        </div>

        <div class="row">
            <div class="col-md-12"><h5 class="wz-m-t-50 wz-m-b-20 text-success"><?php _e("Chatbot")?></h5></div>
            <div class="col-md-12 wz-m-b-25">
                <div class="wz-p-25 bg-solid-success rounded">
                    <div class="wz-wrap-m">
                        <div>
                            <h3 class="success wz-w-100"><?php _e( $wa_chatbot_count )?></h3>
                            <div><?php _e('Sent')?></div>
                        </div>
                        <div class="wz-wrap-c">
                            <i class="fas fa-paper-plane float-right text-success wz-fs-45"></i>
                        </div>
                    </div>
                </div>
            </div>

            <?php if( !empty($chatbots) ){?>
            <div class="col-md-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col"><?php _e("Chatbot item")?></th>
                            <th scope="col"><?php _e("Sent")?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $account_id = 0;
                        $account_tmp = 0;
                        $total = 0;
                        foreach ($chatbots as $key => $value){ 
                        ?>
                            <?php 
                            if($key == 0){
                                $account_id = $value->account_id;
                            ?>
                            <tr>
                                <td colspan="2" class="text-success wz-fw-6 text-uppercase"><?php _e( $value->account_name . " (".$value->account_username.")" )?></td>
                            </tr>
                            <?php }?>

                            

                            <?php if ($account_id != $value->account_id){
                                $account_id = $value->account_id;
                            ?>
                                <tr class="text-danger bg-light">
                                    <td class="wz-fw-6 text-uppercase"><?php _e( "Total" )?></td>
                                    <td class="wz-fw-6"><?php _e( (int)$total )?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-success wz-fw-6 text-uppercase"><?php _e( $value->account_name . " (".$value->account_username.")" )?></td>
                                </tr>
                                <tr>
                                    <td><?php _e( $value->name )?></td>
                                    <td><?php _e( (int)$value->sent )?></td>
                                </tr>
                            <?php $total = 0; }else{ ?>
                                <tr>
                                    <td><?php _e( $value->name )?></td>
                                    <td><?php _e( (int)$value->sent )?></td>
                                </tr>
                            <?php }?>

                            <?php if ($key == count($chatbots) - 1): $total += (int)$value->sent; ?>
                                <tr class="text-danger bg-light">
                                    <td class="wz-fw-6 text-uppercase"><?php _e( "Total" )?></td>
                                    <td class="wz-fw-6"><?php _e( (int)$total )?></td>
                                </tr>
                            <?php endif ?>
                        <?php
                            $total += (int)$value->sent;
                        } 
                        ?>
                    </tbody>
                </table>
            </div>  
            <?php }?>
        </div>
    </div>
</div>