function ItemController(App,data) {
	this.App = App;
	this.App.Items = data;
	this.App.Categories = {};
	this.App.helpers.item = new ItemHelpers(App.helpers.global);
	this.App.itemSort = "nazev:asc";
	
	this.App._pagination.onPage = 15;


	this.parts = {}
	this.chosenCategory = 0;

	this.init = function() {
		this.parts.items = "#items";
		this.parts.sidenav = ".side-nav";
		this.parts.search = "#search";
		this.parts.sort = "#sort";

		if(window.location.hash.length>0) {
			this.chosenCategory = window.location.hash.replace("#","")*1;
		}

		if(this.chosenCategory== 0) {
			this.chosenCategory = this.App.Categories[0].id;
		}

		var filteredItems = this.itemChecker(this.App.Items);

		this.eventSetup();
		this.sortSetup();
		this.App.helpers.item.insertCategories(this.App.Categories,this.parts.sidenav);
		this.App.helpers.item.insertItems(filteredItems,this.parts.items);
		
	}

	this.setCategories = function(data) {
		this.App.Categories = data;

	}

	this.setItems = function(data) {
		if(typeof data == "object" || typeof data == "array") {
			this.App.Items = data;
		} else {
			this.App.Items = {};
		}
	}

	this.paginate = function(data) {
		var paginationInst = new Pagination(data);
		paginationInst.init(this.App._pagination);
		paginationInst.setupEventOnClick(this.changePage,this);
		
		this.App.helpers.item.insert(paginationInst.generatePagination(),"#pagination");
		return paginationInst.getItems();
	}

	this.changePage = function(page,firstThis) {
		firstThis.App._pagination.page = page;
		firstThis.itemChanger();
	}

	this.itemChecker = function(data) {
		var param = [];

		if ($(search).val().length > 0) {
			param.push($(search).val());
		}

		if (this.chosenCategory > 0) {
			param.push(this.chosenCategory*1);
		} else if (window.location.hash.length > 0) {
			param.push(window.location.hash.replace("#","") * 1);
		}
 		var sortedData = this.App.helpers.global.sortMy(data,this.App.itemSort);


		return this.paginate(this.App.helpers.item.itemFilter(sortedData, param));
	} 

	//vyvolá se v případě že se stane údálost ovlivňující zobrazení položek
	this.itemChanger = function() {
		var filtered = this.itemChecker(this.App.Items);
		this.App.helpers.item.insertItems(filtered,this.parts.items);
	}

	this.reloader = function() {
		var parentThis = this;
		$.get(parentThis.App.getUrl("ItemsUrl"),function(items) {
			parentThis.setItems(items);
			var filtered = parentThis.itemChecker(parentThis.App.Items);
			parentThis.App.helpers.item.insertItems(filtered,parentThis.parts.items);
		});
	}
	this.categoryReloader = function() {
		var parentThis = this;
		$.get(parentThis.App.getUrl("categoryUrl"),function(categories) {
			parentThis.setCategories(categories);
			parentThis.App.helpers.item.insertCategories(categories,parentThis.parts.sidenav);
		});
	}	

	this.sortSetup = function() {
		var parentThis = this;
		$(".sortable").sortable({
		  	helper: function(e, tr) {
				var $originals = tr.children();
				var $helper = tr.clone();
				$helper.children().each(function(index) {
				  	// Set helper cell sizes to match the original sizes
				  	$(this).width($originals.eq(index).width());
				});
				return $helper;
		  },
		  stop: function(event, ui){
			$.post(parentThis.App.getUrl("ItemChangePosition"),({"id": ui.item.data("id"),"to": ui.item.index(),'category':parentThis.chosenCategory})).success(function() {
				parentThis.reloader();
			});

		}
		});
		$(".sortable").disableSelection();
		$(".sortable").sortable( "disable" );
	}
	this.eventSetup = function() {
		var parentThis = this;
		//Řazení
		$(parentThis.parts.sort).change(function() {
			parentThis.App.itemSort = $(this).val();

			/*if($(parentThis.parts.sort +" option[value='"+$(this).val()+"']").data("user-sort")) {
			  $(".sortable").sortable( "disable" );
			} else {*/
			  $(".sortable").sortable( "disable" );
			//}
			parentThis.itemChanger();
		});

		//Kategorie
		$(parentThis.parts.sidenav).on("click","a",function() {
			parentThis.chosenCategory = $(this).attr("href").replace("#","");
			parentThis.itemChanger();
		});

		//Vyhledávání
		$(parentThis.parts.search).keyup(function() {
			parentThis.itemChanger();
		});

		//Mazání
		$(parentThis.parts.items).on("click", ".delete", function() {
			parentThis.App.helpers.item.deleteItem($(this).data("id"),parentThis.App.getUrl("ItemDeleteUrl"));
			parentThis.reloader();
		});

		//Editace
		$(parentThis.parts.items).on("click", ".edit", function() {
			parentThis.App.helpers.item.editItem($(this).data("id"),parentThis.App.getUrl("ItemEditUrl"));
		});

		//Mazání Kategorii
		$("#universalLargeModal").on("click", "#categoryDelete", function() {
			parentThis.App.helpers.item.deleteCategory($(this).data("id"),parentThis.App.getUrl("categoryDeleteUrl"));
			$("#universalLargeModal").foundation('reveal','close');
			parentThis.categoryReloader();
		});


	}
}


//Helpery
function ItemHelpers(globalHelpers) {
	this.globalHelpers = globalHelpers;

	this.insertItems = function(items,target) {
		if(typeof items == "undefined") {
			this.insert("<tr></tr>",target);
		} else {
			this.insert($.render.itemRow(items),target);
		}
	}

	this.insertCategories = function(data,target) {
		this.insert($.render.categoryRow(data),target);
	}

	this.deleteCategory = function(catId, route) {
		var parentThis = this;
		var url = route.replace("0", catId);
		$.delete(url, {
			id: catId
		}, function(response) {

			parentThis.globalHelpers.message(response);
		});
	}

	this.deleteItem=function(itemId,route) {
		var parentThis = this;
		var url = route.replace("0", itemId);
		$.delete(url, {
			id: itemId
		}, function(response) {
			parentThis.globalHelpers.message(response);
		});
	}

	this.editItem=function(itemId,route) {
		var parentThis = this;
		var url = route.replace("0", itemId);
		$.get(url, function(response) {
			parentThis.globalHelpers.modalTemplate("large", response);;
		});
		}

		
	this.insert=function(what,where) {
		$(where).html(what);
	}
	
	this.filterItemsByCategoryId=function(data, categoryId) {
		var result = [];
		if (data.length > 0) {
			 result = $.grep(data, function(arr, i) {
			return (arr['category_id']*1 === categoryId*1);
			});
			return result;
		}
	}
	this.searchItems = function(objects, string, elementsToFilter) {
		var items = [];
		var parentThis = this;
		if (typeof objects == "object") {
			$.each(objects, function(key, value) {
				if (parentThis.globalHelpers.searchObject(value, string, elementsToFilter)) {
					items.push(value);
				}
			});
		}
		return items;
	}


	this.itemFilter = function(data,param) {

		var parentThis = this;
		if (typeof param == "undefined") param = false;
		if (param.length > 0 || param) {
			switch (typeof param) {
				case "object":
				case "array":
					var filtered = data;
					$.each(param, function(k, v) {
						filtered = parentThis.itemFilter(filtered,v);
					});
					return filtered;
					break;
				case "string":
					return parentThis.searchItems(data, param, ["name", "note", "code", "unit", "price"]);
					break;
				case "number":
					return parentThis.filterItemsByCategoryId(data, param);
					break;
			}
		} else {
			return data;
		}
	}

}

//Templates
$.templates('categoryRow', '<li><a href="#{{:id}}">{{:name}}</a></li>');
$.templates('itemRow',(
  '<tr data-id="{{:id}}">'+
	'<td class="p10">{{:code}}</td>'+
	'<td class="p20">{{:name}}</td>'+
	'<td class="p13">{{:price}}</td>'+
	'<td class="p7">{{unitParser:unit}}</td>'+
	'<td class="p36">{{:note}}</td>'+
	'<td class="p7"><button class="edit button" data-id="{{:id}}"><i class="fi-pencil"></i></button></td>'+
	'<td class="p7"><button class="delete button alert" data-id="{{:id}}"><i class="fi-trash"></i></button></td>'+
  '</tr>'));