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
else if($_SESSION['page_name'] === 'Note Group Page'){
	set_type("f","../model/noteGroup.json");
	$ng_data = get_AllNoteGroupData(get_fileName());
	require_once 'includes/getGroupID.php';
	$data = getData();
	for ($i=0; $i < count($data->shared_notes); $i++) { 
		$note_data[] =$data->shared_notes[$i];
	}
	$shared = [];
	for ($i=0; $i < count($note_data); $i++) { 
		$data = $note_data[$i];
		set_type("f","../model/students.json");
		$owner = get_studentAccData($data->uid);
		set_type("f","../model/lecturePlanData.json");

		$lp_data = getSingleJsonData($data->uid,$data->id,get_fileName()) ;
		$fullname = $owner->fname.' '.$owner->mname.' '.$owner->lname;
		$shared[] = array('owner_name' => $fullname,'data' => $lp_data);
	}
	
	$_SESSION['slp_data'] = $shared;
}
else{
	$_SESSION['lp_data']  = getAllJsonData($id,get_fileName());
}
header(getRouteUrl());
exit();
