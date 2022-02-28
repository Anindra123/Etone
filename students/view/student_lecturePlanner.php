<?php 
session_start();
$_SESSION['page_name'] = 'Lecture Planner Page';
$lp_data = [];
if(!isset($_SESSION['id'])){
	header('Location: index.php');
	$_SESSION['m_errors'] = get_failure('Error in login ');
	exit();
}
if(!isset($_SESSION['lp_data'])){
	header('Location: ../controller/viewLecturePlannerData.php');
	exit();
}
else{
	$lp_data = $_SESSION['lp_data'];
}
require_once 'includes/header.php';
?>

<h3>Showing all lecture plan of <?php echo $_SESSION['full_name'];?></h3>
<hr>
<a href="student_lecturePlanCreate.php">Add new lecture plan</a>
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
if(count($lp_data) === 0){
	if(isset($_SESSION['success'])){
		unset($_SESSION['success']);
	}
	if(isset($_SESSION['m_errors'])){
		unset($_SESSION['m_errors']);
	}
	echo '<strong>No lecture plan created</strong>';
	require_once 'includes/footer.php';
	exit();
}

?>
<table border="1">
	<thead>
		<tr>
			<th>Subject Name</th>
			<th>Topics Covered</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		for ($i=0; $i < count($lp_data); $i++) { 
			$id = $lp_data[$i]->id;
			$sname = $lp_data[$i]->sname;
			//$q1 = $
			echo '<tr>';
			echo '<td>';
			echo $lp_data[$i]->sname;
			echo '</td>';
			echo '<td>';
			echo $lp_data[$i]->topics;
			echo '</td>';
			echo '<td>';
			echo "<a href=student_lectureNotes.php?lpid=$id&name=$sname>Check notes</a>";
			echo '&nbsp;';
			echo "<a href=student_lecturePlanUpdate.php?lp_id=$id>Update</a>";
			echo '&nbsp;';
			echo "<a href=../controller/lecturePlan_delete.php?lp_id=$id>Delete</a>";
			echo '&nbsp;';
			echo '</td>';
			echo '</tr>';
		}
		?>
	</tbody>
</table>

<?php
if(isset($_SESSION['lp_data'])){
	unset($_SESSION['lp_data']);
}
if(isset($_SESSION['success'])){
	unset($_SESSION['success']);
}
if(isset($_SESSION['m_errors'])){
	unset($_SESSION['m_errors']);
}
require_once 'includes/footer.php';

?>