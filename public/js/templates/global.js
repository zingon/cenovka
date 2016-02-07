function messageTemplate(data, target) {
	$(target).append($.render.messageBox(data));
}

function modalTemplate(size, content) {
	$("#modalField").html($.render.modal({
		'size': size,
		'content': content
	}));
	$('#modal').foundation('reveal', 'open');
}

function inputErrorTemplate(text,target) {
	target.append($.render.errorInput({
		'text':text
	}));
}
$.templates('messageBox', '<div data-alert class="alert-box {{:type}}">{{:text}}<a href="#" class="close">&times;</a></div>');
$.templates('errorInput', '<small class="error">{{:text}}</small>');
$.templates('modal', '<div id="modal" class="reveal-modal {{if size}}{{:size}}{{/if}}" data-reveal><section>{{:content}}</section><a class="close-reveal-modal" arial-label="Close">&#215;</a></div>');