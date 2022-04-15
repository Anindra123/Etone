<?php 
session_start();
require_once 'includes/validations.php';
require_once 'includes/routeTaskPage.php';
require_once '../model/dbDataAcess.php';

$uid = $_SESSION['id'];
$tid = +$_GET['t_id'] ?? -1;
$result = checkValidID($uid,$tid);
if($result !== null){
	$task = $result->get_result();
	if($task->num_rows > 0 ){
		$task = $task->fetch_assoc();
		if($task['status'] === "Completed"){
			$_SESSION['m_errors'] = get_failure('Task already completed ');
		}
		else{
			$result = changeTaskStatus($uid,$tid);
			if($result !== null){
				$_SESSION['success'] = get_sucess($task['tname'].' completed sucessfully ');
			}
		}
	}
	else{
		$_SESSION['m_errors'] = get_failure('Error when updating task status ');
	}

}
header(getRouteUrl());
exit();
