<?php 
session_start();
require_once 'includes/validations.php';
require_once 'includes/routeTaskPage.php';
require_once '../model/dbDataAcess.php';
// require_once '../model/dataAcessType.php';
// set_type("f","../model/scheduleWeek.json");
$uid = $_SESSION['id'];
$sw_id = $_SESSION['sw_id'];
// $sw = checkValidID($uid,$sw_id,get_fileName()) ?? [];
// if(isset($_GET['clear'])){
// 	set_type("f","../model/scheduleClass.json");
// 	deleteJsonData($uid,$sw_id,get_fileName(),0,true);
// 	$_SESSION['success'] = get_sucess('Weekly schedule for week '.$sw->wname.' cleared sucessfully ');
// }
// else if(count($sw) > 0 ){
// 	deleteJsonData($uid,$sw_id,get_fileName());
// 	set_type("f","../model/scheduleClass.json");
// 	deleteJsonData($uid,$sw_id,get_fileName(),0,true);
// 	$_SESSION['success'] = get_sucess('Weekly schedule for week '.$sw->wname.' deleted sucessfully ');
// }
// else{
// 	$_SESSION['m_errors'] = get_failure('Error when deleting task ');
// }
$result = checkValidWeeklySchedule($uid,$sw_id);
if($result !== null){
	$task = $result->get_result();
	if($task->num_rows > 0 ){
		$task= $task->fetch_assoc();
		$result = deleteWeeklyScheduleData($uid,$sw_id);
		if($result !== null){
			$_SESSION['success'] = get_sucess($task['wname'].' deleted sucessfully ');
			$result->close();
			$conn->close();
		}
	}
	else{
		$_SESSION['m_errors'] = get_failure('Error when deleting lecture note ');
	}
	$result->close();
	$conn->close();
}
header(getRouteUrl());
exit();
