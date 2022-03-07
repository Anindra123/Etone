<?php 
session_start();
require_once 'routeTaskPage.php';
require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';
set_type("f","../model/student_taskData.json");
$id = $_SESSION['id'] ?? '';
if($_SESSION['page_name'] === 'Update Task Page'){
	$tid = $_SESSION['t_id'];
	$_SESSION['tu_data'] = getSingleJsonData($id,$tid,get_fileName());
}
else{
	$_SESSION['t_data'] = getAllJsonData($id,get_fileName());
}
header(getRouteUrl());
exit();
