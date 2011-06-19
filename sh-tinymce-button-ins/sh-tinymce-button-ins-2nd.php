<?php
/*
For secondary mode
*/

function shtb_adv_insert_addbuttons() {
	// Don't bother doing this stuff if the current user lacks permissions
	if (!current_user_can('edit_posts') && !current_user_can('edit_pages') )
		return;
	// Add only in Rich Editor mode
	if (get_user_option('rich_editing') == 'true') {
	// add the button for wp25 in a new way
		add_filter("mce_external_plugins", 'add_shtb_adv_insert_tinymce_plugin');
		$button_row = get_option('shtb_adv_button_row');
		if ($button_row== "2" || $button_row== "3" || $button_row== "4") {
			add_filter('mce_buttons_'.$button_row, 'register_shtb_adv_insert_button');
		} else {
			add_filter('mce_buttons', 'register_shtb_adv_insert_button');
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
	$plugin_array['shtb_adv_insert'] = get_option('siteurl').'/wp-content/plugins/syntaxhighlighter-tinymce-button/sh-tinymce-button-ins/editor_plugin.js';	
	return $plugin_array;
}

add_action('init', 'shtb_adv_insert_addbuttons');

?>