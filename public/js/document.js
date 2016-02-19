$(document).ready(function() {
	window.App.Documents = {};
	window.App.Items = {};
  	window.App.pagination.onPage = 10;
  	window.App.pagination.element = "#pagination";

  	init();
});

function init() {

	//načtění dat
	reload();
	$("body").on("click","a.modalLink",function(){
		$('#universalLargeModal').foundation('reveal', 'open', {
	    url: localStorage.DocumentCreateUrl,
	    success: function(data) {
	        onModalCreate();
	    },
	    error: function() {
	        console.log('failed loading modal');
	    }
	});

});



	// Manipulace s přídávání a odebíráním položek
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

	//Odeslání dat o přidaných předmětech do backendu
	$("body").on("click","#sendItems", function() {
		var form = $(this).closest("form");
		$.post(form.attr("action"),{data:JSON.stringify(window.App.Items)},function(res) {
			var url = res.url;
			window.location.href = url;
		});
	});

	//Editace dokumentu
	$("body").on("click","button.edit", function() {
		editDocument($(this).data("id"),onModalEdit);
	});

	//Smazání dokumentu
	$("body").on("click","button.delete", function() {
		deleteDocument($(this).data("id"))
	});



	$("body").on("click", ".saveDoc", function() {
		var form = $(this).closest("form");

		$.put(form.attr("action"),form.serialize(), function(res) {
			message(res);
			window.App.Documents = {};
    		reload();
			$('#universalLargeModal').foundation('reveal', 'close');

		});

	});
}

function reload() {
	var documnets = "#documents";

	loadDocuments(documents);
	loadItems();


}
function onModalEdit() {
	$("body").on("click","#tabNav li a", function() {
		var open = $(this).data("open");
		changeTab(open,function(res) {

			insertItems(res,"#itemsSpace","#"+open);
		},{edit: 1});
	});
}
function onModalCreate() {
	// akce po kliknutí na button next
	$("body").on("click", "button.next", function() {
		var id = $(this).parent().parent().parent().parent().attr("id");
		var form = $(this).parent().parent().parent();
		var parentThis = $(this);

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
					},{});

				}
			});




	});
}