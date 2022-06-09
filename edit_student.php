<?php
session_start();
$_SESSION['emails'] = $_POST["email"];
$_SESSION['names'] =  $_POST['name'];
$pass = urlencode(base64_encode($_POST["password"]));
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "sms");
$query = "update students set name='$_POST[name]',father_name='$_POST[father_name]',class=$_POST[class],mobile='$_POST[mobile]',email='$_POST[email]',password='$pass',remark='$_POST[remark]' where roll_no = $_POST[roll_no]";
$query_run = mysqli_query($connection, $query);
$temp = 1;
setcookie("stu_edit", $temp, time() + 60 * 3);
?>
<script type="text/javascript">
	alert("Details edited successfully.");
	window.location.href = "student_dashboard.php";
</script>