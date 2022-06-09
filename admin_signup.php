<?php
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] ===  "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pass = urlencode(base64_encode($_POST["password"]));
    require 'dbc.php';
    // $exists = false;

    // Check whether this username Exists
    $existSql = "SELECT * FROM `login` WHERE email = '$email';";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if ($numExistRows > 0) {
        // $exists = true;
        $showError = "Email Already Exists";
    } else {
        // $exists = false;    
        $sql = "INSERT INTO `login` (`s_no`, `name`, `email`, `password`) VALUES (NULL,'$name', '$email', '$pass')";
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
    <title>Admin Signup</title>
    <link rel="stylesheet" href="css/adm_singup.css">
    <link rel="icon" type="image/x-icon" href="images/f1.png">
</head>

<body>
    <header><?php
            if ($showAlert) {
                echo '<a class="sign" href="admin_login.php">Login</a>';
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
        <form action="admin_signup.php" method="post" autocomplete="off">
            <!-- name -->
            <div>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required autofocus>
            </div>
            <!-- email -->
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <!-- pass -->
            <div>
                <label for="password">Password</label>
                <input onmouseover="this.setAttribute('type','text')" onmouseout="this.setAttribute('type','password')" placeholder="Hover to show password" type="password" name="password" id="password" required>

            </div>
            <br><br>
            <button type="submit" name="show" class="btn btn-primary btn-block btn-large">Signup</button>
        </form>
    </div>
</body>

</html>