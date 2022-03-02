<?php 
session_start();
require_once 'validations.php';
require_once 'routeTaskPage.php';
require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';
set_type("f","../model/scheduleWeek.json");
$uid = $_SESSION['id'];
$sw_id = $_SESSION['sw_id'];
$sw = checkValidID($uid,$sw_id,get_fileName()) ?? [];
if(isset($_GET['clear'])){
	set_type("f","../model/scheduleClass.json");
	deleteJsonData($uid,$sw_id,get_fileName(),0,true);
	$_SESSION['success'] = get_sucess('Weekly schedule for week '.$sw->wname.' cleared sucessfully ');
}
else if(count($sw) > 0 ){
	deleteJsonData($uid,$sw_id,get_fileName());
	set_type("f","../model/scheduleClass.json");
	deleteJsonData($uid,$sw_id,get_fileName(),0,true);
	$_SESSION['success'] = get_sucess('Weekly schedule for week '.$sw->wname.' deleted sucessfully ');
}
else{
	$_SESSION['m_errors'] = get_failure('Error when deleting task ');
}

header(getRouteUrl());
exit();
