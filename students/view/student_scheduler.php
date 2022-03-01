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
if(!isset($_SESSION['sw_data'])){
	header('Location: ../controller/viewWeeklyScheduleData.php');
	exit();
}
else{
	$sw_data = $_SESSION['sw_data'];
}
// var_dump($sw_data);
// exit();
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
	echo '<a href="">Add Class Schedule</a>';
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
	if(isset($sc_data)){

	}else{
		echo '<tr>';
		echo '<td>';
		echo 'None';
		echo '</td>';
		echo '<td>';
		echo 'None';
		echo '</td>';
		echo '<td>';
		echo 'None';
		echo '</td>';
		echo '<td>';
		echo 'None';
		echo '</td>';
		echo '<td>';
		echo 'None';
		echo '</td>';
		echo '<td>';
		echo 'None';
		echo '</td>';
		echo '<td>';
		echo 'None';
		echo '</td>';
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