<?php
/*
Plugin Name: SyntaxHighlighter TinyMCE Button
Plugin URI: http://www.near-mint.com/blog/software/syntaxhighlighter-tinymce-button
Description: 'SyntaxHighlighter TinyMCE Button' provides additional buttons for Visual Editor and these buttons will help to type or edit <code>&lt;pre&gt;</code> tag for Alex Gorbatchev's <a href='http://alexgorbatchev.com/SyntaxHighlighter/'>SyntaxHighlighter</a>. This plugin is based on '<a href='http://wordpress.org/extend/plugins/codecolorer-tinymce-button/'>CodeColorer TinyMCE Button</a>'.
Version: 0.7
Author: redcocker
Author URI: http://www.near-mint.com/blog/
Text Domain: shtb_adv_lang
Domain Path: /locale/
*/
/*
Date of release: Ver. 0.7 2011/7/10
License: GPL v2
*/
load_plugin_textdomain('shtb_adv_lang', false, 'syntaxhighlighter-tinymce-button/locale');
$shtb_adv_plugin_url = plugin_dir_url( __FILE__ );
$shtb_adv_db_ver = "0.7";
$shtb_adv_setting_opt = get_option('shtb_adv_setting_opt');

// Setting values assign to the associative array
function shtb_adv_setting_array(){
	global $shtb_adv_db_ver;

	$shtb_adv_setting_opt['shtb_adv_using_syntaxhighlighter'] = "other";
	$shtb_adv_setting_opt['shtb_adv_insert'] = "1";
	$shtb_adv_setting_opt['shtb_adv_codebox'] = "1";
	$shtb_adv_setting_opt['shtb_adv_button_window_size'] = "100";
	$shtb_adv_setting_opt['shtb_adv_button_row'] = "1";
	$shtb_adv_setting_opt['shtb_adv_gutter'] = "1";
	$shtb_adv_setting_opt['shtb_adv_first_line'] = "1";
	$shtb_adv_setting_opt['shtb_adv_html_script'] = "0";

	$shtb_adv_language['applescript'] = array('AppleScript', 'true');
	$shtb_adv_language['actionscript3'] = array('Actionscript3', 'true');
	$shtb_adv_language['bash'] = array('Bash shell', 'true');
	$shtb_adv_language['coldfusion'] = array('ColdFusion', 'true');
	$shtb_adv_language['c'] = array('C', 'true');
	$shtb_adv_language['cpp'] = array('C++', 'true');
	$shtb_adv_language['csharp'] = array('C#', 'true');
	$shtb_adv_language['css'] = array('CSS', 'true');
	$shtb_adv_language['delphi'] = array('Delphi', 'true');
	$shtb_adv_language['diff'] = array('Diff', 'true');
	$shtb_adv_language['erlang'] = array('Erlang', 'true');
	$shtb_adv_language['groovy'] = array('Groovy', 'true');
	$shtb_adv_language['html'] = array('HTML', 'true');
	$shtb_adv_language['java'] = array('Java', 'true');
	$shtb_adv_language['javafx'] = array('JavaFX', 'true');
	$shtb_adv_language['javascript'] = array('JavaScript', 'true');
	$shtb_adv_language['pascal'] = array('Pascal', 'true');
	$shtb_adv_language['patch'] = array('Patch', 'true');
	$shtb_adv_language['perl'] = array('Perl', 'true');
	$shtb_adv_language['php'] = array('PHP', 'true');
	$shtb_adv_language['text'] = array('Plain Text', 'true');
	$shtb_adv_language['powershell'] = array('PowerShell', 'true');
	$shtb_adv_language['python'] = array('Python', 'true');
	$shtb_adv_language['ruby'] = array('Ruby', 'true');
	$shtb_adv_language['rails'] = array('Ruby on Rails', 'true');
	$shtb_adv_language['sass'] = array('Sass', 'true');
	$shtb_adv_language['scala'] = array('Scala', 'true');
	$shtb_adv_language['scss'] = array('Scss', 'true');
	$shtb_adv_language['shell'] = array('Shell', 'true');
	$shtb_adv_language['sql'] = array('SQL', 'true');
	$shtb_adv_language['vb'] = array('Visual Basic', 'true');
	$shtb_adv_language['vbnet'] = array('Visual Basic .NET', 'true');
	$shtb_adv_language['xhtml'] = array('XHTML', 'true');
	$shtb_adv_language['xml'] = array('XML', 'true');
	$shtb_adv_language['xslt'] = array('XSLT', 'true');

	update_option('shtb_adv_setting_opt', $shtb_adv_setting_opt);
	update_option('shtb_adv_languages', $shtb_adv_language);
	update_option('shtb_adv_checkver_stamp', $shtb_adv_db_ver);
}

// Check DB table version and create table
add_action('plugins_loaded', 'shtb_adv_check_db_ver');

function shtb_adv_check_db_ver(){
	global $shtb_adv_db_ver;
	if ($shtb_adv_db_ver != get_option('shtb_adv_checkver_stamp')) {
		shtb_adv_setting_array();
		add_action('admin_notices', 'shtb_adv_admin_updated_notice');
	}
}

// Message for admin when DB table updated
function shtb_adv_admin_updated_notice(){
    echo '<div id="message" class="updated"><p>'.__("SyntaxHighlighter TinyMCE Button has successfully created new DB table.(If you updated, Plugin settings were reset to default.)<br />Go to the setting panel and <strong>configure SyntaxHighlighter TinyMCE Button</strong> now.","shtb_adv_lang").'</p></div>';
}

// show plugin info in the footer
function shtb_adv_add_admin_footer(){
	$shtb_adv_plugin_data = get_plugin_data(__FILE__);
	printf('%1$s by %2$s<br />', $shtb_adv_plugin_data['Title'].' '.$shtb_adv_plugin_data['Version'], $shtb_adv_plugin_data['Author']);
}

// show plugin info in the footer
add_action('admin_menu', 'shtb_adv_register_menu_item');

function shtb_adv_register_menu_item() {
	$shtb_adv_page_hook = add_options_page('SyntaxHighlighter TinyMCE Button Options', 'SH TinyMCE Button', 'manage_options', 'syntaxhighlighter-tinymce-button-options', 'shtb_adv_options_panel');
	if ($shtb_adv_page_hook != null) {
		$shtb_adv_page_hook = '-'.$shtb_adv_page_hook;
	}
	add_action('admin_print_scripts'.$shtb_adv_page_hook, 'shtb_adv_load_jscript_for_admin');
}

// Load javascript in setting panel
function shtb_adv_load_jscript_for_admin(){
	global $shtb_adv_plugin_url;
	wp_enqueue_script('rc_admin_js', $shtb_adv_plugin_url.'rc-admin-js.js', false, '1.1');
}

// Add the setting panel
add_filter( 'plugin_action_links', 'shtb_adv_setting_link', 10, 2);

function shtb_adv_setting_link($links, $file){
	static $this_plugin;
	if (! $this_plugin) $this_plugin = plugin_basename(__FILE__);
	if ($file == $this_plugin){
		$settings_link = '<a href="options-general.php?page=syntaxhighlighter-tinymce-button-options">'.__('Settings', 'shtb_adv_lang').'</a>';
		array_unshift($links, $settings_link);
	}  
	return $links;
}

// Load SyntaxHighlighter TinyMCE Buttons
if ($shtb_adv_setting_opt['shtb_adv_insert'] == 1) {
	include_once('sh-tinymce-button-ins/sh-tinymce-button-ins.php');
}
if ($shtb_adv_setting_opt['shtb_adv_codebox'] == 1) {
	include_once('sh-tinymce-button-box/sh-tinymce-button-box.php');
}

// Allow tabs to indent in TinyMCE.
if ($shtb_adv_setting_opt['shtb_adv_insert'] == 1 || $shtb_adv_setting_opt['shtb_adv_codebox'] == 1) {
	add_filter('tiny_mce_before_init', 'shtb_adv_insert_allow_tab');
}

function shtb_adv_insert_allow_tab($initArray) {
    $initArray['plugins']=preg_replace("|[,]+tabfocus|i","",$initArray['plugins']);
    return $initArray;
}

// Add 'pre' tag and 'class' attribte as TinyMCE valid_elements.
add_filter('tiny_mce_before_init', 'shtb_adv_mce_valid_elements');

function shtb_adv_mce_valid_elements($init) {
	if ( isset( $init['extended_valid_elements'] ) 
	&& ! empty( $init['extended_valid_elements'] ) ) {
		$init['extended_valid_elements'] .= ',' . 'pre[class]';
	} else {
		$init['extended_valid_elements'] = 'pre[class]';
	}
	return $init;
}

// Setting panel
function shtb_adv_options_panel(){
	global $shtb_adv_plugin_url, $shtb_adv_db_ver;
	if(!function_exists('current_user_can') || !current_user_can('manage_options')){
			die(__('Cheatin&#8217; uh?'));
	} 
	add_action('in_admin_footer', 'shtb_adv_add_admin_footer');

	if (isset($_POST['SHTB_ADV_Setting_Submit']) && $_POST['shtb_adv_hidden_value'] == "true") {
		echo "<div id='setting-error-settings_updated' class='updated fade'><p><strong>".__("Settings saved.","shtb_adv_lang")."</strong></p></div>";
	} elseif (isset($_POST['SHTB_ADV_Reset']) && $_POST['shtb_adv_reset']='true') {
		echo "<div id='setting-error-settings_updated' class='updated fade'><p><strong>".__("All settings were reset. Please <a href=\"options-general.php?page=syntaxhighlighter-tinymce-button-options\">reload the page</a>.","shtb_adv_lang")."</strong></p></div>";
	}

	$shtb_adv_languages = get_option('shtb_adv_languages');
	$shtb_adv_setting_opt = get_option('shtb_adv_setting_opt');

	if ((!is_array($shtb_adv_languages) || !is_array($shtb_adv_setting_opt) || $shtb_adv_db_ver != get_option('shtb_adv_checkver_stamp')) && !isset($_POST['SHTB_ADV_Reset'])) {
		echo "<div id='setting-error-settings_updated' class='updated settings-error'><p><strong>".__("Error: Missing Database Table. The plugin may fail to create the databese table when install or update. Please re-create database table by clicking on 'Reset All Settings'.","shtb_adv_lang")."</strong></p></div>";
	}

	// Update setting options
	if (isset($_POST['SHTB_ADV_Setting_Submit']) && $_POST['shtb_adv_hidden_value'] == "true") {
		$shtb_adv_setting_opt['shtb_adv_using_syntaxhighlighter'] = $_POST['shtb_adv_using_syntaxhighlighter'];
		$shtb_adv_setting_opt['shtb_adv_insert'] = $_POST['shtb_adv_insert'];
		$shtb_adv_setting_opt['shtb_adv_codebox'] = $_POST['shtb_adv_codebox'];
		$shtb_adv_setting_opt['shtb_adv_button_window_size'] = $_POST['shtb_adv_button_window_size'];
		$shtb_adv_setting_opt['shtb_adv_button_row'] = $_POST['shtb_adv_button_row'];
		$shtb_adv_setting_opt['shtb_adv_gutter'] = $_POST['shtb_adv_gutter'];
		$shtb_adv_setting_opt['shtb_adv_button_row'] = $_POST['shtb_adv_button_row'];
		if ($_POST['shtb_adv_gutter'] == "1") {
			$shtb_adv_setting_opt['shtb_adv_gutter'] = "1";
		} else {
			$shtb_adv_setting_opt['shtb_adv_gutter'] = "0";
		}
		$shtb_adv_setting_opt['shtb_adv_first_line'] = $_POST['shtb_adv_first_line'];
		if ($_POST['shtb_adv_html_script'] == "1") {
			$shtb_adv_setting_opt['shtb_adv_html_script'] = "1";
		} else {
			$shtb_adv_setting_opt['shtb_adv_html_script'] = "0";
		}

		foreach($shtb_adv_languages as  $alias => $val){
			$brush_lang = $val[0];
			$key = 'lang_'.$alias;
			$shtb_adv_new_languages[$alias]= array($brush_lang, $_POST[$key]);
		}
	update_option('shtb_adv_setting_opt', $shtb_adv_setting_opt);
	update_option('shtb_adv_languages', $shtb_adv_new_languages);
	$shtb_adv_languages = get_option('shtb_adv_languages');
	}

	// Reset all settings
	if (isset($_POST['SHTB_ADV_Reset']) && $_POST['shtb_adv_reset']='true') {
		include_once('uninstall.php');
		shtb_adv_setting_array();
	}


	?> 
	<div class="wrap">
	<h2>SyntaxHighlighter TinyMCE Button</h2>
	<form method="post" action="<?php echo($_SERVER['REQUEST_URI']);?>">
	<input type="hidden" name="shtb_adv_hidden_value" value="true" />
	<h3><?php _e("1. Basic settings", 'shtb_adv_lang') ?></h3> 
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><strong><?php _e('Using with', 'shtb_adv_lang') ?></strong></th> 
				<td>
					<input type="radio" name="shtb_adv_using_syntaxhighlighter" value="wp_syntaxhighlighter" <?php if ($shtb_adv_setting_opt['shtb_adv_using_syntaxhighlighter'] == "wp_syntaxhighlighter") {echo 'checked=\"checked\"';} ?>/><?php _e('<a href="http://wordpress.org/extend/plugins/wp-syntaxhighlighter/" style="text-decoration: none">WP SyntaxHighlighter</a>', 'shtb_adv_lang') ?> <input type="radio" name="shtb_adv_using_syntaxhighlighter" value="syntax_highlighter_compress" <?php if ($shtb_adv_setting_opt['shtb_adv_using_syntaxhighlighter'] == "syntax_highlighter_compress") {echo 'checked=\"checked\"';} ?>/><?php _e('<a href="http://wordpress.org/extend/plugins/syntax-highlighter-compress/" style="text-decoration: none">Syntax Highlighter Compress</a>', 'shtb_adv_lang') ?> <input type="radio" name="shtb_adv_using_syntaxhighlighter" value="syntaxhighlighter_evolved" <?php if ($shtb_adv_setting_opt['shtb_adv_using_syntaxhighlighter'] == "syntaxhighlighter_evolved") {echo 'checked=\"checked\"';} ?>/><?php _e('<a href="http://wordpress.org/extend/plugins/syntaxhighlighter/" style="text-decoration: none">SyntaxHighlighter Evolved</a>', 'shtb_adv_lang') ?> <input type="radio" name="shtb_adv_using_syntaxhighlighter" value="other" <?php if ($shtb_adv_setting_opt['shtb_adv_using_syntaxhighlighter'] == "other") {echo 'checked=\"checked\"';} ?>/><?php _e('Other', 'shtb_adv_lang') ?>
					<p><small><?php _e("Select your using plugin based on Alex Gorbatchev's <a href='http://alexgorbatchev.com/SyntaxHighlighter/' style='text-decoration: none'>SyntaxHighlighter</a>.<br />If your plugin is not in the options, Select 'Other'.<br />It is the same if you use <a href='http://wordpress.org/extend/plugins/auto-syntaxhighlighter/' style='text-decoration: none'>Auto SyntaxHighlighter</a>, <a href='http://wordpress.org/extend/plugins/syntax-highlighter-and-code-prettifier/' style='text-decoration: none'>Syntax Highlighter and Code Colorizer for WordPress</a> or <a href='http://wordpress.org/extend/plugins/syntax-highlighter-mt/' style='text-decoration: none'>Syntax Highlighter MT</a>.<br />If you don't know about your using plugin, Select 'Other'. When you select 'Other', this plugin will act innocuously.<br />When using with 'SyntaxHighlighter Evolved', 'Load All Brushes' option must be enabled on the 'SyntaxHighlighter' setting panel.<br />If you want to use full options of 'Dafault settings for your buttons', you should select 'Other'.", "shtb_adv_lang") ?></small></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><strong><?php _e('Buttons', 'shtb_adv_lang') ?></strong></th>
				<td>
					<input type="checkbox" name="shtb_adv_insert" value="1" <?php if ($shtb_adv_setting_opt['shtb_adv_insert'] == '1') {echo 'checked=\"checked\"';} ?>/> Select &amp; Insert <input type="checkbox" name="shtb_adv_codebox" value="1" <?php if ($shtb_adv_setting_opt['shtb_adv_codebox'] == '1') {echo 'checked=\"checked\"';} ?>/> CodeBox
					<p><small><?php _e("Enable/Disable buttons.<br />'Select &amp; Insert' will help you to wrap your code on the post or page in <code>&lt;pre&gt;</code> tag or to update values of previously-markuped code.<br />'CodeBox' will allow you to paste your code into the post or page and wrap in <code>&lt;pre&gt;</code> tag automatically, keeping indent by tabs.<br />In 'Visual Editor', 'Select &amp; Insert' will appear as 'pre' icon and 'CodeBox' will appear as 'CODE' icon.", "shtb_adv_lang") ?></small></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><strong><?php _e('Window size', 'shtb_adv_lang') ?></strong></th> 
				<td>
					<select name="shtb_adv_button_window_size">
						<option value="100" <?php if ($shtb_adv_setting_opt['shtb_adv_button_window_size'] == "100") {echo 'selected="selected"';} ?>>100%</option>
						<option value="105" <?php if ($shtb_adv_setting_opt['shtb_adv_button_window_size'] == "105") {echo 'selected="selected"';} ?>>105%</option>
						<option value="110" <?php if ($shtb_adv_setting_opt['shtb_adv_button_window_size'] == "110") {echo 'selected="selected"';} ?>>110%</option>
					</select>
					<p><small><?php _e("Choose size of pop-up window at the click of buttons.", "shtb_adv_lang") ?></small></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><strong><?php _e('Place the buttons in', 'shtb_adv_lang') ?></strong></th> 
				<td>
					<select name="shtb_adv_button_row">
						<option value="1" <?php if ($shtb_adv_setting_opt['shtb_adv_button_row'] == "1") {echo 'selected="selected"';} ?>><?php _e("1st row", "shtb_adv_lang") ?></option>
						<option value="2" <?php if ($shtb_adv_setting_opt['shtb_adv_button_row'] == "2") {echo 'selected="selected"';} ?>><?php _e("2nd row", "shtb_adv_lang") ?></option>
						<option value="3" <?php if ($shtb_adv_setting_opt['shtb_adv_button_row'] == "3") {echo 'selected="selected"';} ?>><?php _e("3rd row", "shtb_adv_lang") ?></option>
						<option value="4" <?php if ($shtb_adv_setting_opt['shtb_adv_button_row'] == "4") {echo 'selected="selected"';} ?>><?php _e("4th row", "shtb_adv_lang") ?></option>
					</select> <?php _e("of TinyMCE toolbar.", "shtb_adv_lang") ?>
					<p><small><?php _e("Choose TinyMCE toolbar row which buttons will be placed in.", "shtb_adv_lang") ?></small></p>
				</td>
			</tr>
		</table>
		<h3><a href="javascript:showhide('id1');" name="button_settings"><?php _e("2. Dafault settings for your buttons", 'shtb_adv_lang') ?></a></h3> 
		<div id="id1" style="display:none;">
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><strong><?php _e('Show Line Number', 'shtb_adv_lang') ?></strong></th>
				<td>
					<input type="checkbox" name="shtb_adv_gutter" value="1" <?php if ($shtb_adv_setting_opt['shtb_adv_gutter'] == '1') {echo 'checked=\"checked\"';} ?>/>
					<p><small><?php _e("Enable/Disable 'Show Line number' option by default.<br />Only when 'Other' is selected in 'Using with' option, this option can work.", "shtb_adv_lang") ?></small></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><strong><?php _e('Starting Line Number', 'shtb_adv_lang') ?></strong></th>
				<td>
					<input type="text" name="shtb_adv_first_line" size="2" value="<?php echo $shtb_adv_setting_opt['shtb_adv_first_line']; ?>" />
					<p><small><?php _e("Enter default starting line number.<br />When 'WP SyntaxHighlighter' or 'SyntaxHighlighter Evolved' is selected in 'Using with' option, this option can't work.", 'shtb_adv_lang') ?></small></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><strong><?php _e('html-script', 'shtb_adv_lang') ?></strong></th>
				<td>
					<input type="checkbox" name="shtb_adv_html_script" value="1" <?php if ($shtb_adv_setting_opt['shtb_adv_html_script'] == '1') {echo 'checked=\"checked\"';} ?>/>
					<p><small><?php _e("Enable/Disable 'html-script' option by default.", "shtb_adv_lang") ?></small></p>
				</td>
			</tr>
			<tr valign="top"> 
				<th scope="row"><strong><?php _e('Default languages', 'shtb_adv_lang') ?></strong></th>
				<td>
					<p><small><?php _e("Choose languages listed in the drop-down list by default.<br />When 'WP SyntaxHighlighter' is selected in 'Using with' option, this option can't work.", "shtb_adv_lang") ?></small></p>
				</td>
			</tr>
		<?php 
		if (is_array($shtb_adv_languages)) {
			foreach($shtb_adv_languages as $alias => $val){
				$brush_lang = $val[0];
				$brush_enable = $val[1];
			?>
			<tr valign="top">
				<th scope="row"><?php echo $alias; ?></strong></th>
				<td>
				<label for="<?php echo 'lang_'.$alias; ?>_Yes"> <input type="radio" id="<?php echo $lang; ?>_Yes" name="<?php echo 'lang_'.$alias; ?>" value="true" <?php if($brush_enable == 'true'){echo 'checked="checked"';}?> /><?php _e('Yes', 'shtb_adv_lang') ?></label>
				<label for="<?php echo 'lang_'.$alias; ?>_No"><input type="radio" id="<?php echo $lang; ?>_No" name="<?php echo 'lang_'.$alias; ?>" value="false" <?php if($brush_enable == 'false'){echo 'checked="checked"';}?> /><?php _e('No', 'shtb_adv_lang') ?></label>
				</td>
			</tr>
			<?php }
		 } ?>
		</table>
		</div>
		<p class="submit">
		<input type="submit" name="SHTB_ADV_Setting_Submit" value="<?php _e('Save Changes', 'shtb_adv_lang') ?>" />
		</p>
	</form>
	<h3><?php _e('3. Restore all settings to default', 'shtb_adv_lang') ?></h3>
	<form method="post" action="<?php echo($_SERVER['REQUEST_URI']);?>" onsubmit="return confirmreset()">
		<p class="submit">
		<input type="hidden" name="shtb_adv_reset" value="true" />
		<input type="submit" name="SHTB_ADV_Reset" value="<?php _e('Reset All Settings', 'shtb_adv_lang') ?>" />
		</p>
	</form>
	<h3><a href="javascript:showhide('id2');" name="system_info"><?php _e("4. Your System Info", 'shtb_adv_lang') ?></a></h3>
	<div id="id2" style="display:none; margin-left:20px">
	<p>
	<?php _e('Server OS:', 'shtb_adv_lang') ?> <?php echo php_uname('s').' '.php_uname('r'); ?><br />
	<?php _e('PHP version:', 'shtb_adv_lang') ?> <?php echo phpversion(); ?><br />
	<?php _e('MySQL version:', 'shtb_adv_lang') ?> <?php echo mysql_get_server_info(); ?><br />
	<?php _e('WordPress version:', 'shtb_adv_lang') ?> <?php bloginfo("version"); ?><br />
	<?php _e('Site URL:', 'shtb_adv_lang') ?> <?php bloginfo("url"); ?><br />
	<?php _e('WordPress URL:', 'shtb_adv_lang') ?> <?php bloginfo("wpurl"); ?><br />
	<?php _e('WordPress language:', 'shtb_adv_lang') ?> <?php bloginfo("language"); ?><br />
	<?php _e('WordPress character set:', 'shtb_adv_lang') ?> <?php bloginfo("charset"); ?><br />
	<?php _e('WordPress theme:', 'shtb_adv_lang') ?> <?php $shtb_theme = get_theme(get_current_theme()); echo $shtb_theme['Name'].' '.$shtb_theme['Version']; ?><br />
	<?php _e('SyntaxHighlighter TinyMCE Button version:', 'shtb_adv_lang') ?> <?php $shtb_plugin_data = get_plugin_data(__FILE__); echo $shtb_plugin_data['Version']; ?><br />
	<?php _e('SyntaxHighlighter TinyMCE Button URL:', 'shtb_adv_lang') ?> <?php echo $shtb_adv_plugin_url; ?><br />
	<?php _e('Your browser:', 'shtb_adv_lang') ?> <?php echo $_SERVER['HTTP_USER_AGENT']; ?>
	</p>
	</div>
	<p>
	<?php _e("To report a bug ,submit requests and feedback, ", 'shtb_adv_lang') ?><?php _e('Use <a href="http://wordpress.org/tags/syntaxhighlighter-tinymce-button?forum_id=10">Forum</a> or <a href="http://www.near-mint.com/blog/contact">Mail From</a>', 'shtb_adv_lang') ?>
	</p>
	</div>
<?php } 
?>