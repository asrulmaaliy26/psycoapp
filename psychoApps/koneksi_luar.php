<?php
$dbserver = "db";
$dbusername = "root";
$dbpassword = "root";
$dbname = "db_apps-psi";
($con = mysqli_connect($dbserver, $dbusername, $dbpassword))  or die(mysqli_error($con));
mysqli_select_db($con, $dbname) or die(mysqli_error($con));
