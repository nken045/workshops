function confirmDialog(content) {
	if(window.confirm(content + 'を行います。よろしいですか？')){
		return true;
	} else {
		return false;
	}
}
