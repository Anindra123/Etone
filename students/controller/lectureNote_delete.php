<?php 
session_start();
require_once 'validations.php';
require_once 'routeTaskPage.php';
require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';
set_type("f","../model/lectureNoteData.json");
$uid = $_SESSION['id'];
$pid = $_SESSION['pid'];
$lnid = +$_GET['ln_id'] ?? -1;
$ln = checkValidID($uid,$lnid,get_fileName(),$pid);
if(count($ln) > 0 ){
	deleteJsonData($uid,$lnid,get_fileName(),$pid);
	$_SESSION['success'] = get_sucess($ln->tname.' deleted sucessfully ');
}
else{
	$_SESSION['m_errors'] = get_failure('Error when deleting task ');
}

header(getRouteUrl());
exit();
