function contactTemplate(data, target) {

	data = paginationInit(data,window.App.pagination);
	$(target).html($.render.contactRow(data));
}

$.templates("contactRow",(
	'<tr>'+
		'<td>{{:name}}</td>'+
		'<td>{{:firstname}} {{:lastname}}</td>'+
		'<td>{{:adress}}{{if city || zip_code}},{{/if}} {{:city}} {{:zip_code}}</td>'+
		'<td>{{:note}}</td>'+
		'<td><button class="edit button" data-id="{{:id}}"><i class="fi-pencil"></i></button></td>'+
		'<td><button class="delete button alert" data-id="{{:id}}"><i class="fi-trash"></i></button></td>'+
	'</tr>'
	));