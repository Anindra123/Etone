<?php 
			if(count($errors) === 0 && isset($_SESSION['success'])){
				echo '<br>';
				echo $_SESSION['success'];
				echo '<br><br>';
			}
			if(isset($_SESSION['m_errors']))
			{
				echo '<br>';
				echo $_SESSION['m_errors'];
				echo '<br><br>';
			}
?>

<br><br>
<form action="../controller/student_task_validation.php" method="post" onsubmit="return taskValidation(this)" novalidate>	
	<fieldset>
		<legend><?php echo $page_title;?></legend>
		<label for="tname">Task Title *:</label>
		<br><br>
		<input type="text" name="tname"id="tname" autofocus 
		value= "<?php echo $data['tname'] ?? '';?>">
		<br>
		<span class="err tn"><?php echo $errors['tname_err'] ?? ''; ?></span>
		<br><br>
		<label for="stime">Start time *:</label>
		<br><br>
		<input type="time" name="stime"id="stime" 
		value= "<?php echo date('H:i',strtotime($data['stime'])) ?? '';?>">
		<br>
		<span class="err st"><?php echo $errors['stime_err'] ?? ''; ?></span>
		<br><br>
		<label for="etime">End time *:</label>
		<br><br>
		<input type="time" name="etime"id="etime" 
		value= "<?php echo date('H:i',strtotime($data['etime'])) ?? '';?>">
		<br>
		<span class="err et"><?php echo $errors['etime_err'] ?? ''; ?></span>
		<br><br>
	</fieldset>
	<br>
	<input type="submit">
	&nbsp; <a href="student_tasks.php" style="pointer-events:initial;"><button type="button">Go back</button></a>
	<br>
</form>
<script src="scripts/tasks.js"></script>
