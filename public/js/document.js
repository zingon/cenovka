$(document).ready(function() {
	window.App.documnet = {};
  	window.App.pagination.onPage = 20;
  	window.App.pagination.element = "#pagination";

  	init();
});

function init() {

	reload();

	$(document).on("click", "button.next", function() {
		var id = $(this).parent().parent().parent().parent().attr("id");
		var form = $(this).parent().parent().parent().parent();
		if(form.data("edit")){
			$.put(form.attr("action"),form.serialize());
		} else {
			$.post(form.attr("action"),form.serialize());

		}

		changeTab($(this).data("open"));
	});
}

function reload() {
	var documnets = "#documents";

	loadDocuments(documents);
}