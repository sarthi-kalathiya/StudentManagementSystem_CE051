<head>
	<title>Admin Dashboard</title>
	<link rel="icon" type="image/x-icon" href="images/f2.png">
	<link rel="stylesheet" href="css/adm_dash.css">
	<?php
	session_start();
	if (!isset($_SESSION['emaila'])) {
		header("Location:admin_login.php");
	}
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
				<li>Name:<?php echo $_SESSION['namea']; ?></li>
				<li>Email: <?php echo $_SESSION['emaila']; ?></li>
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
							<input type="submit" name="search_student" value="Search Student" <?php
																								if (isset($_POST['search_student'])) {
																									echo 'style="background-color: #979797;"';
																								}
																								?>>
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" name="edit_student" value="Edit Student" <?php
																							if (isset($_POST['edit_student']) or isset($_COOKIE['edit_adm_stu'])) {
																								echo 'style="background-color: #979797;"';
																							}
																							?>>
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" name="add_new_student" value="Add New Student" <?php
																								if (isset($_POST['add_new_student']) or isset($_COOKIE['add_stu'])) {
																									echo 'style="background-color: #979797;"';
																								}
																								?>>
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" name="delete_student" value="Delete Student" <?php
																								if (isset($_POST['delete_student']) or isset($_COOKIE['del_adm_stu'])) {
																									echo 'style="background-color: #979797;"';
																								}
																								?>>
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" name="show_teacher" value="Show Teachers" <?php
																							if (isset($_POST['show_teacher'])) {
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
				if (isset($_POST['search_student'])) {
				?>
					<center>
						<form action="" method="post" class="insearch" autocomplete="off">
							&nbsp;&nbsp;<b>Enter Roll No:</b>&nbsp;&nbsp; <input type="number" name="roll_no" autofocus required>
							<input type="submit" name="search_by_roll_no_for_search" value="Search">
						</form>
					</center>
					<?php
				}
				if (isset($_POST['search_by_roll_no_for_search'])) {
					$query = "select * from students where roll_no = '$_POST[roll_no]'";
					$query_run = mysqli_query($connection, $query);
					$num = mysqli_num_rows($query_run);
					if (1 == $num) {
						while ($row = mysqli_fetch_assoc($query_run)) {
					?>
							<center>
								<table class="opsearch">
									<tr>
										<td>
											<b>Roll No:</b>
										</td>
										<td>
											<input type="text" value="<?php echo $row['roll_no'] ?>" disabled>
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
											<input type="text" value="<?php echo $row['class'] ?>" disabled>
										</td>
									</tr>
									<tr>
										<td>
											<b>Mobile:</b>
										</td>
										<td>
											<input type="tel" id="phone" name="mobile" placeholder="1234566786" pattern="[0-9]{10}" value="<?php echo $row['mobile'] ?>" disabled>
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
											<input onmouseover="this.setAttribute('type','text')" onmouseout="this.setAttribute('type','password')" type="password" name="password" id="password" required="required" autocomplete="off" value="<?php echo base64_decode(urldecode($row['password'])) ?>" disabled>
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
					} else {
						?>
						<center>
							<p class="not_found">Student Not Found!!!</p>
						</center>
				<?php
					}
				}
				?>
				<!-- #Code for edit student details---Start-->
				<?php
				if (isset($_POST['edit_student']) or isset($_COOKIE['edit_adm_stu'])) {
				?>
					<center>
						<form action="" method="post" class="insearch" autocomplete="off">
							&nbsp;&nbsp;<b>Enter Roll No:</b>&nbsp;&nbsp; <input type="number" name="roll_no" autofocus required>
							<input type="submit" name="search_by_roll_no_for_edit" value="Edit">
						</form>
					</center>
					<?php
				}
				if (isset($_POST['search_by_roll_no_for_edit'])) {
					$query = "select * from students where roll_no = $_POST[roll_no]";
					$query_run = mysqli_query($connection, $query);
					$num = mysqli_num_rows($query_run);
					if (1 == $num) {
						while ($row = mysqli_fetch_assoc($query_run)) {
					?>
							<center>

								<form action="admin_edit_student.php" method="post" autocomplete="off">
									<table class="opsearch">
										<tr>
											<td>
												<b>Roll No:</b>
											</td>
											<td>
												<input type="number" name="roll_no" value="<?php echo $row['roll_no'] ?>" required>
											</td>
										</tr>
										<tr>
											<td>
												<b>Name:</b>
											</td>
											<td>
												<input type="text" name="name" value="<?php echo $row['name'] ?>" required>
											</td>
										</tr>
										<tr>
											<td>
												<b>Father's Name:</b>
											</td>
											<td>
												<input type="text" name="father_name" value="<?php echo $row['father_name'] ?>" required>
											</td>
										</tr>
										<tr>
											<td>
												<b>Class:</b>
											</td>
											<td>
												<input type="number" name="class" value="<?php echo $row['class'] ?>" required>
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
												<input type="email" name="email" value="<?php echo $row['email'] ?>" required>
											</td>
										</tr>
										<tr>
											<td>
												<b>Password:</b>
											</td>
											<td>
												<input onmouseover="this.setAttribute('type','text')" onmouseout="this.setAttribute('type','password')" type="password" name="password" id="password" required="required" autocomplete="off" value="<?php echo base64_decode(urldecode($row['password'])) ?>" required>
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
												<input type="submit" name="edit" value="Save">
											</td>
										</tr>
									</table>
								</form>
							</center>
						<?php
						}
					} else {
						?>
						<center>
							<p class="not_found">Student Not Found!!!</p>
						</center>
				<?php
					}
				}
				?>
				<!-- #Code for Delete student details---Start-->
				<?php
				if (isset($_POST['delete_student']) or isset($_COOKIE['del_adm_stu'])) {
				?>
					<center>
						<form action="delete_student.php" method="post" class="insearch" autocomplete="off">
							&nbsp;&nbsp;<b>Enter Roll No:</b>&nbsp;&nbsp; <input type="number" name="roll_no" autofocus required>
							<input type="submit" name="search_by_roll_no_for_delete" value="Delete">
						</form>
					</center>
				<?php
				}
				?>
				<!-- add new student -->
				<?php
				if (isset($_POST['add_new_student']) or isset($_COOKIE['add_stu'])) {
				?>
					<center>
						<h2>Fill the given details</h2>
						<form action="add_student.php" method="post" autocomplete="off">
							<table>
								<tr>
									<td>
										<b>Roll No:</b>
									</td>
									<td>
										<input type="number" name="roll_no" required autofocus>
									</td>
								</tr>
								<tr>
									<td>
										<b>Name:</b>
									</td>
									<td>
										<input type="text" name="name" required>
									</td>
								</tr>
								<tr>
									<td>
										<b>Father's Name:</b>
									</td>
									<td>
										<input type="text" name="father_name" required>
									</td>
								</tr>
								<tr>
									<td>
										<b>Class:</b>
									</td>
									<td>
										<input type="number" name="class" required>
									</td>
								</tr>
								<tr>
									<td>
										<b>Mobile:</b>
									</td>
									<td>
										<input type="tel" id="phone" name="mobile" placeholder="1234566786" pattern="[0-9]{10}" required>
									</td>
								</tr>
								<tr>
									<td>
										<b>Email:</b>
									</td>
									<td>
										<input type="email" name="email" required>
									</td>
								</tr>
								<tr>
									<td>
										<b>Password:</b>
									</td>
									<td>
										<input onmouseover="this.setAttribute('type','text')" onmouseout="this.setAttribute('type','password')" type="password" name="password" id="password" required="required" autocomplete="off">
									</td>
								</tr>
								<tr>
									<td>
										<b>Remark:</b>
									</td>
									<td>
										<textarea rows="3" cols="40" placeholder="Optional" name="remark"></textarea>
									</td>
								</tr>
								<tr>
									<td></td>
									<td><br><input type="submit" name="add" value="Add Student" style="width: 7vw;"></td>
								</tr>
							</table>
						</form>
					</center>
				<?php
				}
				?>
				<?php
				if (isset($_POST['show_teacher'])) {
				?>
					<center>
						<h2>Teacher's Details</h2>
						<div style="overflow-x: auto;">
							<table style="border-collapse: collapse;border: 1px solid black;">
								<tr>
									<td id="td"><b>ID</b></td>
									<td id="td"><b>Name</b></td>
									<td id="td"><b>Mobile</b></td>
									<td id="td"><b>subject</b></td>
								</tr>
								<?php
								$query = "select * from teachers";
								$query_run = mysqli_query($connection, $query);
								while ($row = mysqli_fetch_assoc($query_run)) {
								?>
									<tr>
										<td id="td"><?php echo $row['t_id'] ?></td>
										<td id="td"><?php echo $row['name'] ?></td>
										<td id="td"><?php echo $row['mobile'] ?></td>
										<td id="td"><?php echo $row['subject'] ?></td>
									</tr>
								<?php
								} ?>

							</table>
						</div>
					</center>

				<?php
				}
				?>
			</div>
		</div>
	</div>
</body>

<?php
setcookie("edit_adm_stu", '', time() - 60 * 2);
setcookie("del_adm_stu", '', time() - 60 * 2);
setcookie("add_stu", '', time() - 60 * 2);
?>