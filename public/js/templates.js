function categoryTemplate(data, target) {
	$(target).html($.render.categoryRow(data));
}

function itemTemplate(data, target) {
	$(target).html($.render.itemRow(data));
}
//Templates
$.templates('categoryRow', '<li><a href="#{{:id}}">{{:name}}</a></li>');
	$.templates('itemRow', '<tr><td>{{:code}}</td><td>{{:name}}</td><td>{{:price}}</td><td>{{:unit}}</td><td>{{:note}}</td><td></td><td><button class="delete button alert" data-id="{{:id}}"><i class="fi-trash"></i></button></td></tr>');