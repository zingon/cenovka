
function documentTemplate(target,data) {
	data = paginationInit(data,window.App.pagination);
	$(target).html($.render.documentRow(data));

}

function itemConnectionTemplate(html,targetHtml, target,data) {

	$(target).html($(html).find(targetHtml).html($.render.itemConnectionRow(data)).parent().parent());
}
function itemEditConnectionTemplate(html,targetHtml, target,data) {

	$(target).html($(html).find(targetHtml).html($.render.itemEditConnectionRow(data)).parent().parent());
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