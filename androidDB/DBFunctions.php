<?php
include('DBConnect.php');

class DBFunctions {
	private $dbConnect;

    // constructor
    function __construct() {
        // connecting to database
        $this->dbConnect = new DBConnect();
        $this->dbConnect->connect();
    }
 
    // destructor
    function __destruct() {
         
    }
	
	/********************************************************************************
										LOGIN FUNCTIONS
	*********************************************************************************/
	function login($username, $password) {
		$sql_query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
		$result = $this->dbConnect->getConn()->query($sql_query);
		$num_rows = $result->num_rows;
		if ($num_rows > 0) {
			return true;
		}
		else {
			return false;
		}
	}
	
	
	/********************************************************************************
										REGISTER FUNCTIONS
	*********************************************************************************/
	function register($username, $password) {
		$sql_query = "INSERT INTO users (username, password) VALUES ('$username', '$password')" ;
		$result =$this->dbConnect->getConn()->query($sql_query);
		if ($result) {
			return true;
		}
		else {
			return false;
		}
	}
	
	//Check if the given user exist
	function isUserExist($username) {
		$sql_query = "SELECT username FROM users WHERE username = '$username'";
		$result = $this->dbConnect->getConn()->query($sql_query);
		$num_rows = $result->num_rows;
		if ($num_rows > 0) {
			return true;
		}
		else {
			return false;
		}
	}
}

?>