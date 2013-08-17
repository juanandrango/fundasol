<?php 

/**
* A Record is the base clase for all objects in fundasol.
*
*
* A Record is an objects that will never be deleted ideally (No function is given). 
* However, there is an setQuery function that will perform any query against our 
* database; such function is private for internal usage only.
*/

include('dbinterface.php');

//Types
const CLIENT_TYPE = 0;
const ACCOUNT_TYPE = 1;
const RECEIPT_TYPE = 2;
const PAYMENT_TYPE = 3;

//Status: defined on each type
//id: type + random number; recreate if already exist

class Record implements DBInterface {
	protected $type;
	protected $RecordID;
	protected $createDate;
	protected $createTime;
	protected $status;
	protected $creatorID;
	protected $query;

	public function __constructor($conn, $uid) {
		loadFromDB($conn);
	}

	public function __constructor($type, $status, $creatorID, ) {
		$this->type = $type;
		$this->status = $status;
	}

	public function writeToDB($conn) {
		//establish connection and set data
	}

	public function loadFromDB($conn, $uid) {
		//establish connection and set data
	} 

}

?>