=== SyntaxHighlighter TinyMCE Button ===
Contributors: redcocker, homolibere
Donate link: http://www.near-mint.com/blog/donate/
Tags: syntaxhighlighter, code, tinymce, button, syntax, highlight
Requires at least: 3.0
Tested up to: 3.1.2
Stable tag: 0.2.1.1

"SyntaxHighlighter TinyMCE Button" provides buttons for Visual Editor and will help to type &lt;pre&gt; tag for SyntaxHighlighter.

== Description ==

"SyntaxHighlighter TinyMCE Button" provides additional buttons for "Visual Editor(TinyMCE)" and these buttons will help to type or edit `<pre>` tag for Alex Gorbatchev's SyntaxHighlighter.

This plugin is based on "[CodeColorer TinyMCE Button](http://wordpress.org/extend/plugins/codecolorer-tinymce-button/ "homolibere developed")"

= Feature =

* You can operate in Visual Editor, No need to use HTML Editor.
* Easy wrap your code in `<pre>` tag by two ways.
* Enable to change language and options of previously-markuped code.
* Once your code is wrapped in `<pre>` tag, You can type 'tabs' for indent.
* Translated into English(Default) and Japanese(UTF-8).

= Compliant plugins =

You can use this plugin with following code syntax highlighter.

[WP SyntaxHighlighter](http://wordpress.org/extend/plugins/wp-syntaxhighlighter/ "WP SyntaxHighlighter"), [Syntax Highlighter Compress](http://wordpress.org/extend/plugins/syntax-highlighter-compress/ "Syntax Highlighter Compress"), [Auto SyntaxHighlighter](http://wordpress.org/extend/plugins/auto-syntaxhighlighter/ "Auto SyntaxHighlighter"), [Syntax Highlighter and Code Colorizer for WordPress](http://wordpress.org/extend/plugins/syntax-highlighter-and-code-prettifier/ "Syntax Highlighter and Code Colorizer for WordPress"), [Syntax Highlighter MT](http://wordpress.org/extend/plugins/syntax-highlighter-mt/ "Syntax Highlighter MT") etc.

= Notes =

This plugin is designed to work with a plugin based on Alex Gorbatchev's SyntaxHighlighter Ver, 2.0 or higher.

You can not use this plugin with some 'SyntaxHighlighter'-based plugins which do not support `<pre>` tag.

== Installation ==

1. Upload plugin folder to the `/wp-content/plugins/` directory.
1. Activate the plugin through the "Plugins" menu in WordPress.
1. If you need, go to "Settings" -> "SH TinyMCE Button" to configure.

= Usage =

Usage: To wrap your code in `<pre>` tag.

If you have previously-written code on your post or page, by this way, you can wrap your code in `<pre>` tag for 'SyntaxHighlighter'.

1. With the mouse, select and highlight your code where you want to aplly "SyntaxHighlighter".
1. Click "pre" button.
1. Select language and options.
1. Click "Insert" button.

Usage: To paste your code into the post or page.

If you want to copy the code from the other document and paste into your post or page, this way is best. Your pasted code will be warpped in `<pre>` tag automatically.

1. Click "CODE" button.
1. Select language and options and paste your code into textbox.
1. Click "Insert" button.

Usage: To change language and options of previously-markuped code.

1. With the mouse, select and highlight your code.
1. Click "pre" button.
1. Change language and options.
1. Click "Update" button.

Usage: To indent by tabs

1. Just type tab in your code. But till your code is wrapped in `<pre>` tag, you can not type any tabs.

== Screenshots ==

1. This is added buttons on TinyMCE.
2. This is pop up window at the click of "pre" button.
3. This is pop up window at the click of "CODE" button.
4. This is setting panel.

== Changelog ==

= 0.2.2 =
* The priority of a function hooked has been changed for "[Auto SyntaxHighlighter](http://wordpress.org/extend/plugins/auto-syntaxhighlighter/ "Auto SyntaxHighlighter")".

= 0.2.1 =
* Simplified codes related to processing tabfocus.
* Modified Japanese translation(modified "shtb_adv_lang-ja.mo" file).
* Translation of button labels on TinyMCE popup window has been completed.
* layout of buttons on TinyMCE popup window has been changed.

= 0.2 =
* Added "CODE" button which allows to paste sourcecode into post or page, keeping indent by tab.
* Enable to change language and options of previously-markuped code.

= 0.1.1 =
* This is the first version.

== Upgrade Notice ==

= 0.2.2 =
This version has a low-priority change.

= 0.2.1 =
This version has some low-priority changes.

= 0.2 =
This version has some new features.

= 0.1.1 =
This version is the first version.
