<?php
if (!defined('ABSPATH') && !defined('WP_UNINSTALL_PLUGIN')) {exit();}
delete_option('shtb_adv_setting_opt');
delete_option('shtb_adv_languages');
delete_option('shtb_adv_checkver_stamp');
delete_option('shtb_adv_updated');
delete_option('shtb_adv_using_syntaxhighlighter'); // option in older version.
delete_option('shtb_adv_insert'); // option in older version.
delete_option('shtb_adv_codebox'); // option in older version.
delete_option('shtb_adv_button_window_size'); // option in older version.
delete_option('shtb_adv_button_row'); // option in older version.
delete_option('shtb_adv_safe_mode'); // option in older version.
delete_option('allow_tab'); // option in older version.
?>
