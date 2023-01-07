<?php

class Database{
	
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "starbuy_db"; 
	private $conn;
    
    public function getConnection(){		
			$conn = new mysqli($this->host, $this->user, $this->password, $this->database);
			if($conn->connect_error){
				die("Error failed to connect to MySQL: " . $conn->connect_error);
			} else {
				return $conn;
			}
    }

    function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
}
?>