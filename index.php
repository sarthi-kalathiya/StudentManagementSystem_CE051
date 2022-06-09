<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
	<link rel="stylesheet" href="css/login.css">
	<link rel="icon" type="image/x-icon" href="images/f1.png">

</head>

<body>
	<center><br><br>
		<div class="login">
			<h1>Student Management System</h1><br>
			<form method="post">
				<button type="submit" class="btn btn-primary btn-block btn-large" name="admin_login">Admin Login</button>
				<button type="submit" class="btn btn-primary btn-block btn-large" name="student_login">Student Login</button>

			</form>
		</div>
		<?php
		if (isset($_POST['admin_login'])) {
			header("Location: admin_login.php");
		}
		if (isset($_POST['student_login'])) {
			header("Location: student_login.php");
		}
		?>
	</center>
</body>

</html>