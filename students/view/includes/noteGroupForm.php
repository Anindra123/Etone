<form action="../controller/searchStudentData.php" method="get" novalidate>
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
		<legend>Add Members</legend>
		<br><br>
		<input type="search" name="mail"id="mail" 
		>
		&nbsp;
		<input type="submit">
		&nbsp;
		<span><?php echo $errors['mail_err'] ?? ''; ?></span>
		<br><br>
		
		<label>Current Group Members :</label>
		<?php
		$g_users = $_SESSION['g_users'] ?? [];
		if(count($g_users) > 0){
			echo '<ol>';
			for ($i=0; $i < count($g_users); $i++) { 
				$user = $g_users[$i];
				if($user['role'] === 'gc'){
					echo '<li>';
					echo $user['name'].' (Group Creator)';
					echo '</li>';
				}
				else{
					echo '<li>';
					echo $user['name'].' (Note Viewer)';
					echo '</li>';
				}
			}
			echo '</ol>';
		}else{
			echo '<b>No Group Members added currently</b>';
		}
		?>
	</fieldset>
</form>

<form action="../controller/noteGroup_validation.php" method="post" novalidate>	
	<fieldset>
		<legend><?php echo $page_title;?></legend>
		<label for="gname">Group name*:</label>
		<br><br>
		<input type="text" name="gname"id="gname" autofocus 
		value= "<?php echo $data['gname'] ?? '';?>">
		<br>
		<span><?php echo $errors['gname_err'] ?? ''; ?></span>
		<br><br>
		<label>Content Permission * :</label>
		&nbsp;
		<input type="checkbox" name="con_per" value="view" id="view">
		<label for="view">View</label>
		<br>
		<span><?php echo $errors['con_per_err'] ?? ''; ?></span>
	</fieldset>
	<br>
	<input type="submit">
	&nbsp; <a href="student_noteGroup.php">Go back</a>
	<br>
</form>