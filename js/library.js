function votingCheckStatus(id, operator) {
	$.post("ajax-handler.php", {operation: 1, id_user: id}, function(r) {
       // format and output result
       if (r == 1 && operator == 1) { //until enabled
	       top.location.reload();
	   }
	   if (r != 1 && operator != 1) { //until disabled
	       top.location.reload();
	   }
    });
}

function checkStatusNotif(id) {
	$.post("ajax-handler.php", {operation: 1, id_user: id}, function(r) {
	   if (r == 1) {
	       $("#notif-"+id).css("background-color","green");
	   } else {
	       $("#notif-"+id).css("background-color","red");
	   }
    });
}

function checkStatus(id) {
	$.post("ajax-handler.php", {operation: 1, id_user: id}, function(r) {
       // format and output result
       if (r == 1) {
	       $("#display-evote-status-"+id).html('E-vote is enabled');
	   } else {
	       $("#display-evote-status-"+id).html('E-vote is disabled');
	   }
    });
}
	
function enableEvote(id) {
	$.post("ajax-handler.php", {operation: 2, value: 1, id_user: id});
	checkStatus(id);
}

function disableEvote(id){
	$.post("ajax-handler.php", {operation: 2, value: 0, id_user: id});
	checkStatus(id);
}
