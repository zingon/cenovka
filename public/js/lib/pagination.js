function paginationInit(items, settings) {
	var pages = [];
	var count = items.length;
	var pageCount = Math.ceil(count / settings.onPage);
	var first = true;
	var last = true;
	if (pageCount > 1) {
		for (var i = 1; i <= pageCount; i++) {
			var active = (settings.page == i) ? true : false;
			pages.push({
				page: i,
				active: active
			});
			if (active && i == 1) {
				first = false;
			} else if (active && i == pageCount) {
				last = false;
			}
		};
		$(settings.element).html($.render.pagination({
			first: first,
			pagination: $.render.paginationItem(pages),
			last: last,
		}));
		$(settings.element + " a").click(function(event) {
			event.preventDefault();
			var action = $(this).data("page");
			if (action == "back") {
				settings.page--;
			} else if (action == "next") {
				settings.page++;
			} else {
				settings.page = action * 1;
			}
			reload();
		});
		return items.slice(settings.onPage * (settings.page - 1), settings.onPage * settings.page);
	} else {
		$(settings.element + " .pagination").html("");
		return items;
	}
}

function Pagination(items) {
	this.items 		= items;
	this.count 		= items.length;
	this.pageCount  = 0;
	this.page 		= 0;
	this.first 		= true;
	this.last 		= true;
	this.pages		= [];
	this.onPage 	= 0;

	this.init = function(settings) {
		this.pageCount = Math.ceil(this.count / settings.onPage);
		this.onPage =  settings.onPage;
		this.page = settings.page;

		if (this.pageCount > 1) {
			for (var i = 1; i <= this.pageCount; i++) {
				var active = (this.page == i) ? true : false;
				this.pages.push({
					page: i,
					active: active
				});
				if (active && i == 1) {
					first = false;
				} else if (active && i == this.pageCount) {
					last = false;
				}
			}
		}
	}

	this.generatePagination = function() {
		var parentThis = this;
		if (this.pageCount > 1) {
			return $.render.pagination({
				first: parentThis.first,
				pagination: $.render.paginationItem(parentThis.pages),
				last: parentThis.last,
			});
		} else {
			return "";
		}
	}
	this.getItems = function() {
		var parentThis = this;
		if (this.pageCount > 1) {
			return this.items.slice(parentThis.onPage * (parentThis.page - 1), parentThis.onPage * parentThis.page);
		} else {
			return this.items;
		}
	}
	this.setupEventOnClick = function(callback,InstanceThis) {
		var parentThis = this;
		$("body").on("click","ul.pagination a",(function(event) {
			event.preventDefault();
			var action = $(this).data("page");
			if (action == "back") {
				parentThis.page--;
			} else if (action == "next") {
				parentThis.page++;
			} else {
				parentThis.page = action * 1;
			}
			callback(parentThis.page,InstanceThis);
		}));
	}

}

$.templates('paginationItem', '<li class="{{if active}}current{{/if}}"><a href="#" data-page="{{:page}}">{{:page}}</a></li>');
$.templates('pagination', '<div class="pagination-centered"><ul class="pagination"><li class="arrow {{if !first}}unavailable{{/if}}"><a href="#" data-page="back">&laquo;</a></li>{{:pagination}}<li class="arrow {{if !last}}unavailable{{/if}}"><a href="#" data-page="next">&raquo;</a></li></ul></div>')