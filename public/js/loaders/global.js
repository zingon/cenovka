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
  $.get(localStorage.SettingUserUrl, function(data) {
    modalTemplate("large", data);
    var modal = $("#modal");
    modal.find("input[name=hidden]").val(1);
  });
}

function sortMy(data, by) {
  var sortes = by.split(":");
  data.sort(function(a, b) {
    if (sortes[1] == "asc") {
      var f,s;
      if(sortes[2] == "num"){
        f = 1*a[sortes[0]];
        s = 1*b[sortes[0]];
      } else {
        f = a[sortes[0]];
        s = b[sortes[0]];
      }
      if (f > s) {
        return 1;
      } else if (f < s) {
        return -1;
      } else {
        return 0;
      }

    } else {
      var f,s;
      if(sortes[2] == "num"){
        f = 1*a[sortes[0]];
        s = 1*b[sortes[0]];
      } else {
        f = a[sortes[0]];
        s = b[sortes[0]];
      }
      if (f > s) {
        return -1;
      } else if (f < s) {
        return 1;
      } else {
        return 0;
      }
    }
  });
  return data;
}