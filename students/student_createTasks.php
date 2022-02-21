<?php 
session_start();
$_SESSION['page_name'] = 'Create Task Page';
$id = $_SESSION['id'] ?? '';
require_once 'header.php';
require_once 'dataAcess.php';
?>
<form>
	<fieldset>
		<legend>Create New Task :</legend>
		<label for="tname">Task title *:</label>
		<br><br>
		<input type="text" name="tname"id="tname" autofocus 
		value= "<?php echo $data['tname'] ?? '';?>">
		<br>
		<span><?php echo $errors['tname_err'] ?? ''; ?></span>
		<br><br>
		<label for="stime">Start time *:</label>
		<br><br>
		<input type="time" name="stime"id="stime" 
		value= "<?php echo $data['stime'] ?? '';?>">
		<br>
		<span><?php echo $errors['stime_err'] ?? ''; ?></span>
		<br><br>
		<label for="etime">End time *:</label>
		<br><br>
		<input type="time" name="etime"id="etime" 
		value= "<?php echo $data['etime'] ?? '';?>">
		<br>
		<span><?php echo $errors['etime_err'] ?? ''; ?></span>
		<br><br>
		<br>
		<button type="submit">Create Task</button>
		&nbsp;
		<a href="student_tasks.php">Go back</a>
		<br><br>
	</fieldset>
</form>




<?php
require_once 'footer.php';
?>  