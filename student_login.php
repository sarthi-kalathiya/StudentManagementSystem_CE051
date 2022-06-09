<?php
$login = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] ===  "POST") {
  require 'dbc.php';
  $connection = mysqli_connect("localhost", "root", "");
  $db = mysqli_select_db($connection, "sms");
  $query = "select * from students where email = '$_POST[email]'";
  $query_run = mysqli_query($connection, $query);
  $num = mysqli_num_rows($query_run);
  if (1 == $num) {

    while ($row = mysqli_fetch_assoc($query_run)) {
      if ($row['email'] == $_POST['email']) {
        if ($row['password'] == urlencode(base64_encode($_POST['password']))) {
          session_start();
          $_SESSION['names'] =  $row['name'];
          $_SESSION['emails'] =  $row['email'];
          header("Location: student_dashboard.php");
        } else {
          echo '<script>alert("Wrong Password!")</script>';
        }
      }
    }
  } else {
    echo '<script>alert("Wrong Email!")</script>';
  }
}
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Login</title>
  <link rel="stylesheet" href="css/login_s_a.css">
  <link rel="icon" type="image/x-icon" href="images/f1.png">
</head>

<body>
  <header>
    <a class="sign" href="stu_signup.php">Sign Up</a>
    <a class="home" href="index.php">Home</a>
  </header>
  <div class="login">
    <h1>Login</h1>
    <form method="post" action="/StudentManagementSystem_CE051/student_login.php" autocomplete="off">
      <input type="email" id="email" name="email" placeholder="email" required autofocus />
      <input onmouseover="this.setAttribute('type','text')" onmouseout="this.setAttribute('type','password')" placeholder="Hover to show password" type="password" name="password" id="password" required>
      <button type="submit" class="btn btn-primary btn-block btn-large">Let me in.</button>
    </form>
  </div>
  </div>
  </div>
</body>

</html>