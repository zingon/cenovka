$(document).ready(function() {
	init();
});
function init() {
	getActualDocument();
	getHistory();
	setTimeout(function(){
		if(window.location.hash.length>0) {
			getDocumentFromHistory(window.location.hash.replace("#","")*1);
		}
	}, 200);
	$("#actual").click(function() {
		getActualDocument();
		window.location.hash = "";
	});
	$("#history").on("click","a",function(ev) {
		setTimeout(function(){
			getDocumentFromHistory(window.location.hash.replace("#","")*1);
		}, 200);
	});
}
function getHistory() {
	$.get(localStorage.ExportUrl,{document_id: window.App.actualDoc},function(res) {
		$("#history").html($.render.menuRow(res));
	});
}
function addToHistory() {
	window.location.href = localStorage.ExportOfferUrl.replace("0",window.App.actualDoc)+"/0";
}

function getActualDocument() {
	$("#saveButton").show();
	$("#exportButton").attr("href",$("#exportButton").attr("href").split("?")[0]);
$.get(localStorage.DocumentShowUrl.replace("0",window.App.actualDoc),function(res) {
	renderExternalTmpl({name:"offerTemplate",data:res},function(html) {
		insertDocument(html);
	});

});
}

function getDocumentFromHistory(id) {
	$("#saveButton").hide();
	$("#exportButton").attr("href",$("#exportButton").attr("href").split("?")[0]+"?version="+id);
	$.get(localStorage.ExportShowUrl.replace("0",id),function(res){
		insertDocument(res)
	});
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
$.templates('menuRow', '<li><a href="#{{:id}}">{{dateTime:created_at}}</a></li>');
$.views.converters("dateTime", function(val) {
  var date = new Date(val);
  return date.getDate()+"."+(date.getMonth()+1)+"."+date.getFullYear()+" "+date.getHours()+":"+date.getMinutes()+":"+date.getSeconds() ;
});