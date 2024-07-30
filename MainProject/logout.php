<?php 
    session_start();
    unset($_SESSION['us']);
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
</head>
<body>
    <h1>Logged Out Successfully</h1>
    <h4><a href="login.php">Click here to go back to login</a></h4>
</body>
<style>
    h1{
        text-align: center;
        color: red;
    }
</style>
</html>