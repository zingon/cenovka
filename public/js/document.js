$(document).ready(function() {
	window.App.Documents = {};
	window.App.Items = {};
  	window.App.pagination.onPage = 10;
  	window.App.pagination.element = "#pagination";

  	init();
});

function init() {

	reload();

	$(document).on("click", "button.next", function() {
		var id = $(this).parent().parent().parent().parent().attr("id");
		var form = $(this).parent().parent().parent();
		var parentThis = $(this);
		if(form.data("edit")){
			$.put(form.attr("action"),form.serialize());
		} else {
			$.post(form.attr("action"),form.serialize(),function(res) {
				var messageRes = res;
				if(messageRes.type == "danger") {
					$.each(messageRes.messages,function(k,v){
						var input = $("input[name="+k+"]");
						inputError(input,v);
					});
				} else {

					changeTab(parentThis.data("open"),function(res) {
						insertItems(res,"#itemsSpace","#items");
					});

				}
			});

		}


	});
}

function reload() {
	var documnets = "#documents";

	loadDocuments(documents);
	loadItems();
}