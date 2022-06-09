<?php
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] ===  "POST") {
	$pass = urlencode(base64_encode($_POST["password"]));
	require 'dbc.php';
	$sql = "update students set name='$_POST[name]',father_name='$_POST[father_name]',class=$_POST[class],mobile='$_POST[mobile]',email='$_POST[email]',password='$pass',remark='$_POST[remark]' where roll_no = $_POST[roll_no]";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		// $showAlert = true;
		$temp = 1;
		setcookie("edit_adm_stu", $temp, time() + 60 * 3);

?>

		<script type="text/javascript">
			alert("Details edited successfully.");
			window.location.href = "admin_dashboard.php";
		</script>
<?php
	}
	// }
} else {
	echo "something went wrong
	<br>please try again later!!!";
}
?>