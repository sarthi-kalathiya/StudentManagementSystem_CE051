<?php
require 'dbc.php';
$existSql1 = "SELECT * FROM `students` WHERE email = '$_POST[email]';";
$existSql2 = "SELECT * FROM `students` WHERE roll_no='$_POST[roll_no]';";
$result1 = mysqli_query($conn, $existSql1);
$result2 = mysqli_query($conn, $existSql2);
$numExistRows1 = mysqli_num_rows($result1);
$numExistRows2 = mysqli_num_rows($result2);
if ($numExistRows1 > 0) {
?>
	<script type="text/javascript">
		alert("This Email already exist.");
		window.location.href = "admin_dashboard.php";
	</script>
<?php
} else if ($numExistRows2 > 0) {
?>
	<script type="text/javascript">
		alert("This Roll no already exist.");
		window.location.href = "admin_dashboard.php";
	</script>
<?php
} else {
	$pass = urlencode(base64_encode($_POST['password']));
	$connection = mysqli_connect("localhost", "root", "");
	$db = mysqli_select_db($connection, "sms");
	$query = "insert into students values('',$_POST[roll_no],'$_POST[name]','$_POST[father_name]',$_POST[class],'$_POST[mobile]','$_POST[email]','$pass','$_POST[remark]')";
	$query_run = mysqli_query($connection, $query);
	$temp = 1;
	setcookie("add_stu", $temp, time() + 60 * 3);
?>
	<script type="text/javascript">
		alert("Student added successfully.");
		window.location.href = "admin_dashboard.php";
	</script>
<?php
}
?>