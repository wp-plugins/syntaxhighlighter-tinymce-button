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

function insertSHTBADVINSERTcode() {

	ed = tinyMCEPopup.editor
	var langname_ddb = document.getElementById('shtb_adv_insert_language');
	var langname = langname_ddb.value;
	var linenumbers = document.getElementById('shtb_adv_insert_linenumbers').checked;
	var inst = tinyMCE.getInstanceById('content');
	var html = inst.selection.getContent();
	html = html.replace(/<p>/g,"").replace(/<\/p>/g,"<br \/>");

	var tagtext = '<pre class="brush: ';
	classAttribs = langname;

	if (linenumbers)
		classAttribs = classAttribs + '; gutter: true';
	else
		classAttribs = classAttribs + '; gutter: false';

	if(e = ed.dom.getParent(ed.selection.getNode(), 'pre')){
		ed.dom.setAttribs(e, {class : 'brush: '+classAttribs});
	} else {
	window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext+classAttribs+'">'+html+'</pre>');
	tinyMCEPopup.editor.execCommand('mceRepaint');
	}
	tinyMCEPopup.close();
	return;
}
