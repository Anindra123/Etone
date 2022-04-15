<?php 
session_start();
require_once 'includes/validations.php';
require_once 'includes/routeTaskPage.php';
require_once '../model/dbDataAcess.php';

$uid = $_SESSION['id'];
$pid = $_SESSION['pid'];
$lnid = +$_GET['ln_id'] ?? -1;

$result = checkValidLectureNote($uid,$pid,$lnid);
if($result !== null){
	$task = $result->get_result();
	if($task->num_rows > 0 ){
		$task= $task->fetch_assoc();
		$result = deleteLectureNoteData($uid,$pid,$lnid);
		if($result !== null){
			$_SESSION['success'] = get_sucess($task['tname'].' deleted sucessfully ');
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
