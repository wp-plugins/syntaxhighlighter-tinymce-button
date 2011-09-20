<?php
// Data migration for ver. 0.6 or older
$shtb_adv_setting_opt = get_option('shtb_adv_setting_opt');
$using_syntaxhighlighter = get_option('shtb_adv_using_syntaxhighlighter');
if ($using_syntaxhighlighter) {
	$shtb_adv_setting_opt['shtb_adv_using_syntaxhighlighter'] = $using_syntaxhighlighter;
}
$button_window_size = get_option('shtb_adv_button_window_size');
if ($button_window_size) {
	$shtb_adv_setting_opt['shtb_adv_button_window_size'] = $button_window_size;
}
$button_row = get_option('shtb_adv_button_row');
if ($button_row) {
	$shtb_adv_setting_opt['shtb_adv_button_row'] = $button_row;
}
update_option('shtb_adv_setting_opt', $shtb_adv_setting_opt);
?>