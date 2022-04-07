<?php
session_start();

if(!isset($_SESSION['id'])){
	header('Location: index.php');
	$_SESSION['m_errors'] = get_failure('Error in login ');
	exit();
}

$_SESSION['page_name'] = 'Daily tasks page';

$task_data = [];
if(!isset($_SESSION['t_data'])){
	header('Location: ../controller/viewTaskData.php');
	exit();
}else{
	// var_dump($_SESSION['t_data']);
	// exit();
	$task_data = $_SESSION['t_data'];
}
require_once 'includes/header.php'; 
?>

<h3>Today's tasks for <?php echo $_SESSION['full_name'];?></h3>
<a style="pointer-events: initial;display: block; margin: 20px;" href="student_taskCreate.php"><button>Create Task</button></a>
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
	require_once 'includes/footer.php';
	exit();
}

?>

<table>
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
			$id = $task_data[$i]['id'];
			echo '<tr>';
			echo '<td>';
			echo $task_data[$i]['tname'];
			echo '</td>';
			echo '<td>';
			echo date('g:i a',strtotime($task_data[$i]['stime']));
			echo '</td>';
			echo '<td>';
			echo date('g:i a',strtotime($task_data[$i]['etime']));
			echo '</td>';
			echo '<td>';
			echo $task_data[$i]['status'];
			echo '</td>';
			echo '<td>';
			echo date('d-m-y',strtotime($task_data[$i]['date']));
			echo '</td>';
			echo '<td>';
			echo "<a style='pointer-events: initial;' href=../controller/student_taskComplete.php?t_id=$id><button>Complete</button></a>";
			echo '&nbsp;';
			echo "<a style='pointer-events: initial;' href=student_taskUpdate.php?t_id=$id><button>Update</button></a>";
			echo '&nbsp;';
			echo "<a style='pointer-events: initial;' href=../controller/student_taskDelete.php?t_id=$id><button style='background-color: indianred;'>Delete</button></a>";
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
require_once 'includes/footer.php';

?>