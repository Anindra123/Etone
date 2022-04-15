<?php 
session_start();
require_once 'includes/routeTaskPage.php';
require_once '../model/dbDataAcess.php';

$id = $_SESSION['id'] ?? '';

if($_SESSION['page_name'] === 'Update Lecture Plan Page'){
	$lpid = $_SESSION['lp_id'];
	$result = getLecturePlanData($id,$lpid);
	if($result !== null){
		$dataResult = $result->get_result();
		if($dataResult->num_rows >= 1){
			$_SESSION['lpu_data'] = $dataResult->fetch_assoc();
		}
		$result->close();
		$conn->close();
	}
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
	$result = getAllLecturePlanData($id);
	if($result !== null){
		$dataResult = $result->get_result();
		$out = [];
		$data = [];
		if($dataResult->num_rows >= 1){
				while($data = $dataResult->fetch_assoc()){
					$out[] = $data;
				}
				$_SESSION['lp_data'] = $out;
				
		}else{
			$_SESSION['lp_data']= [];
		}
		$result->close();
		$conn->close();
	}

}
header(getRouteUrl());
exit();
