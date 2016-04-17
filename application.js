function toggleVisible(div){
	$("#"+div).toggle();
	if ($("#hidden_comments").is(":visible")) {
    		$("#expand_comments").text("Hide");
  		} 
  		else {
    		$("#expand_comments").text("Show");
  		}
}

function toggleEdit(div){
	$("#"+div).toggle();
}

function clearContents(element) {
  element.value = '';
}


