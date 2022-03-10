<?php 
session_start();
require_once 'includes/routeTaskPage.php';
require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';
set_type("f","../model/lecturePlanData.json");
$id = $_SESSION['id'] ?? '';

if($_SESSION['page_name'] === 'Update Lecture Plan Page'){
	$lpid = $_SESSION['lp_id'];
	$_SESSION['lpu_data'] = getSingleJsonData($id,$lpid,get_fileName());
}
else{
	$_SESSION['lp_data']  = getAllJsonData($id,get_fileName());
}
header(getRouteUrl());
exit();
