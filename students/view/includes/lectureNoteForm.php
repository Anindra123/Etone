<?php 
			if(count($errors) === 0 && isset($_SESSION['success'])){
				echo '<br>';
				echo $_SESSION['success'];
				echo '<br><br>';
			}
?>
<br><br>
<form action="../controller/lectureNotes_validation.php" method="post" onsubmit="return validateLectureNote(this)" novalidate>	
	<fieldset>
		<legend><?php echo $page_title;?></legend>
		<label for="tname">Topic name *:</label>
		<br><br>
		<input type="text" name="tname"id="tname" autofocus 
		value= "<?php echo $data['tname'] ?? '';?>">
		<br>
		<span class="err tn"><?php echo $errors['tname_err'] ?? ''; ?></span>
		<br><br>
		<label for="ldate">Lecture Date :</label>
		<br><br>
		<input type="date" name="ldate"id="ldate"
		value= "<?php echo date('Y-m-d',strtotime($data['ldate'])) ?? '';?>">
		<br>
		<span class="err ld"><?php echo $errors['ldate_err'] ?? ''; ?></span>
		<br><br>
		<label for="ltime">Lecture Time :</label>
		<br><br>
		<input type="time" name="ltime"id="ltime" autofocus 
		value= "<?php echo date('H:i',strtotime($data['ltime'])) ?? '';?>">
		<br>
		<span class="err lt"><?php echo $errors['ltime_err'] ?? ''; ?></span>
		<br><br>
		<label for="notes">Write note below * :</label>
		<br><br>
		<textarea rows="20" cols="50" name="notes" id="notes" placeholder="Write note here"><?php echo $data['notes'] ?? '';?></textarea>
		<br>
		<span class="err ln"><?php echo $errors['notes_err'] ?? ''; ?></span>
	</fieldset>
	<br>
	<input type="submit">
	&nbsp; <a href="student_lectureNotes.php" style="pointer-events:initial"><button type="button">Go back</button></a>
	<br>
</form>

<script src="scripts/lectureNote.js"></script>