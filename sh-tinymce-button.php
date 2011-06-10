<?php
/*
Plugin Name: SyntaxHighlighter TinyMCE Button
Plugin URI: http://www.near-mint.com/blog/software
Description: 'SyntaxHighlighter TinyMCE Button' provides additional buttons for Visual Editor and these buttons will help to type or edit <code>&lt;pre&gt;</code> tag for Alex Gorbatchev's <a href='http://alexgorbatchev.com/SyntaxHighlighter/'>SyntaxHighlighter</a>. This plugin is based on '<a href='http://wordpress.org/extend/plugins/codecolorer-tinymce-button/'>CodeColorer TinyMCE Button</a>'.
Version: 0.5
Author: Redcocker
Author URI: http://www.near-mint.com/blog/
Text Domain: shtb_adv_lang
Domain Path: /locale/
*/
/*
Date of release: Ver. 0.5 2011/6/10
License: GPL v2
*/
load_plugin_textdomain('shtb_adv_lang', false, 'syntaxhighlighter-tinymce-button/locale');

add_action('admin_menu', 'shtb_adv_register_menu_item');
add_filter( 'plugin_action_links', 'shtb_adv_setting_link', 10, 2 );

function shtb_adv_add_admin_footer(){ //show plugin info in the footer
	$plugin_data = get_plugin_data(__FILE__);
	printf('%1$s by %2$s<br />', $plugin_data['Title'].' '.$plugin_data['Version'], $plugin_data['Author']);
}

function shtb_adv_register_menu_item() {
	register_setting( 'shtb_adv-settings-group', 'shtb_adv_using_syntaxhighlighter'); 
	register_setting( 'shtb_adv-settings-group', 'shtb_adv_insert'); 
	register_setting( 'shtb_adv-settings-group', 'shtb_adv_codebox'); 
	register_setting( 'shtb_adv-settings-group', 'shtb_adv_button_row'); 
	register_setting( 'shtb_adv-settings-group', 'shtb_adv_safe_mode'); 
	add_option('shtb_adv_using_syntaxhighlighter', 'other');
	add_option('shtb_adv_insert', 1);
	add_option('shtb_adv_codebox', 1);
	add_option('shtb_adv_button_row', '1');
	add_option('shtb_adv_safe_mode', 0);
	add_options_page('SyntaxHighlighter TinyMCE Button Options', 'SH TinyMCE Button', 10, 'syntaxhighlighter-tinymce-button-options', 'shtb_adv_options_panel');
}

function shtb_adv_setting_link( $links, $file ){
	static $this_plugin;
	if ( ! $this_plugin ) $this_plugin = plugin_basename(__FILE__);
	if ( $file == $this_plugin ){
		$settings_link = '<a href="options-general.php?page=syntaxhighlighter-tinymce-button-options">'.__('Settings', 'shtb_adv_lang').'</a>';
		array_unshift( $links, $settings_link );
	}  
	return $links;
} 

//Load SyntaxHighlighter TinyMCE Button
if (get_option('shtb_adv_insert') == 1 && get_option('shtb_adv_safe_mode') == 0) {
	include_once('sh-tinymce-button-ins/sh-tinymce-button-ins.php');
} elseif (get_option('shtb_adv_insert') == 1 && get_option('shtb_adv_safe_mode') == 1) {
	include_once('sh-tinymce-button-ins/sh-tinymce-button-ins-2nd.php');
}

if (get_option('shtb_adv_codebox') == 1 && get_option('shtb_adv_safe_mode') == 0) {
	include_once('sh-tinymce-button-box/sh-tinymce-button-box.php');
} elseif (get_option('shtb_adv_codebox') == 1 && get_option('shtb_adv_safe_mode') == 1) {
	include_once('sh-tinymce-button-box/sh-tinymce-button-box-2nd.php');
}

// Allow tabs to indent in tinyMCE.
if (get_option('shtb_adv_insert') == 1 || get_option('shtb_adv_codebox') == 1) {
	add_filter('tiny_mce_before_init', 'shtb_adv_insert_allow_tab');
}

function shtb_adv_insert_allow_tab($initArray) {
    $initArray['plugins']=preg_replace("|[,]+tabfocus|i","",$initArray['plugins']);
    return $initArray;
}

// Add 'pre' tag and 'class' attribte as TinyMCE valid_elements.
if (get_option('shtb_adv_safe_mode') == 0) {
	add_filter('tiny_mce_before_init', 'shtb_adv_mce_valid_elements');
}

function shtb_adv_mce_valid_elements($init) {
	if ( isset( $init['extended_valid_elements'] ) 
	&& ! empty( $init['extended_valid_elements'] ) ) {
		$init['extended_valid_elements'] .= ',' . 'pre[class]';
	} else {
		$init['extended_valid_elements'] = 'pre[class]';
	}
	return $init;
}

//Setting panel
function shtb_adv_options_panel(){
	if(!function_exists('current_user_can') || !current_user_can('manage_options')){
			die(__('Cheatin&#8217; uh?'));
	} 
	add_action('in_admin_footer', 'shtb_adv_add_admin_footer');
	?> 
	<div class="wrap">
	<h2>SyntaxHighlighter TinyMCE Button</h2>
	<form method="post" action="options.php">
		<table style="margin-top:20px">
		<?php settings_fields('shtb_adv-settings-group'); ?>
			<tr valign="top">
				<th scope="row" align="right"><?php _e('Using with', 'shtb_adv_lang') ?></th> 
				<td style="padding-left:10px">
					<input type="radio" name="shtb_adv_using_syntaxhighlighter" value="wp_syntaxhighlighter" <?php if (get_option('shtb_adv_using_syntaxhighlighter') == "wp_syntaxhighlighter") {echo 'checked=\"checked\"';} ?>/><?php _e('<a href="http://wordpress.org/extend/plugins/wp-syntaxhighlighter/" style="text-decoration: none">WP SyntaxHighlighter</a>', 'shtb_adv_lang') ?> <input type="radio" name="shtb_adv_using_syntaxhighlighter" value="syntax_highlighter_compress" <?php if (get_option('shtb_adv_using_syntaxhighlighter') == "syntax_highlighter_compress") {echo 'checked=\"checked\"';} ?>/><?php _e('<a href="http://wordpress.org/extend/plugins/syntax-highlighter-compress/" style="text-decoration: none">Syntax Highlighter Compress</a>', 'shtb_adv_lang') ?> <input type="radio" name="shtb_adv_using_syntaxhighlighter" value="syntaxhighlighter_evolved" <?php if (get_option('shtb_adv_using_syntaxhighlighter') == "syntaxhighlighter_evolved") {echo 'checked=\"checked\"';}?>/><?php _e('<a href="http://wordpress.org/extend/plugins/syntaxhighlighter/" style="text-decoration: none">SyntaxHighlighter Evolved</a>', 'shtb_adv_lang') ?> <input type="radio" name="shtb_adv_using_syntaxhighlighter" value="other" <?php if (get_option('shtb_adv_using_syntaxhighlighter') == "other") {echo 'checked=\"checked\"';}?>/><?php _e('Other', 'shtb_adv_lang') ?>
					<p><small><?php _e("Select your using plugin based on Alex Gorbatchev's <a href='http://alexgorbatchev.com/SyntaxHighlighter/' style='text-decoration: none'>SyntaxHighlighter</a>.<br />If your plugin is not in the options, Select 'Other'.<br />It is the same if you use <a href='http://wordpress.org/extend/plugins/auto-syntaxhighlighter/' style='text-decoration: none'>Auto SyntaxHighlighter</a>, <a href='http://wordpress.org/extend/plugins/syntax-highlighter-and-code-prettifier/' style='text-decoration: none'>Syntax Highlighter and Code Colorizer for WordPress</a> or <a href='http://wordpress.org/extend/plugins/syntax-highlighter-mt/' style='text-decoration: none'>Syntax Highlighter MT</a>.<br />If you don't know about your using plugin, Select 'Other'. When you select 'Other', this plugin will act innocuously.<br />When using with 'SyntaxHighlighter Evolved', 'Load All Brushes' option must be enabled on the 'SyntaxHighlighter' setting panel.", "shtb_adv_lang") ?></small></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" align="right"><?php _e('Buttons', 'shtb_adv_lang') ?></th>
				<td style="padding-left:10px">
					<?php $insert_check = get_option('shtb_adv_insert') ? ' checked="checked" ' : ''; ?>
					<?php $codebox_check = get_option('shtb_adv_codebox') ? ' checked="checked" ' : ''; ?>
					<input type="checkbox" name="shtb_adv_insert" value="1" <?php echo $insert_check; ?>/> Select &amp; Insert <input type="checkbox" name="shtb_adv_codebox" value="1" <?php echo $codebox_check; ?>/> CodeBox
					<p><small><?php _e("Enable/Disable buttons.<br />'Select &amp; Insert' will help you to wrap your code on the post or page in <code>&lt;pre&gt;</code> tag or to update values of previously-markuped code.<br />'CodeBox' will allow you to paste your code into the post or page, keeping indent by tabs.<br />Your pasted code will be warpped in <code>&lt;pre&gt;</code> tag automatically.<br/ >In 'Visual Editor', 'Select &amp; Insert' will appear as 'pre' icon and 'CodeBox' will appear as 'CODE' icon.", "shtb_adv_lang") ?></small></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" align="right"><?php _e('Place the buttons in', 'shtb_adv_lang') ?></th> 
				<td style="padding-left:10px">
					<select name="shtb_adv_button_row">
						<option value="1" <?php if (get_option('shtb_adv_button_row') == "1") {echo 'selected="selected"';} ?>><?php _e("1st row", "shtb_adv_lang") ?></option>
						<option value="2" <?php if (get_option('shtb_adv_button_row') == "2") {echo 'selected="selected"';} ?>><?php _e("2nd row", "shtb_adv_lang") ?></option>
						<option value="3" <?php if (get_option('shtb_adv_button_row') == "3") {echo 'selected="selected"';} ?>><?php _e("3rd row", "shtb_adv_lang") ?></option>
						<option value="4" <?php if (get_option('shtb_adv_button_row') == "4") {echo 'selected="selected"';} ?>><?php _e("4th row", "shtb_adv_lang") ?></option>
					</select> <?php _e("of TinyMCE toolbar.", "shtb_adv_lang") ?>
					<p><small><?php _e("Choose TinyMCE toolbar row which buttons will be placed in.", "shtb_adv_lang") ?></small></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" align="right"><?php _e('Secondary mode', 'shtb_adv_lang') ?></th> 
				<td style="padding-left:10px">
					<?php $safe_mode_check = get_option('shtb_adv_safe_mode') ? ' checked="checked" ' : ''; ?>
					<input type="checkbox" name="shtb_adv_safe_mode" value="1" <?php echo $safe_mode_check; ?>/>
					<p><small><?php _e("When the buttons are unshown, try to activate this option.", "shtb_adv_lang") ?></small></p>
				</td>
			</tr>
		 </table>
		<p class="submit">
		  <input type="submit" name="Submit" value="<?php _e('Save Changes', 'shtb_adv_lang') ?>" />
		</p>
	</form>
<?php } 
?>