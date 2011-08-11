<?php
/*
SyntaxHighlighter TinyMCE Button Codebox
Version: 0.7.2 2011/8/11 by Redcocker
License: GPL v2
http://www.near-mint.com/blog/
*/

function shtb_adv_codebox_addbuttons() {
	// Don't bother doing this stuff if the current user lacks permissions
	if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') )
		return;
	// Add only in Rich Editor mode
	if ( get_user_option('rich_editing') == 'true') {
	// add the button for wp25 in a new way
		add_filter("mce_external_plugins", 'add_shtb_adv_codebox_tinymce_plugin');
		$shtb_adv_setting_opt = get_option('shtb_adv_setting_opt');
		$button_row = $shtb_adv_setting_opt['shtb_adv_button_row'];
		if ($button_row== "2" || $button_row== "3" || $button_row== "4") {
			add_filter('mce_buttons_'.$button_row, 'register_shtb_adv_codebox_button');
		} else {
			add_filter('mce_buttons', 'register_shtb_adv_codebox_button');
		}
		if (version_compare(get_bloginfo('version'), "3.2", ">=")) {
			add_filter('wp_fullscreen_buttons', 'shtb_adv_codebox_fullscreen');
		}
	}
}

// used to insert button in wordpress 2.5x editor
function register_shtb_adv_codebox_button($buttons) {
	array_push($buttons, "shtb_adv_codebox");
	return $buttons;
}

// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
function add_shtb_adv_codebox_tinymce_plugin($plugin_array) {
	global $shtb_adv_plugin_url;
	$shtb_adv_setting_opt = get_option('shtb_adv_setting_opt');
	if ($shtb_adv_setting_opt['shtb_adv_button_window_size'] == "105") {
		$plugin_array['shtb_adv_codebox'] = $shtb_adv_plugin_url.'sh-tinymce-button-box/editor_plugin_105.js';
	} elseif ($shtb_adv_setting_opt['shtb_adv_button_window_size'] == "110") {
		$plugin_array['shtb_adv_codebox'] = $shtb_adv_plugin_url.'sh-tinymce-button-box/editor_plugin_110.js';
	} else {
		$plugin_array['shtb_adv_codebox'] = $shtb_adv_plugin_url.'sh-tinymce-button-box/editor_plugin.js';
	}
	return $plugin_array;
}

function shtb_adv_codebox_change_tinymce_version($version) {
	return ++$version;
}

// For fullscreen mode
function shtb_adv_codebox_fullscreen($buttons) {
	$buttons['shtb_adv_codebox'] = array(
	'title' => __('SyntaxHighlighter TinyMCE Button CodeBox'),
	'onclick' => "tinyMCE.execCommand('shtb_adv_codebox_cmd');",
	'both' => false);
	return $buttons;
}

// Modify the version when tinyMCE plugins are changed.
add_filter('tiny_mce_version', 'shtb_adv_codebox_change_tinymce_version');
// init process for button control
add_action('init', 'shtb_adv_codebox_addbuttons');

?>