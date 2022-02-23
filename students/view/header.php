<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Etone : note management and planning app</title>
	<link rel="icon" type="image/x-icon" href="../public/img/notes3.ico">
</head>
<body>
	<header>
		<table>
			<tbody>
				<tr>
					<td>
						<img src="../public/img/notes-icon.png" alt="notes icon" width="50" height="50">
					</td>
					<td>
						<h1>Etone : <i>A note managment and planning app</i></h1>
					</td>
				</tr>
			</tbody>
		</table>
		<hr>
		<!-- profile and page view and profile related navigation links -->
		<p>&nbsp;<b>Hello, <?php echo $_SESSION['full_name'] ?? ""; ?></b> &nbsp; 
			<b><?php echo $_SESSION['page_name'] ?? "";?></b>
			
			
				&nbsp;
				<a href="student_viewAccount.php">View profile</a>&nbsp;
				<a href="student_updateAccount.php">Update profile</a> &nbsp;
				<a href="student_changePass.php"> Change password </a>&nbsp;
				<a href="logout.php">Log Out</a>&nbsp; 
				</p> 
			
			<hr>
			<!-- menu navigation !-->
			<br>
			<nav>
				&nbsp;
				<a href="student_tasks.php">Daily Tasks</a>&nbsp;
				<a href="">Menu 2</a>&nbsp;
				<a href="">Menu 3</a>&nbsp;
				<a href="">Menu 4</a>&nbsp;
			</nav>
			<br>
			<hr>
		</header>
