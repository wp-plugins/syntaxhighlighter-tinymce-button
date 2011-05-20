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

function insertSHTBADVCODEBOXcode() {

	var langname_ddb = document.getElementById('shtb_adv_codebox_language');
	var langname = langname_ddb.value;
	var linenumbers = document.getElementById('shtb_adv_codebox_linenumbers').checked;
	var starting_linenumber = document.getElementById('shtb_adv_codebox_starting_linenumber').value;
	var highlight_lines = document.getElementById('shtb_adv_codebox_highlighted_lines').value;
	var html_script = document.getElementById('shtb_adv_codebox_html_script').checked;
	var code = document.getElementById('shtb_adv_codebox_code').value.replace(/</g,'&lt;').replace(/\n/g,'<br>');

	var tagtext = '<pre class="brush: ';
	classAttribs = langname;

	if (linenumbers)
		classAttribs = classAttribs + '; gutter: true';
	else
		classAttribs = classAttribs + '; gutter: false';

	if (starting_linenumber)
		classAttribs = classAttribs + '; first-line: ' + starting_linenumber;
	else
		classAttribs = classAttribs;

	if (highlight_lines)
		classAttribs = classAttribs + '; highlight: [' + highlight_lines + ']';
	else
		classAttribs = classAttribs;

	if (html_script)
		classAttribs = classAttribs + '; html-script: true';
	else
		classAttribs = classAttribs;

	if(starting_linenumber.match(/[^0-9]+/)){
			alert("Please input number to the 'Starting Line Number' column");
			return;
	} else if(highlight_lines != "" && highlight_lines.match(/[^,0-9]/)){
			alert("Please input a linenumber or comma-separated linenumbers to the 'Highlighted Lines' column");
			return;
	} else if (code == '') {
		alert("Your code is empty");
	} else {
	tinyMCEPopup.editor.execCommand('mceInsertContent', false, tagtext+classAttribs+'">'+code+'</pre>');
	}
	tinyMCEPopup.close();
	return;
}
