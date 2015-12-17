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
			if(active && i == 1) {
				first = false;
			}  else if ( active && i == pageCount) {
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
			if(action ==  "back") {
				settings.page--;
			} else if(action == "next") {
				settings.page++;
			} else {
				settings.page = action*1;
			}
			reload();
		});

		return items.slice(settings.onPage*(settings.page-1),settings.onPage*settings.page);

	} else {
		$(settings.element + " .pagination").html("");
		return items;
	}
}
$.templates('paginationItem', '<li class="{{if active}}current{{/if}}"><a href="#" data-page="{{:page}}">{{:page}}</a></li>');
$.templates('pagination', '<ul class="pagination"><li class="arrow {{if !first}}unavailable{{/if}}"><a href="#" data-page="back">&laquo;</a></li>{{:pagination}}<li class="arrow {{if !last}}unavailable{{/if}}"><a href="#" data-page="next">&raquo;</a></li></ul>')