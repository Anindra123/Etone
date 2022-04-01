<?php
	$filename = "";
	//static $conn = Null;
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "etonedb";
	//set which way the application 
	//is acessing data
	function set_type($dAtype,$file=""){
		global $filename,$conn,$servername,$username,$password,$dbname;
		if($dAtype === "f"){
			$filename = $file;
		}
		if($dAtype === "d"){
			$conn = new mysqli($servername,$username,$password,$dbname);
		}
	}

	//return the filename set
	function get_fileName(){
		global $filename;
		return $filename;
	}


	function getConn(){
		global $conn,$servername,$username,$password,$dbname;
		if(isset($conn) === false){
			$conn = new mysqli($servername,$username,$password,$dbname);
		}
		else{
			return $conn;
		}
	}