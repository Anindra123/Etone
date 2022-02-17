<?php
	
	function readData($filename){
		$fr = "";
		$handle = fopen($filename,'r');
		$flen = filesize($filename);
		if($flen > 0){
			$fr = fread($handle,$flen);
		}
		$fc = fclose($handle);
		return $fr;
	}

	function set_studentData($data,$filename){
		$handle = fopen($filename,'r');
		$flen = filesize($filename);
		$fr = "";
		if($flen > 0){
			$fr = fread($handle,$flen);
		}
		$fc = fclose($handle);
		
		$json_data = json_decode($fr);
		$handle = fopen($filename, 'w');
		$data_arr = array();
		if($handle === false){
			die("<h3>Cannot open file</h3>");
		}
		if($json_data === NULL){
			$data['id'] = 1;
			$data_arr[] = $data;
			$data_arr = json_encode($data_arr);
			fwrite($handle, $data_arr);
		}
		else{
			$data['id'] = $json_data[count($json_data)-1]->id;
			$data['id']++; 
			$json_data[] = $data;
			$json_data = json_encode($json_data);
			fwrite($handle, $json_data);
		}
		$fc = fclose($handle);
	}

	function validate_login($email,$pass,$filename){
		$json_data = readData($filename);
		$found = false;
		for($i = 0;$i<count($json_data);$i++){
			if($json_data[$i]->mail === $email && $json_data[$i]->pass === $pass){
				$found = true;
				$idx = $i;
				break;
			}
		}

		if($found === true){
			return $json_data[$idx];
		}
		else{
			return [];
		}

	}