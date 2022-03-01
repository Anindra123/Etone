<?php
session_start();
require_once 'routeTaskPage.php';
require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';
set_type("f","../model/scheduleWeek.json");
$uid = $_SESSION['id'];
$sw_id = $_SESSION['sw_id'];
if($_SESSION['page_name'] === 'Update Schedule Week Page'){
	$_SESSION['swu_data']  = getSingleJsonData($uid,$sw_id,get_fileName());

}
else{
	$_SESSION['sw_data'] = getAllJsonData($uid,get_fileName());
}

header(getRouteUrl());
exit();