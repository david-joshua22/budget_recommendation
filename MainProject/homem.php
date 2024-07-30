<?php
    include("connection.php");
    session_start();
    $email = $_SESSION['us'];
    $sql = "select * from hbud where email = '$email'";
    $result = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($result);
    if($count>0){
         echo"<script>
         window.location.replace('budh.php');
         </script>";
    }
?>
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
        <form action="budh.php" method="POST" class="flex justify-center mt-10 rounded">
                <div class="p-4 bg-blue-400 grid grid-cols-1 gap-y-4 rounded-xl">
                    <div class="p-4 bg-blue-200 rounded">
                        <label for="amount input">Enter Amount for current month</label>
                        <input type="number"class="p-3 m-4 ip w-80 h-5 border-b-2 border-black focus:outline-none text-md bg-transparent text-center"  name = "amount" placeholder="Enter amount" required>
                    </div>
                    <div class="p-4 bg-blue-200 rounded">
                        <p>Select the utilites required by you:</p>
                                <input type="checkbox" name="Utility[]" id = "u1"  value="Grocery"/>
                                <label for="u1">Groceries</label><br>
                                <input type="checkbox" name="Utility[]" id = "u2"  value="Fruits&Vegetables"/>
                                <label for="u2">Fruits and Vegetables</label><br>
                                <input type="checkbox" name="Utility[]" id = "u3"value="gas"/>
                                <label for="u3">Gas</label><br>
                                <input type="checkbox" name="Utility[]"id = "u4" value="water"/>
                                <label for="u4">Water</label><br>
                                <input type="checkbox" name="Utility[]"id = "u5" value="maid"/>
                                <label for="u5">Maid</label><br>
                                <input type="checkbox" name="Utility[]"id = "u6" value="Electricity"/>
                                <label for="u6">Power Bill</label><br>
                                <input type="checkbox" name="Utility[]"id = "u7" value="TV_bill"/>
                                <label for="u7">Tv Bills</label><br>
                                <input type="checkbox" name="Utility[]"id = "u8" value="Internet"/>
                                <label for="u8">Internet</label><br>
                                <input type="checkbox" name="Utility[]"id = "u9" value="Ironing"/>
                                <label for="u9">Clothes_Ironing</label><br>
                                <input type="checkbox" name="Utility[]"id = "u10" value="Apartment_Maintainance"/>
                                <label for="u10">Apartment_Maintainance</label><br>
                    </div>
                    <div class="flex justify-center">
                        <input type="submit" name = "subH" id = "subbtn" class="bg-blue-300 text-black w-24 text-xl rounded-md font-semibold  transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-150" value="SUBMIT">
                    </div>
                </div>
        </form>
</body>
</html>