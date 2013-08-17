function sendPostRequest(senderID, htmlReceiverID,  rData) {
	$.ajax({
		url: "index.php", 
		type: "post",
		data: rData,     
		success: function (html) { 
			$('#' + htmlReceiverID).html(html);
		}   
	});
	return false; 
}

$(document).ready( function() {
	
	/*index.phtml*/
	$('#showClientsBtn').click(function () {   
	  	var dataArray = {};
	  	dataArray.view = 'clients_table';
	  	dataArray.actions = ['get_clients_table_A'];
	  	dataArray['get_clients_table_A'] = '';
	  	console.log("DEBUG:" + JSON.stringify(dataArray));
	  	sendPostRequest('showClientsBtn', 'viewContent',  dataArray);
	});
	$('#showAccountsBtn').click(function() {
		var dataArray = {};
		dataArray.view = 'accounts_table';
		dataArray.actions = ['get_accounts_table_A'];
		dataArray['get_accounts_table_A'] = '';
		console.log("DEBUG:" + JSON.stringify(dataArray));
	  	sendPostRequest('showAccountsBtn', 'viewContent',  dataArray);
	});
	$('#createClientBtn').click(function() {
		var dataArray = {};
		dataArray.view = 'create_client';
		sendPostRequest('createClientBtn', 'viewContent', dataArray);
	}); 
});
