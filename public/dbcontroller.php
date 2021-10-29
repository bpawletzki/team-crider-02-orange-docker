<?php
class DBController {
	private $host = "mariadb";
	private $user = "root";
	private $password = "welcome1";
	private $database = "love_you_a_latte";
	private $conn;
	
	function __construct() {
		$this->conn = $this->connectDB();
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function insertQuery($query) {
		$result = mysqli_query($this->conn,$query);
		if(!$result){
			die(mysqli_error($this->conn));
		}
	}

	function getId($query) {
		$result = mysqli_query($this->conn,$query);
		if(!$result){
			die(mysqli_error($this->conn));
		}else if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
				return $row["id"];
			}
		}
	}

	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
}
?>
