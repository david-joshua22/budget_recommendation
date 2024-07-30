<?php
    include("connection.php");
    if(isset($_POST['login'])){
        $lemail = $_POST['lemail'];
        $lpass  = $_POST['lpass'];
    }
    $result = mysqli_query($conn,"SELECT * FROM signup WHERE email = '$lemail'");
    $count = mysqli_num_rows($result);
    if($count == 0)
    {
        echo 
        '<script>
            window.location.href="login.php";
            alert("Check email or Signup");
        </script>';
    }
    if($result == 1){
        $check_pass = mysqli_query($conn,"SELECT * FROM signup WHERE email = '$lemail'");
        $pass_val = mysqli_fetch_array($check_pass,MYSQLI_ASSOC);
        if($pass_val['password'] == $lpass){
            session_start();
            $_SESSION['us'] = $lemail;
            echo 
        '<script>
            window.location.href="Welcome.php";
        </script>';
        }
        else{
            echo 
        '<script>
            window.location.href="login.php";
            alert("Check password entered");
        </script>';
         }
    }
?>