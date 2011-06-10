<?php
/*
SyntaxHighlighter TinyMCE Button Codebox
Version: 0.5 2011/6/10 by Redcocker
License: GPL v2
http://www.near-mint.com/blog/
*/

class shtb_adv_add_codebox_button {

	function shtb_adv_add_codebox_button() {
		// Modify the version when tinyMCE plugins are changed.
		add_filter('tiny_mce_version', array(&$this, 'shtb_adv_codebox_change_tinymce_version'));
		// init process for button control
		add_action('init', array(&$this, 'shtb_adv_codebox_addbuttons'));
	}

	function shtb_adv_codebox_addbuttons() {
		// Don't bother doing this stuff if the current user lacks permissions
		if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') )
			 return;
		// Add only in Rich Editor mode
		if ( get_user_option('rich_editing') == 'true') {
		// add the button for wp25 in a new way
			add_filter("mce_external_plugins", array(&$this, 'add_shtb_adv_codebox_tinymce_plugin'));
			$button_row = get_option('shtb_adv_button_row');
			if ($button_row== "2" || $button_row== "3" || $button_row== "4") {
				add_filter('mce_buttons_'.$button_row, array(&$this, 'register_shtb_adv_codebox_button'));
			} else {
				add_filter('mce_buttons', array(&$this, 'register_shtb_adv_codebox_button'));
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
		$plugin_array['shtb_adv_codebox'] = get_option('siteurl').'/wp-content/plugins/syntaxhighlighter-tinymce-button/sh-tinymce-button-box/editor_plugin.js';	
		return $plugin_array;
	}

	function shtb_adv_codebox_change_tinymce_version($version) {
		return ++$version;
	}

}

$tinymce_button = new shtb_adv_add_codebox_button();

?>