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
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-content/plugins/syntaxhighlighter-tinymce-button/sh-tinymce-button-box/tinymce.js?ver=0.2"></script>
	<base target="_self" />
</head>
		<body id="link" onload="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';document.getElementById('shtb_adv_codebox_code').focus();" style="display: none">
<!-- <form onsubmit="insertLink();return false;" action="#"> -->
	<form name="shtb_adv_codebox" action="#">
		<table border="0" cellpadding="4" cellspacing="0">
         <tr>
			<td nowrap="nowrap"><label for="shtb_adv_codebox_language"><?php _e("Select Language", 'shtb_adv_lang'); ?></label></td>
			<td><select id="shtb_adv_codebox_language" name="shtb_adv_codebox_language" style="width: 200px">
			<option value="applescript"><?php _e("AppleScript", 'shtb_adv_lang'); ?></option>
			<option value="actionscript3"><?php _e("Actionscript3", 'shtb_adv_lang'); ?></option>
			<option value="bash"><?php _e("Bash shell", 'shtb_adv_lang'); ?></option>
			<option value="coldfusion"><?php _e("ColdFusion", 'shtb_adv_lang'); ?></option>
			<option value="c"><?php _e("C", 'shtb_adv_lang'); ?></option>
			<option value="cpp"><?php _e("C++", 'shtb_adv_lang'); ?></option>
			<option value="csharp"><?php _e("C#", 'shtb_adv_lang'); ?></option>
			<option value="css"><?php _e("CSS", 'shtb_adv_lang'); ?></option>
			<option value="delphi"><?php _e("Delphi", 'shtb_adv_lang'); ?></option>
			<option value="diff"><?php _e("Diff", 'shtb_adv_lang'); ?></option>
			<option value="erlang"><?php _e("Erlang", 'shtb_adv_lang'); ?></option>
			<option value="groovy"><?php _e("Groovy", 'shtb_adv_lang'); ?></option>
			<option value="html"><?php _e("HTML", 'shtb_adv_lang'); ?></option>
			<option value="java"><?php _e("Java", 'shtb_adv_lang'); ?></option>
			<option value="javafx"><?php _e("JavaFX", 'shtb_adv_lang'); ?></option>
			<option value="javascript"><?php _e("JavaScript", 'shtb_adv_lang'); ?></option>
			<option value="pascal"><?php _e("Pascal", 'shtb_adv_lang'); ?></option>
			<option value="patch"><?php _e("Patch", 'shtb_adv_lang'); ?></option>
			<option value="perl"><?php _e("Perl", 'shtb_adv_lang'); ?></option>
			<option value="php"><?php _e("PHP", 'shtb_adv_lang'); ?></option>
			<option value="text"><?php _e("Plain Text", 'shtb_adv_lang'); ?></option>
			<option value="powershell"><?php _e("PowerShell", 'shtb_adv_lang'); ?></option>
			<option value="python"><?php _e("Python", 'shtb_adv_lang'); ?></option>
			<option value="ruby"><?php _e("Ruby", 'shtb_adv_lang'); ?></option>
			<option value="rails"><?php _e("Ruby on Rails", 'shtb_adv_lang'); ?></option>
			<option value="sass"><?php _e("Sass", 'shtb_adv_lang'); ?></option>
			<option value="scala"><?php _e("Scala", 'shtb_adv_lang'); ?></option>
			<option value="scss"><?php _e("Scss", 'shtb_adv_lang'); ?></option>
			<option value="shell"><?php _e("Shell", 'shtb_adv_lang'); ?></option>
			<option value="sql"><?php _e("SQL", 'shtb_adv_lang'); ?></option>
			<option value="vb"><?php _e("Visual Basic", 'shtb_adv_lang'); ?></option>
			<option value="vbnet"><?php _e("Visual Basic .NET", 'shtb_adv_lang'); ?></option>
			<option value="xhtml"><?php _e("XHTML", 'shtb_adv_lang'); ?></option>
			<option value="xml"><?php _e("XML", 'shtb_adv_lang'); ?></option>
			<option value="xslt"><?php _e("XSLT", 'shtb_adv_lang'); ?></option>
            </select></td>
          </tr>
          <tr>
			<td nowrap="nowrap" valign="top"><label for="shtb_adv_codebox_linenumbers"><?php _e("Show Line Number", 'shtb_adv_lang'); ?></label></td>
            <td><label><input name="shtb_adv_codebox_linenumbers" id='shtb_adv_codebox_linenumbers' type="checkbox" checked="checked" /></label></td>
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
			    <input type="button" id="cancel" name="cancel" value="<?php _e("Cancel", 'shtb_adv_lang'); ?>" onclick="tinyMCEPopup.close();" />
		</div>

		<div style="float: right">
				<input type="submit" id="insert" name="insert" value="<?php _e("Insert", 'shtb_adv_lang'); ?>" onclick="insertSHTBADVCODEBOXcode();" />
		</div>
	</div>
</form>
</body>
</html>