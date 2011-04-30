function init() {
	tinyMCEPopup.resizeToInnerSize();
}

function getCheckedValue(radioObj) {
	if(!radioObj)
		return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
		if(radioObj.checked)
			return radioObj.value;
		else
			return "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
}

function insertSHTBcode() {

	var tagtext;
	var langname_ddb = document.getElementById('shtb_language');
	var langname = langname_ddb.value;
	var linenumbers = document.getElementById('shtb_linenumbers').checked;
	var inst = tinyMCE.getInstanceById('content');
	var html = inst.selection.getContent();
	
	if (linenumbers)
		tagtext = "<pre class=\"brush: " + langname + "; gutter: true;\"";
	else
		tagtext = "<pre class=\"brush: " + langname + "; gutter: false;\"";
	
	window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext+'>'+html+'</pre>');
	tinyMCEPopup.editor.execCommand('mceRepaint');
	tinyMCEPopup.close();
	return;
}
