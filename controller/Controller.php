<?php

class Controller {

	public static $model;
	public static $view;
	public static $actionResult;
	
	//Actions
	public static $actionList = array(
		'create_client_A' 		=>	array('modelFunc' => 'insertNewClientDB'),
		'get_clients_table_A'	=> 	array('modelFunc' => 'getAllClients'), 
		'get_client_A'			=> 	array('modelFunc' => 'getClient'), 
		'get_accounts_client_A' => 	array('modelFunc' => 'getAccountsFromClient'), 
		'update_client_info_A' 	=> 	array('modelFunc' => 'updateClientInfo'),
		'create_account_A'		=>  array('modelFunc' => 'insertNewAccount'), 
		'get_accounts_table_A' 	=> 	array('modelFunc' => 'getAllAccounts'),
		'get_account_A'			=>	array('modelFunc' => 'getAccount')
		);

	//Assume there is a payload. Assume more than one actions
	public static function processAction() {
		Model::connect();
		foreach(Controller::$actionList as $key => $value) {
			if (isset($_POST[$key])) {
				Controller::$actionResult[$key] = call_user_func("Model::" . $value['modelFunc'], $_POST[$key]);
			}
		}
		Model::disconnect();
	}

	public static function processView() {
		if(isset($_POST['view'])) {
			Controller::$view = View::$viewsLoc . View::$viewsList[$_POST['view']];
		}
	}
}

?>