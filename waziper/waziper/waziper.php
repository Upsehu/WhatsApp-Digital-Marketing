<?php
/**
* Plugin Name: Waziper - Bulk WhatsApp Sender Software for Wordpress
* Plugin URI: https://www.stackposts.com/
* Description: WhatsApp Marketing Tool Plugin for WordPress which is one of the products by Stackposts.  You can use many of its features such as allowing you to automatically Bulk WhatsApp Sender by seconds to millions of customers, Auto Reply for a first message, Chatbot System with keywords or sentences, Sending all types of file like PDF, Excel, txt,... Additional, exporting contacts are from groups. It’s not only WhatsApp Marketing Software but also help your business keep and reach more customers.
* Version: 1.0
* Author: StackCode
* Author URI: http://stackposts.com/
**/

if ( ! class_exists('WP_Waziper') ){

    class WP_Waziper{

        public $plugin; 
        public $tb_waziper_sessions;
        public $tb_waziper_autoresponder;
        public $tb_waziper_account_manager;
        public $tb_waziper_contacts;
        public $tb_waziper_chatbot;
        public $tb_waziper_phone_numbers;
        public $tb_waziper_schedules;
        public $tb_waziper_stats;
        public $server_url;

        function __construct(){
            global $wpdb;
            $this->tb_waziper_sessions = $wpdb->prefix.'waziper_sessions';
            $this->tb_waziper_autoresponder = $wpdb->prefix.'waziper_autoresponder';
            $this->tb_waziper_account_manager = $wpdb->prefix.'waziper_account_manager';
            $this->tb_waziper_contacts = $wpdb->prefix.'waziper_contacts';
            $this->tb_waziper_chatbot = $wpdb->prefix.'waziper_chatbot';
            $this->tb_waziper_phone_numbers = $wpdb->prefix.'waziper_phone_numbers';
            $this->tb_waziper_schedules = $wpdb->prefix.'waziper_schedules';
            $this->tb_waziper_stats = $wpdb->prefix.'waziper_stats';

            if(get_option('timezone_string') != ""){
                date_default_timezone_set( get_option('timezone_string') );
            }
            $this->server_url = get_option("waziper_server_url");
            require_once plugin_dir_path( __FILE__ ) . 'inc/constants.php';
            require_once plugin_dir_path( __FILE__ ) . 'inc/helpers.php';
            $this->plugin = plugin_basename( __FILE__ );
        }

        function register(){
            add_option( 'waziper_access_token', md5( uniqid() ) );
            add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
            add_filter( 'plugin_action_links_' . $this->plugin, array( $this, 'add_settings_link' ) );
            add_action( 'wp_ajax_waziper_pages', array( $this, 'pages' ) );
            add_action( 'wp_ajax_waziper_get_image', 'get_image' );
        }

        function get_image() {
            if(isset($_GET['id']) ){
                $image = wp_get_attachment_image( filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT ), 'medium', false, array( 'id' => 'myprefix-preview-image' ) );
                $data = array(
                    'image'    => $image,
                );
                wp_send_json_success( $data );
            } else {
                wp_send_json_error();
            }
        }

        function add_settings_link( $links ){
            $settings_link = '<a href="admin.php?page=waziper&go=settings" >Settings</a>';
            array_push($links, $settings_link);
            return $links;
        }

        function add_admin_menu() {
            add_menu_page(WAZIPER_TITLE, WAZIPER_MENU_NAME, 'manage_options', 'waziper', array( $this, 'view_main'), plugins_url( WAZIPER_FOLDER_NAME. 'assets/img/icon.png' ) );
        }

        function view_main() {
            global $wpdb;
            $purchase_code = get_option("waziper_purchase_code");
            $waziper_api_purchase_code = get_option("waziper_api_purchase_code");
            $server_url = $this->server_url;
            $accounts = $wpdb->get_results( "SELECT * FROM $this->tb_waziper_account_manager WHERE `status` = 1", OBJECT);
            if( waziper_get("go") != "settings" && ($purchase_code && $server_url) ){
                require_once plugin_dir_path( __FILE__ ) . 'views/main.php';
            }else{
                require_once plugin_dir_path( __FILE__ ) . 'views/license.php';
            }
        }

        function enqueue(){
            wp_enqueue_media();
            wp_enqueue_style('waziper_remixicon', plugins_url( '/assets/fonts/remixicon/remixicon.css', __FILE__ ) );
            wp_enqueue_style('waziper_awesome', plugins_url( '/assets/fonts/awesome/awesome.css', __FILE__ ) );
            wp_enqueue_style('waziper_bootstrap', plugins_url( '/assets/plugins/bootstrap/css/bootstrap.min.css', __FILE__ ) );
            wp_enqueue_style('waziper_emojionearea', plugins_url( '/assets/plugins/emojionearea/emojionearea.min.css', __FILE__ ) );
            wp_enqueue_style('waziper_magicsuggest', plugins_url( '/assets/plugins/magicsuggest/magicsuggest-min.css', __FILE__ ) );
            wp_enqueue_style('waziper_izitoast', plugins_url( '/assets/plugins/izitoast/css/izitoast.css', __FILE__ ) );
            wp_enqueue_style('waziper_ui', plugins_url( '/assets/plugins/jquery-ui/jquery-ui.min.css', __FILE__ ) );
            wp_enqueue_style('waziper_datetimepicker', plugins_url( '/assets/plugins/datetimepicker/jquery-ui-timepicker-addon.min.css', __FILE__ ) );
            wp_enqueue_style('waziper_tagsinput', plugins_url( '/assets/plugins/tagsinput/tagsinput.css', __FILE__ ) );
            wp_enqueue_style('waziper_style', plugins_url( '/assets/css/style.css', __FILE__ ) );
            wp_enqueue_script('waziper_emojionearea', plugins_url( '/assets/plugins/emojionearea/emojionearea.min.js', __FILE__ ) );
            wp_enqueue_script('waziper_magicsuggest', plugins_url( '/assets/plugins/magicsuggest/magicsuggest-min.js', __FILE__ ) );
            wp_enqueue_script('waziper_bootstrap', plugins_url( '/assets/plugins/bootstrap/js/bootstrap.bundle.min.js', __FILE__ ) );
            wp_enqueue_script('waziper_nicescroll', plugins_url( '/assets/plugins/nicescroll/nicescroll.js', __FILE__ ) );
            wp_enqueue_script('waziper_izitoast', plugins_url( '/assets/plugins/izitoast/js/izitoast.js', __FILE__ ) );
            wp_enqueue_script('waziper_ui', plugins_url( '/assets/plugins/jquery-ui/jquery-ui.min.js', __FILE__ ) );
            wp_enqueue_script('waziper_datetimepicker', plugins_url( '/assets/plugins/datetimepicker/jquery-ui-timepicker-addon.min.js', __FILE__ ) );
            wp_enqueue_script('waziper_tagsinput', plugins_url( '/assets/plugins/tagsinput/tagsinput.js', __FILE__ ) );
            wp_enqueue_script('waziper_core', plugins_url( '/assets/js/core.js', __FILE__ ) );
        }

        function activation(){
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
            require_once plugin_dir_path( __FILE__ ) . 'inc/database.php';
            add_action('admin_menu', 'waziper_admin_menu');
            waziper_install();
        }

        function deactivation(){
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
            require_once plugin_dir_path( __FILE__ ) . 'inc/database.php';
            waziper_uninstall();
        }

        function uninstall(){
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
            require_once plugin_dir_path( __FILE__ ) . 'inc/database.php';
            waziper_uninstall();
            delete_option('waziper_server_url');
            delete_option('waziper_purchase_code');
            delete_option('waziper_access_token');
        }

        function pages(){
            global $wpdb;
            $page = addslashes(waziper_get("page"));
            $instance_id = addslashes(waziper_get("instance_id"));
            $access_token = addslashes(waziper_get("access_token"));
            $body = waziper_get("body");
            $caption = waziper_get("caption");
            $chat_id = addslashes(waziper_get("chat_id"));
            $cursor = addslashes(waziper_get("cursor"));
            $fromMe = addslashes(waziper_get("fromMe"));
            $filename = addslashes(waziper_get("filename"));
            $message_id = addslashes(waziper_get("message_id"));

            switch ($page) {
                case 'dashboard':

                    $wa_message_sent_today = 0;
                    $wa_bulk_total_count = 0;
                    $wa_bulk_sent_count = 0;
                    $wa_bulk_failed_count = 0;
                    $wa_autoresponder_count = 0;
                    $wa_chatbot_count = 0;
                    $wa_chat_count = 0;

                    $sql = "SELECT * FROM $this->tb_waziper_stats";
                    $stats = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);

                    if( !empty($stats) ){
                        $wa_message_sent_today = (int)$stats->wa_message_sent_today;
                        $wa_bulk_total_count = (int)$stats->wa_bulk_total_count;
                        $wa_bulk_sent_count = (int)$stats->wa_bulk_sent_count;
                        $wa_bulk_failed_count = (int)$stats->wa_bulk_failed_count;
                        $wa_autoresponder_count = (int)$stats->wa_autoresponder_count;
                        $wa_chatbot_count = (int)$stats->wa_chatbot_count;
                        $wa_chat_count = (int)$stats->wa_chat_count;
                    }

                    $bulk_data = [];
                    $bulk_total = 0;
                    $bulk_sent = 0;
                    $bulk_failed = 0;
                    $sql = "SELECT `a`.*, `b`.`id` as `account_id`, `b`.`name` as `account_name`, `b`.`username` as `account_username` FROM `".$this->tb_waziper_schedules."` as `a` JOIN `".$this->tb_waziper_account_manager."` as `b` ON `a`.`account_id` = `b`.`id` GROUP BY `a`.`id` ORDER BY `b`.`id` ASC";
                    $bulks = $wpdb->get_results( $wpdb->prepare($sql), OBJECT);

                    if(!empty($bulks)){
                        foreach ($bulks as $key => $value) {

                            $sent = (int)$value->sent;
                            if(isset($bulk_data[$value->account_id]) ){
                                $sent = $bulk_data[$value->account_id]['sent'] + $sent;
                            }

                            $failed = (int)$value->failed;
                            if(isset($bulk_data[$value->account_id]) ){
                                $failed = $bulk_data[$value->account_id]['failed'] + $failed;
                            }

                            $bulk_data[$value->account_id] = [
                                "account_name" => $value->account_name, 
                                "account_username" => $value->account_username, 
                                "sent" => $sent,
                                "failed" => $failed
                            ];

                            $bulk_total += (int)$value->sent + (int)$value->failed;
                            $bulk_sent += (int)$value->sent;
                            $bulk_failed += (int)$value->failed;
                        }
                    }


                    $bulk_data = json_decode( json_encode($bulk_data) );

                    $sql = "SELECT `a`.*, `b`.`id` as `account_id`, `b`.`name` as `account_name`, `b`.`username` as `account_username` FROM `".$this->tb_waziper_autoresponder."` as `a` JOIN `".$this->tb_waziper_account_manager."` as `b` ON `a`.`instance_id` = `b`.`token` ORDER BY `b`.`id` ASC";
                    $autoresponders = $wpdb->get_results( $wpdb->prepare($sql), OBJECT);

                    

                    $sql = "SELECT `a`.*, `b`.`id` as `account_id`, `b`.`name` as `account_name`, `b`.`username` as `account_username` FROM `".$this->tb_waziper_chatbot."` as `a` JOIN `".$this->tb_waziper_account_manager."` as `b` ON `a`.`instance_id` = `b`.`token` ORDER BY `b`.`id` ASC";
                    $chatbots = $wpdb->get_results( $wpdb->prepare($sql), OBJECT);

                    waziper_ms([
                        "status" => "success",
                        "message" => "Success",
                        "submenu" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/dashboard.php', [ 
                            'wa_bulk_total_count' => $wa_bulk_total_count,
                            'wa_bulk_sent_count' => $wa_bulk_sent_count,
                            'wa_bulk_failed_count' => $wa_bulk_failed_count,
                            'bulk_data' => $bulk_data,
                            'wa_autoresponder_count' => $wa_autoresponder_count,
                            'wa_chatbot_count' => $wa_chatbot_count,
                            'wa_message_sent_today' => $wa_message_sent_today,
                            'autoresponders' => $autoresponders,
                            'chatbots' => $chatbots
                        ] ),
                        "content" => false
                    ]);
                    break;

                case 'add_account':
                    $sql = "SELECT * FROM $this->tb_waziper_sessions WHERE `status` = 0";
                    $account = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);

                    if(!$account){
                        $instance_id = strtoupper(uniqid());

                        $wpdb->insert( $this->tb_waziper_sessions , array(
                            "ids" => md5( uniqid() ),
                            "instance_id" => $instance_id,
                            "data" => NULL,
                            "status" => 0
                        ));
                    }else{
                        $instance_id = $account->instance_id;
                    }

                    $result = waziper_get_curl( $this->server_url."get_qrcode?instance_id=".$instance_id."&access_token=".get_option( 'waziper_access_token' ) );
                    $check = json_decode($result);

                    if( $check->status == "error" ){
                        waziper_ms([
                            "status" => "error",
                            "message" => $check->message,
                            "submenu" => "",
                            "content" => ""
                        ]);
                    }else{
                        $data = array(
                            "instance_id" => $instance_id,
                            "qrcode" => $check->base64
                        );
                    }

                    waziper_ms([
                        "status" => "success",
                        "message" => "Success",
                        "submenu" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/qrcode.php', $data ),
                        "content" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/empty.php', $data )
                    ]);
                    break;

                case 'check_login':
                    $sql = "SELECT * FROM $this->tb_waziper_sessions WHERE `status` = 1 AND instance_id = '{$instance_id}'";
                    $whatsapp_session = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);

                    if($whatsapp_session){
                        $profile = json_decode($whatsapp_session->data);

                        $sql = "SELECT * FROM $this->tb_waziper_account_manager WHERE `token` = '{$instance_id}'";
                        $account = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);

                        if(!$account){
                            $sql = "SELECT * FROM $this->tb_waziper_account_manager WHERE `pid` = '{$profile->jid}'";
                            $account = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);
                        }

                        $avatar = waziper_save_img( $account->avatar, plugin_dir_path( __FILE__ ). 'assets/avatar/', plugin_dir_url(__FILE__). 'assets/avatar/' );

                        if($account){
                            $sql = "UPDATE $this->tb_waziper_account_manager SET avatar = '{$avatar}' WHERE id = $account->id";
                            $wpdb->query( $wpdb->prepare( $wpdb->prepare($sql) ) );
                        }

                        waziper_ms([
                            "status" => "success",
                            "message" => "Success"
                        ]);
                    }

                    waziper_ms([
                        "status" => "error",
                        "message" => "Unsuccess"
                    ]);

                    break;

                case 'menu':
                    $result = json_decode( waziper_get_curl( $this->server_url."instance?instance_id=".$instance_id."&access_token=".get_option( 'waziper_access_token' ) ) );
                    if(!empty($result)){
                        if($result->status == "success"){
                            if($result->data->avatar){
                                $avatar = waziper_save_img( $result->data->avatar, plugin_dir_path( __FILE__ ). 'assets/avatar/', plugin_dir_url(__FILE__). 'assets/avatar/' );
                                $sql = "UPDATE $this->tb_waziper_account_manager SET `avatar` = '{$avatar}' WHERE `token` = '{$instance_id}'";
                                $wpdb->query( $wpdb->prepare( $wpdb->prepare($sql) ) );
                            }

                            waziper_ms([
                                "status" => "success",
                                "message" => "Success",
                                "submenu" => false,
                                "data" => $result->data,
                                "content" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/menu.php', [ 'instance_id' => $instance_id, 'access_token' => $access_token ] )
                            ]);
                        }else{
                            waziper_ms([
                                "status" => "error",
                                "relogin" => isset($result->relogin)?1:0,
                                "message" => $result->message
                            ]);
                        }
                    }else{
                        waziper_ms([
                            "status" => "error",
                            "message" => "Cannot connect to server. Please try again later"
                        ]);
                    }
                    break;

                case 'profile':
                    $result = json_decode( waziper_get_curl( $this->server_url."instance?instance_id=".$instance_id."&access_token=".get_option( 'waziper_access_token' ) ) );
                    if(!empty($result)){
                        if($result->status == "success"){
                            $sql = "SELECT * FROM $this->tb_waziper_account_manager WHERE `token` = '{$instance_id}'";
                            $account = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);

                            waziper_ms(array(
                                "status" => "success",
                                "message" => "Success",
                                "submenu" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/profile.php', [ 'result' => $result->data, 'account' => $account ] ),
                                "content" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/empty.php' )
                            ));
                        }else{
                            waziper_ms(array(
                                "status" => "error",
                                "relogin" => isset($result->relogin)?1:0,
                                "message" => $result->message
                            ));
                        }
                    }else{
                        waziper_ms(array(
                            "status" => "error",
                            "message" => "Cannot connect to server. Please try again later"
                        ));
                    }
                    break;

                case 'contact_group':
                    $result = $wpdb->get_results( "SELECT * FROM $this->tb_waziper_contacts", OBJECT);

                    if(!empty($result)){
                        foreach( $result as $key => $value ){
                            $sql = "SELECT count(*) as count FROM $this->tb_waziper_phone_numbers WHERE `pid` = '{$value->id}'";
                            $count = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);
                            $result[$key]->count = $count->count;
                        }
                    }

                    waziper_ms(array(
                        "status" => "success",
                        "message" => "Success",
                        "content" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/contact_group.php', [ 'result' => $result ] ),
                        "submenu" => false,
                    ));
                    break;

                case 'contact_group_list':
                    $ids = waziper_get("ids");
                    waziper_ms([
                        "status" => "success",
                        "content" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/contact_group_list.php', [ 'ids' => $ids ] ),
                        "submenu" => false,
                    ]);
                    break;

                case 'load_contact_group_list':
                    $ids = waziper_get("ids");

                    $sql = "SELECT * FROM $this->tb_waziper_contacts WHERE `ids` = '{$ids}'";
                    $numbers = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);
                    if( !$numbers ) return false;

                    $page = (int)waziper_post("page");

                    $sql = "SELECT * FROM $this->tb_waziper_phone_numbers WHERE `pid` = '{$numbers->id}' ORDER BY `id` DESC LIMIT ".((int)$page*100).", 100";
                    $result = $wpdb->get_results( $wpdb->prepare($sql), OBJECT);
                    include_once plugin_dir_path( __FILE__ ) . 'views/sub/ajax_load_phone_numbers.php';
                    wp_die();
                    break;

                case 'delete_phone':
                    $ids = waziper_post('id');

                    if( empty($ids) ){
                        waziper_ms(array(
                            "status" => "error",
                            "message" => 'Please select an item to delete'
                        ));
                    }

                    if( is_array($ids) ){
                        foreach ($ids as $id) {
                            $wpdb->delete( $this->tb_waziper_phone_numbers, array('ids'=> $id));
                        }
                    }
                    elseif( is_string($ids) )
                    {
                        $wpdb->delete( $this->tb_waziper_phone_numbers, array('ids'=> $ids));
                    }

                    waziper_ms(array(
                        "status" => "success",
                        "message" => "Success"
                    ));
                    break;

                case 'contact_group_import':
                    $ids = waziper_get("ids");
                    waziper_ms(array(
                        "status" => "success",
                        "content" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/contact_group_import.php', ["ids" => $ids]),
                        "submenu" => false,
                    ));
                    break;

                case 'ajax_add_phone':
                    $ids = waziper_get("ids");
                    $phone_numbers = waziper_post("phone_numbers");
                    if($phone_numbers == ""){
                        waziper_ms(array(
                            "status" => "error",
                            "message" => "Phone numbers is required"
                        ));
                    }

                    $phone_numbers = explode("\n", $phone_numbers);

                    $sql = "SELECT * FROM $this->tb_waziper_contacts WHERE `ids` = '{$ids}' ";
                    $item = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);

                    if(!empty($item)){
                        foreach ($phone_numbers as $key => $phone_number) {
                            $phone_number = str_replace("+", "", $phone_number);
                            $phone_number = str_replace(" ", "", $phone_number);
                            $phone_number = str_replace("'", "", $phone_number);
                            $phone_number = str_replace("`", "", $phone_number);
                            $phone_number = str_replace("\"", "", $phone_number);
                            $phone_number = trim($phone_number);

                            if(is_numeric($phone_number)){

                                $sql = "SELECT * FROM $this->tb_waziper_phone_numbers WHERE `pid` = '{$item->id}' AND `phone` = '{$phone_number}' ";
                                $check = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);
                                if(empty($check)){
                                    $wpdb->insert( $this->tb_waziper_phone_numbers , array(
                                        "ids" => md5(uniqid()),
                                        "pid" => $item->id,
                                        "phone" => $phone_number
                                    ));
                                }

                            }
                        }
                    }

                    waziper_ms(array(
                        "status" => "success",
                        "message" => "Success"
                    ));
                    break; 

                case 'contact_group_update':
                    $ids = waziper_get("ids");
                    $groups = $wpdb->get_results( "SELECT * FROM $this->tb_waziper_contacts WHERE `status` = 1", OBJECT);
                    $sql = "SELECT * FROM $this->tb_waziper_contacts WHERE `ids` = '{$ids}' ";
                    $result = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);

                    waziper_ms([
                        "status" => "success",
                        "content" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/contact_group_update.php', [ 'groups' => $groups, 'result' => $result ] ),
                        "submenu" => false,
                    ]);
                    break;

                case 'save_contact_group':
                    $status = waziper_post('status');
                    $name = waziper_post('name');
                    $ids = waziper_get('ids');

                    $sql = "SELECT * FROM $this->tb_waziper_contacts WHERE `ids` = '{$ids}' ";
                    $item = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);

                    if(!$item){
                        $sql = "SELECT * FROM $this->tb_waziper_contacts WHERE `name` = '{$name}' ";
                        $item = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);

                        if($name == ""){
                            waziper_ms(array(
                                "status" => "error",
                                "message" => "Group contact name is required"
                            ));
                        }

                        $wpdb->insert( $this->tb_waziper_contacts , array(
                            "ids" => md5(uniqid()),
                            "name" => $name,
                            "status" => $status,
                            "changed" => date("Y-m-d H:i:s"),
                            "created" => date("Y-m-d H:i:s")
                        ));
                    }else{
                        $sql = "SELECT * FROM $this->tb_waziper_contacts WHERE `ids` != '{$ids}' AND `name` = '{$name}' ";
                        $item = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);

                        if($name == ""){
                            waziper_ms(array(
                                "status" => "error",
                                "message" => "Group contact name is required"
                            ));
                        }

                        if(!empty($item)){
                            waziper_ms(array(
                                "status" => "error",
                                "message" => "This group contact name already exists"
                            ));
                        }

                        $wpdb->update( $this->tb_waziper_contacts , array(
                            "name" => $name,
                            "status" => $status,
                            "changed" => date("Y-m-d H:i:s")
                        ), array('ids'=> $ids));
                    }

                    waziper_ms(array(
                        "status" => "success",
                        "message" => "Success"
                    ));
                    break;

                case 'delete_contact_group':
                    $ids = waziper_post('id');

                    if( empty($ids) ){
                        waziper_ms(array(
                            "status" => "error",
                            "message" => "Please select an item to delete"
                        ));
                    }

                    if( is_array($ids) ){
                        foreach ($ids as $id) {
                            $sql = "SELECT * FROM $this->tb_waziper_contacts WHERE `ids` = '{$id}'";
                            $item = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);

                            if(!empty($item)){
                                $wpdb->delete( $this->tb_waziper_contacts, array('ids'=> $id));
                                $wpdb->delete( $this->tb_waziper_phone_numbers, array('pid'=> $item->id));
                            }
                        }
                    }
                    elseif( is_string($ids) )
                    {
                        $sql = "SELECT * FROM $this->tb_waziper_contacts WHERE `ids` = '{$ids}'";
                        $item = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);
                        if(!empty($item)){
                            $wpdb->delete( $this->tb_waziper_contacts, array('ids'=> $ids));
                            $wpdb->delete( $this->tb_waziper_phone_numbers, array('pid'=> $item->id));
                        }
                    }

                    waziper_ms(array(
                        "status" => "success",
                        "message" => "Success"
                    ));
                    break;

                case 'contact_schedules':
                    $instance_id = waziper_get("instance_id");
                    waziper_ms([
                        "status" => "success",
                        "message" => "Success",
                        "content" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/contact_schedules.php', ['instance_id' => $instance_id] ),
                        "submenu" => false,
                    ]);
                    break;

                case 'load_contact_schedules':
                    $instance_id = waziper_get("instance_id");
                    $page = (int)waziper_post("page");

                    $sql = "SELECT `a`.*, `b`.`name` as `group`, `d`.`name` as `account_name`, `d`.`username` as `account_username`, `d`.`token` 
                    FROM `{$this->tb_waziper_schedules}` as `a` 
                    LEFT JOIN `{$this->tb_waziper_contacts}` as `b` ON `a`.`contact_group_id` = `b`.`id` 
                    LEFT JOIN `{$this->tb_waziper_account_manager}` as `d` ON `a`.`account_id` = `d`.`id` 
                    WHERE `d`.`token` = '{$instance_id}' 
                    ORDER BY `a`.`created` DESC 
                    LIMIT ".((int)$page*30).", 30";

                    $schedules = $wpdb->get_results( $wpdb->prepare($sql), OBJECT);

                    if(!empty($schedules)){
                        foreach ($schedules as $key => $value) {
                            $sql = "SELECT count(*) as count FROM $this->tb_waziper_phone_numbers WHERE `pid` = '{$value->contact_group_id}'";
                            $count_phone = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);
                            $schedules[$key]->total_phone_number = $count_phone->count;
                        }
                    }

                    include_once plugin_dir_path( __FILE__ ) . 'views/sub/load_contact_schedules.php';
                    wp_die();
                    break;

                case 'contact_create_campaign':
                    $ids = waziper_get("ids");

                    $sql = "SELECT * FROM $this->tb_waziper_schedules WHERE `ids` = '{$ids}'";
                    $item = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);

                    $sql = "SELECT * FROM $this->tb_waziper_contacts WHERE `status` = '1'";
                    $groups = $wpdb->get_results( $wpdb->prepare($sql), OBJECT);
                    
                    waziper_ms(array(
                        "status" => "success",
                        "message" => "Success",
                        "submenu" => false,
                        "content" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/contact_create_campaign.php', [ 'item' => $item, 'groups' => $groups, "instance_id" => $instance_id ] ),
                    ));
        
                    break;

                case 'bulk_save':
                    $ids = waziper_post("ids");
                    $account = waziper_post("account");
                    $group = waziper_post("group");
                    $name = waziper_post("name");
                    $caption = waziper_post("caption");  
                    $medias = waziper_post("media");
                    $instance_id = waziper_post("instance_id");
                    $time_post = strtotime( str_replace("/", "-", waziper_post("time_post") ) );
                    $is_schedule = waziper_post("is_schedule");
                    $min_interval_per_post = (int)waziper_post("min_interval_per_post");
                    $max_interval_per_post = (int)waziper_post("max_interval_per_post");
                    $medias = array_filter($medias);

                    $sql = "SELECT * FROM $this->tb_waziper_schedules WHERE `ids` = '{$ids}'";
                    $item = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);

                    if($name == ""){
                        waziper_ms(array(
                            "status" => "error",
                            "message" => "Campaign name is required"
                        ));
                    }

                    if($group == ""){
                        waziper_ms(array(
                            "status" => "error",
                            "message" => "Contact group is required"
                        ));
                    }

                    if(!is_array($medias) && $caption == ""){
                        waziper_ms([
                            "status" => "error",
                            "message" => 'Please enter a caption or add a media'
                        ]);
                    }

                    if($min_interval_per_post < 5){
                        waziper_ms(array(
                            "status" => "error",
                            "message" => "Min interval must be greater than or equal to 5"
                        ));
                    }

                    if($max_interval_per_post > 9000){
                        waziper_ms(array(
                            "status" => "error",
                            "message" => "Max interval must be less than or equal to 9000"
                        ));
                    }

                    if($min_interval_per_post > $max_interval_per_post){
                        waziper_ms(array(
                            "status" => "error",
                            "message" => "Max interval must be greater than or equal to min interval"
                        ));
                    }

                    if($time_post == ""){
                        waziper_ms(array(
                            "status" => "error",
                            "message" => "Time post is required"
                        ));
                    }

                    $sql = "SELECT * FROM $this->tb_waziper_account_manager WHERE `token` = '{$instance_id}'";
                    $account = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);

                    $sql = "SELECT * FROM $this->tb_waziper_contacts WHERE `id` = '{$group}'";
                    $group = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);

                    if(empty($account)){
                        waziper_ms(array(
                            "status" => "error",
                            "message" => "Please select at least a profile"
                        ));
                    }

                    if(empty($group)){
                        waziper_ms(array(
                            "status" => "error",
                            "message" => "Please select a contact group"
                        ));
                    }

                    if( $account->status == 0 ){
                        waziper_ms(array(
                            "status" => "error",
                            "message" => "Relogin is required"
                        ));
                    }

                    if(!empty($item)){
                        $wpdb->update( $this->tb_waziper_schedules , array(
                            "account_id" => $account->id,
                            "contact_group_id" => $group->id,
                            "min_delay" => $min_interval_per_post,
                            "max_delay" => $max_interval_per_post,
                            "name" => $name,
                            "data" => $caption,
                            "media" => empty($medias)?"[]":json_encode($medias),
                            "path" => ABSPATH,
                            "changed" => date("Y-m-d H:i:s")
                        ), array('ids'=> $item->id));
                    }else{
                        $wpdb->insert( $this->tb_waziper_schedules , array(
                            "ids" => md5(uniqid()),
                            "account_id" => $account->id,
                            "contact_group_id" => $group->id,
                            "time_post" => $time_post,
                            "min_delay" => $min_interval_per_post,
                            "max_delay" => $max_interval_per_post,
                            "name" => $name,
                            "data" => $caption,
                            "media" => empty($medias)?"[]":json_encode($medias),
                            "path" => ABSPATH,
                            "time_post" => $time_post,
                            "status" => 1,
                            "changed" => date("Y-m-d H:i:s"),
                            "created" => date("Y-m-d H:i:s")
                        ));
                    }

                    waziper_ms(array(
                        "status" => "success",
                        "message" => "Success"
                    ));
                    break;

                case 'bulk_schedule_action':
                    $ids = waziper_get("ids");
                    $status = waziper_get("status");

                    $sql = "SELECT * FROM $this->tb_waziper_schedules WHERE `ids` = '{$ids}'";
                    $item = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);
                    if(!empty($item)){
                        switch ($status) {
                            case 0:
                                $status = ['status' => 0, 'running' => 0];
                                $result = '<a href="'.admin_url("admin-ajax.php?action=waziper_pages&page=bulk_schedule_action&ids=".$ids."&status=1").'" class="btn-wa-schedule-action btn-play text-primary"><i class="ri-play-fill" title="Play"></i></a>';
                                break;

                            case 1:
                                $status = ['status' => 1, 'running' => 0];
                                $result = '<a href="'.admin_url("admin-ajax.php?action=waziper_pages&page=bulk_schedule_action&ids=".$ids."&status=0").'" class="btn-wa-schedule-action btn-pause text-danger"><i class="ri-pause-circle-line" title="Pause"></i></a>';
                                break;
                            
                            default:
                                $status = ['status' => 2, 'running' => 0];
                                $result = '<div class="btn-success text-success"><i class="ri-check-double-line" title="Complete"></i></div>';
                                break;
                        }

                        $wpdb->update( $this->tb_waziper_schedules , $status, array('ids'=> $item->ids));

                        waziper_ms(array(
                            "status" => "success",
                            "message" => 'Success',
                            "content" => $result,
                        )) ;
                    }

                    waziper_ms([
                        "status" => "error",
                        "message" => 'Something went wrong, please try again later',
                    ]);
                    break;

                case 'bulk_delete':
                    $ids = waziper_get("ids");

                    if( empty($ids) ){
                        waziper_ms(array(
                            "status" => "error",
                            "message" => 'Please select an item to delete'
                        ));
                    }

                    if( is_array($ids) ){
                        foreach ($ids as $id) {
                            $wpdb->delete( $this->tb_waziper_schedules, array('ids'=> $id));
                        }
                    }
                    elseif( is_string($ids) )
                    {
                        $wpdb->delete( $this->tb_waziper_schedules, array('ids'=> $ids));
                    }

                    waziper_ms(array(
                        "status" => "success",
                        "message" => "Success"
                    ));
                    break;

                case 'export_participants':
                    $result = json_decode( waziper_get_curl( $this->server_url."get_groups?instance_id=".$instance_id."&access_token=".get_option( 'waziper_access_token' ) ) );
                    if(!empty($result)){
                        if($result->status == "success"){
                            waziper_ms(array(
                                "status" => "success",
                                "message" => "Success",
                                "submenu" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/group_chat.php', [ 'result' => $result->data ] ), 
                                "content" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/empty.php' ),
                            ));
                        }else{
                            waziper_ms(array(
                                "status" => "error",
                                "relogin" => isset($result->relogin)?1:0,
                                "message" => $result->message
                            ));
                        }
                    }else{
                        waziper_ms(array(
                            "status" => "error",
                            "message" => "Cannot connect to server. Please try again later"
                        ));
                    }
                    break;

                case 'download_participants':

                    $result = json_decode( waziper_get_curl( $this->server_url."get_group_participants?group_id=".$chat_id."&instance_id=".$instance_id."&access_token=".get_option( 'waziper_access_token' ) ) );
                    if(!empty($result)){
                        if($result->status == "success"){
                            $participants = [];
                            foreach ($result->data as $value) {
                                $participants[] = [
                                    'id' => $value->id,
                                    'user' => waziper_get_phone($value->id)
                                ];
                            }

                            waziper_download_send_headers("data_export_participants-" . date("Y-m-d") . ".csv");
                            echo array2csv($participants);
                        }else{
                            waziper_ms([
                                "status" => "error",
                                "relogin" => isset($result->relogin)?1:0,
                                "message" => __($result->message)
                            ]);
                        }
                    }else{
                        waziper_ms([
                            "status" => "error",
                            "message" => __("Cannot connect to server. Please try again later")
                        ]);
                    }
                    break;

                case 'autoresponder':
                    $sql = "SELECT * FROM $this->tb_waziper_autoresponder WHERE `instance_id` = '{$instance_id}'";
                    $result = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);

                    waziper_ms(array(
                        "status" => "success",
                        "message" => "Success",
                        "submenu" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/autoresponder.php', [ "instance_id" => $instance_id, 'result' => $result ] ),
                        "content" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/autoresponder_preview.php', [ "instance_id" => $instance_id, 'result' => $result ] ),
                    ));
                    break;

                case 'autoresponder_save':
                    
                    $status = (int)waziper_post('status');
                    $medias = waziper_post("media");
                    $caption = waziper_post('caption');
                    $delay = waziper_post('delay');
                    $instance_id = waziper_post('instance_id');
                    $except = waziper_post('except');
                    $send_to = (int)waziper_post('send_to');
                    $medias = array_filter($medias);

                    if(!$delay){
                        waziper_ms(array(
                            "status" => "error",
                            "message" => "Delay is required"
                        ));
                    }

                    $sql = "SELECT * FROM $this->tb_waziper_account_manager WHERE `token` = '{$instance_id}'";
                    $account = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);

                    if(empty($account)){
                        waziper_ms(array(
                            "status" => "error",
                            "message" => 'Profile does not exist'
                        ));
                    }

                    if(!is_array($medias) && $caption == ""){
                        waziper_ms(array(
                            "status" => "error",
                            "message" => "Please enter a caption or add a media"
                        ));
                    }

                    $sql = "SELECT * FROM $this->tb_waziper_autoresponder WHERE `ids` = '{$account->ids}'";
                    $item = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);

                    if(!$item ){
                        $wpdb->insert( $this->tb_waziper_autoresponder , array(
                            "ids" => $account->ids,
                            "instance_id" => $account->token,
                            "data" => $caption,
                            "media" => empty($medias)?"[]":json_encode($medias),
                            "except" => empty($except)?"[]":json_encode($except),
                            "path" => ABSPATH,
                            "delay" => $delay,
                            "send_to" => $send_to,
                            "status" => $status,
                            "changed" => date("Y-m-d H:i:s"),
                            "created" => date("Y-m-d H:i:s")
                        ));
                    }else{
                        $wpdb->update( $this->tb_waziper_autoresponder , array(
                            "instance_id" => $account->token,
                            "data" => $caption,
                            "media" => empty($medias)?"[]":json_encode($medias),
                            "except" => empty($except)?"[]":json_encode($except),
                            "path" => ABSPATH,
                            "delay" => $delay,
                            "send_to" => $send_to,
                            "status" => $status,
                            "changed" => date("Y-m-d H:i:s")
                        ), array('ids'=> $account->ids));
                    }

                    waziper_ms(array(
                        "status" => "success",
                        "message" => 'Success'
                    ));

                    break;

                case 'bulk':
                    waziper_ms(array(
                        "status" => "success",
                        "message" => "Success",
                        "submenu" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/bulk.php', [] ),
                        "content" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/empty.php', [] ),
                    ));
                    break;

                case 'chatbot':
                    $instance_id = waziper_get("instance_id");
                    $sql = "SELECT * FROM $this->tb_waziper_chatbot WHERE `instance_id` = '{$instance_id}'";
                    $result = $wpdb->get_results( $wpdb->prepare($sql), OBJECT);

                    waziper_ms(array(
                        "status" => "success",
                        "message" => "Success",
                        "submenu" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/chatbot_list.php', [ "instance_id" => $instance_id, 'result' => $result ] ),
                        "content" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/empty.php', [] ),
                    ));
                    break;

                case 'chatbot_update':
                    $ids = waziper_get("ids");
                    $instance_id = waziper_get("instance_id");
                    $sql = "SELECT * FROM $this->tb_waziper_chatbot WHERE `ids` = '{$ids}'";
                    $result = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);

                    waziper_ms(array(
                        "status" => "success",
                        "message" => "Success",
                        "content" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/chatbot_update.php', [ "instance_id" => $instance_id, 'result' => $result ] ),
                        "submenu" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/empty.php', [] ),
                    ));
                    break;

                case 'chatbot_delete':

                    $ids = waziper_post('id');

                    if( empty($ids) ){
                        waziper_ms([
                            "status" => "error",
                            "message" => "Please select an item to delete"
                        ]);
                    }

                    if( is_array($ids) ){
                        foreach ($ids as $id) {
                            $wpdb->delete( $this->tb_waziper_chatbot, array('ids'=> $id));
                        }
                    }
                    elseif( is_string($ids) )
                    {
                        $wpdb->delete( $this->tb_waziper_chatbot, array('ids'=> $ids));
                    }

                    waziper_ms([
                        "status" => "success",
                        "message" => "Success"
                    ]);
                    break;

                case 'chatbot_save':
                    $ids = waziper_post("ids");
                    $type = waziper_post("type");
                    $name = waziper_post("name");
                    $keywords = waziper_post("keywords");  
                    $caption = waziper_post("caption");  
                    $medias = waziper_post("media");
                    $send_to = (int)waziper_post('send_to');
                    $status = (int)waziper_post("status");
                    $instance_id = waziper_get("instance_id");
                    $interval_per_post = (int)waziper_post("interval_per_post");
                    $medias = array_filter($medias);

                    $sql = "SELECT * FROM $this->tb_waziper_chatbot WHERE `ids` = '{$ids}'";
                    $item = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);

                    if( $name == "" ){
                        waziper_ms([
                            "status" => "error",
                            "message" => "Bot name is required"
                        ]);
                    }

                    if( $keywords == "" ){
                        waziper_ms([
                            "status" => "error",
                            "message" => "Keywords is required"
                        ]);
                    }

                    $sql = "SELECT * FROM $this->tb_waziper_account_manager WHERE `token` = '{$instance_id}'";
                    $account = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);

                    if( empty($account) ){
                        waziper_ms(array(
                            "status" => "error",
                            "message" => "Please select at least a profile"
                        ));
                    }

                    if( $account->status == 0 ){
                        waziper_ms(array(
                            "status" => "error",
                            "message" => "Relogin is required"
                        ));
                    }

                    if(!is_array($medias) && $caption == ""){
                        waziper_ms(array(
                            "status" => "error",
                            "message" => "Please enter a caption or add a media"
                        ));
                    }

                    $run = 0;
                    $sql = "SELECT * FROM $this->tb_waziper_chatbot WHERE `instance_id` = '{$instance_id}'";
                    $chatbot_item = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);
                    if(!empty($chatbot_item) && $chatbot_item->run){
                        $run = 1;
                    }

                    $keywords = waziper_keyword_trim($keywords);
                    
                    if(!empty($item)){
                        $data = [
                            "instance_id" => $instance_id,
                            "type" => $type,
                            "name" => $name,
                            "keywords" => mb_strtolower($keywords),
                            "caption" => $caption,
                            "media" => empty($medias)?"[]":json_encode($medias),
                            "path" => ABSPATH,
                            "run" => $run,
                            "send_to" => $send_to,
                            "status" => $status,
                            "changed" => date("Y-m-d H:i:s")
                        ];

                        $result = $wpdb->update( $this->tb_waziper_chatbot, $data, ["id" => $item->id]);
                    }else{
                        $data = [
                            "ids" => md5( uniqid() ),
                            "instance_id" => $instance_id,
                            "type" => $type,
                            "name" => $name,
                            "keywords" => mb_strtolower($keywords),
                            "caption" => $caption,
                            "media" => empty($medias)?"[]":json_encode($medias),
                            "path" => ABSPATH,
                            "run" => $run,
                            "send_to" => $send_to,
                            "status" => $status,
                            "changed" => date("Y-m-d H:i:s"),
                            "created" => date("Y-m-d H:i:s")
                        ];

                        $result = $wpdb->insert( $this->tb_waziper_chatbot, $data);
                    }

                    waziper_ms(array(
                        "status" => "success",
                        "message" => "Success"
                    ));
                    break;

                case 'chatbot_status':
                    $instance_id = waziper_post("instance_id");
                    $access_token = waziper_post("access_token");

                    $sql = "SELECT * FROM $this->tb_waziper_chatbot WHERE `instance_id` = '{$instance_id}'";
                    $chatbot_item = $wpdb->get_row( $wpdb->prepare($sql), OBJECT);

                    if(!empty($chatbot_item)){
                        if($chatbot_item->run){
                            $wpdb->update( $this->tb_waziper_chatbot, array('run' => 0), array('instance_id' => $instance_id));
                        }else{
                            $wpdb->update( $this->tb_waziper_chatbot, array('run' => 1), array('instance_id' => $instance_id));
                        }
                    }

                    waziper_ms(array(
                        "status" => "success",
                        "message" => 'Success'
                    ));
                    break;

                case 'logout':
                    $result = json_decode( waziper_get_curl( $this->server_url."logout?instance_id=".$instance_id."&access_token=".get_option( 'waziper_access_token' ) ) );
                    if(!empty($result)){
                        if($result->status == "success"){

                            waziper_ms(array(
                                "status" => "success",
                                "message" => "Success",
                                "submenu" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/start.php' ),
                                "content" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/empty.php' ),
                                "logout" => true
                            ));
                        }else{
                            waziper_ms(array(
                                "status" => "error",
                                "relogin" => isset($result->relogin)?1:0,
                                "message" => $result->message
                            ));
                        }
                    }else{
                        waziper_ms(array(
                            "status" => "error",
                            "message" => "Cannot connect to server. Please try again later"
                        ));
                    }
                    break;

                case 'settings_save':
                    $purchase_code = waziper_post("purchase_code");
                    $waziper_api_purchase_code = waziper_post("waziper_api_purchase_code");
                    $whatsapp_server = waziper_post("whatsapp_server");

                    if($purchase_code == ""){
                        waziper_ms(array(
                            "status" => "error",
                            "message" => "Purchase code is required"
                        ));
                    }

                    if($whatsapp_server == ""){
                        waziper_ms(array(
                            "status" => "error",
                            "message" => "Whatsapp server is required"
                        ));
                    }

                    add_option("waziper_purchase_code", $purchase_code);
                    update_option("waziper_purchase_code", $purchase_code);

                    add_option("waziper_api_purchase_code", $waziper_api_purchase_code);
                    update_option("waziper_api_purchase_code", $waziper_api_purchase_code);

                    add_option("waziper_server_url", $whatsapp_server);
                    update_option("waziper_server_url", $whatsapp_server);

                    waziper_ms(array(
                        "status" => "success",
                        "message" => "Success"
                    ));
                    break;


                case 'api':
                    waziper_ms(array(
                        "status" => "success",
                        "message" => "Success",
                        "content" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/api_content.php' ),
                        "submenu" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/api_menu.php' ),
                    ));
                    break;

                case 'empty':
                    waziper_ms(array(
                        "status" => "success",
                        "message" => "Success",
                        "content" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/empty.php' ),
                        "submenu" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/start.php' ),
                    ));
                    break;

                default:
                    waziper_ms(array(
                        "status" => "success",
                        "message" => "Success",
                        "content" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/empty.php' ),
                        "submenu" => waziper_output( plugin_dir_path( __FILE__ ) . 'views/sub/start.php' ),
                    ));
                    break;
            }
        }

    }
    
    $WP_Waziper = new WP_Waziper();
    $WP_Waziper->register();

    //Activation
    register_activation_hook( __FILE__, array( $WP_Waziper, 'activation' ) );

    //Deactivation
    register_deactivation_hook( __FILE__, array( $WP_Waziper, 'deactivation' ) );
}
