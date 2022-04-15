<?php 
session_start();
require_once 'includes/validations.php';
require_once 'includes/routeTaskPage.php';
require_once '../model/dbDataAcess.php';

$uid = $_SESSION['id'];
$lpid = +$_GET['lp_id'] ?? -1;

$result = checkValidLecturePlan($uid,$lpid);
if($result !== null){
	$task = $result->get_result();
	if($task->num_rows > 0 ){
		$task= $task->fetch_assoc();
		$lnresult = deleteAllLectureNoteData($uid);
		$lpresult = deleteLecturePlanData($uid,$lpid);
		if($lnresult !== null && $lpresult !== null){
			$_SESSION['success'] = get_sucess($task['sname'].' deleted sucessfully ');
			$lnresult->close();
			$lpresult->close();
			$conn->close();
		}
	}
	else{
		$_SESSION['m_errors'] = get_failure('Error when deleting task ');
	}
	$result->close();
	$conn->close();
}

header(getRouteUrl());
exit();
