<?php
/*
SyntaxHighlighter TinyMCE Button Insert
Version: 0.3 2011/5/16 by Redcocker
License: GPL v2
http://www.near-mint.com/blog/
*/

function shtb_adv_insert_addbuttons() {
	// Add only in Rich Editor mode
	if ( get_user_option('rich_editing') == 'true') {
	// add the button for wp25 in a new way
		add_filter("mce_external_plugins", "add_shtb_adv_insert_tinymce_plugin");
		add_filter('mce_buttons', 'register_shtb_adv_insert_button');
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

function shtb_adv_insert_mce_valid_elements($init) {
	if ( isset( $init['extended_valid_elements'] ) 
	&& ! empty( $init['extended_valid_elements'] ) ) {
		$init['extended_valid_elements'] .= ',' . 'pre[class]';
	} else {
		$init['extended_valid_elements'] = 'pre[class]';
	}
	return $init;
}

function shtb_adv_insert_change_tinymce_version($version) {
	return ++$version;
}
// Modify the version when tinyMCE plugins are changed.
add_filter('tiny_mce_version', 'shtb_adv_insert_change_tinymce_version');
// init process for button control
add_action('init', 'shtb_adv_insert_addbuttons');

?>