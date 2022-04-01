<?php 
session_start();
require_once 'includes/validations.php';
require_once 'includes/routeTaskPage.php';
require_once '../model/dbDataAcess.php';
// require_once '../model/dataAcessType.php';
// set_type("f","../model/lecturePlanData.json");
$uid = $_SESSION['id'];
$lpid = +$_GET['lp_id'] ?? -1;
// $lp = checkValidID($uid,$lpid,get_fileName()) ?? Null;
// if(isset($lp)){
// 	deleteJsonData($uid,$lpid,get_fileName());
// 	set_type("f","../model/lectureNoteData.json");
// 	deleteJsonData($uid,$lpid,get_fileName(),0,true);
// 	set_type("f","../model/noteGroup.json");
// 	$ng_data = get_AllNoteGroupData(get_fileName());

// 	require_once 'includes/getGroupID.php';
	
// 	if(count($ng_data) > 0){
// 		$data =(array) getData();
// 		$n_data = [];
// 		for ($i=0; $i < count($data['shared_notes']); $i++) { 
// 			$p_data = $data['shared_notes'][$i];
// 			if($p_data->id !== $lpid && $p_data->uid!== $uid){
// 				$n_data[]  = $p_data;
// 			}
// 		}
// 		$data['shared_notes'] = $n_data;
// 		$id = $_SESSION['g_id'];
// 		updateNoteGroupData($id,$data,get_fileName());
// 	}

// 	$_SESSION['success'] = get_sucess($lp->sname.' deleted sucessfully ');
// }
// else{
// 	$_SESSION['m_errors'] = get_failure('Error when deleting lecture plan ');
// }
$result = checkValidLecturePlan($uid,$lpid);
if($result !== null){
	$task = $result->get_result();
	if($task->num_rows > 0 ){
		$task= $task->fetch_assoc();
		$lnresult = deleteAllLectureNoteData($uid,$lpid);
		$lpresult = deleteLecturePlanData($uid,$lpid);
		if($lnresult !== null && $lpresult !== null){
			$_SESSION['success'] = get_sucess($task['sname'].' deleted sucessfully ');
			$lnresult->close();
			$lpresult->close();
			$conn->close();
		}
	}
	else{
		$_SESSION['m_errors'] = get_failure('Error when deleting task ');
	}
	$result->close();
	$conn->close();
}

header(getRouteUrl());
exit();
