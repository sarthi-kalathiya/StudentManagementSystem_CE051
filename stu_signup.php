<?php
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] ===  "POST") {
  $roll = $_POST["roll_NO"];
  $name = $_POST["name"];
  $fname = $_POST["fname"];
  $class = $_POST["class"];
  $mobile = $_POST["mobile"];
  $email = $_POST["email"];
  $pass = urlencode(base64_encode($_POST["password"]));
  $re = "";
  require 'dbc.php';
  $existSql1 = "SELECT * FROM `students` WHERE email = '$email';";
  $existSql2 = "SELECT * FROM `students` WHERE roll_no='$roll';";
  $result1 = mysqli_query($conn, $existSql1);
  $result2 = mysqli_query($conn, $existSql2);
  $numExistRows1 = mysqli_num_rows($result1);
  $numExistRows2 = mysqli_num_rows($result2);
  if ($numExistRows1 > 0) {
    $showError = "Email already exist.";
  } else if ($numExistRows2 > 0) {
    $showError = "This Roll no already exist.";
  } else {
    // $exists = false;    
    $sql = "INSERT INTO `students` (`s_no`, `roll_no`, `name`, `father_name`, `class`, `mobile`, `email`, `password`, `remark`) VALUES (NULL, '$roll','$name', '$fname','$class','$mobile', '$email', '$pass', '$re')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $showAlert = true;
    }
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Signup</title>
  <link rel="stylesheet" href="css/stu_signup.css">
  <link rel="icon" type="image/x-icon" href="images/f1.png">
</head>

<body>
  <header><?php
          if ($showAlert) {
            echo '<a class="sign" href="student_login.php">Login</a>';
          }
          ?>
    <a class="home" href="index.php">Home</a>
  </header>
  <?php

  if ($showAlert) {
    echo '<div class="success">
<strong>Success !</strong> Your account is now created and you can login.
</div>';
  }
  if ($showError) {
    echo '<div class="exist">
<strong>Error !</strong> ' . $showError . '
</div>';
  }
  ?>

  <div class="login">
    <form action="stu_signup.php" method="post" autocomplete="off">
      <!-- name -->
      <div>
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required autofocus>
      </div>
      <!-- fname -->
      <div>
        <label for="fname">Father Name</label>
        <input type="text" id="fname" name="fname" required>
      </div>
      <!-- email -->
      <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
      </div>
      <!-- class -->
      <div>
        <label for="class">Class</label>
        <input type="number" id="class" name="class" required>
      </div>
      <!-- roll -->
      <div>
        <label for="roll_NO">Roll No</label>
        <input type="number" id="roll_NO" name="roll_NO" required>
      </div>
      <!-- mobile -->
      <div>
        <label for="mobile">Mobile</label>
        <input type="tel" id="mobile" name="mobile" placeholder="1234566786" pattern="[0-9]{10}" required>
      </div>
      <!-- pass -->
      <div>
        <label for="password">Password</label>
        <input onmouseover="this.setAttribute('type','text')" onmouseout="this.setAttribute('type','password')" placeholder="Hover to show password" type="password" name="password" id="password" required>

      </div>
      <br><br>
      <button type="submit" class="btn btn-primary btn-block btn-large">Signup</button>
    </form>
  </div>
</body>

</html>