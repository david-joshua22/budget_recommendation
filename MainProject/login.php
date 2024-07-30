<?php
    include("connection.php");
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
<body class="overflow-hidden bg-[url('closeup-economist-using-calculator-while-going-through-bills-taxes-office.jpg')] bg-no-repeat bg-cover">
    <nav class=" flex justify-between bg-blue-200 border-b drop-shadow-2xl">
        <h1 class="pb-2  capitalize select-none font-bold text-black mx-7 pt-5 text-3xl">Budget
            recommendation</h1>
        <div
            class="m-7 pr-14 font-sans text-1xl font-semibold hover:underline hover:scale-110 transition-all duration-200">
            <i class="fa-solid fa-user-plus"></i>
            <a href="signup.php">SIGNUP</a>
        </div>
    </nav>
    <main class="bg-transparent h-screen flex justify-center">
    <form action="log.php" method="POST">
        <div
            class="flex flex-col items-center container w-96 h-3/3 rounded-3xl bg-transparent backdrop-blur-xl border-2 drop-shadow-xl mt-28 hover:backdrop-blur-2xl">
            <h2 class="font-bold text-4xl flex mt-10 mb-14 text-black drop-shadow-xl font-serif bg-green-200 rounded cursor-default">Login</h2>
            <div class="p-1 lb text-xl mr-42 font-semibold text-black drop-shadow-xl font-serif bg-green-200 rounded cursor-default">E-mail</div>
            <input type="email"
                class=" p-3 m-4 ip w-80 h-5 border-b-2 border-black focus:outline-none text-md bg-transparent text-center" name="lemail"><br>
            <div class=" lb text-xl mr-42 font-semibold text-black drop-shadow-xl font-serif bg-green-200 rounded cursor-default">Password</div>
            <input type="password"
                class="p-3 m-4 ip w-80 h-5 border-b-2 border-black focus:outline-none text-md bg-transparent text-center" name="lpass">
            <div class="butt">
                <input type="submit" name = "login"
                    class="bg-blue-300 text-black w-24 h-8 mt-10 text-xl rounded-md font-semibold  transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-150">
            </div>
            <br><br>
        </div>
    </form>
    </main>
</body>
</html>