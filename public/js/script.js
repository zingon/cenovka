function modalSetter(url) {
    $.get(url, function(data) {
        $('#modal').html(data);
        $('.closeModal').click(function() {
            $('.modal').css('display', 'none');
        });
    });
}

function tableFilter(arg, on) {
    tableReseter(arg, on);
    $(arg).click(function(event) {
        event.preventDefault();
        var filter = $(this).data('filter');
        $(on).each(function(index, val) {
            if ($(val).data('filter') != filter) {
                $(val).addClass('hidden');
            }
        });
    });
}

function tableReseter(arg, on) {
    $(arg).click(function(event) {
        event.preventDefault();
        $(on).removeClass('hidden');
    });
}

function addMessage(type, message) {
    $("div.alert").removeClass('hidden');
    $("div.alert").addClass('alert-' + type);
    $("div.alert ul").append('<li>' + message + '</li>');
}

function messagesParser(data, type, callback) {
    if ($.isPlainObject(data)) {
        $.each(data, function(i, v) {
            $('label').each(function(ii, iv) {
                if (i === $(iv).attr('for')) {
                    callback(type, v[0].replace(i, 'Pole ' + $(iv).text()));
                }
            });
        });
    } else {
        callback(type, data);
    }
}

function getToken() {
    $.get('{{route("token")}}', function(token) {
        $('input[name="_token"]').val(token);
    });
}
$(function() {
    $('.destroy').click(function(e) {
        var fakt = confirm("Opravdu chcete smazat tuto položku");
        if (!fakt) {
            e.preventDefault();
        }
    });
    $('a.modalLink').click(function(event) {
        event.preventDefault();
        var url = $(this).attr('href');
        modalSetter(url);
        $('a.modalLink').click(function(event) {
            event.preventDefault();
            var url = $(this).attr('href');
            modalSetter(url);
        });
    });
});