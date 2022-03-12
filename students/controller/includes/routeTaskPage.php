<?php 

function getRouteUrl(){
	$url = "";

	switch ($_SESSION['page_name']) {
		case 'Update Note Group Page':
			$url = 'Location: ../view/student_updateNoteGroup.php';
			break;
		case 'Show Shared Lecture Notes Page':
			$url = 'Location: ../view/student_sharedNoteShow.php';
			break;
		case 'Shared Lecture Notes Page':
			$url = 'Location: ../view/student_sharedNote.php';
			break;
		case 'Note Group Users Page':
			$url = 'Location: ../view/student_noteGroupUsers.php';
			break;
		case 'Note Group Page':
			$url = 'Location: ../view/student_noteGroup.php';
			break;
		case 'Create Note Group Page':
			$url = 'Location: ../view/student_createNoteGroup.php';
			break;
		case 'Update Task Page':
			$url = 'Location: ../view/student_taskUpdate.php';
			break;
		case 'Create Task Page':
			$url = 'Location: ../view/student_taskCreate.php';
			break;
		case 'Daily tasks page':
			$url = 'Location: ../view/student_tasks.php';
			break;
		case 'Update Lecture Plan Page':
			$url = 'Location: ../view/student_lecturePlanUpdate.php';
			break;
		case 'Create Lecture Plan Page':
			$url = 'Location: ../view/student_lecturePlanCreate.php';
			break;
		case 'Lecture Planner Page':
			$url = 'Location: ../view/student_lecturePlanner.php';
			break;
		case 'Lecture Notes Page':
			$url = 'Location: ../view/student_lectureNotes.php';
			break;
		case 'Create Lecture Notes Page':
			$url = 'Location: ../view/student_lectureNoteCreate.php';
			break;
		case 'Update Lecture Notes Page':
			$url = 'Location: ../view/student_lectureNoteUpdate.php';
			break;
		case 'Show Lecture Notes Page':
			$url = 'Location: ../view/student_lectureNoteShow.php';
			break;
		case 'Create Schedule Week Page':
			$url = 'Location: ../view/student_scheduleCreate.php';
			break;
		case 'Update Schedule Week Page':
			$url = 'Location: ../view/student_scheduleUpdate.php';
			break;
		case 'Class Scheduler Page':
			$url = 'Location: ../view/student_scheduler.php';
			break;
		case 'Create Class Schedule Page':
			$url = 'Location: ../view/student_classScheduleCreate.php';
			break;
		case 'Update Class Schedule Page':
			$url = 'Location: ../view/student_classScheduleUpdate.php';
			break;
		default:
			$url = 'Location: ../view/logout.php';
			break;
	}
	return $url;
}