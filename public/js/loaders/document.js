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

function changeTab(open,getfunction,data) {
	if(typeof data == "undefined") data={};
	var parts = ["items","offer","editItems"];
	parts.forEach(function(v, k) {
		$("#"+ v).hide();
		$("li."+v).removeClass("active");
	});
	$("#"+open).show();
	$("li."+open).addClass("active");
	var url =$("#"+open).data("url");
	if(url.length>0) {
		$.get(url,data, function(response){
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

function deleteDocument(documentId) {
  var url = localStorage.DocumentDeleteUrl.replace("0", documentId);
  $.delete(url, {
    id: documentId
  }, function(response) {
  	window.App.Documents = {};
    reload();
    message(response);
  });
}

function editDocument( documentId, callback) {
  var url = localStorage.DocumentEditUrl.replace("0", documentId);
  $('#universalLargeModal').foundation('reveal', 'open', {
	    url: url,
	    success: function(data) {
	        callback();
	    },
	    error: function() {
	        console.log('failed loading modal');
	    }
	});
}