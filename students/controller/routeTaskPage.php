<?php 

function getRouteUrl(){
	$url = "";
	if($_SESSION['page_name'] === 'Update Task Page'){
		$url = 'Location: ../view/student_taskUpdate.php';
	}
	else if($_SESSION['page_name'] === 'Create Task Page'){
		$url = 'Location: ../view/student_taskCreate.php';
	}
	else{
		$url = 'Location: ../view/student_tasks.php';
	}
	return $url;
}