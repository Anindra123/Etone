<?php 
session_start();
require_once 'includes/validations.php';
require_once 'includes/routeTaskPage.php';
require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';
set_type("f","../model/student_taskData.json");
$uid = $_SESSION['id'];
$tid = +$_GET['t_id'] ?? -1;
$task = checkValidID($uid,$tid,get_fileName());
if(count($task) > 0 ){
	deleteJsonData($uid,$tid,get_fileName());
	$_SESSION['success'] = get_sucess($task->tname.' deleted sucessfully ');
}
else{
	$_SESSION['m_errors'] = get_failure('Error when deleting task ');
}

header(getRouteUrl());
exit();
