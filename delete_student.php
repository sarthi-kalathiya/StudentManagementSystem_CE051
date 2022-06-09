<?php
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "sms");
$query = "delete from students where roll_no = $_POST[roll_no]";
$query_run = mysqli_query($connection, $query);
if ($query_run) {
	header("Location:admin_dashboard.php");
	$temp = 1;
	setcookie("del_adm_stu", $temp, time() + 60 * 3);
} else {
	echo "Some error occured.<br>try again later.";
}
