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
	$("body").on("change", ".selected", function() {
		if($(this).is(':checked')){
			var row = $(this).parent().parent();
			window.App.Items[$(this).data("index")*1].used = true;
			window.App.Items[$(this).data("index")*1].count = row.find(".count").val();
			window.App.Items[$(this).data("index")*1].discount = row.find(".discount").val();
			$("body").on("change",".count",function() {
				window.App.Items[$(this).data("index")*1].count = $(this).val();
			});
			$("body").on("change",".discount",function() {
				window.App.Items[$(this).data("index")*1].discount = $(this).val();
			});
		} else {
			window.App.Items[$(this).data("index")*1].used = false;
		}
	});
	$("body").on("click","#sendItems", function() {
		var form = $(this).closest("form");
		$.post(form.attr("action"),{data:JSON.stringify(window.App.Items)},function(res) {
			var url = res.url;
			console.log(url);
			window.location.href = url;
		});
	});


}

function reload() {
	var documnets = "#documents";

	loadDocuments(documents);
	loadItems();
}