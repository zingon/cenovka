
function documentTemplate(target,data) {
	data = paginationInit(data,window.App.pagination);
	$(target).html($.render.documentRow(data));

}

$.templates("documentRow", '<tr> <td>{{:code}}</td><td>{{:name}}</td><td>{{:odberatel.name}}</td><td>{{lengthArray:item_conection}}</td><td>{{date:vystaven}}</td><td>{{date:expire}}</td><td></td><td></td></tr>');

