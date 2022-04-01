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

	function deleteAllLectureNoteData($sid,$lpid){
		$conn = setConnection();
		if($conn->connect_error){
			$_SESSION['m_errors'] = $GLOBALS['err'];
			return Null;
		}
		$stmt = $conn->prepare("delete from student_lecture_note where lp_id=? and sid=?");
		$stmt->bind_param("ii",$lpid,$sid);
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

	function deleteWeeklyScheduleData($sid,$id){
		$conn = setConnection();
		if($conn->connect_error){
			$_SESSION['m_errors'] = $GLOBALS['err'];
			return Null;
		}
		$stmt = $conn->prepare("delete from student_weekly_schedule where id=? and sid=?");
		$stmt->bind_param("ii",$id,$sid);
		$stmt->execute();
		return $stmt;
	}