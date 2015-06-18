<?php 
class DatabaseInitialiser {
	$servername;
	$username;
	$password;
	$connection;
	public function DatabaseInitialiser($servername, $username, $password){
		$this->servername = ($servername) ? $servername : 'localhost';
		$this->username = ($username) ? $username : 'root';
		$this->password = ($password) ? $password : 'P8k10IAyUq';
		$this->createConnection();
		$this->createAndEnterDatabase();
		$this->createTables();
	}
	
	private function createConnection () {
		$this->connection = new mysqli($this->servername, $this->username, $this->password);
		//check connection
		if ($this->connection->connect_error) {
			die("Connection failed: " . $this->connection->connect_error);
		}
	}
	
	private function createAndEnterDatabase () {
		$sqlQueries = array("CREATE DATABASE IF NOT EXISTS `Shamenet`", "USE `Shamenet`");
		foreach($sqlQueries as $querie){
			$this->querySql($querie);
		}
	}
	
	public function querySql ($sql) {
		if ($this->connection->query($sql) === TRUE)
			return TRUE;
		else
			return FALSE;
	}
	
	private function createTables(){
		$sqlQueries = array(
		"CREATE TABLE `users` (
				`ID` int(10) NOT NULL auto_increment
		)",
		"CREATE TABLE `shames` (
				`ID` int(10) NOT NULL auto_increment
		)",
		"CREATE TABLE `websites` (
				`ID` int(10) NOT NULL auto_increment
		)");
		
		foreach($sqlQueries as $querie){
			$this->querySql($querie);
		}
	}
}


?>