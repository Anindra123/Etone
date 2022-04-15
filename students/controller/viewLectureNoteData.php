<?php 
session_start();
require_once 'includes/routeTaskPage.php';
require_once '../model/dbDataAcess.php';

$id = $_SESSION['id'] ?? '';
$pid = $_SESSION['pid'] ?? '';
if($_SESSION['page_name'] === 'Update Lecture Notes Page'){
	$lnid = $_SESSION['ln_id'];
	
	$result = getLectureNoteData($id,$pid,$lnid);
	if($result !== null){
		$dataResult = $result->get_result();
		if($dataResult->num_rows >= 1){
			$_SESSION['lnu_data'] = $dataResult->fetch_assoc();
		}
		$result->close();
		$conn->close();
	}
}
else if($_SESSION['page_name'] === 'Lecture Notes Page'){
	

	$result = getAllLectureNoteData($id,$pid);
	if($result !== null){
		$dataResult = $result->get_result();
		$out = [];
		$data = [];
		if($dataResult->num_rows >= 1){
				while($data = $dataResult->fetch_assoc()){
					$out[] = $data;
				}
				$_SESSION['ln_data'] = $out;
				
		}else{
			$_SESSION['ln_data'] = [];
		}
		$result->close();
		$conn->close();
	}
}
else if($_SESSION['page_name'] === 'Shared Lecture Notes Page'){
	$uid = $_SESSION['uid'];
	$_SESSION['ln_data']  = getAllJsonData($uid,get_fileName(),$pid);
}
else if($_SESSION['page_name'] === 'Show Lecture Notes Page'){
	$lnid = $_SESSION['ln_id'];
	$result = getLectureNoteData($id,$pid,$lnid);
	if($result !== null){
		$dataResult = $result->get_result();
		if($dataResult->num_rows >= 1){
			$_SESSION['lns_data']  = $dataResult->fetch_assoc();
		}
		$result->close();
		$conn->close();
	}
}
else if($_SESSION['page_name'] === 'Show Shared Lecture Notes Page'){
	$uid = $_SESSION['uid'];
	$lnid = $_SESSION['ln_id'];
	$_SESSION['lns_data']  = getSingleJsonData($uid,$lnid,get_fileName(),$pid);

}
header(getRouteUrl());
exit();
