<?php 
session_start();

$_SESSION['page_name'] = 'Class Scheduler Page';
if(!isset($_SESSION['id'])){
	header('Location: index.php');
	$_SESSION['m_errors'] = get_failure('Error in login ');
	exit();
}
$sw_data = [];
$sc_data = [];
$w_data = [];
if(!isset($_SESSION['sw_data']) && !isset($_SESSION['sc_data']) && !isset($_SESSION['week_data'])){
	header('Location: ../controller/viewWeeklyScheduleData.php');
	exit();
}
else{
	$sw_data = $_SESSION['sw_data'];
	$sc_data = $_SESSION['sc_data'];
	$w_data = $_SESSION['week_data'] ?? [];
}
function showClassSchedule($data){
	$id = $data['id'];
	echo '<td class=>';
	echo '<i>'.$data['cname'].'</i>';
	echo '<br>';
	echo 'Remainder : '.$data['rname'];
	echo '<br>';
	echo '<b>Start time</b>: '.date('h:i A',strtotime($data['stime'])) ?? '';
	echo '<br>';
	echo '<b>End time</b>: '.date('h:i A',strtotime($data['etime'])) ?? '';
	echo '<br>';
	echo "<a href='student_classScheduleUpdate.php?sc_id=$id' style='pointer-events: initial;'><button>Update</button></a>";
	echo '&nbsp;';
	echo "<a href='../controller/classSchedule_delete.php?sc_id=$id' style='pointer-events: initial;'><button style='background-color: indianred;'>Delete</button></a>";
	echo '</td>';
}

require_once 'includes/header.php';
?>
<h3>Showing this weeks schedule for <?php echo $_SESSION['full_name'];?></h3>

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
	$_SESSION['sw_id'] = $sw_data[0]['id'];
	echo "<div class='schedulerMenu'>";
	echo "<a href='student_classScheduleCreate.php' style='pointer-events: initial;'><button style='float: left;'>Add Class Schedule</button></a>";
	echo "<a href='../controller/schedule_delete.php?clear=true' style='pointer-events: initial;'><button style='float: left;'>Clear Schedule</button></a>";
	echo "<div class='scheduleText'>";
	echo "<span><b>Week :</b>".$sw_data[0]['wname'] ?? ''."</span>";

	echo "<span><b>Start date :</b>".date('Y-m-d',strtotime($sw_data[0]['sdate'])) ?? ''."</span>";

	echo "<span><b>End date :</b>".date('Y-m-d',strtotime($sw_data[0]['edate'])) ?? ''."</span>";
	echo "</div>";

	

	echo "<a href='student_scheduleUpdate.php' style='pointer-events: initial;'><button style='float: right;'>Update Schedule</button></a>";

	echo "<a href='../controller/schedule_delete.php' style='pointer-events: initial;'><button style='float: right;background-color: indianred;'>Delete Schedule</button></a>";

	echo '</div>';
	echo "<table class='classSchedule'>";
	echo '<tbody>';
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
			$weekday = $w_data[$sc_data[$j]['id']];
			$k = 0;
			for ($i=1; $i < 8; $i++) {		
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
	echo "<a href='student_scheduleCreate.php' style='pointer-events:initial'><button>Create Schedule</button></a>";
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
if(isset($_SESSION['week_data'])){
	unset($_SESSION['week_data']);
}
require_once 'includes/footer.php';
?>