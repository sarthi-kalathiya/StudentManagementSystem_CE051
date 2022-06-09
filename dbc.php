<?php
// connecting MYSQLi database by PHP script
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'sms');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
// check conected or not
if(!$conn)
    // echo "Connection  successfully !";

    // else
    // die("ERROR:sorry we failed to conect " . mysqli_connect_error());
?>