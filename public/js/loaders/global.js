function searchObject(obj, string, columns) {
  var nope = false;
  $.each(string.split(" "), function(string_key, substring) {
    if (substring.length > 0) {
      $.each(columns, function(key, value) {
        if (obj[value].length >= substring.length && obj[value].toLowerCase().search(substring.toLowerCase()) > -1) {
          nope = true;
        }
      });
    }
  });
  if (nope === true) {
    return true;
  }
}

function message(data) {
  var target = ".message-box";
  messageTemplate(data.messages, target);
  $(document).foundation('alert', 'reflow');
}

function setMeIn() {
  $.get(localStorage.SettingUserUrl,function(data) {
    modalTemplate("large",data);
    var modal = $("#modal");
    modal.find("input[name=hidden]").val(1);
  });
}