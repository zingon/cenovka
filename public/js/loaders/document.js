function loadDocuments(target) {
	$.get(localStorage.DocumentUrl,function(response) {
		documentTemplate(target,response);
	});
}