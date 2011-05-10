<?php
/*
Plugin Name: SyntaxHighlighter TinyMCE Button
Plugin URI: http://www.near-mint.com/blog/software
Description: 'SyntaxHighlighter TinyMCE Button' provides additional buttons for Visual Editor and these buttons will help to type or edit <code>&lt;pre&gt;</code> tag for Alex Gorbatchev's <a href='http://alexgorbatchev.com/SyntaxHighlighter/'>SyntaxHighlighter</a>. This plugin is based on '<a href='http://wordpress.org/extend/plugins/codecolorer-tinymce-button/'>CodeColorer TinyMCE Button</a>'.
Version: 0.2
Author: Redcocker
Author URI: http://www.near-mint.com/blog/
Text Domain: shtb_adv_lang
Domain Path: /locale/
*/
/*
Date of release: Ver. 0.2 2011/5/10
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
	register_setting( 'shtb_adv-settings-group', 'shtb_adv_insert'); 
	register_setting( 'shtb_adv-settings-group', 'shtb_adv_codebox'); 
	add_option('shtb_adv_insert', 1);
	add_option('shtb_adv_codebox', 1);
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
if (get_option('shtb_adv_insert') == 1) {
	include('sh-tinymce-button-ins/sh-tinymce-button-ins.php');
}
if (get_option('shtb_adv_codebox') == 1) {
	include('sh-tinymce-button-box/sh-tinymce-button-box.php');
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
				<th scope="row" align="right"><?php _e('Buttons', 'shtb_adv_lang') ?></th>
				<td style="padding-left:10px">
					<?php $insert_check = get_option('shtb_adv_insert') ? ' checked="checked" ' : ''; ?>
					<?php $codebox_check = get_option('shtb_adv_codebox') ? ' checked="checked" ' : ''; ?>
					<input type="checkbox" name="shtb_adv_insert" value="1" <?php echo $insert_check; ?>/> Select &amp; Insert <input type="checkbox" name="shtb_adv_codebox" value="1" <?php echo $codebox_check; ?>/> CodeBox
					<p><small><?php _e("Enable/Disable buttons.<br />'Select &amp; Insert' will help you to wrap your code on the post or page in <code>&lt;pre&gt;</code> tag or to update values of previously-markuped code.<br />'CodeBox' will allow you to paste your code into the post or page, keeping indent by tabs. Your pasted code will be warpped in <code>&lt;pre&gt;</code> tag automatically.<br/ >In 'Visual Editor', 'Select &amp; Insert' will appear as 'pre' icon and 'CodeBox' will appear as 'CODE' icon.", "shtb_adv_lang") ?></small></p>
				</td>
			</tr>
		 </table>
		<p class="submit">
		  <input type="submit" name="Submit" value="<?php _e('Save Changes', 'shtb_adv_lang') ?>" />
		</p>
	</form>
<?php } 
?>