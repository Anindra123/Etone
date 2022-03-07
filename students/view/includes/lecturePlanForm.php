<form action="../controller/lecturePlan_validation.php" method="post" novalidate>	
	<fieldset>
		<span>
			<?php 
			if(count($errors) === 0 && isset($_SESSION['success'])){
				echo '<br>';
				echo $_SESSION['success'];
				echo '<br><br>';
			}
			?>
		</span>
		<legend><?php echo $page_title;?></legend>
		<label for="sname">Subject name*:</label>
		<br><br>
		<input type="text" name="sname"id="sname" autofocus 
		value= "<?php echo $data['sname'] ?? '';?>">
		<br>
		<span><?php echo $errors['sname_err'] ?? ''; ?></span>
		<br><br>
		<label for="topics">Add topics covered :</label>
		<br><br>
		<textarea name="topics" id="topics"><?php echo $data['topics'] ?? '';?></textarea>
		<br>
		<span><?php echo $errors['topics_err'] ?? ''; ?></span>
	</fieldset>
	<br>
	<input type="submit">
	&nbsp; <a href="student_lecturePlanner.php">Go back</a>
	<br>
</form>