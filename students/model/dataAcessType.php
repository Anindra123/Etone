<?php
	$filename = "";
	function set_type($dAtype,$file=""){
		global $filename;
		if($dAtype === "f"){
			$filename = $file;
		}
	}

	function get_fileName(){
		global $filename;
		return $filename;
	}


	