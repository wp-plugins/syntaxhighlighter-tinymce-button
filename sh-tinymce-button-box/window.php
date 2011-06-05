<?php
$wpconfig = realpath("../../../../wp-config.php");
if (!file_exists($wpconfig))  {
	echo "Could not found wp-config.php. Error in path :\n\n".$wpconfig ;	
	die;	
}
require_once($wpconfig);
require_once(ABSPATH.'/wp-admin/admin.php');
global $wpdb;
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHTB CodeBox</title>
<!-- 	<meta http-equiv="Content-Type" content="<?php// bloginfo('html_type'); ?>; charset=<?php //echo get_option('blog_charset'); ?>" /> -->
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-content/plugins/syntaxhighlighter-tinymce-button/sh-tinymce-button-box/tinymce.js?ver=0.4.1"></script>
<base target="_self" />
</head>
<body id="link" onload="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';document.getElementById('shtb_adv_codebox_code').focus();" style="display: none">
<!-- <form onsubmit="insertLink();return false;" action="#"> -->
	<form name="shtb_adv_codebox" action="#">
		<table border="0" cellpadding="4" cellspacing="0">
			<tr>
				<td nowrap="nowrap"><label for="shtb_adv_codebox_language"><?php _e("Select Language", 'shtb_adv_lang'); ?></label></td>
				<td>
					<select id="shtb_adv_codebox_language" name="shtb_adv_codebox_language" style="width: 200px">
					<?php 
					if (get_option('shtb_adv_using_syntaxhighlighter') == 'wp_syntaxhighlighter' && function_exists('wp_sh_register_menu_item') && is_array(get_option('wp_sh_language3')) && is_array(get_option('wp_sh_language2'))) {
						if (get_option('wp_sh_version') == '3.0') {
							$shtb_adv_language = get_option('wp_sh_language3');
						} elseif (get_option('wp_sh_version') == '2.1') {
							$shtb_adv_language = get_option('wp_sh_language2');
						}
						if (is_array($shtb_adv_language)) {
							asort($shtb_adv_language);
							echo "\n";
							foreach ($shtb_adv_language as $key => $val) {
								if ($val[1] == 'true' || $val[1] =='added') {
									echo '						<option value="'.$key.'">'.$val[0]."</option>\n";
								}
							}
							echo "\n";
						}
					} else {
						echo '<option value="applescript">'.__("AppleScript", 'shtb_adv_lang')."</option>\n";
						echo '<option value="actionscript3">'.__("Actionscript3", 'shtb_adv_lang')."</option>\n";
						echo '<option value="bash">'.__("Bash shell", 'shtb_adv_lang')."</option>\n";
						echo '<option value="coldfusion">'.__("ColdFusion", 'shtb_adv_lang')."</option>\n";
						echo '<option value="c">'.__("C", 'shtb_adv_lang')."</option>\n";
						echo '<option value="cpp">'.__("C++", 'shtb_adv_lang')."</option>\n";
						echo '<option value="csharp">'.__("C#", 'shtb_adv_lang')."</option>\n";
						echo '<option value="css">'.__("CSS", 'shtb_adv_lang')."</option>\n";
						echo '<option value="delphi">'.__("Delphi", 'shtb_adv_lang')."</option>\n";
						echo '<option value="diff">'.__("Diff", 'shtb_adv_lang')."</option>\n";
						echo '<option value="erlang">'.__("Erlang", 'shtb_adv_lang')."</option>\n";
						echo '<option value="groovy">'.__("Groovy", 'shtb_adv_lang')."</option>\n";
						echo '<option value="html">'.__("HTML", 'shtb_adv_lang')."</option>\n";
						echo '<option value="java">'.__("Java", 'shtb_adv_lang')."</option>\n";
						echo '<option value="javafx">'.__("JavaFX", 'shtb_adv_lang')."</option>\n";
						echo '<option value="javascript">'.__("JavaScript", 'shtb_adv_lang')."</option>\n";
						echo '<option value="pascal">'.__("Pascal", 'shtb_adv_lang')."</option>\n";
						echo '<option value="patch">'.__("Patch", 'shtb_adv_lang')."</option>\n";
						echo '<option value="perl">'.__("Perl", 'shtb_adv_lang')."</option>\n";
						echo '<option value="php">'.__("PHP", 'shtb_adv_lang')."</option>\n";
						echo '<option value="text">'.__("Plain Text", 'shtb_adv_lang')."</option>\n";
						echo '<option value="powershell">'.__("PowerShell", 'shtb_adv_lang')."</option>\n";
						echo '<option value="python">'.__("Python", 'shtb_adv_lang')."</option>\n";
						echo '<option value="ruby">'.__("Ruby", 'shtb_adv_lang')."</option>\n";
						echo '<option value="rails">'.__("Ruby on Rails", 'shtb_adv_lang')."</option>\n";
						echo '<option value="sass">'.__("Sass", 'shtb_adv_lang')."</option>\n";
						echo '<option value="scala">'.__("Scala", 'shtb_adv_lang')."</option>\n";
						echo '<option value="scss">'.__("Scss", 'shtb_adv_lang')."</option>\n";
						echo '<option value="shell">'.__("Shell", 'shtb_adv_lang')."</option>\n";
						echo '<option value="sql">'.__("SQL", 'shtb_adv_lang')."</option>\n";
						echo '<option value="vb">'.__("Visual Basic", 'shtb_adv_lang')."</option>\n";
						echo '<option value="vbnet">'.__("Visual Basic .NET", 'shtb_adv_lang')."</option>\n";
						echo '<option value="xhtml">'.__("XHTML", 'shtb_adv_lang')."</option>\n";
						echo '<option value="xml">'.__("XML", 'shtb_adv_lang')."</option>\n";
						echo '<option value="xslt">'.__("XSLT", 'shtb_adv_lang')."</option>\n";
					}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td nowrap="nowrap" valign="top"><label for="shtb_adv_codebox_linenumbers"><?php _e("Show Line Number", 'shtb_adv_lang'); ?></label></td>
				<td><?php $shc_opt = get_option('shc_opt'); if ((get_option('shtb_adv_using_syntaxhighlighter') == 'wp_syntaxhighlighter' && function_exists('wp_sh_register_menu_item') && get_option('wp_sh_gutter') == 0) || (get_option('shtb_adv_using_syntaxhighlighter') == 'syntax_highlighter_compress' && function_exists('shc_install') && $shc_opt[shc_gutter] == 0)) {$shtb_adv_codebox_linenumbers_check = '';} else {$shtb_adv_codebox_linenumbers_check = 'checked="checked" ';}?><label><input name="shtb_adv_codebox_linenumbers" id='shtb_adv_codebox_linenumbers' type="checkbox" <?php echo $shtb_adv_codebox_linenumbers_check; ?>/></label></td>
			</tr>
			<tr>
				<td nowrap="nowrap" valign="top"><label for="shtb_adv_codebox_starting_linenumber"><?php _e("Starting Line Number", 'shtb_adv_lang'); ?></label></td>
				<td><?php if (get_option('shtb_adv_using_syntaxhighlighter') == 'wp_syntaxhighlighter' && function_exists('wp_sh_register_menu_item') && get_option('wp_sh_gutter') == 1) {$shtb_adv_codebox_starting_linenumber_value = get_option('wp_sh_first_line');} else {$shtb_adv_codebox_starting_linenumber_value = '1';}?><label><input name="shtb_adv_codebox_starting_linenumber" id='shtb_adv_codebox_starting_linenumber' type="text" value="<?php echo $shtb_adv_codebox_starting_linenumber_value; ?>" /></label></td>
			</tr>
			<tr>
				<td nowrap="nowrap" valign="top"><label for="shtb_adv_codebox_highlighted_lines"><?php _e("Highlighted Lines", 'shtb_adv_lang'); ?></label></td>
				<td><label><input name="shtb_adv_codebox_highlighted_lines" id='shtb_adv_codebox_highlighted_lines' type="text" /></label><br /><?php _e("Enter comma-separated linenumbers", 'shtb_adv_lang'); ?></td>
			</tr>
			<tr>
				<td nowrap="nowrap" valign="top"><label for="shtb_adv_codebox_html_script"><?php _e("html-script", 'shtb_adv_lang'); ?></label></td>
				<td><label><input name="shtb_adv_codebox_html_script" id='shtb_adv_codebox_html_script' type="checkbox" /></label></td>
			</tr>
			<tr>
				<td nowrap="nowrap" valign="top" colspan="2">
				<label for="shtb_adv_codebox_code"><?php _e("Your Code:", 'shtb_adv_lang'); ?></label><br />
				<textarea id="shtb_adv_codebox_code" rows="18" name="shtb_adv_codebox_code" style="width: 340px; height: 225px" /></textarea>
				</td>
			</tr>
		</table>
		<div class="mceActionPanel">
			<div style="float: left">
				<input type="submit" id="insert" name="insert" value="<?php _e("Insert", 'shtb_adv_lang'); ?>" onclick="insertSHTBADVCODEBOXcode();" />
			</div>
			<div style="float: right">
				<input type="button" id="cancel" name="cancel" value="<?php _e("Cancel", 'shtb_adv_lang'); ?>" onclick="tinyMCEPopup.close();" />
			</div>
		</div>
	</form>
</body>
</html>