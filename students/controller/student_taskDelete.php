<?php 
session_start();
require_once 'includes/validations.php';
require_once 'includes/routeTaskPage.php';
require_once '../model/dbDataAcess.php';
// require_once '../model/dataAcessType.php';
// set_type("f","../model/student_taskData.json");
$uid = $_SESSION['id'];
$tid = +$_GET['t_id'] ?? -1;
//$task = checkValidID($uid,$tid,get_fileName());
$result = checkValidID($uid,$tid);
if($result !== null){
	$task = $result->get_result();
	if($task->num_rows > 0 ){
		$task= $task->fetch_assoc();
		$result = deleteTaskData($uid,$tid);
		if($result !== null){
			$_SESSION['success'] = get_sucess($task['tname'].' deleted sucessfully ');
			$result->close();
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
