<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Etone : note management and planning app</title>
	<link rel="icon" type="image/x-icon" href="../../public/img/notes3.ico">
	<link rel="stylesheet" href="styles/style.css">
	<link rel="stylesheet" href="styles/header.css">
	<link rel="stylesheet" href="styles/footer.css">
	<link rel="stylesheet" href="styles/profile.css">
	<link rel="stylesheet" href="styles/lectureNote.css">
	<link rel="stylesheet" href="styles/classSchedule.css">
	<style>
		textarea{
			width: 90%;
			height: 200px;
			background-color: #f8f8f8;
			padding: 15px 20px 15px 20px;
			box-sizing: border-box;
			resize: none;
		}
		input[type=email],input[type=password],input[type=text]{
			width: 90%;
			padding: 10px;
			margin: auto;
			font-size: 1vw;
		}
		input[type=time],input[type=date]{
			width: 20%;
			padding: 10px;
		}
		input[type=search]{
			width: 50%;
			padding: 10px;
			margin: auto;
		}
		#goBack{
			text-align: left;
			width: 50%;
			margin: auto;
		}
		select{
			width: 30%;
			padding: 10px;
			border-radius: 4px;
			margin: auto;
			margin-bottom: 5px;
		}

	</style>
</head>
<body>
	<header>
		
		<div id="title">
			<img src="../../public/img/notes-icon.png" alt="notes icon" width="50" height="50">
			<h1>Etone : <i>A note management and planning app</i></h1>
		</div>				
		<nav>
			<a style="float: right;"href="logout.php">Log Out</a>
			<a style="float: right;" href="student_viewAccount.php">View profile</a>
			<a style="float: right;"href="student_updateAccount.php">Update profile</a>
			<a style="float: right;"href="student_changePass.php"> Change password</a>


			<!-- profile and page view and profile related navigation links -->
			<b>Hello, <?php echo $_SESSION['full_name'] ?? ""; ?></b>
			<b><?php echo $_SESSION['page_name'] ?? "";?></b>

			<a href="student_tasks.php">Daily Tasks</a>
			<a href="student_lecturePlanner.php">Lecture Planner</a>
			<a href="student_scheduler.php">Class Scheduler</a>

		</nav>
	</header>
