<?php 
			if(count($errors) === 0 && isset($_SESSION['success'])){
				echo '<br>';
				echo $_SESSION['success'];
				echo '<br><br>';
			}
?>
<br><br>
<form action="../controller/lecturePlan_validation.php" method="post" onsubmit="return validateLecturePlan(this)" novalidate>	
	<fieldset>
		<legend><?php echo $page_title;?></legend>
		<label for="sname">Subject name*:</label>
		<br><br>
		<input type="text" name="sname"id="sname" autofocus 
		value= "<?php echo $data['sname'] ?? '';?>">
		<br>
		<span class="err sn"><?php echo $errors['sname_err'] ?? ''; ?></span>
		<br><br>
		<label for="topics">Add topics covered :</label>
		<br><br>
		<textarea name="topics" id="topics"><?php echo $data['topics'] ?? '';?></textarea>
		<br>
		<span class="err ts"><?php echo $errors['topics_err'] ?? ''; ?></span>
	</fieldset>
	<br>
	<input type="submit">
	&nbsp; <a href="student_lecturePlanner.php" style="pointer-events:initial;"><button type="button">Go back</button></a>
	<br>
</form>
<script src="scripts/lecturePlan.js"></script>