<?php
require_once 'dataAcessType.php';

// read contents from file and 
//return json data
function readData($filename){
	$fr = "";
	$handle = fopen($filename,'r');
	$flen = filesize($filename);
	//check if the file has content
	if($flen > 0){
		$fr = fread($handle,$flen);
	}
	$fc = fclose($handle);
	return $fr;
}

//write json data to a file
function writeData($data,$filename){
	$fw = "";
	$handle = fopen($filename,'w');
	$fw = fwrite($handle, $data);
	$fc = fclose($handle);
	// check if the data has been written to
	// the file
	if($fw === false){
		echo "<h3>Cannot write to file</h3>";
		exit();
	}
}


//check whether user has given
//correct username and pass when login
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

//returns all data for a student
// with a unique id
function get_studentAccData($id){
	$json_data = readData(get_fileName());
	$out = json_decode($json_data) ?? [];
	for($i=0;$i<count($out);$i++){
		if($out[$i]->id === $id){
			return $out[$i];
		}
	}
}

function get_AllNoteGroupData($filename){
	$json_data = readData(get_fileName());
	$out = json_decode($json_data) ?? [];
	return $out;
}

function updateNoteGroupData($id,$data,$filename){
	$json_data = readData(get_fileName());
	$out = json_decode($json_data) ?? [];
	for ($i=0; $i < count($out); $i++) { 
		if($out[$i]->id === $id){
			$out[$i]->gname = $data['gname'];
			$out[$i]->con_per = $data['con_per'];
			$out[$i]->shared_notes = $data['shared_notes'];
			$out[$i]->note_viewers = $data['note_viewers'];
		}
	}
	$data = json_encode($out);
	writeData($data,$filename);
}

function search_studentData($mail,$filename){
	$json_data = readData($filename) ?? '';
	if(empty($json_data)){
		return [];
	}
	$data = json_decode($json_data);
	$out = Null;
	$found = false;
	for ($i=0; $i < count($data); $i++) { 
		if($data[$i]->mail === $mail){
			$out = $data[$i];
			$found = true;
		}
	}
	if($found){
		return $out;
	}else{
		return [];
	}

}

// //check for duplicate username,password or mail
// //during registering
// function validate_registration($uname,$pass,$mail){
// 	$json_data = readData(get_fileName());
// 	$arr = json_decode($json_data) ?? [];
// 	for($i=0;$i<count($arr);$i++){
// 		if($arr[$i]->uname === $uname || 
// 			$arr[$i]->pass === $pass ||
// 			$arr[$i]->mail === $mail
// 		)
// 		{
// 			return True;
// 		}
// 	}
// 	return False;
// }

//update student current account information
// function update_studentData($data,$id){
// 	$json_data = readData(get_fileName());
// 	$arr = json_decode($json_data);
// 	for($i=0;$i<count($data);$i++){
// 		if($arr[$i]->id === $id){
// 			$arr[$i]->fname = $data['fname'];
// 			$arr[$i]->lname = $data['lname'];
// 			$arr[$i]->mname = $data['mname'];
// 			$arr[$i]->ins_name = $data['ins_name'];
// 			$arr[$i]->loe = $data['loe'];
// 			break;
// 		}
// 	}
// 	$data = json_encode($arr);
// 	writeData($data,get_fileName());

// }

//check whether old password
//given when changing password is valid
function valid_pass($pass,$id){
	$data = get_studentAccData($id);
	if($data->pass === $pass){
		return True;
	}
	return False;
}

//update user password
// function update_password($data,$id){
// 	$json_data = readData(get_fileName());
// 	$arr = json_decode($json_data);
// 	for($i=0;$i<count($arr);$i++){
// 		if($arr[$i]->id === $id){
// 			$arr[$i]->pass = $data['pass'];
// 			break;
// 		}
// 	}
// 	$data = json_encode($arr);
// 	writeData($data,get_fileName());

// }

//checks whether user has given
//correct username and email when reseting password
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

//delete account and its related data
function delete_account($uid,$filename,$flag=false){
	$json_data = readData($filename);
	$arr  = json_decode($json_data);
	$new_arr = array();
	for ($i=0; $i < count($arr); $i++) { 
		if($flag === true){
			if($arr[$i]->id === $uid){
				continue;
			}
			else{
				$new_arr[] = $arr[$i];
			}
		}
		else{
			if($arr[$i]->uid === $uid){
				continue;
			}
			else{
				$new_arr[] = $arr[$i];
			}
		}
	}
	$new_arr = json_encode($new_arr);
	writeData($new_arr,get_fileName());
}





//update daily task data
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
	$data = json_encode($arr);
	writeData($data,$filename);
}



//check the selected data id
//for deleting or updating status
//reusable method
// function checkValidID($uid,$id,$filename,$pid=0){
// 	$json_data = readData($filename);
// 	$arr = json_decode($json_data);
// 	for ($i=0; $i < count($arr); $i++) { 
// 		if($pid !== 0){
// 			if($arr[$i]->uid === $uid && $arr[$i]->id === $id && $arr[$i]->pid === $pid){
// 				return $arr[$i];
// 			}
// 		}
// 		else{
// 			if($arr[$i]->uid === $uid && $arr[$i]->id === $id){
// 				return $arr[$i];
// 			}
// 		}
// 	}
// 	return [];
// }

//delete user any user related data
//reusable method 
function deleteJsonData($uid,$id,$filename,$pid=0,$flag=false){
	$json_data = readData($filename);
	$arr = json_decode($json_data);
	$out = [];
	for ($i=0; $i < count($arr); $i++) { 
		if($pid !== 0){
			if($arr[$i]->uid === $uid && $arr[$i]->id === $id && $arr[$i]->pid === $pid){
				continue;
			}
			else{
				$out[] = $arr[$i];
			}
		}else{
			if($flag === false){
				if($arr[$i]->uid === $uid && $arr[$i]->id === $id){
					continue;
				}else{
					$out[] = $arr[$i];
				}
			}else{
				if($arr[$i]->uid === $uid && $arr[$i]->pid === $id){
					continue;
				}else{
					$out[] = $arr[$i];
				}
			}
			
		}
	}
	$data = json_encode($out);
	writeData($data,$filename);
}

// //change task status from todo to complete
// function changeTaskStatus($uid,$tid,$filename){
// 	$json_data = readData($filename);
// 	$arr = json_decode($json_data);
// 	for ($i=0; $i < count($arr); $i++) { 
// 		if($arr[$i]->uid === $uid && $arr[$i]->id === $tid){
// 			$arr[$i]->status = "Completed";
// 		}
// 	}
// 	$data = json_encode($arr);
// 	writeData($data,$filename);
// }

//get all user related data
//reusable method
function getAllJsonData($uid,$filename,$pid = 0,$flag = false){

	$json_data = readData($filename) ?? '';
	if(empty($json_data)){
		return [];
	}
	$arr = json_decode($json_data);
	$out = array();
	for ($i=0; $i < count($arr); $i++) { 
		if($flag === true){
			if($arr[$i]->id === $uid){
				return $arr[$i];
			}
		}
		else{
			if($pid !== 0){

				if($arr[$i]->uid === $uid && $arr[$i]->pid === $pid){
					$out[] = $arr[$i];
				}

			}
			else{
				if($arr[$i]->uid === $uid){
					$out[] = $arr[$i];
				} 
			}
		}

	}
	if(count($out) > 0){
		return $out;
	}
	else{
		return [];
	}
}
//set user related data
//reusable method
function setJsonData($data,$filename){
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

//update lecture planner related data
function updateLecturePlanData($uid,$tid,$data,$filename){
	$json_data = readData($filename);
	$arr = json_decode($json_data);
	for ($i=0; $i < count($arr); $i++) { 
		if($arr[$i]->uid === $uid && $arr[$i]->id === $tid){
			$arr[$i]->sname = $data['sname'];
			$arr[$i]->topics = $data['topics'];
		}
	}
	$data = json_encode($arr);
	writeData($data,$filename);
}
//update lecture note related data
function updateLectureNoteData($uid,$pid,$id,$data,$filename){
	$json_data = readData($filename);
	$arr = json_decode($json_data);
	for ($i=0; $i < count($arr); $i++) { 
		if($arr[$i]->uid === $uid && $arr[$i]->pid === $pid && $arr[$i]->id === $id){
			$arr[$i]->tname = $data['tname'];
			$arr[$i]->ltime = $data['ltime'];
			$arr[$i]->ldate = $data['ldate'];
			$arr[$i]->notes = $data['notes'];
		}
	}
	$data = json_encode($arr);
	writeData($data,$filename);
}
//returns only a single user related data
// reusable method
function getSingleJsonData($uid,$id,$filename,$pid=0){
	$json_data = readData($filename);
	$arr = json_decode($json_data);
	for ($i=0; $i < count($arr); $i++) { 
		if($pid !== 0){
			if($arr[$i]->uid === $uid && $arr[$i]->id === $id && $arr[$i]->pid === $pid){
				return $arr[$i];
			}
		}
		else{
			if($arr[$i]->uid === $uid && $arr[$i]->id === $id){
				return $arr[$i];
			}
		}
	}
}
//search for some data and return single data
//reusable method
function searchJsonData($uid,$key,$name,$filename,$pid=0){
	$data = getAllJsonData($uid,$filename,$pid);
	$found = false;
	$out = [];
	for ($i=0; $i < count($data); $i++) {
		$arr = (array)$data[$i]; 
		if(strtolower($arr[$key]) === strtolower($name)){
			$out = $arr;
			$found = true;
		}
	}

	if($found){
		return $out;
	}
	else{
		return [];
	}
}
//update weekly scheduler related data 
function updateWeeklyScheduleData($uid,$id,$data,$filename){
	$json_data = readData($filename);
	$arr = json_decode($json_data);
	for ($i=0; $i < count($arr); $i++) { 
		if($arr[$i]->uid === $uid && $arr[$i]->id === $id){
			$arr[$i]->wname = $data['wname'];
		}
	}
	$data = json_encode($arr);
	writeData($data,$filename);
}
//update class schedule data for weekly scheduler
function updateClassScheduleData($uid,$pid,$id,$data,$filename){
	$json_data = readData($filename);
	$arr = json_decode($json_data);
	for ($i=0; $i < count($arr); $i++) { 
		if($arr[$i]->uid === $uid && $arr[$i]->pid === $pid && $arr[$i]->id === $id){
			$arr[$i]->cname = $data['cname'];
			$arr[$i]->rname = $data['rname'];
			$arr[$i]->stime = $data['stime'];
			$arr[$i]->etime = $data['etime'];
			$arr[$i]->weekday = $data['weekday'];
		}
	}
	$data = json_encode($arr);
	writeData($data,$filename);
}

function discardNoteGroup($id,$filename){
	$json_data = readData($filename);
	$data = json_decode($json_data) ?? [];
	$out = [];
	for ($i=0; $i < count($data); $i++) { 
		if($data[$i]->id !== $id){
			$out[] = $data[$i];
		}
	}
	$out = json_encode($out);
	writeData($out,$filename);
}

function userMemberOfGroup($mail,$filename){
	$json_data = readData($filename);
	$data = json_decode($json_data) ?? [];
	$flag = false;
	for ($i=0; $i < count($data); $i++) { 

		$note_viewers = $data[$i]->note_viewers;
		for ($j=0; $j < count($note_viewers); $j++) { 
			if($note_viewers[$j]->mail === $mail){
				$flag = true;
			}
		}
	}
	if($flag){
		return True;
	}
	else{
		return False;
	}
	

}