<?php
if(!function_exists('waziper_install')){
  function waziper_install(){
    global $wpdb;
    $sql = "
      CREATE TABLE `{$wpdb->prefix}waziper_account_manager` (
        `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
        `ids` mediumtext DEFAULT NULL,
        `pid` mediumtext DEFAULT NULL,
        `name` mediumtext DEFAULT NULL,
        `username` mediumtext DEFAULT NULL,
        `token` mediumtext DEFAULT NULL,
        `avatar` mediumtext DEFAULT NULL,
        `url` mediumtext DEFAULT NULL,
        `data` mediumtext DEFAULT NULL,
        `proxy` text DEFAULT NULL,
        `status` int(11) DEFAULT NULL,
        `changed` datetime DEFAULT NULL,
        `created` datetime DEFAULT NULL,
        PRIMARY KEY  (id)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

      CREATE TABLE `{$wpdb->prefix}waziper_autoresponder` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `ids` text DEFAULT NULL,
        `instance_id` text DEFAULT NULL,
        `data` text DEFAULT NULL,
        `media` longtext DEFAULT NULL,
        `except` longtext DEFAULT NULL,
        `path` text DEFAULT NULL,
        `delay` int(11) DEFAULT NULL,
        `result` text DEFAULT NULL,
        `sent` int(11) DEFAULT NULL,
        `send_to` int(1) DEFAULT NULL,
        `status` int(11) DEFAULT NULL,
        `changed` datetime DEFAULT NULL,
        `created` datetime DEFAULT NULL,
        PRIMARY KEY  (id)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

      CREATE TABLE `{$wpdb->prefix}waziper_chatbot` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `ids` text DEFAULT NULL,
        `name` text DEFAULT NULL,
        `keywords` text DEFAULT NULL,
        `instance_id` text DEFAULT NULL,
        `type` int(11) DEFAULT NULL,
        `caption` text DEFAULT NULL,
        `media` text DEFAULT NULL,
        `path` text DEFAULT NULL,
        `run` int(1) DEFAULT 1,
        `sent` int(11) DEFAULT NULL,
        `send_to` int(1) DEFAULT NULL,
        `status` int(1) DEFAULT NULL,
        `changed` datetime DEFAULT NULL,
        `created` datetime DEFAULT NULL,
        PRIMARY KEY  (id)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

      CREATE TABLE `{$wpdb->prefix}waziper_contacts` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `ids` text DEFAULT NULL,
        `name` text DEFAULT NULL,
        `status` int(11) DEFAULT NULL,
        `changed` datetime DEFAULT NULL,
        `created` datetime DEFAULT NULL,
        PRIMARY KEY  (id)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

      CREATE TABLE `{$wpdb->prefix}waziper_phone_numbers` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `ids` text DEFAULT NULL,
        `pid` text DEFAULT NULL,
        `phone` text DEFAULT NULL,
        PRIMARY KEY  (id)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

      CREATE TABLE `{$wpdb->prefix}waziper_schedules` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `ids` text DEFAULT NULL,
        `account_id` int(11) DEFAULT NULL,
        `contact_group_id` int(11) DEFAULT NULL,
        `time_post` int(11) DEFAULT NULL,
        `min_delay` int(11) DEFAULT NULL,
        `max_delay` int(11) DEFAULT NULL,
        `name` text DEFAULT NULL,
        `data` text DEFAULT NULL,
        `media` longtext DEFAULT NULL,
        `path` text DEFAULT NULL,
        `sent` int(11) DEFAULT 0,
        `failed` int(11) DEFAULT 0,
        `result` text DEFAULT NULL,
        `running` int(1) DEFAULT 0,
        `status` int(11) DEFAULT NULL,
        `changed` datetime DEFAULT NULL,
        `created` datetime NOT NULL,
        PRIMARY KEY  (id)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

      CREATE TABLE `{$wpdb->prefix}waziper_sessions` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `ids` text DEFAULT NULL,
        `instance_id` text DEFAULT NULL,
        `data` longtext DEFAULT NULL,
        `status` int(11) DEFAULT NULL,
        PRIMARY KEY  (id)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

      CREATE TABLE `{$wpdb->prefix}waziper_stats` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `ids` text DEFAULT NULL,
        `wa_message_sent_today` int(11) DEFAULT NULL,
        `wa_chat_count` int(11) DEFAULT 0,
        `wa_chatbot_count` int(11) DEFAULT NULL,
        `wa_autoresponder_count` int(11) DEFAULT NULL,
        `wa_bulk_total_count` int(11) DEFAULT NULL,
        `wa_bulk_sent_count` int(11) DEFAULT NULL,
        `wa_bulk_failed_count` int(11) NOT NULL,
        `wa_time_reset` int(11) NOT NULL,
        PRIMARY KEY  (id)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

      CREATE TABLE `{$wpdb->prefix}waziper_webhook` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `ids` text DEFAULT NULL,
        `instance_id` text DEFAULT NULL,
        `webhook_url` text DEFAULT NULL,
        `status` int(11) DEFAULT NULL,
        PRIMARY KEY  (id)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";

    dbDelta( $sql );
  }
}

if(!function_exists('waziper_uninstall')){
  function waziper_uninstall(){
    global $wpdb;

    $tables = array(
      "{$wpdb->prefix}waziper_account_manager",
      "{$wpdb->prefix}waziper_autoresponder",
      "{$wpdb->prefix}waziper_chatbot",
      "{$wpdb->prefix}waziper_contacts",
      "{$wpdb->prefix}waziper_phone_numbers",
      "{$wpdb->prefix}waziper_schedules",
      "{$wpdb->prefix}waziper_sessions",
      "{$wpdb->prefix}waziper_stats",
      "{$wpdb->prefix}waziper_webhook",
    );

    for ($i=0; $i < count($tables) ; $i++) { 
      $wpdb->query( "DROP TABLE IF EXISTS ".$tables[$i] );
    }
  }
}
?>
