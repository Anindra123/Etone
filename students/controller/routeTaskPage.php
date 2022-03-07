<?php 

function getRouteUrl(){
	$url = "";
	if($_SESSION['page_name'] === 'Update Task Page'){
		$url = 'Location: ../view/student_taskUpdate.php';
	}
	else if($_SESSION['page_name'] === 'Create Task Page'){
		$url = 'Location: ../view/student_taskCreate.php';
	}
	else if($_SESSION['page_name'] === 'Daily tasks page'){
		$url = 'Location: ../view/student_tasks.php';
	}
	else if($_SESSION['page_name'] === 'Update Lecture Plan Page'){
		$url = 'Location: ../view/student_lecturePlanUpdate.php';
	}
	else if($_SESSION['page_name'] === 'Create Lecture Plan Page'){
		$url = 'Location: ../view/student_lecturePlanCreate.php';
	}
	else if($_SESSION['page_name'] === 'Lecture Planner Page'){
		$url = 'Location: ../view/student_lecturePlanner.php';
	}
	else if($_SESSION['page_name'] === 'Lecture Notes Page'){
		$url = 'Location: ../view/student_lectureNotes.php';
	}
	else if($_SESSION['page_name'] === 'Create Lecture Notes Page'){
		$url = 'Location: ../view/student_lectureNoteCreate.php';
	}
	else if($_SESSION['page_name'] === 'Update Lecture Notes Page'){
		$url = 'Location: ../view/student_lectureNoteUpdate.php';
	}
	else if($_SESSION['page_name'] === 'Show Lecture Notes Page'){
		$url = 'Location: ../view/student_lectureNoteShow.php';
	}
	else if($_SESSION['page_name'] === 'Create Schedule Week Page'){
		$url = 'Location: ../view/student_scheduleCreate.php';
	}
	else if($_SESSION['page_name'] === 'Update Schedule Week Page'){
		$url = 'Location: ../view/student_scheduleUpdate.php';
	}
	else if($_SESSION['page_name'] === 'Class Scheduler Page'){
		$url = 'Location: ../view/student_scheduler.php';
	}
	else if($_SESSION['page_name'] === 'Create Class Schedule Page'){
		$url = 'Location: ../view/student_classScheduleCreate.php';
	}
	else if($_SESSION['page_name'] === 'Update Class Schedule Page'){
		$url = 'Location: ../view/student_classScheduleUpdate.php';
	}
	return $url;
}