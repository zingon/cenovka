function categoryTemplate(data, target) {
	$(target).html($.render.categoryRow(data));
}

function itemTemplate(data, target) {
	$.each(data, function(k, v) {
		var unit = v.unit.split("^");
		if (unit.length > 1) {
			data[k]["unit"] = unit[0] + "<sup>" + unit[1] + "</sup>";
		}
	});
	data = paginationInit(data,window.App.pagination);
	data = sortMy(data, window.App.ItemSort);
	$(target).html($.render.itemRow(data));
}
//Templates
$.templates('categoryRow', '<li><a href="#{{:id}}">{{:name}}</a></li>');
$.templates('itemRow', '<tr data-id="{{:id}}"><td class="p10">{{:code}}</td><td class="p20">{{:name}}</td><td class="p13">{{:price}}</td><td class="p7">{{:unit}}</td><td class="p36">{{:note}}</td><td class="p7"><button class="edit button" data-id="{{:id}}"><i class="fi-pencil"></i></button></td><td class="p7"><button class="delete button alert" data-id="{{:id}}"><i class="fi-trash"></i></button></td></tr>');