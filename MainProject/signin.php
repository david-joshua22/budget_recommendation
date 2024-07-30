<?php
    include("connection.php");
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $password = $_POST['password'];
    }
    else{
        echo'<script>alert("Failed")</script>';
    }
    $sql = "select * from signup where email = '$email'";
    $result = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($result);
    if($count>0){
        echo 
        '<script>
            window.location.href="login.php";
            alert("Signin email exits login with password");
        </script>';
    }
    else{
        $sql1 = "INSERT INTO signup(user_Name,age,email,password) VALUES('$name','$age','$email','$password')";
        $result1 = mysqli_query($conn,$sql1);
        if($result){
            echo
            '<script>
                window.location.href="login.php";
                alert("Signup successful now login with credentials");
            </script>';
        }
    }
?>