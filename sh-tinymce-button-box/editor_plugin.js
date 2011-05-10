// Docu : http://wiki.moxiecode.com/index.php/TinyMCE:Create_plugin/3.x#Creating_your_own_plugins

(function() {
	// Load plugin specific language pack
	tinymce.PluginManager.requireLangPack('shtb_adv_codebox');
	 
	tinymce.create('tinymce.plugins.shtb_adv_codebox', {
		
		init : function(ed, url) {
		// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');

			ed.addCommand('shtb_adv_codebox', function() {
				ed.windowManager.open({
					file : url + '/window.php',
					width : 360,
					height : 340,
					inline : 1
				}, {
					plugin_url : url // Plugin absolute URL
				});
			});

			// Register example button
			ed.addButton('shtb_adv_codebox', {
				title : 'SyntaxHighlighter TinyMCE Button CodeBox',
				cmd : 'shtb_adv_codebox',
				image : url + '/shtb_img.png'
			});

			// Add a node change handler, selects the button in the UI when a image is selected
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('shtb_adv_codebox', n.nodeName == 'IMG');
			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
					longname  : 'shtb_adv_codebox',
					author 	  : 'redcocker',
					authorurl : 'http://www.near-mint.com/blog',
					infourl   : 'http://www.near-mint.com/blog',
					version   : "0.2"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('shtb_adv_codebox', tinymce.plugins.shtb_adv_codebox);
})();


