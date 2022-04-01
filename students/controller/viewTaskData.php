<?php 
session_start();
require_once 'includes/routeTaskPage.php';
require_once '../model/dbDataAcess.php';
// require_once '../model/dataAcessType.php';
// set_type("f","../model/student_taskData.json");
$id = $_SESSION['id'] ?? '';
if($_SESSION['page_name'] === 'Update Task Page'){
	$tid = $_SESSION['t_id'];
	$result = getTaskData($id,$tid);
	
	if($result !== null){
		$dataResult = $result->get_result();
		if($dataResult->num_rows >= 1){
			$_SESSION['tu_data'] = $dataResult->fetch_assoc();
		}
		$result->close();
		$conn->close();
	}
}
else if($_SESSION['page_name'] === 'Daily tasks page'){
	$result = getAllTaskData($id);
	if($result !== null){
		$dataResult = $result->get_result();
		$out = [];
		$data = [];
		if($dataResult->num_rows >= 1){
				while($data = $dataResult->fetch_assoc()){
					$out[] = $data;
				}
				$_SESSION['t_data'] = $out;
				
		}else{
			$_SESSION['t_data'] = [];
		}
		$result->close();
		$conn->close();
	}
}
header(getRouteUrl());
exit();
