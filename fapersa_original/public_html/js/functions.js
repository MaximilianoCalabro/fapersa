function printWindow() {
	window.focus();
	
	if ($.browser.msie && $.browser.version >= 7.0) {
		document.execCommand('print',false,null);
	}else{
		window.print();
	}
	
	closeTB();
}

function closeWindow() {
	if (typeof(self.parent.tb_remove) == 'function') {
		self.parent.tb_remove();
	}else{
		window.location.href = '/';
	}
}

function closeTB() {
	self.parent.tb_remove();
	void('');
}