<?php 
session_start();
$_SESSION['page_name'] = 'Class Scheduler Page';
if(!isset($_SESSION['id'])){
	header('Location: index.php');
	$_SESSION['m_errors'] = get_failure('Error in login ');
	exit();
}
$sw_data = Null;
$sc_data = Null;
if(!isset($_SESSION['sw_data']) && !isset($_SESSION['sc_data'])){
	header('Location: ../controller/viewWeeklyScheduleData.php');
	exit();
}
else{
	$sw_data = $_SESSION['sw_data'];
	$sc_data = $_SESSION['sc_data'];
}
function showClassSchedule($data){
	$id = $data->id;
	echo '<td>';
	echo '<i>'.$data->cname.'</i>';
	echo '<br>';
	echo 'Remainder : '.$data->rname;
	echo '<br>';
	echo '<b>Start time</b>: '.date('h:i A',strtotime($data->stime)) ?? '';
	echo '<br>';
	echo '<b>End time</b>: '.date('h:i A',strtotime($data->etime)) ?? '';
	echo '<br>';
	echo "<a href=student_classScheduleUpdate.php?sc_id=$id>Update</a>";
	echo '&nbsp;';
	echo "<a href=../controller/classSchedule_delete.php?sc_id=$id>Delete</a>";
	echo '</td>';
}

require_once 'includes/header.php';
?>
<h3>Showing this weeks schedule for <?php echo $_SESSION['full_name'];?></h3>
<hr>
<?php
if(isset($_SESSION['success'])){
	echo '<br>';
	echo $_SESSION['success'];
	echo '<br><br>';
}
if(isset($_SESSION['m_errors'])){
	echo '<br>';
	echo $_SESSION['m_errors'];
	echo '<br><br>';
}
if(count($sw_data) > 0){
	$_SESSION['sw_id'] = $sw_data[0]->id;
	echo '<table border=1>';
	echo '<tbody>';
	echo '<tr>';
	echo '<td>';
	echo '<a href="student_classScheduleCreate.php">Add Class Schedule</a>';
	echo '</td>';
	echo '<td>';
	echo '<b>Week :</b>'.$sw_data[0]->wname ?? '';
	echo '</td>';
	echo '<td colspan="2">';
	echo '<b>Start date :</b>'.$sw_data[0]->sdate.'&nbsp;&nbsp;&nbsp;' ?? '';

	echo '<b>End date :</b>'.$sw_data[0]->edate ?? '';
	echo '</td>';
	echo '<td>';
	echo '<a href="student_scheduleUpdate.php">Update Schedule</a>';
	echo '</td>';
	echo '<td>';
	echo '<a href="../controller/schedule_delete.php">Delete Schedule</a>';
	echo '</td>';
	echo '<td>';
	echo '<a href="../controller/schedule_delete.php?clear=true">Clear Schedule</a>';
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>';
	echo 'Sunday';
	echo '</th>';
	echo '<th>';
	echo 'Monday';
	echo '</th>';
	echo '<th>';
	echo 'Tuesday';
	echo '</th>';
	echo '<th>';
	echo 'Wednesday';
	echo '</th>';
	echo '<th>';
	echo 'Thursday';
	echo '</th>';
	echo '<th>';
	echo 'Friday';
	echo '</th>';
	echo '<th>';
	echo 'Saturday';
	echo '</th>';
	echo '</tr>';
	if(count($sc_data) > 0){
		for ($j=0; $j < count($sc_data); $j++) { 
			echo '<tr>';
			$weekday =(array)$sc_data[$j]->weekday;
			$k = 0;
			for ($i=1; $i < 8; $i++) {

// 				if($k < count($weekday) 
// 					&& $weekday[$k] === 'Sun' 
// 					&& $i === 1){
// 					showClassSchedule($sc_data[$j]);
// 				$k++;
// 			}
// 			else if($k < count($weekday)
// 				&& $weekday[$k] === 'Mon'&& $i === 2){
// 				showClassSchedule($sc_data[$j]);
// 			$k++;
// 		}
// 		else if($k < count($weekday) 
// 			&& $weekday[$k] === 'Tue'&& $i === 3){
// 			showClassSchedule($sc_data[$j]);
// 		$k++;
// 	}
// 	else if($k < count($weekday) 
// 		&& $weekday[$k] === 'Wed'&& $i === 4){
// 		showClassSchedule($sc_data[$j]);
// 	$k++;
// }
// else if($k < count($weekday) 
// 	&& $weekday[$k] === 'Thu'&& $i === 5){
// 	showClassSchedule($sc_data[$j]);
// $k++;
// }
// else if($k < count($weekday) 
// 	&& $weekday[$k] === 'Fri'&& $i === 6){
// 	showClassSchedule($sc_data[$j]);
// $k++;
// }
// else if($k < count($weekday) 
// 	&& $weekday[$k] === 'Sat'&& $i === 7){
// 	showClassSchedule($sc_data[$j]);
// $k++;
// }			
				if(array_key_exists($i, $weekday)){
					showClassSchedule($sc_data[$j]);
				}
				else{
					echo '<td>';
					echo 'None';
					echo '</td>';
				}


			}
			echo'</tr>';
		}
	}else{
		echo '<tr>';
		for ($i=0; $i < 7; $i++) { 
			echo '<td>';
			echo 'None';
			echo '</td>';
		}
		echo '</tr>';
	}
	echo '<tbody>';
	echo '</table>';
}else{
	echo '<br>';
	echo '<b>No weekly schedule created</b>';
	echo '<br><br>';
	echo '<a href=student_scheduleCreate.php>Create Schedule</a>';
	echo '<br><br>';
}
if(isset($_SESSION['success'])){
	unset($_SESSION['success']);
}
if(isset($_SESSION['m_errors'])){
	unset($_SESSION['m_errors']);
}

if(isset($_SESSION['sw_data'])){
	unset($_SESSION['sw_data']);
}
if(isset($_SESSION['sc_data'])){
	unset($_SESSION['sc_data']);
}
require_once 'includes/footer.php';
?>