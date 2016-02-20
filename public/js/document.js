$(document).ready(function() {
	window.App.Documents = {};
	window.App.Edit = {}
	window.App.Edit.documentId = 0;
	window.App.Edit.itemCategoryId = 0;
	window.App.Edit.selected = {};
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
			var selected = window.App.Edit.selected[$(this).data("index")*1];
			if(typeof selected == "undefined") {
				selected = findItemById(window.App.Items,$(this).data("index")*1);
				selected.id = $(this).data("index")*1;
			}

			selected.used = true;
			selected.count = row.find(".count").val();
			selected.discount = row.find(".discount").val();
			window.App.Edit.selected[$(this).data("index")*1] = selected;


		} else {
			window.App.Edit.selected[$(this).data("index")*1] = {};
		}
	});

	$("body").on("change",".count",function() {
		window.App.Edit.selected[$(this).data("index")*1].count = $(this).val();
	});

	$("body").on("change",".discount",function() {
		window.App.Edit.selected[$(this).data("index")*1].discount = $(this).val();
	});

	//Odeslání dat o přidaných předmětech do backendu
	$("body").on("click","#sendItems", function() {
		var form = $(this).closest("form");
		$.post(form.attr("action"),{data:JSON.stringify(window.App.Edit.selected),document_id:window.App.Edit.documentId},function(res) {
			message(res);
			window.App.Documents = {}
 			reload();
			$('#universalLargeModal').foundation('reveal', 'close');
		});
	});

	$("body").on("click","#updateItems", function() {
		var form = $(this).closest("form");
		$.put(form.attr("action"),{data:JSON.stringify(window.App.Edit.selected),document_id:window.App.Edit.documentId},function(res) {
			message(res);

			$('#universalLargeModal').foundation('reveal', 'close');
		});
	});

	$("body").on("click","#removeItemConnection",function() {
		removeSelectedItem($(this).data("id"));
	});

	//Editace dokumentu
	$("body").on("click","button.edit", function() {
		window.App.Edit.documentId = $(this).data("id");
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
		if($(this).data("open") == "editItems") {
			changeTab(open,function(res) {
				getSelectedItems(window.App.Edit.documentId,function(selectedItems) {
					selectedItems.forEach(function(v, k) {
						var selected = {};
						selected.id = v.id;
						selected.count = v.count;
						selected.discount = v.discount;
						window.App.Edit.selected[v.id] = selected;
					});
					insertItems(res,"#itemsSpace","#"+open,selectedItems,1);
				})
			},{edit:1});
		} else {
			changeTab(open,function(res) {
				getSelectedItems(window.App.Edit.documentId,function(selectedItems) {
					var unSelectedItems = diffItems(window.App.Items, selectedItems);
					insertItems(res,"#itemsSpace","#"+open,unSelectedItems);
				})
			});
		}

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
					window.App.Edit.documentId = res.document;
					changeTab(parentThis.data("open"),function(res) {
						insertItems(res,"#itemsSpace","#items");
					},{});

				}
			});




	});
}



