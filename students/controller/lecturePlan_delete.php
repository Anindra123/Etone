<?php 
session_start();
require_once 'includes/validations.php';
require_once 'includes/routeTaskPage.php';
require_once '../model/dataAcess.php';
require_once '../model/dataAcessType.php';
set_type("f","../model/lecturePlanData.json");
$uid = $_SESSION['id'];
$lpid = +$_GET['lp_id'] ?? -1;
$lp = checkValidID($uid,$lpid,get_fileName()) ?? Null;
if(isset($lp)){
	deleteJsonData($uid,$lpid,get_fileName());
	set_type("f","../model/lectureNoteData.json");
	deleteJsonData($uid,$lpid,get_fileName(),0,true);
	set_type("f","../model/noteGroup.json");
	$ng_data = get_AllNoteGroupData(get_fileName());

	require_once 'includes/getGroupID.php';
	
	if(count($ng_data) > 0){
		$data =(array) getData();
		$n_data = [];
		for ($i=0; $i < count($data['shared_notes']); $i++) { 
			$p_data = $data['shared_notes'][$i];
			if($p_data->id !== $lpid && $p_data->uid!== $uid){
				$n_data[]  = $p_data;
			}
		}
		$data['shared_notes'] = $n_data;
		$id = $_SESSION['g_id'];
		updateNoteGroupData($id,$data,get_fileName());
	}

	$_SESSION['success'] = get_sucess($lp->sname.' deleted sucessfully ');
}
else{
	$_SESSION['m_errors'] = get_failure('Error when deleting lecture plan ');
}

header(getRouteUrl());
exit();
