// Docu : http://wiki.moxiecode.com/index.php/TinyMCE:Create_plugin/3.x#Creating_your_own_plugins

(function() {
	// Load plugin specific language pack
	tinymce.PluginManager.requireLangPack('shtb');
	 
	tinymce.create('tinymce.plugins.shtb', {
		
		init : function(ed, url) {
		// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');

			ed.addCommand('shtb', function() {
				ed.windowManager.open({
					file : url + '/window.php',
					width : 360,
					height : 90,
					inline : 1
				}, {
					plugin_url : url // Plugin absolute URL
				});
			});

			// Register example button
			ed.addButton('shtb', {
				title : 'SyntaxHighlighter',
				cmd : 'shtb',
				image : url + '/shtb_img.png'
			});

			// Add a node change handler, selects the button in the UI when a image is selected
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('shtb', n.nodeName == 'IMG');
			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
					longname  : 'shtb',
					author 	  : 'redcocker',
					authorurl : 'http://www.near-mint.com/blog',
					infourl   : 'http://www.near-mint.com/blog',
					version   : "0.1"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('shtb', tinymce.plugins.shtb);
})();


