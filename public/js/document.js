$(document).ready(function() {
	window.App.documnet = {};
  	window.App.pagination.onPage = 20;
  	window.App.pagination.element = "#pagination";

  	init();
});

function init() {

	reload();

}

function reload() {
	var documnets = "#documents";

	loadDocuments(documents);
}