
function documentTemplate(target,data) {
	data = paginationInit(data,window.App.pagination);
	$(target).html($.render.documentRow(data));

}

function itemConnectionTemplate(html,targetHtml, target,data) {

	$(target).html($(html).find(targetHtml).html($.render.itemConnectionRow(data)).parent().parent());
}

$.templates("documentRow", (
	'<tr>'+
		'<td>{{:code}}</td>'+
		'<td>{{:name}}</td>'+
		'<td>{{:odberatel.name}}</td>'+
		'<td>{{lengthArray:item_conection}}</td>'+
		'<td>{{date:vystaven}}</td>'+
		'<td>{{date:expire}}</td>'+
		'<td class="p7"><button class="edit button" data-id="{{:id}}"><i class="fi-pencil"></i></button></td>'+
		'<td class="p7"><button class="delete button alert" data-id="{{:id}}"><i class="fi-trash"></i></button></td>'+
	'</tr>'
	));

$.templates("itemConnectionRow", (
		'<tr {{if note }}data-tooltip aria-haspopup="true" class="has-tip" title="{{:note}}"{{/if}}>'+
        	'<td class="p7"><input type="checkbox" class="selected" name="selected[{{:id}}]" value="{{:id}}" data-index="{{:#getIndex()}}"></td>'+
            '<td class="p7">{{:code}}</td>'+
            '<td>{{:name}}</td>'+
            '<td class="p20">{{:price}}</td>'+
            '<td class="p15"><input type="number" class="count" name="count[{{:id}}]" value="1" step="0.01" data-index="{{:#getIndex()}}"></td>'+
            '<td class="p15"><input type="number" class="discount" name="discount[{{:id}}" value="0" step="0.01" data-index="{{:#getIndex()}}"></td>'+
        '</tr>'
	));
