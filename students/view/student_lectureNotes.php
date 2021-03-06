<?php 
session_start();
$_SESSION['page_name'] = 'Lecture Notes Page';
$ln_data = [];
$data = [];
$sname = '';
if(!isset($_SESSION['id'])){
	header('Location: index.php');
	$_SESSION['m_errors'] = get_failure('Error in login ');
	exit();
}

if(isset($_GET['lpid'])){
	$_SESSION['pid'] = +$_GET['lpid'];

}

if(isset($_GET['name'])){
	$_SESSION['sname'] = $_GET['name'];
}
if(!isset($_SESSION['ln_data'])){
	header('Location: ../controller/viewLectureNoteData.php');
	exit();
}
else{
	$ln_data = $_SESSION['ln_data'];
}

$errors = $_SESSION['ln_errors'] ?? [];
require_once 'includes/header.php';
?>

<h3>Showing all notes for <?php echo $_SESSION['sname'];?></h3>
<a href="student_lectureNoteCreate.php" style="pointer-events:initial"><button>Add new note</button></a>
&nbsp;
<a href="student_lecturePlanner.php" style="pointer-events:initiall"><button>Go Back</button></a>
<br><br>
<form action="../controller/noteSearch.php" method="get" onsubmit="validateAndSearchNote(this);return false;" novalidate>
	<label for="n_name">Search for a note by name :</label>
	<input type="search" name="n_name" value="">
	&nbsp;
	<input type="submit" name="search" value="search">
	&nbsp;
	<br><br>
</form>
<span class="err ns"><?php echo $errors['search_err'] ?? ''; ?></span>
<script src="scripts/searchNote.js"></script>
<br><br>
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
if(count($ln_data) === 0){
	if(isset($_SESSION['success'])){
		unset($_SESSION['success']);
	}
	if(isset($_SESSION['m_errors'])){
		unset($_SESSION['m_errors']);
	}
	if(isset($_SESSION['ln_data'])){
		unset($_SESSION['ln_data']);
	}
	if(isset($_SESSION['ln_errors'])){
		unset($_SESSION['ln_errors']);
	}	
	echo '<strong>No lecture notes added</strong>';
	require_once 'includes/footer.php';
	exit();
}

?>
<div id="noteData">
<table>
	<thead>
		<tr>
			<th>Notes</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$j = 0;
		for ($i=0; $i < count($ln_data); $i++) { 
				echo '<tr>';
				$id = $ln_data[$i]['id'];
				echo '<td>';
				echo $ln_data[$i]['tname'];
				echo '</td>';
				echo '<td>';
				echo "<a href='student_lectureNoteShow.php?ln_id=$id' style='pointer-events: initial;'><button>View</button></a>";
				echo '&nbsp;';
				echo "<a href='student_lectureNoteUpdate.php?ln_id=$id' style='pointer-events: initial;'><button>Update</button></a>";
				echo '&nbsp;';
				echo "<a href='../controller/lectureNote_delete.php?ln_id=$id' style='pointer-events: initial;'><button style='background-color: indianred;'>Delete</button></a>";
				echo '&nbsp;';
				echo '</td>';
				echo '</tr>';
			}

		?>
	</tbody>
</table>
</div>

<?php
if(isset($_SESSION['ln_data'])){
	unset($_SESSION['ln_data']);
}
if(isset($_SESSION['success'])){
	unset($_SESSION['success']);
}
if(isset($_SESSION['m_errors'])){
	unset($_SESSION['m_errors']);
}
if(isset($_SESSION['ln_errors'])){
	unset($_SESSION['ln_errors']);
}
require_once 'includes/footer.php';

?>