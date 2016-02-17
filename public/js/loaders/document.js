function loadDocuments(target) {
	if(window.App.Documents.length>0) {
		documentTemplate(target,window.App.Documents);
	} else {
		$.get(localStorage.DocumentUrl,function(response) {
			documentTemplate(target,response);
			window.App.Documents = response;
		});
	}
}

function changeTab(open,getfunction) {
	var parts = ["items","offer","editItems"];
	parts.forEach(function(v, k) {
		$("#"+ v).hide();
	});
	$("#"+open).show();
	var url =$("#"+open).data("url");
	if(url.length>0) {
		$.get(url, function(response){
			getfunction(response);
		});
	}
}

function loadItems() {
	$.get(localStorage.ItemsUrl, function(response) {
		window.App.Items = response;
	});
}

function insertItems(html, targetHtml, target) {
	itemConnectionTemplate(html,targetHtml,target,window.App.Items);
}