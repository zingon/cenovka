function messageTemplate(data, target) {
	$(target).append($.render.messageBox(data));
}

function modalTemplate(size, content) {
	$("#modalField").append($.render.modal({
		'size': size,
		'content': content
	}));
	$('#modal').foundation('reveal', 'open');
}
$.templates('messageBox', '<div data-alert class="alert-box {{:type}}">{{:text}}<a href="#" class="close">&times;</a></div>');
$.templates('modal', '<div id="modal" class="reveal-modal {{if size}}{{:size}}{{/if}}" data-reveal><section>{{:content}}</section><a class="close-reveal-modal" arial-label="Close">&#215;</a></div>');