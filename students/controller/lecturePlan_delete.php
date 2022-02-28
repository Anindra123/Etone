<?php 
session_start();
require_once 'validations.php';
require_once 'routeTaskPage.php';
require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';
set_type("f","../model/lecturePlanData.json");
$uid = $_SESSION['id'];
$lpid = +$_GET['lp_id'] ?? -1;
$lp = checkValidID($uid,$lpid,get_fileName()) ?? [];
if(count($lp) > 0 ){
	deleteJsonData($uid,$lpid,get_fileName());
	set_type("f","../model/lectureNoteData.json");
	deleteJsonData($uid,$lpid,get_fileName(),0,true);
	$_SESSION['success'] = get_sucess($lp->sname.' deleted sucessfully ');
}
else{
	$_SESSION['m_errors'] = get_failure('Error when deleting task ');
}

header(getRouteUrl());
exit();
