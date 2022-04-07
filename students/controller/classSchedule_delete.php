<?php 
session_start();
require_once 'includes/validations.php';
require_once 'includes/routeTaskPage.php';
require_once '../model/dbDataAcess.php';
// require_once '../model/dataAcessType.php';
// set_type("f","../model/scheduleClass.json");
$uid = $_SESSION['id'];
$pid = $_SESSION['sw_id'];
$scid = +$_GET['sc_id'];

// $sc = checkValidID($uid,$scid,get_fileName(),$pid);
// if(count($sc) > 0 ){
	$wresult = deleteWeekDays($scid);
	$result = deleteClassSchedule($scid);
	// deleteJsonData($uid,$scid,get_fileName(),$pid);
	if($wresult !== null && $result !== null){
		$_SESSION['success'] = get_sucess($sc->cname.' schedule deleted sucessfully ');
		$wresult->close();
		$result->close();
	}
// }
// else{
// 	$_SESSION['m_errors'] = get_failure('Error when deleting schedule ');
// }

header(getRouteUrl());
exit();
