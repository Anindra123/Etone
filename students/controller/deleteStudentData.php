<?php 
session_start();
$id = $_SESSION['id'] ;

require_once '../model/dbDataAcess.php';

if(isset($_GET['submit'])){
	if($_GET['submit'] === "yes"){
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