<head>
	<title>Student Dashboard</title>
	<link rel="stylesheet" href="css/stu_dash.css">
	<link rel="icon" type="image/x-icon" href="images/f2.png">
	<?php
	session_start();
	if (!isset($_SESSION['emails'])) {
		header("Location:student_login.php");
	}

	$_SESSION['timeout'] = time();
	$name = "";
	$connection = mysqli_connect("localhost", "root", "");
	$db = mysqli_select_db($connection, "sms");
	?>
</head>

<body>
	<header>
		<nav>
			<ul class="topnav">
				<li>Student Management System</li>
				<li>Name:<?php echo $_SESSION['names']; ?></li>
				<li>Email: <?php echo $_SESSION['emails']; ?></li>
				<li id="lgot"><a href="logout.php">Logout</a></li>
			</ul>
		</nav>

	</header>

	<div class="main">

		<div class="left_side">
			<form action="" method="post">
				<table>
					<tr>
						<td>
							<input type="submit" name="edit_detail" value="Edit Detail" <?php
																						if (isset($_POST['edit_detail']) or isset($_COOKIE['stu_edit'])) {
																							echo 'style="background-color: #979797;"';
																						}
																						?>>
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" name="show_detail" value="Profile" <?php
																					if (isset($_POST['show_detail'])) {
																						echo 'style="background-color: #979797;"';
																					}
																					?>>
						</td>
					</tr>
				</table>
			</form>
		</div>
		<div class="right_side">
			<div id="demo">
				<!-- #Code for search student---Start-->
				<?php
				if (isset($_POST['edit_detail']) or isset($_COOKIE['stu_edit'])) {
					$query = "select * from students where email = '$_SESSION[emails]'";
					$query_run = mysqli_query($connection, $query);
					while ($row = mysqli_fetch_assoc($query_run)) {
				?>
						<center>

							<form action="edit_student.php" method="post" autocomplete="off">
								<table class="opsearch">
									<tr>
										<td>
											<b>Roll No:</b>
										</td>
										<td>
											<input type="number" name="roll_no" value="<?php echo $row['roll_no'] ?>">
										</td>
									</tr>
									<tr>
										<td>
											<b>Name:</b>
										</td>
										<td>
											<input type="text" name="name" value="<?php echo $row['name'] ?>">
										</td>
									</tr>
									<tr>
										<td>
											<b>Father's Name:</b>
										</td>
										<td>
											<input type="text" name="father_name" value="<?php echo $row['father_name'] ?>">
										</td>
									</tr>
									<tr>
										<td>
											<b>Class:</b>
										</td>
										<td>
											<input type="number" name="class" value="<?php echo $row['class'] ?>">
										</td>
									</tr>
									<tr>
										<td>
											<b>Mobile:</b>
										</td>
										<td>
											<input type="tel" id="phone" name="mobile" placeholder="1234566786" pattern="[0-9]{10}" required value="<?php echo $row['mobile'] ?>">
										</td>
									</tr>
									<tr>
										<td>
											<b>Email:</b>
										</td>
										<td>
											<input type="email" name="email" value="<?php echo $row['email'] ?>">
										</td>
									</tr>
									<tr>
										<td>
											<b>Password:</b>
										</td>
										<td>
											<input onmouseover="this.setAttribute('type','text')" onmouseout="this.setAttribute('type','password')" placeholder="Hover to show password" type="password" name="password" id="password" required="required" autocomplete="off" value="<?php echo base64_decode(urldecode($row['password'])) ?>">
										</td>
									</tr>
									<tr>
										<td>
											<b>Remark:</b>
										</td>
										<td>
											<textarea name="remark"><?php echo $row['remark'] ?></textarea>
										</td>
									</tr>
									<tr>
										<td></td>
										<td>
											<input type="submit" value="Save">
										</td>
									</tr>
								</table>
							</form>
						</center>
				<?php
					}
				}
				?>
				<?php
				if (isset($_POST['show_detail'])) {
					$query = "select * from students where email = '$_SESSION[emails]'";
					$query_run = mysqli_query($connection, $query);
					while ($row = mysqli_fetch_assoc($query_run)) {
				?>
						<center>
							<table class="opsearch">
								<tr>
									<td>
										<b>Roll No:</b>
									</td>
									<td>
										<input type="number" value="<?php echo $row['roll_no'] ?>" disabled>
									</td>
								</tr>
								<tr>
									<td>
										<b>Name:</b>
									</td>
									<td>
										<input type="text" value="<?php echo $row['name'] ?>" disabled>
									</td>
								</tr>
								<tr>
									<td>
										<b>Father's Name:</b>
									</td>
									<td>
										<input type="text" value="<?php echo $row['father_name'] ?>" disabled>
									</td>
								</tr>
								<tr>
									<td>
										<b>Class:</b>
									</td>
									<td>
										<input type="number" value="<?php echo $row['class'] ?>" disabled>
									</td>
								</tr>
								<tr>
									<td>
										<b>Mobile:</b>
									</td>
									<td>
										<input type="tel" id="phone" name="mobile" value="<?php echo $row['mobile'] ?>" disabled>
									</td>
								</tr>
								<tr>
									<td>
										<b>Email:</b>
									</td>
									<td>
										<input type="email" value="<?php echo $row['email'] ?>" disabled>
									</td>
								</tr>
								<tr>
									<td>
										<b>Password:</b>
									</td>
									<td>
										<input onmouseover="this.setAttribute('type','text')" onmouseout="this.setAttribute('type','password')" placeholder="Hover to show password" type="password" name="password" id="password" required="required" autocomplete="off" value="<?php echo base64_decode(urldecode($row['password'])) ?>" disabled>

									</td>
								</tr>
								<tr>
									<td>
										<b>Remark:</b>
									</td>
									<td>
										<textarea rows="3" cols="40" disabled><?php echo $row['remark'] ?></textarea>
									</td>
								</tr>
							</table>
						</center>
				<?php
					}
				}
				?>
			</div>
		</div>
	</div>
</body>

<?php
setcookie("stu_edit", '', time() - 60 * 2);
