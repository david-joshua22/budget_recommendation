<?php
    include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/70f47a6946.js" crossorigin="anonymous"></script>
</head>
<body class="overflow-auto bg-[url('closeup-economist-using-calculator-while-going-through-bills-taxes-office.jpg')] bg-no-repeat bg-cover">
<nav class="flex justify-between bg-blue-200 border-b drop-shadow-2xl">
        <h1 class="pb-2  capitalize select-none font-bold text-black mx-7 pt-5 text-3xl">Budget
            recommendation</h1>
        <div
            class="m-7 pr-14 font-sans text-1xl font-semibold hover:underline hover:scale-110 transition-all duration-200">
            <i class="fa-solid fa-right-to-bracket"></i>
            <a href="login.php">Login</a>
        </div>
    </nav>
    <div class="flex justify-center">
        <div >
            <form action="signin.php" method="POST" class="flex flex-col items-center container w-96 h-fit rounded-3xl bg-transparent backdrop-blur-xl border-2 mt-5 hover:backdrop-blur-2xl">
                <div class="p-5 pb-10 text-center">
                    <h1 class="p-1 text-4xl text-black font-serif bg-green-200 rounded">Sign Up</h1>
                </div>
               
               <div class="font-bold text-xl flex mb-2 text-gray-900 drop-shadow-xl flex justify-center">
                    <label for="name" class="p-1 font-serif bg-green-200 rounded cursor-default">Name:</label>
                </div>
                <input type="text" class="border-b-2 border-black focus:outline-none text-md bg-transparent  flex justify-center text-center w-80" id="name" name="name" required><br><br>

                <div class="font-bold text-xl flex mb-2 text-gray-900 drop-shadow-xl flex justify-center">
                    <label for="age" class="p-1 font-serif bg-green-200 rounded cursor-default">Age:</label>
                </div>
                <input type="number" class="px-10 border-b-2 border-black focus:outline-none text-md bg-transparent  flex justify-center text-center w-80" id="age" name="age" required><br><br>

                <div class="font-bold text-xl flex mb-2 text-gray-900 drop-shadow-xl flex justify-center">
                    <label for="email" class="p-1 font-serif bg-green-200 rounded cursor-default">Email:</label>
                </div>
                <input type="email" id="email" name="email" class="px-10 border-b-2 border-black focus:outline-none text-md bg-transparent  flex justify-center text-center w-80" required><br><br>

                <div class="font-bold text-xl flex mb-2 text-gray-900 drop-shadow-xl flex justify-center">
                    <label for="password" class="p-1 font-serif bg-green-200 rounded cursor-default">Password:</label>
                </div>
                <input type="password" id="password" name="password" class="px-10 border-b-2 border-black focus:outline-none text-md bg-transparent  flex justify-center text-center w-80" required><br><br>
                <div class="py-1 px-5 flex justify-center">
                    <input type="submit" name = "submit"  class = "mb-5 bg-blue-300 text-black w-24 h-8 text-xl rounded-md font-semibold  transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-150" value="Sign Up">
                </div>

            </form>
        </div>
    </div>
</body>
</html>