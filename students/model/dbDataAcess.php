<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "etonedb";
$err = "Error in connecting to database &#10060;";
$conn = new mysqli($servername,$username,$password,$dbname);
function setConnection(){
	global $conn,$servername,$username,$password,$dbname;
	if(!isset($conn->client_info)){
		$conn = new mysqli($servername,$username,$password,$dbname);
		return $conn;
	}
	else{
		return $conn;
	}
}

function setStudentData($data){	
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("insert into student(fname,mname,lname,loe,ins_name,uname,mail,pass) values(?,?,?,?,?,?,?,?)");
	$stmt->bind_param('ssssssss',$data['fname'],$data['mname'],$data['lname'],$data['loe'],$data['ins_name'],$data['uname'],$data['mail'],$data['pass']);
	$stmt->execute();
	return $stmt;
}

function validate_registration($uname,$pass,$mail){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("select * from student where uname=? or mail=? or pass=?");
	$stmt->bind_param("sss",$uname,$mail,$pass);
	$stmt->execute();
	return $stmt;
}

function validate_login($mail,$pass){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("select * from student where mail=? and pass=?");
	$stmt->bind_param("ss",$mail,$pass);
	$stmt->execute();
	return $stmt;
}
function getStudentData($id){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("select * from student where id=?");
	$stmt->bind_param("i",$id);
	$stmt->execute();
	return $stmt;
}
function update_studentData($id,$data){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("update student set fname=?,mname=?,lname=?,loe=?,ins_name=? where id=?");
	$stmt->bind_param("sssssi",$data['fname'],$data['mname'],
		$data['lname'],$data['loe'],$data['ins_name'],$id);
	$stmt->execute();
	return $stmt;
}

function valid_pass($id,$pass){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}

	$stmt = $conn->prepare("select * from student where pass=? and id=?");
	$stmt->bind_param("si",$pass,$id);
	$stmt->execute();
	return $stmt;
}

function update_password($id,$data){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("update student set pass=? where id=?");
	$stmt->bind_param("si",$data['pass'],$id);
	$stmt->execute();
	return $stmt;
}

function setTaskData($data){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("insert into student_task(tname,stime,etime,sid) values(?,?,?,?)");
	$stmt->bind_param("sssi",$data['tname'],$data['stime'],$data['etime'],$data['sid']);
	$stmt->execute();
	return $stmt;
}

function getAllTaskData($sid){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("select * from student_task where sid=?");
	$stmt->bind_param("i",$sid);
	$stmt->execute();
	return $stmt;
}

function checkValidID($sid,$tid){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("select * from student_task where id=? and sid=?");
	$stmt->bind_param("ii",$tid,$sid);
	$stmt->execute();
	return $stmt;
}

function changeTaskStatus($sid,$tid){
	$conn = setConnection();
	$status = "Completed";
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("update student_task set status=? where id=? and sid=?");
	$stmt->bind_param("sii",$status,$tid,$sid);
	$stmt->execute();
	return $stmt;
}

function deleteTaskData($sid,$tid){
	$conn = setConnection();
	$status = "Completed";
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("delete from student_task where id=? and sid=?");
	$stmt->bind_param("ii",$tid,$sid);
	$stmt->execute();
	return $stmt;
}

function getTaskData($sid,$tid){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("select * from student_task where id=? and sid=?");
	$stmt->bind_param("ii",$tid,$sid);
	$stmt->execute();
	return $stmt;
}

function updateTaskData($sid,$tid,$data){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("update student_task set tname=?,stime=?,etime=? where id=? and sid=?");
	$stmt->bind_param("sssii",$data['tname'],$data['stime'],$data['etime'],$tid,$sid);
	$stmt->execute();
	return $stmt;
}


function setLecturePlanData($data){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("insert into student_lecture_plan(sname,topics,sid) values(?,?,?)");
	$stmt->bind_param("ssi",$data['sname'],$data['topics'],$data['uid']);
	$stmt->execute();
	return $stmt;
}


function updateLecturePlanData($sid,$lpid,$data){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("update student_lecture_plan set sname=?,topics=? where id=? and sid=?");
	$stmt->bind_param("ssii",$data['sname'],$data['topics'],$lpid,$sid);
	$stmt->execute();
	return $stmt;
}

function getAllLecturePlanData($sid){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("select * from student_lecture_plan where sid=?");
	$stmt->bind_param("i",$sid);
	$stmt->execute();
	return $stmt;
}

function getLecturePlanData($sid,$lpid){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("select * from student_lecture_plan where id=? and sid=?");
	$stmt->bind_param("ii",$lpid,$sid);
	$stmt->execute();
	return $stmt;
}

function checkValidLecturePlan($sid,$lpid){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("select * from student_lecture_plan where id=? and sid=?");
	$stmt->bind_param("ii",$lpid,$sid);
	$stmt->execute();
	return $stmt;
}

function deleteLecturePlanData($sid,$lpid){

	$conn = setConnection();
	$status = "Completed";
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("delete from student_lecture_plan where id=? and sid=?");
	$stmt->bind_param("ii",$lpid,$sid);
	$stmt->execute();
	return $stmt;
}

function getAllLectureNoteData($sid,$lpid){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("select * from student_lecture_note where lp_id=? and sid=?");
	$stmt->bind_param("ii",$lpid,$sid);
	$stmt->execute();
	return $stmt;
}
function getLectureNoteData($sid,$lpid,$id){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("select * from student_lecture_note where id=? and lp_id=? and sid=?");
	$stmt->bind_param("iii",$id,$lpid,$sid);
	$stmt->execute();
	return $stmt;
}

function setLectureNoteData($data){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("insert into student_lecture_note(tname,ldate,ltime,notes,lp_id,sid) values(?,?,?,?,?,?)");
	$stmt->bind_param("ssssii",$data['tname'],$data['ldate'],$data['ltime'],$data['notes'],$data['pid'],$data['uid']);
	$stmt->execute();
	return $stmt;

}

function updateLectureNoteData($sid,$lpid,$id,$data){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("update student_lecture_note set tname=?,ltime=?,ldate=?,notes=? where id=? and lp_id=? and sid=?");
	$stmt->bind_param("ssssiii",$data['tname'],$data['ltime'],$data['ldate'],$data['notes'],$id,$lpid,$sid);
	$stmt->execute();
	return $stmt;
}

function checkValidLectureNote($sid,$lpid,$id){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("select * from student_lecture_note where id=? and lp_id=? and sid=?");
	$stmt->bind_param("iii",$id,$lpid,$sid);
	$stmt->execute();
	return $stmt;
}
function deleteLectureNoteData($sid,$lpid,$id){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("delete from student_lecture_note where id=? and lp_id=? and sid=?");
	$stmt->bind_param("iii",$id,$lpid,$sid);
	$stmt->execute();
	return $stmt;
}

function deleteAllLectureNoteData($sid){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("delete from student_lecture_note where sid=?");
	$stmt->bind_param("i",$sid);
	$stmt->execute();
	return $stmt;
}

function setWeeklyScheduleData($data){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("insert into student_weekly_schedule(wname,sdate,edate,sid) values(?,?,?,?)");
	$stmt->bind_param("sssi",$data['wname'],$data['sdate'],$data['edate'],$data['uid']);
	$stmt->execute();
	return $stmt;
}

function updateWeeklyScheduleData($sid,$id,$data){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("update student_weekly_schedule set wname=? where id=? and sid=?");
	$stmt->bind_param("sii",$data['wname'],$id,$sid);
	$stmt->execute();
	return $stmt;
}

function getAllWeeklyScheduleData($sid){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("select * from student_weekly_schedule where sid=?");
	$stmt->bind_param("i",$sid);
	$stmt->execute();
	return $stmt;

}

function getWeeklyScheduleData($sid,$id){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("select * from student_weekly_schedule where id=? and sid=?");
	$stmt->bind_param("ii",$id,$sid);
	$stmt->execute();
	return $stmt;

}

function checkValidWeeklySchedule($sid,$id){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("select * from student_weekly_schedule where id=? and sid=?");
	$stmt->bind_param("ii",$id,$sid);
	$stmt->execute();
	return $stmt;

}

function deleteWeeklyScheduleData($sid){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("delete from student_weekly_schedule where sid=?");
	$stmt->bind_param("i",$sid);
	$stmt->execute();
	return $stmt;
}

function setClassSchedule($data){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("insert into student_class_schedule(cname,rname,stime,etime,ws_id,sid) values(?,?,?,?,?,?)");
	$stmt->bind_param("ssssii",$data['cname'],$data['rname'],$data['stime'],$data['etime'],$data['pid'],$data['uid']);

	$stmt->execute();
	return $stmt;

}

function updateClassSchedule($sid,$wid,$scid,$data){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("update student_class_schedule set cname=?,rname=?,stime=?,etime=? where id=? and ws_id=? and sid=?");
	$stmt->bind_param('ssssiii',$data['cname'],$data['rname'],$data['stime'],$data['etime'],$scid,$wid,$sid);
	$stmt->execute();
	return $stmt;
}

function deleteClassSchedule($scid){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("delete from student_class_schedule where id=?");
	$stmt->bind_param("i",$scid);
	$stmt->execute();
	return $stmt;

}

function getAllClassSchedule($sid,$wid){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("select * from student_class_schedule where ws_id=? and sid=?");
	$stmt->bind_param("ii",$wid,$sid);
	$stmt->execute();
	return $stmt;
} 

function getClassSchedule($sid,$wid,$id){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("select * from student_class_schedule where id=? and ws_id=? and sid=?");
	$stmt->bind_param("iii",$id,$wid,$sid);
	$stmt->execute();
	return $stmt;
} 

function getAllWeekDays($scid){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}

	$stmt = $conn->prepare("select week_table.* from week_table inner join student_class_week on week_table.id=student_class_week.w_id and student_class_week.sid=? ");
	$stmt->bind_param("i",$scid);
	$stmt->execute();
	return $stmt;
}

function deleteWeekDays($scid){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("delete from student_class_week where sid=?");
	$stmt->bind_param("i",$scid);
	$stmt->execute();
	return $stmt;

}

function setWeekDays($scid,$wdata){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("insert into student_class_week(sid,w_id) values (?,?)");
	for($i = 0;$i<count($wdata);$i++){
		$stmt->bind_param('ii',$scid,$wdata[$i]);
		$stmt->execute();
	}
	return $stmt;
}



	// function updateWeekDays($scid,$wdata){
	// 	$conn = setConnection();
	// 	if($conn->connect_error){
	// 		$_SESSION['m_errors'] = $GLOBALS['err'];
	// 		return Null;
	// 	}
	// 	$wval = $cval = 0;
	// 	$stmt = $conn->prepare("update student_class_week set w_id=? where sid=?");
	// 	$stmt->bind_param('ii',$wval,$cval);
	// 	$cwids = getClassWeekID($scid);
	// 	for($j=0;$j<count($cwids);$j++){
	// 		$cval = $cwid[$i];
	// 		for()
	// 	}
	// 	exit();
	// 	return $stmt;
	// }



function getWeekID($data){
	$w_id = [];
	global $stmt;
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("select * from week_table where wname=?");

	foreach($data as $val){
		$var = $val;
		$stmt->bind_param("s",$val);
		$stmt->execute();
		$result = $stmt->get_result();
		$data = $result->fetch_assoc();
		array_push($w_id, $data['id']);
	}
	return $w_id;
}

function deleteAllWeekData($sid){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("delete student_class_week.* from student_class_week,student_class_schedule where student_class_week.sid= student_class_schedule.id and student_class_schedule.sid=?");
		if($stmt == false){
			echo($conn->error);
			exit();
		}
		$stmt->bind_param('i',$sid);
		$stmt->execute();
		return $stmt;
}

function deleteAllClassScheduleData($sid){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("delete from student_class_schedule where sid=?");
	$stmt->bind_param("i",$sid);
	$stmt->execute();
	return $stmt;
}

function passwordReset_validation($uname,$mail){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("select * from student where uname=? and mail=?");
	$stmt->bind_param("ss",$uname,$mail);
	$stmt->execute();
	return $stmt;
}


function deleteAllTasks($sid){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("delete from student_task where sid=?");
	$stmt->bind_param("i",$sid);
	$stmt->execute();
	return $stmt;
}

function deleteAllLecturePlan($sid){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("delete from student_lecture_plan where sid=?");
	$stmt->bind_param("i",$sid);
	$stmt->execute();
	return $stmt;
}


function deleteStudentData($sid){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("delete from student where id=?");
	$stmt->bind_param("i",$sid);
	$stmt->execute();
	return $stmt;
}

function searchNoteData($id,$pid,$data){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("select * from student_lecture_note where tname=? and lp_id=? and sid=? ");
	$stmt->bind_param("sii",$data,$pid,$id);
	$stmt->execute();
	return $stmt;
}

function getTaskByStatus($id,$status){
	$conn = setConnection();
	if($conn->connect_error){
		$_SESSION['m_errors'] = $GLOBALS['err'];
		return Null;
	}
	$stmt = $conn->prepare("select * from student_task where status=? and sid=? ");
	$stmt->bind_param("ss",$status,$id);
	$stmt->execute();
	return $stmt;
}