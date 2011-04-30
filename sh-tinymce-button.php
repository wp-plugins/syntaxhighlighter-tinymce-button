<?php
/*
Plugin Name: SyntaxHighlighter TinyMCE Button
Plugin URI: http://www.near-mint.com/blog/software
Description: 'SyntaxHighlighter TinyMCE Button' provides additional button for Visual Editor and will help to type <code>&lt;pre&gt;</code> tag for SyntaxHighlighter. This plugin is based on '<a href="http://wordpress.org/extend/plugins/codecolorer-tinymce-button/">CodeColorer TinyMCE Button</a>'.
Version: 0.1.1
Author: Redcocker
Author URI: http://www.near-mint.com/blog/
Text Domain: shtb_lang
Domain Path: /locale/
*/
/*
Date of release: Ver. 0.1.1 2011/5/1
License: GPL v2
*/
load_plugin_textdomain('shtb_lang', false, 'syntaxhighlighter-tinymce-button/locale');

add_action('admin_menu', 'shtb_register_menu_item');
add_filter( 'plugin_action_links', 'shtb_setting_link', 10, 2 );

function shtb_add_admin_footer(){ //show plugin info in the footer
	$plugin_data = get_plugin_data(__FILE__);
	printf('%1$s by %2$s<br />', $plugin_data['Title'].' '.$plugin_data['Version'], $plugin_data['Author']);
}

function shtb_register_menu_item() {
	register_setting( 'shtb-settings-group', 'allow_tab'); 
	add_option('allow_tab', 1);
	add_options_page('SyntaxHighlighter TinyMCE Button Options', 'SH TinyMCE Button', 10, 'syntaxhighlighter-tinymce-button-options', 'shtb_options_panel');
}

function shtb_setting_link( $links, $file ){
	static $this_plugin;
	if ( ! $this_plugin ) $this_plugin = plugin_basename(__FILE__);
	if ( $file == $this_plugin ){
		$settings_link = '<a href="options-general.php?page=syntaxhighlighter-tinymce-button-options">'.__('Settings', 'shtb_lang').'</a>';
		array_unshift( $links, $settings_link );
	}  
	return $links;
} 

function shtb_addbuttons() {
	// Add only in Rich Editor mode
	if ( get_user_option('rich_editing') == 'true') {
	// add the button for wp25 in a new way
		add_filter("mce_external_plugins", "add_shtb_tinymce_plugin", 5);
		add_filter('mce_buttons', 'register_shtb_button', 5);
	}
}

// used to insert button in wordpress 2.5x editor
function register_shtb_button($buttons) {
	array_push($buttons, "separator", "shtb");
	return $buttons;
}

// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
function add_shtb_tinymce_plugin($plugin_array) {
	$plugin_array['shtb'] = get_option('siteurl').'/wp-content/plugins/syntaxhighlighter-tinymce-button/editor_plugin.js';	
	return $plugin_array;
}

function shtb_change_tinymce_version($version) {
	return ++$version;
}
// Modify the version when tinyMCE plugins are changed.
add_filter('tiny_mce_version', 'shtb_change_tinymce_version');
// init process for button control
add_action('init', 'shtb_addbuttons');

// Allow tab to indent in tinyMCE.
if (get_option('allow_tab') == 1) {
	add_filter('tiny_mce_before_init', 'allow_tab');
}

function allow_tab($initArray) {
    $initArray['plugins']=preg_replace("|[,]+tabfocus|i","",$initArray['plugins']);
    return $initArray;
}

//Setting panel
function shtb_options_panel(){
	if(!function_exists('current_user_can') || !current_user_can('manage_options')){
			die(__('Cheatin&#8217; uh?'));
	} 
	add_action('in_admin_footer', 'shtb_add_admin_footer');
	?> 
	<div class="wrap">
	<h2>SyntaxHighlighter TinyMCE Button</h2>
	<form method="post" action="options.php">
		<table style="margin-top:20px">
		<?php settings_fields('shtb-settings-group'); ?>
			<tr valign="baseline">
				<th scope="row"><?php _e('Allow to type tabs', 'shtb_lang') ?></th> 
				<td>
					<?php $auto_check = get_option('allow_tab') ? ' checked="yes" ' : ''; ?>
					<input type="checkbox" name="allow_tab" value="1" <?php echo $auto_check; ?>/>
					<p><small><?php _e('If you activate this option, you can type tab characters in Visual Editor to indent.', 'shtb_lang') ?></small></p>
				</td>
			</tr>
		 </table>
		<p class="submit">
		  <input type="submit" name="Submit" value="<?php _e('Save Changes', 'shtb_lang') ?>" />
		</p>
	</form>
<?php } 
?>