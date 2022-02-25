<?php
session_start();
$_SESSION['page_name'] = 'Daily tasks page';

$task_data = [];
if(!isset($_SESSION['t_data'])){
	header('Location: ../controller/viewTaskData.php');
	exit();
}else{
	$task_data = $_SESSION['t_data'];
}
require_once 'header.php'; 
?>

<h3>Today's tasks for <?php echo $_SESSION['full_name'];?></h3>
<hr>
<a href="student_taskCreate.php">Create Task</a>
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
if(count($task_data) === 0){
	if(isset($_SESSION['success'])){
		unset($_SESSION['success']);
	}
	if(isset($_SESSION['m_errors'])){
		unset($_SESSION['m_errors']);
	}
	echo '<strong>No task added for today</strong>';
	require_once 'footer.php';
	exit();
}

?>

<table border="1">
	<thead>
		<tr>
			<th>Title</th>
			<th>Start Time</th>
			<th>End Time</th>
			<th>Status</th>
			<th>Date</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		for ($i=0; $i < count($task_data); $i++) { 
			$id = $task_data[$i]->id;
			echo '<tr>';
			echo '<td>';
			echo $task_data[$i]->tname;
			echo '</td>';
			echo '<td>';
			echo $task_data[$i]->stime;
			echo '</td>';
			echo '<td>';
			echo $task_data[$i]->etime;
			echo '</td>';
			echo '<td>';
			echo $task_data[$i]->status;
			echo '</td>';
			echo '<td>';
			echo $task_data[$i]->date;
			echo '</td>';
			echo '<td>';
			echo "<a href=../controller/student_taskComplete.php?t_id=$id>Complete</a>";
			echo '&nbsp;';
			echo "<a href=student_taskUpdate.php?t_id=$id>Update</a>";
			echo '&nbsp;';
			echo "<a href=../controller/student_taskDelete.php?t_id=$id>Delete</a>";
			echo '&nbsp;';
			echo '</td>';
			echo '</tr>';
		}
		?>
	</tbody>
</table>

<?php
if(isset($_SESSION['t_data'])){
	unset($_SESSION['t_data']);
}
if(isset($_SESSION['success'])){
	unset($_SESSION['success']);
}
if(isset($_SESSION['m_errors'])){
	unset($_SESSION['m_errors']);
}
require_once 'footer.php';

?>