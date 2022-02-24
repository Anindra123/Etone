<form action="../controller/student_task_validation.php" method="post" novalidate>	
	<fieldset>
		<span>
			<?php 
			if(count($errors) === 0 && isset($_SESSION['success'])){
				echo '<br>';
				echo $_SESSION['success'];
				echo '<br><br>';
				unset($_SESSION['success']);
			}?>
		</span>
		<legend><?php echo $page_title;?></legend>
		<label for="tname">Task Title *:</label>
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
	</fieldset>
	<br>
	<input type="submit">
	&nbsp; <a href="student_tasks.php">Go back</a>
	<br>
</form>