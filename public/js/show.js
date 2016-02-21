$(document).ready(function() {

	init();

});
function init() {
$.get(localStorage.DocumentShowUrl.replace("0",window.App.actualDoc),function(res) {
	renderExternalTmpl({name:"offerTemplate",data:res},function(html) {
		console.log(res);
		insertDocument(html);
	});
	//var myTmpl = $.templates("#documentTemplate");



});
}
function getAllDocuments() {

}
function getActualDocument() {

}
function resizeIframe(obj) {
	obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
}

function insertDocument(html) {
	$("iframe.document").removeAttr("style");
	$(".document").attr("srcdoc",html);
		setTimeout(function(){
		resizeIframe($("iframe.document")[0]);
	},200);
}

$.templates("documentTmpl", "#documentTemplate");

function renderExternalTmpl(item,callback) {

	var file = '../js/templates/' + item.name + '.tmpl.html';
   $.get(file,function(tmplData) {
		$.templates({ tmpl: tmplData });
		callback($.render.tmpl(item.data));
   });


	 }
