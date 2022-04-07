<form action="../controller/classSchedule_validation.php" method="post" novalidate>	
	<fieldset>
		<span>
			<?php 
			if(count($errors) === 0 && isset($_SESSION['success'])){
				echo '<br>';
				echo $_SESSION['success'];
				echo '<br><br>';
			}
			if(isset($_SESSION['m_errors'])){
				echo '<br>';
				echo $_SESSION['m_errors'];
				echo '<br><br>';
			}
			?>
		</span>
		<legend><?php echo $page_title;?></legend>
		<label for="cname">Class name *:</label>
		<br><br>
		<input type="text" name="cname"id="cname" autofocus 
		value= "<?php echo $data['cname'] ?? '';?>">
		<br>
		<span><?php echo $errors['cname_err'] ?? ''; ?></span>
		<br><br>
		<label for="stime">Start time *:</label>
		<br><br>
		<input type="time" name="stime"id="stime" 
		value= "<?php echo date('H:i',strtotime($data['stime'])) ?? '';?>">
		<br>
		<span><?php echo $errors['stime_err'] ?? ''; ?></span>
		<br><br>
		<label for="etime">End time *:</label>
		<br><br>
		<input type="time" name="etime"id="etime" 
		value= "<?php echo date('H:i',strtotime($data['etime'])) ?? '';?>">
		<br>
		<span><?php echo $errors['etime_err'] ?? ''; ?></span>
		<br><br>
		<label for="rname">Remainder :</label>
		<br><br>
		<input type="text" name="rname"id="rname" autofocus 
		value= "<?php echo $data['rname'] ?? '';?>">
		<br>
		<span><?php echo $errors['rname_err'] ?? ''; ?></span>
		<br><br>
		<label for="weekday">Week days * :</label>
		<input type="checkbox" name="weekday[1]" value=
		"Sun" id="sun">
		<label for="sun">Sun</label>
		&nbsp;
		<input type="checkbox" name="weekday[2]" value=
		"Mon" id="mon">
		<label for="mon">Mon</label>
		&nbsp;
		<input type="checkbox" name="weekday[3]" value=
		"Tue" id="tue">
		<label for="tue">Tue</label>
		&nbsp;
		<input type="checkbox" name="weekday[4]" value=
		"Wed" id="wed">
		<label for="wed">Wed</label>
		&nbsp;
		<input type="checkbox" name="weekday[5]" value=
		"Thu" id="thu">
		<label for="thu">Thu</label>
		&nbsp;
		<input type="checkbox" name="weekday[6]" value=
		"Fri" id="fri">
		<label for="fri">Fri</label>
		&nbsp;
		<input type="checkbox" name="weekday[7]" value=
		"Sat" id="sat">
		<label for="sat">Sat</label>
		&nbsp;
		<span><?php echo $errors['weekday_err'] ?? ''; ?></span>
		<br><br>
	</fieldset>
	<br>
	<input type="submit">
	&nbsp; <a href="student_scheduler.php">Go back</a>
	<br>
</form>