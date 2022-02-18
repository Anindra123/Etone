<?php
	require_once 'dataAcessType.php';
    set_type("f","students.json");
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

	function set_studentData($data){
		$filename = get_fileName();
		$json_data = readData($filename);
		$arr = json_decode($json_data);
		$handle = fopen($filename, 'w');
		$data_arr = array();
		if($handle === false){
			die("<h3>Cannot open file</h3>");
		}
		if($arr === NULL){
			$data['id'] = 1;
			$data_arr[] = $data;
			$data_arr = json_encode($data_arr);
			fwrite($handle, $data_arr);
		}
		else{
			$data['id'] = $arr[count($arr)-1]->id;
			$data['id']++; 
			$arr[] = $data;
			$arr = json_encode($arr);
			fwrite($handle, $arr);
		}
		$fc = fclose($handle);
	}

	function validate_login($email,$pass){
		$json_data = readData(get_fileName());
		$arr = json_decode($json_data) ?? [];
		$found = false;
		for($i = 0;$i<count($arr);$i++){
			if($arr[$i]->mail === $email && $arr[$i]->pass === $pass){
				$found = true;
				$idx = $i;
				break;
			}
		}

		if($found === true){
			return $arr[$idx];
		}
		else{
			return [];
		}

	}

	function get_studentAccData($id){
		$json_data = readData(get_fileName());
		$out = json_decode($json_data) ?? [];
		for($i=0;$i<count($out);$i++){
			if($out[$i]->id === $id){
				return $out[$i];
			}
		}
	}

	function validate_registration($uname,$pass,$mail){
		$json_data = readData(get_fileName());
		$arr = json_decode($json_data) ?? [];
		for($i=0;$i<count($arr);$i++){
			if($arr[$i]->uname === $uname || 
				$arr[$i]->pass === $pass ||
				$arr[$i]->mail === $mail
			)
			{
				return True;
			}
		}
		return False;
	}