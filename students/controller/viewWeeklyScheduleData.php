<?php
session_start();
require_once 'includes/routeTaskPage.php';
require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';
set_type("f","../model/scheduleWeek.json");
$uid = $_SESSION['id'];
$sw_id = $_SESSION['sw_id'];
$scid = $_SESSION['sc_id'];
if($_SESSION['page_name'] === 'Update Schedule Week Page'){
	$_SESSION['swu_data']  = getSingleJsonData($uid,$sw_id,get_fileName());

}
else if($_SESSION['page_name'] === 'Update Class Schedule Page'){
	set_type("f","../model/scheduleClass.json");
	$_SESSION['scu_data']  = getSingleJsonData($uid,$scid,get_fileName(),$sw_id);
}
else{
	$_SESSION['sw_data'] = getAllJsonData($uid,get_fileName());
	set_type("f","../model/scheduleClass.json");
	$sw_data = $_SESSION['sw_data'];
	$sw_id = $sw_data[0]->id;
	$_SESSION['sc_data'] = getAllJsonData($uid,get_fileName(),$sw_id);
}

header(getRouteUrl());
exit();