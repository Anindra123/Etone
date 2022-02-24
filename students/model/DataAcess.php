<?php
require_once 'dataAcessType.php';
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

function writeData($data,$filename){
	$fw = "";
	$handle = fopen($filename,'w');
	$fw = fwrite($handle, $data);
	$fc = fclose($handle);
	if($fw === false){
		echo "<h3>Cannot write to file</h3>";
		exit();
	}
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
		writeData($data_arr,$filename);
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

function update_studentData($data,$id){
	$json_data = readData(get_fileName());
	$arr = json_decode($json_data);
	for($i=0;$i<count($data);$i++){
		if($arr[$i]->id === $id){
			$arr[$i]->fname = $data['fname'];
			$arr[$i]->lname = $data['lname'];
			$arr[$i]->mname = $data['mname'];
			$arr[$i]->ins_name = $data['ins_name'];
			$arr[$i]->loe = $data['loe'];
			break;
		}
	}
	$data = json_encode($arr);
	writeData($data,get_fileName());

}

function valid_pass($pass,$id){
	$data = get_studentAccData($id);
	if($data->pass === $pass){
		return True;
	}
	return False;
}
function update_password($data,$id){
	$json_data = readData(get_fileName());
	$arr = json_decode($json_data);
	for($i=0;$i<count($arr);$i++){
		if($arr[$i]->id === $id){
			$arr[$i]->pass = $data['pass'];
			break;
		}
	}
	$data = json_encode($arr);
	writeData($data,get_fileName());

}

function passwordReset_validation($uname,$email){
	$json_data = readData(get_fileName());
	$arr  = json_decode($json_data);
	for ($i=0; $i < count($arr); $i++) { 
		if($arr[$i]->uname === $uname && 
			$arr[$i]->mail === $email ){
			return $arr[$i]->id;
		}
	}
	return -1;
}


function delete_account($id){
	$json_data = readData(get_fileName());
	$arr  = json_decode($json_data);
	$new_arr = array();
	for ($i=0; $i < count($arr); $i++) { 
		if($arr[$i]->id === $id){
			continue;
		}
		else{
			$new_arr[] = $arr[$i];
		}
	}
	$new_arr = json_encode($new_arr);
	writeData($new_arr,get_fileName());
}


function getAllTaskData($uid,$filename){
	$json_data = readData($filename) ?? '';
	if(empty($json_data)){
		return [];
	}
	$arr = json_decode($json_data);
	$out = array();
	for ($i=0; $i < count($arr); $i++) { 
		if($arr[$i]->uid === $uid){
			$out[] = $arr[$i];
		}
	}
	if(count($out) > 0){
		return $out;
	}
	else{
		return [];
	}
}

function getTaskData($uid,$tid,$filename){
	$json_data = readData($filename);
	$arr = json_decode($json_data);
	for ($i=0; $i < count($arr); $i++) { 
		if($arr[$i]->uid === $uid && $arr[$i]->id === $tid){
			return $arr[$i];
		}
	}
}

function setTaskData($data,$filename){
	$json_data = readData($filename);
	$arr = json_decode($json_data);
	if(!isset($arr)){
		$data_arr = [];
		$data['id'] = 1;
		$data_arr[] = $data;
		$data_arr = json_encode($data_arr);
		writeData($data_arr,$filename);
	}
	else{
		$data['id'] = $arr[count($arr)-1]->id;
		$data['id']++;
		$arr[] = $data;
		$arr= json_encode($arr);
		writeData($arr,$filename);
	}
}

function updateTaskData($uid,$tid,$data,$filename){
	$json_data = readData($filename);
	$arr = json_decode($json_data);
	for ($i=0; $i < count($arr); $i++) { 
		if($arr[$i]->uid === $uid && $arr[$i]->id === $tid){
			$arr[$i]->tname = $data['tname'];
			$arr[$i]->stime = $data['stime'];
			$arr[$i]->etime = $data['etime'];
		}
	}
	$arr = json_encode($arr);
	writeData($arr,$filename);
}