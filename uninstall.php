<?php
if (!defined('ABSPATH') && !defined('WP_UNINSTALL_PLUGIN')) {exit();}
delete_option('shtb_adv_using_syntaxhighlighter');
delete_option('shtb_adv_insert');
delete_option('shtb_adv_codebox');
delete_option('shtb_adv_button_window_size');
delete_option('shtb_adv_button_row');
delete_option('shtb_adv_safe_mode'); // option in older version.
delete_option('allow_tab'); // option in older version.
?>
