<?php 
session_start();
require_once 'includes/routeTaskPage.php';
require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';
set_type("f","../model/lectureNoteData.json");
$id = $_SESSION['id'] ?? '';
$pid = $_SESSION['pid'] ?? '';
if($_SESSION['page_name'] === 'Update Lecture Notes Page'){
	$lnid = $_SESSION['ln_id'];
	$_SESSION['lnu_data'] = getSingleJsonData($id,$lnid,get_fileName(),$pid);
}
else if($_SESSION['page_name'] === 'Lecture Notes Page'){
	$_SESSION['ln_data']  = getAllJsonData($id,get_fileName(),$pid);
}
else if($_SESSION['page_name'] === 'Shared Lecture Notes Page'){
	$uid = $_SESSION['uid'];
	$_SESSION['ln_data']  = getAllJsonData($uid,get_fileName(),$pid);
}
else if($_SESSION['page_name'] === 'Show Lecture Notes Page'){
	$lnid = $_SESSION['ln_id'];
	$_SESSION['lns_data']  = getSingleJsonData($id,$lnid,get_fileName(),$pid);
}
else if($_SESSION['page_name'] === 'Show Shared Lecture Notes Page'){
	$uid = $_SESSION['uid'];
	$lnid = $_SESSION['ln_id'];
	$_SESSION['lns_data']  = getSingleJsonData($uid,$lnid,get_fileName(),$pid);

}
header(getRouteUrl());
exit();
