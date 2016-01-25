function loadDocuments(target) {
	$.get(localStorage.DocumentUrl,function(response) {
		documentTemplate(target,response);
	});
}

function changeTab(open) {
	var parts = ["items","offer","editItems"];
	parts.forEach(function(v, k) {
		$("#"+ v).hide();
	});
	$("#"+open).show();
}