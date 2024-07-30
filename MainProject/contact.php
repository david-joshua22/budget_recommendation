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
        <div class="flex justify-center">
        <div class="p-4 mt-20 bg-blue-200 rounded-xl drop-shadow-xl w-[80%]">
        <div class="flex justify-center">
            <span class="p-2  text-4xl text-bold flex justify-center w-[80%]"> Contact Us</span>
        </div>
            <div class="flex justify-center">
                <p class="p-4 text-center text-justify  w-[80%] text-xl">
                    If you have any questions or concerns about our webpage please contact us at the following email address:
                </p>
            </div>
            <div class="flex justify-center">
            <table class = "py-40 px-50 shadow-md border-double">
                    <thead class = "border-b-gray-100 border-solid shadow-md divide-y divide-gray-800 bg-slate-400">
                            <th class = "p-3 text-2xl text-center font-semibold uppercase  shadow-md">Name</th>
                            <th class = "p-3 text-2xl text-left font-semibold uppercase  shadow-md">Email</th>
                    </thead>
                    <tbody class="divide-y">
                        <tr class="bg-blue-200 hover:bg-blue-100 hover:scale-105 cursor-pointer duration-300">
                            <td class = "p-3 text-md shadow-md text-left uppercase">BALABADRUNI SIRI</td>
                            <td class = "p-3 text-md shadow-md text-center">siribalabadruni@gmail.com</td>
                        </tr>
                        <tr class="bg-blue-400 hover:bg-blue-100 hover:scale-105 cursor-pointer duration-300">
                            <td class = "p-3 text-md shadow-md text-left uppercase">DAVID JOSHUA RAJ G</td>
                            <td class = "p-3 text-md shadow-md text-center">mailtojoshua22@gmail.com</td>
                        </tr>
                        <tr class="bg-blue-600 hover:bg-blue-100 hover:scale-105 cursor-pointer duration-300">
                            <td class = "p-3 text-md shadow-md text-left uppercase">DUBAKULA DINESH</td>
                            <td class = "p-3 text-md shadow-md text-center">dineshdubakula12@gmail.com</td>
                        </tr>
                   </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>