<?php
	$filename = "";

	//set which way the application 
	//is acessing data
	function set_type($dAtype,$file=""){
		global $filename;
		if($dAtype === "f"){
			$filename = $file;
		}
	}

	//return the filename set
	function get_fileName(){
		global $filename;
		return $filename;
	}


	