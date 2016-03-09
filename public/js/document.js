function DocumentController(App,data) {
	this.App = App;
	this.App.Documents = data;
	this.App.Items = {};
	this.App.Categories = {};

	this.App.helpers.document = new DocumentHelpers(App.helpers.global);
	this.App.helpers.item = new ItemHelpers(App.helpers.global);
	this.App._pagination.onPage = 10;
	this.parts = {}

	this.init = function() {
		this.parts.documents = "#documents";
		console.log(this.App);
		this.eventSetup();
		
		var filtered = this.documentChecker(this.App.Documents);
		this.App.helpers.document.insertDocuments(filtered,this.parts.documents);
	}

	this.setItems=function(data) {
			this.App.Items = data;
	}
	this.setCategories= function(data){
			this.App.Categories = data;
	}

	this.paginate = function(data) {
		var paginationInst = new Pagination(data);
		paginationInst.init(this.App._pagination);
		paginationInst.setupEventOnClick(this.changePage,this);
		
		this.App.helpers.document.insert(paginationInst.generatePagination(),"#pagination");
		return paginationInst.getItems();
	}

	this.changePage = function(page,firstThis) {
		firstThis.App._pagination.page = page;
		firstThis.documentChanger();
	}

	this.documentChecker=function(data){
		return this.paginate(data);
	}

	this.documentChanger = function() {
		var filtered = this.documentChecker(this.App.Documents);
		this.App.helpers.document.insertDocuments(filtered,this.parts.documents);
	}

	this.modelCreateDocument = function(param) {
		switch(param) {
			case "next":
					// var id = $(this).parent().parent().parent().parent().attr("id");
					// var form = $(this).parent().parent().parent();
					// var parentThis = $(this);

					// 	$.post(form.attr("action"),form.serialize(),function(res) {
					// 		var messageRes = res;
					// 		if(messageRes.type == "danger") {
					// 			$.each(messageRes.messages,function(k,v){
					// 				var input = $("input[name="+k+"]");
					// 				inputError(input,v);
					// 			});
					// 		} else {
					// 			window.App.Edit.documentId = res.document;
					// 			changeTab(parentThis.data("open"),function(res) {
					// 				insertItems(res,"#itemsSpace","#items");
					// 			},{});

					// 		}
					// 	});
				break;
			default:

				break;
		}
	}

	this.eventSetup = function() {
		var parentThis = this;

		//Create modal
		$("body").on("click","a.modalLink",function(){

			$('#universalLargeModal').foundation('reveal', 'open', {
		    url: parentThis.App.getUrl("DocumentCreateUrl"),
		    success: function(data) {
		    	var documentModalCreate = new DocumentModalCreate();
		    	$("body").on("click", "button.next", function() {
		    		documentModalCreate.setPositionThis(this);
		    		documentModalCreate.postForm(this.changeTab($(this).data("open"),function(responce) {

		    		}));
		    	});
		    },
		    error: function() {
		        console.log('failed loading modal');
		    }
		});
		});
	}
	this.changeTab= function(open,getfunction,data) {
		if(typeof data == "undefined") data={edit:0};
		var parts = ["items","offer","editItems"];
		parts.forEach(function(v, k) {
			$("#"+ v).hide();
			$("li."+v).removeClass("active");
		});
		$("#"+open).show();
		$("li."+open).addClass("active");
		var url =$("#"+open).data("url");
		if(url.length>0) {
			$.get(url,{edit:data.edit}, function(response){
				getfunction(response);
			});
		}
	}

}

function DocumentModalCreate() {
	this.positionThis;
	this.form;
	this.actualId;
	this.edit = 0;

	this.postForm = function(callback) {
		$.post(form.attr("action"),form.serialize(),function(res) {
			var messageRes = res;
			if(messageRes.type == "danger") {
				$.each(messageRes.messages,function(k,v){
					var input = $("input[name="+k+"]");
					inputError(input,v);
				});
			} else {
				window.App.Edit.documentId = res.document;
					return callback

			}
	 	});
	}	
	
	this.inputError=function(input,v) {
		input.addClass("error");
		input.parent().find("small.error").remove();
		this.inputErrorTemplate(text,input.parent());
	} 

	this.setPositionThis = function(positionThis) {
		this.positionThis = positionThis;
		this.form = $(positionThis).closest("form");
		this.actualId = this.form.parent().attr("id");
		this.edit = this.form.data("edit");
		console.log(this);
	}

	this.inputErrorTemplate = function(text,target) {
		target.append($.render.errorInput({
			'text':text
		}));
	}
}

function DocumentHelpers(globalHelper) {
	this.globalHelper = globalHelper;

	this.insertDocuments=function(data,target) {

		this.insert($.render.documentRow(data),target);
	}

	this.insert=function(what,where) {
		$(where).html(what);
	}
}
$.templates("documentRow", (
	'<tr>'+
		'<td>{{:code}}</td>'+
		'<td><a href="{{showDocument:id}}">{{:name}}</a></td>'+
		'<td>{{:odberatel.name}}</td>'+
		'<td>{{:items_conection.length}}</td>'+
		'<td>{{date:vystaven}}</td>'+
		'<td>{{date:expire}}</td>'+
		'<td class="p7"><button class="edit button" data-id="{{:id}}"><i class="fi-pencil"></i></button></td>'+
		'<td class="p7"><button class="delete button alert" data-id="{{:id}}"><i class="fi-trash"></i></button></td>'+
	'</tr>'
	));

$.templates("itemConnectionRow", (
		'<tr {{if note }}data-tooltip aria-haspopup="true" class="has-tip" title="{{:note}}"{{/if}}>'+
        	'<td class="p7"><input type="checkbox" class="selected" name="selected[{{:id}}]" value="{{:id}}" data-index="{{:id}}"></td>'+
            '<td class="p7">{{:code}}</td>'+
            '<td>{{:name}}</td>'+
            '<td class="p20">{{:price}}</td>'+
            '<td class="p15"><input type="number" class="count" name="count[{{:id}}]" value="1" step="0.01" data-index="{{:id}}"></td>'+
            '<td class="p15"><input type="number" class="discount" name="discount[{{:id}}" value="0" max="100" min="0" step="0.01" data-index="{{:id}}"></td>'+
        '</tr>'
	));

$.templates("itemEditConnectionRow", (
		'<tr {{if note }}data-tooltip aria-haspopup="true" class="has-tip" title="{{:note}}"{{/if}}>'+
            '<td class="p7">{{:item.code}}</td>'+
            '<td>{{:item.name}}</td>'+
            '<td class="p20">{{:item.price}}</td>'+
            '<td class="p15"><input type="number" class="count" name="count[{{:id}}]" value="{{:count}}" step="0.01" data-index="{{:id}}"></td>'+
            '<td class="p15"><input type="number" class="discount" name="discount[{{:id}}" value="{{:discount}}" step="0.01" max="100" min="0" data-index="{{:id}}"></td>'+
            '<td class="p7"><button type="button" data-id="{{:id}}" id="removeItemConnection"><span class="fi-trash"></span></button></td>'+
        '</tr>'
	));

$.views.converters("showDocument", function(val) {
	return localStorage.DocumentShowUrl.replace("0", val);
});

// $(document).ready(function() {
// 	window.App.Documents = {};
// 	window.App.Edit = {}
// 	window.App.Edit.documentId = 0;
// 	window.App.Edit.itemCategoryId = 0;
// 	window.App.Edit.selected = {};
// 	window.App.Items = {};
//   	window.App.pagination.onPage = 10;
//   	window.App.pagination.element = "#pagination";

//   	init();
// });

// function init() {

// 	//načtění dat
// 	reload();
// 	// $("body").on("click","a.modalLink",function(){
// 	// 	$('#universalLargeModal').foundation('reveal', 'open', {
// 	//     url: localStorage.DocumentCreateUrl,
// 	//     success: function(data) {
// 	//         onModalCreate();
// 	//     },
// 	//     error: function() {
// 	//         console.log('failed loading modal');
// 	//     }
// 	// });

// // });



// 	// Manipulace s přídávání a odebíráním položek
// 	$("body").on("change", ".selected", function() {
// 		if($(this).is(':checked')){
// 			var row = $(this).parent().parent();
// 			var selected = window.App.Edit.selected[$(this).data("index")*1];
// 			if(typeof selected == "undefined") {
// 				selected = findItemById(window.App.Items,$(this).data("index")*1);
// 				selected.id = $(this).data("index")*1;
// 			}

// 			selected.used = true;
// 			selected.count = row.find(".count").val();
// 			selected.discount = row.find(".discount").val();
// 			window.App.Edit.selected[$(this).data("index")*1] = selected;


// 		} else {
// 			window.App.Edit.selected[$(this).data("index")*1] = {};
// 		}
// 	});

// 	$("body").on("change",".count",function() {
// 		window.App.Edit.selected[$(this).data("index")*1].count = $(this).val();
// 	});

// 	$("body").on("change",".discount",function() {
// 		window.App.Edit.selected[$(this).data("index")*1].discount = $(this).val();
// 	});

// 	//Odeslání dat o přidaných předmětech do backendu
// 	$("body").on("click","#sendItems", function() {
// 		var form = $(this).closest("form");
// 		$.post(form.attr("action"),{data:JSON.stringify(window.App.Edit.selected),document_id:window.App.Edit.documentId},function(res) {
// 			message(res);
// 			window.App.Documents = {}
//  			reload();
// 			$('#universalLargeModal').foundation('reveal', 'close');
// 		});
// 	});

// 	$("body").on("click","#updateItems", function() {
// 		var form = $(this).closest("form");
// 		$.put(form.attr("action"),{data:JSON.stringify(window.App.Edit.selected),document_id:window.App.Edit.documentId},function(res) {
// 			message(res);

// 			$('#universalLargeModal').foundation('reveal', 'close');
// 		});
// 	});

// 	$("body").on("click","#removeItemConnection",function() {
// 		removeSelectedItem($(this).data("id"));
// 	});

// 	//Editace dokumentu
// 	$("body").on("click","button.edit", function() {
// 		window.App.Edit.documentId = $(this).data("id");
// 		editDocument($(this).data("id"),onModalEdit);
// 	});

// 	//Smazání dokumentu
// 	$("body").on("click","button.delete", function() {
// 		deleteDocument($(this).data("id"))
// 	});



// 	$("body").on("click", ".saveDoc", function() {
// 		var form = $(this).closest("form");

// 		$.put(form.attr("action"),form.serialize(), function(res) {
// 			message(res);
// 			window.App.Documents = {};
//     		reload();
// 			$('#universalLargeModal').foundation('reveal', 'close');

// 		});

// 	});
// }

// function reload() {
// 	var documnets = "#documents";

// 	loadDocuments(documents);
// 	loadItems();


// }
// function onModalEdit() {
// 	$("body").on("click","#tabNav li a", function() {
// 		var open = $(this).data("open");
// 		if($(this).data("open") == "editItems") {
// 			changeTab(open,function(res) {
// 				getSelectedItems(window.App.Edit.documentId,function(selectedItems) {
// 					selectedItems.forEach(function(v, k) {
// 						var selected = {};
// 						selected.id = v.id;
// 						selected.count = v.count;
// 						selected.discount = v.discount;
// 						window.App.Edit.selected[v.id] = selected;
// 					});
// 					insertItems(res,"#itemsSpace","#"+open,selectedItems,1);
// 				})
// 			},{edit:1});
// 		} else {
// 			changeTab(open,function(res) {
// 				getSelectedItems(window.App.Edit.documentId,function(selectedItems) {
// 					var unSelectedItems = diffItems(window.App.Items, selectedItems);
// 					insertItems(res,"#itemsSpace","#"+open,unSelectedItems);
// 				})
// 			});
// 		}

// 	});
// }
// function onModalCreate() {
// 	// akce po kliknutí na button next
// 	$("body").on("click", "button.next", function() {
// 		var id = $(this).parent().parent().parent().parent().attr("id");
// 		var form = $(this).parent().parent().parent();
// 		var parentThis = $(this);

// 			$.post(form.attr("action"),form.serialize(),function(res) {
// 				var messageRes = res;
// 				if(messageRes.type == "danger") {
// 					$.each(messageRes.messages,function(k,v){
// 						var input = $("input[name="+k+"]");
// 						inputError(input,v);
// 					});
// 				} else {
// 					window.App.Edit.documentId = res.document;
// 					changeTab(parentThis.data("open"),function(res) {
// 						insertItems(res,"#itemsSpace","#items");
// 					},{});

// 				}
// 			});




// 	});
// }



