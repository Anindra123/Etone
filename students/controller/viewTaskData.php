<?php 
session_start();
require_once 'routeTaskPage.php';
require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';
set_type("f","../model/student_taskData.json");
$id = $_SESSION['id'] ?? '';
if(!isset($_SESSION['t_data']) && isset($_SESSION['t_id'])){
	$tid = +$_SESSION['t_id'];
	$_SESSION['t_data'] = getTaskData($id,$tid,get_fileName());
}
else if(!isset($_SESSION['t_data'])){
	$_SESSION['t_data'] = getAllTaskData($id,get_fileName());

}
header(getRouteUrl());
exit();
