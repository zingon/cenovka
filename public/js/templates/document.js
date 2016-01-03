
function documentTemplate(data, target) {
	data = paginationInit(data,window.App.pagination);
	$(target).html($.render.documentRow(data));
}

	$.templates("documentRow", '<tr> <td>{{:code}}</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>')