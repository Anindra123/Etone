<?php 
session_start();
$id = $_SESSION['id'] ;

require_once '../model/dbDataAcess.php';
// require_once '../model/dataAcessType.php';

if(isset($_GET['submit'])){
	if($_GET['submit'] === "yes"){
		// set_type("f","../model/lectureNoteData.json");
		// delete_account($id,get_fileName());
		// set_type("f","../model/lecturePlanData.json");
		// delete_account($id,get_fileName());
		// set_type("f","../model/scheduleClass.json");
		// delete_account($id,get_fileName());
		// set_type("f","../model/scheduleWeek.json");
		// delete_account($id,get_fileName());
		// set_type("f","../model/student_taskData.json");
		// delete_account($id,get_fileName());
		// set_type("f","../model/noteGroup.json");
		// if(isset($_SESSION['g_id'])){
		// 	if($_SESSION['user_type'] === 'gc'){
		// 		$uid = $_SESSION['g_id'];
		// 		discardNoteGroup($uid,get_fileName());
		// 	}
		// 	else{
		// 		$_SESSION['uid'] = $id;
		// 		require_once 'includes/removeUserData.php';
		// 	}
		// }
		// set_type("f","../model/students.json");
		// delete_account($id,get_fileName(),true);
		$dwresult = deleteAllWeekData($id);
		$dcresult = deleteAllClassScheduleData($id);
		$dwsresult = deleteWeeklyScheduleData($id);
		$dlnresult = deleteAllLectureNoteData($id);
		$dlpresult = deleteAllLecturePlan($id);
		$dltresult = deleteAllTasks($id);
		$dsresult = deleteStudentData($id);
		if($dwresult !== null && $dcresult !==null && $dwsresult !== null && $dlnresult !== null && $dlpresult !== null && $dltresult !== null && $dsresult !== null){
			header("Location: ../view/logout.php");
			exit();
		} 
		
	}
	else{
		header("Location: ../view/student_tasks.php");
		exit();
	}
}