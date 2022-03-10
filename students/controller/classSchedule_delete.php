<?php 
session_start();
require_once 'includes/validations.php';
require_once 'includes/routeTaskPage.php';
require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';
set_type("f","../model/scheduleClass.json");
$uid = $_SESSION['id'];
$pid = $_SESSION['sw_id'];
$scid = +$_GET['sc_id'];
var_dump($scid);
$sc = checkValidID($uid,$scid,get_fileName(),$pid);
if(count($sc) > 0 ){
	deleteJsonData($uid,$scid,get_fileName(),$pid);
	$_SESSION['success'] = get_sucess($sc->cname.' schedule deleted sucessfully ');
}
else{
	$_SESSION['m_errors'] = get_failure('Error when deleting schedule ');
}

header(getRouteUrl());
exit();
