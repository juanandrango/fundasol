<?php

class Model {

	private static $connDB;

	public static function connect() {
		Model::$connDB = mysqli_connect("localhost", "root", "qpalFJ10mysql", "fundasol");
		if (mysqli_connect_errno()) {
 			 printf("Connect failed: %s\n", mysqli_connect_error());
 			 echo "DB Connection Error";
		}
	}

	public static function disconnect() {
		mysqli_close(Model::$connDB);
		//echo "disconnecting";
	}


	//ACTIONS *****************************************************************************

	public static function getClient($clientID) {
		$sql_match_client_id = "SELECT * FROM Clients WHERE Clients.id = '" . $clientID ."'";
		//SET SESSION VAR (later to be defined)
		$_SESSION['currentClientId'] = $clientID;
		return mysqli_fetch_assoc(mysqli_query(Model::$connDB, $sql_match_client_id));
	}

	public static function getAllClients() {
		$sql_all_clients = "SELECT * FROM Clients";
      	return mysqli_query(Model::$connDB, $sql_all_clients);
		//return $sql_all_clients;
	}

	//Account Actions
	public static function getAllAccounts() { 
		$sql_all_accounts = "SELECT * FROM Accounts";
		return mysqli_query(Model::$connDB, $sql_all_accounts);
	}

	public static function getAccount($accountID) {
		$sql_account = "SELECT * FROM Accounts WHERE Accounts.id='" . $accountID . "'";
		return mysqli_fetch_assoc(mysqli_query(Model::$connDB, $sql_account));
	}

	public static function getAccountsFromClient($clientID) {
		$sql_all_accounts_from_client = "SELECT * FROM Accounts WHERE Accounts.client_id=" . $clientID;
		return mysqli_query(Model::$connDB, $sql_all_accounts_from_client);
	}

	// public static function getAccount($clientID, $accountID) {

	// }

	public static function insertNewClientDB($aClient) {
		$sql_insert_client = "INSERT INTO Clients (first_name, last_name, state_id) values ('" . $aClient['first_name'] . "', '" . $aClient['last_name'] . "'," . $aClient['state_id'] . ")";
		$result = mysqli_query(Model::$connDB, $sql_insert_client);
		if ( false===$result ) {
			printf("error: %s\n", mysqli_error(Model::$connDB));
		} else {
			 echo 'done.';
		}
	}

	public static function insertNewAccount($aAccount) {
		$sql_insert_account = "INSERT INTO Accounts (";
		foreach(Account::$createAccountRequiredAttrs as $attr) {
			$sql_insert_account .= $attr . ", ";
		}
		$sql_insert_account = substr($sql_insert_account, 0, -2); //Strip last comma
		$sql_insert_account .= ") values (";
		foreach(Account::$createAccountRequiredAttrs as $attr) {
			if (Account::$tableAttrs[$attr]["type"] == "STRING") {
				//add single quotes 
				$sql_insert_account .= "'" . $aAccount[$attr] . "', ";
			} else {
				$sql_insert_account .= $aAccount[$attr] . ", ";
			}
		}
		$sql_insert_account = substr($sql_insert_account, 0, -2); //Strip last comma
		$sql_insert_account .= ")";
		return mysqli_query(Model::$connDB, $sql_insert_account);
	}

	public static function updateClientInfo($newInfoArray) {
		$sql_update_client_info = "UPDATE Clients SET ";
		foreach($newInfoArray as $key => $value) {
			if ($key != "clientId") {
				$sql_update_client_info .= $key . " = " . $value . ", ";	
			} 		
		}
		$sql_update_client_info = substr($sql_update_client_info, 0, -2);
		$sql_update_client_info .= " WHERE id = " . $newInfoArray['clientId'];
		return mysqli_query(Model::$connDB, $sql_update_client_info);
	}

}

?>