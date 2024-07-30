<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/70f47a6946.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gradient-to-r from-green-400 to-blue-500 h-[100%]">
    <div>
        <nav class="flex justify-between bg-blue-200 border-b drop-shadow-2xl">
        <h1 class="pb-2  capitalize select-none font-bold text-black mx-7 pt-3 text-3xl">Budget
            recommendation</h1>
        <div>
            <ul class="pt-4 flex items-center gap-[4vw]">
                    <li><a href="welcome.php" class="text-1xl font-semibold hover:underline hover:scale-110 transition-all duration-200">HOME</a></li>
                    <li><a href="about.php" class="text-1xl font-semibold hover:underline hover:scale-110 transition-all duration-200">ABOUT</a></li>
                    <li><a href="contact.php" class="text-1xl font-semibold hover:underline hover:scale-110 transition-all duration-200">CONTACT US</a></li>
                    <li><a href="logout.php" class="px-4 text-1xl font-semibold hover:underline hover:scale-110 transition-all duration-200"><i class="fa-solid fa-right-to-bracket"></i>Logout</a></li>
            </ul>
        </div>
        </nav>
                <div class="py-3 text-center">
                    <span id = "greeting" class="p-1 font-serif bg-green-200 rounded text-4xl cursor-default">kkk</span>
                </div>
        <div class="flex justify-center">
            <div class="flex grid grid-cols-2 gap-x-8 gap-y-4">
                <a href="salaried.php">
                    <div class="bg-white rounded hover:bg-red-200 hover:scale-105 cursor-pointer duration-100">
                        <div class="rounded overflow-hidden shadow-lg max-w-sm">
                            <img src="18771.jpg" class="w-96 h-64">
                            <span class="text-center text-xl"><h3>Salaried</h3></span>
                        </div>
                    </div>
                <a href="homem.php">
                    <div class="bg-white rounded hover:bg-blue-200 hover:scale-105 cursor-pointer duration-100">
                        <div class="rounded overflow-hidden shadow-lg max-w-sm">
                            <img src="Wavy_REst-01_Single-07.jpg" class="w-96 h-64">
                            <span class="text-center text-xl"><h3>Home-Makers</h3></span>
                        </div>
                    </div>
                </a>
                <a href="stu.php">
                    <div class="bg-white rounded hover:bg-yellow-200 hover:scale-105 cursor-pointer duration-100">
                        <div class="rounded overflow-hidden shadow-lg max-w-sm">
                            <img src="13027.jpg" class="w-100% h-64">
                            <span class="text-center text-xl"><h3>Students</h3></span>
                        </div>
                    </div>
                </a>
                <a href="salaried.php">
                    <div class="bg-white rounded hover:bg-green-200 hover:scale-105 cursor-pointer duration-100">
                        <div class="rounded overflow-hidden shadow-lg max-w-sm">
                            <img src="20943821.jpg" class="w-96 h-64">
                            <span class="text-center text-xl"><h3>Retired</h3></span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
<?php 
    include("connection.php");
    session_start();
    if(isset($_SESSION))
    {
        $em = $_SESSION['us'];
        $q = mysqli_query($conn,"SELECT * FROM signup WHERE email = '$em'");
        $r = mysqli_fetch_array($q,MYSQLI_ASSOC);
        $name = $r['user_Name'];
        echo "<script>
        document.getElementById('greeting').innerHTML = 'Welcome $name';
        </script>";
    }
    else{
        echo("Kindly login");
        echo "<script>
            window.location.replace('login.php');
        </script>";
    }
?>