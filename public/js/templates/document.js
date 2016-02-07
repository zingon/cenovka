
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
        	'<td class="col-md-1"><input type="checkbox" name="selected[{{:id}}]" value="{{:id}}"></td>'+
            '<td class="col-md-2">{{:code}}</td>'+
            '<td class="col-md-3">{{:name}}</td>'+
            '<td class="col-md-2">{{:price}}</td>'+
            '<td class="col-md-2"><input type="number" name="count[{{:id}}]" value="1" patern="^\\$?(([1-9](\\d*|\\d{0,2}(,\\d{3})*))|0)(\\.\\d{1,2})?$"></td>'+
            '<td class="col-md-2"><input type="number" name="discount[{{:id}}" value="0" patern="^\\$?(([1-9](\\d*|\\d{0,2}(,\\d{3})*))|0)(\\.\\d{1,2})?$"></td>'+
        '</tr>'
	));
