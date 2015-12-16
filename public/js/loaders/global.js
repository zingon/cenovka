function searchObject(obj,string,columns) {
  var nope = false;
  $.each(columns,function(key,value) {

    if(obj[value].length>=string.length && obj[value].toLowerCase().search(string.toLowerCase())>-1){
      nope = true;
    }
  });
  if(nope===true) {
    return true;
  }
}

function message(data){
  var target = ".message-box";
  messageTemplate(data.messages,target);
  $(document).foundation('alert', 'reflow');
}
