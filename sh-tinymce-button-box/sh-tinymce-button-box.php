<?php
/*
SyntaxHighlighter TinyMCE Button Codebox
Version: 0.4 2011/5/21 by Redcocker
License: GPL v2
http://www.near-mint.com/blog/
*/

function shtb_adv_codebox_addbuttons() {
	// Add only in Rich Editor mode
	if ( get_user_option('rich_editing') == 'true') {
	// add the button for wp25 in a new way
		add_filter("mce_external_plugins", "add_shtb_adv_codebox_tinymce_plugin");
		add_filter('mce_buttons', 'register_shtb_adv_codebox_button');
	}
}

// used to insert button in wordpress 2.5x editor
function register_shtb_adv_codebox_button($buttons) {
	array_push($buttons, "separator", "shtb_adv_codebox");
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
// Modify the version when tinyMCE plugins are changed.
add_filter('tiny_mce_version', 'shtb_adv_codebox_change_tinymce_version');
// init process for button control
add_action('init', 'shtb_adv_codebox_addbuttons');

?>