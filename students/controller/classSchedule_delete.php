<?php 
session_start();
require_once 'includes/validations.php';
require_once 'includes/routeTaskPage.php';
require_once '../model/dbDataAcess.php';
$uid = $_SESSION['id'];
$pid = $_SESSION['sw_id'];
$scid = +$_GET['sc_id'];

$wresult = deleteWeekDays($scid);
$result = deleteClassSchedule($scid);
if($wresult !== null && $result !== null){
	$_SESSION['success'] = get_sucess($sc->cname.' schedule deleted sucessfully ');
	$wresult->close();
	$result->close();
}


header(getRouteUrl());
exit();
