<?php
session_start();
$_SESSION['page_name'] = 'Daily tasks page';

require_once 'header.php'; 
require_once 'dataAcess.php';
require_once 'dataAcessType.php';
set_type("f","student_taskData.json");
$id = $_SESSION['id'] ?? '';
$task_data = getTaskData($id,get_fileName()) ?? [];
?>

<h3>Today's tasks for <?php echo $_SESSION['full_name'];?></h3>
<hr>
<a href="student_taskCreate.php">Create Task</a>
<hr>
<?php 
if(count($task_data) === 0){
	echo '<strong>No task added for today</strong>';
	require_once 'footer.php';
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
			echo "<a href=student_taskUpdate.php?id=$id>Update</a>";
			echo '&nbsp;';
			echo "<a href=student_taskDelete.php?id=$id>Delete</a>";
			echo '&nbsp;';
			echo '</td>';
			echo '</tr>';
		}
		?>
	</tbody>
</table>

<?php
require_once 'footer.php';
?>