<?php
    include("connection.php");
    session_start();
    $email = $_SESSION['us'];
    $sql = "select * from salbud where email = '$email'";
    $result = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($result);
    if($count>0){
        echo"<script>
            window.location.replace('bud.php');
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
        <form action="bud.php" method="POST">
                <div class="p-4 bg-red-400 grid grid-cols-1 gap-y-4 rounded-xl">
                    <div class="p-4 bg-red-200 rounded text-center text-bold text-xl">
                        <label for="salary input">Enter Salary</label>
                        <input type="number" name = "salary" class="p-3 m-4 ip w-80 h-5 border-b-2 border-black focus:outline-none text-md bg-transparent text-center"  placeholder="Enter Salary" required>
                    </div>
                    <div class="p-4 bg-red-200 rounded">
                        <p>Do you live in your own house:</p>
                              <input type="radio" id="re" name="rent" value="0" required>
                              <label for="re">Yes</label><br>
                              <input type="radio" id="nre" name="rent" value="1">
                              <label for="nre">No</label><br>
                    </div>
                    <div class="p-4 bg-red-200 rounded">
                        <p>What kind of transport do you use to commute:</p>
                              <input type="radio" id="tr" name="Transport" value="0" required>
                              <label for="tr">Own Transport</label><br>
                              <input type="radio" id="ptr" name="Transport" value="1">
                              <label for="ptr">Public</label><br>
                    </div>
                    <div class="p-4 bg-red-200 rounded">
                        <p>Select the utilites required by you:</p>
                                <input type="checkbox" name="Utility[]" id = "u1"  value="electricity"/>
                                <label for="u1">Electricity</label><br>
                                <input type="checkbox" name="Utility[]" id = "u2"  value="gas"/>
                                <label for="u2">Gas</label><br>
                                <input type="checkbox" name="Utility[]" id = "u3"value="internet+phone"/>
                                <label for="u4">Internet+Phone</label><br>
                                <input type="checkbox" name="Utility[]"id = "u4" value="water"/>
                                <label for="u4">Water</label><br>
                    </div>
                    <div class="p-4 bg-red-200 rounded">
                        <p>How likely are you to go out to for leisure:</p>
                                <input type="radio" id="high" name="leisure" value="2" required>
                                <label for="high">Highly Likely</label><br>
                                <input type="radio" id="mid" name="leisure" value="1">
                                <label for="mid">Likely</label><br>
                                <input type="radio" id="low" name="leisure" value="0">
                                <label for="low">Less Likely</label><br>
                    </div>
                    <div class="p-4 bg-red-200 rounded">
                        <p>How likely are you to go out to shop:</p>
                                <input type="radio" id="highs" name="shop" value="2" required>
                                <label for="highs">Highly Likely</label><br>
                                <input type="radio" id="mids" name="shop" value="1">
                                <label for="mids">Likely</label><br>
                                <input type="radio" id="lows" name="shop" value="0">
                                <label for="lows">Less Likely</label><br>
                    </div>
                    <div class = "flex justify-center">
                        <input type="submit" name = "subSal" id = "subbtn"class="bg-blue-300 text-black w-24 text-xl rounded-md font-semibold  transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-150"  value="SUBMIT">
                    </div>
                </div>
        </form>
</body>
</html>