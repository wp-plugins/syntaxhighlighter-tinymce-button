<?php
/*
SyntaxHighlighter TinyMCE Button Insert
Version: 0.6 2011/6/25 by Redcocker
License: GPL v2
http://www.near-mint.com/blog/
*/

class shtb_adv_add_insert_button {

	function shtb_adv_add_insert_button() {
		// Modify the version when tinyMCE plugins are changed.
		add_filter('tiny_mce_version', array(&$this, 'shtb_adv_insert_change_tinymce_version'));
		// init process for button control
		add_action('init', array(&$this, 'shtb_adv_insert_addbuttons'));	}

	function shtb_adv_insert_addbuttons() {
		// Don't bother doing this stuff if the current user lacks permissions
		if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') )
			 return;
		// Add only in Rich Editor mode
		if ( get_user_option('rich_editing') == 'true') {
		// add the button for wp25 in a new way
			add_filter("mce_external_plugins", array(&$this, 'add_shtb_adv_insert_tinymce_plugin'));
			$button_row = get_option('shtb_adv_button_row');
			if ($button_row== "2" || $button_row== "3" || $button_row== "4") {
				add_filter('mce_buttons_'.$button_row, array(&$this, 'register_shtb_adv_insert_button'));
		
			} else {
				add_filter('mce_buttons', array(&$this, 'register_shtb_adv_insert_button'));
			}
		}
	}

	// used to insert button in wordpress 2.5x editor
	function register_shtb_adv_insert_button($buttons) {
		array_push($buttons, "separator", "shtb_adv_insert");
		return $buttons;
	}

	// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
	function add_shtb_adv_insert_tinymce_plugin($plugin_array) {
	global $shtb_plugin_url;
		if (get_option('shtb_adv_button_window_size') == "105") {
			$plugin_array['shtb_adv_insert'] = $shtb_plugin_url.'sh-tinymce-button-ins/editor_plugin_105.js';
		} elseif (get_option('shtb_adv_button_window_size') == "110") {
			$plugin_array['shtb_adv_insert'] = $shtb_plugin_url.'sh-tinymce-button-ins/editor_plugin_110.js';
		} else {
			$plugin_array['shtb_adv_insert'] = $shtb_plugin_url.'sh-tinymce-button-ins/editor_plugin.js';
		}
		return $plugin_array;
	}

	function shtb_adv_insert_change_tinymce_version($version) {
		return ++$version;
	}

}

$tinymce_button = new shtb_adv_add_insert_button();

?>