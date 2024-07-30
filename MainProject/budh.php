<?php 
    include("connection.php");
    session_start();
    if(isset($_SESSION))
    {
        $email = $_SESSION['us'];
        $sql = "select * from hbud where email = '$email'";
        $result = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($result);
        if($count>0){
            $budg = mysqli_query($conn,"SELECT * FROM hbud WHERE email = '$email'");
            $pv = mysqli_fetch_array($budg,MYSQLI_ASSOC);
            $amount = $pv['amount'];
            $utlity =[];
            if($pv['groc']>0){
                $utlity['Grocery'] = $pv['groc'];
            }
            if($pv['gas']>0){
                $utlity['gas'] = $pv['gas'];
            }
            if($pv['fnv']>0){
                $utlity['Fruits&Vegetables'] = $pv['fnv'];
            }
            if($pv['water']>0){
                $utlity['water'] = $pv['water'];
            }
            if($pv['maid']>0){
                $utlity['maid'] = $pv['maid'];
            }
            if($pv['power']>0){
                $utlity['Electricity'] = $pv['power'];
            }
            if($pv['tv']>0){
                $utlity['TV_bill'] = $pv['tv'];
            }
            if($pv['inter']>0){
                $utlity['Internet'] = $pv['inter'];
            }
            if($pv['ion']>0){
                $utlity['Ironing'] = $pv['ion'];
            }
            if($pv['aptmain']>0){
                $utlity['Apartment_Maintainance'] = $pv['aptmain'];
            }
        }
        else{
            if(isset($_POST['subH'])){
                $amount  = $_POST['amount'];
                $utl = $_POST['Utility'];
            }
                $ut = ["Grocery"=>0.15,"gas"=>0.1,"Fruits&Vegetables"=>0.05,"water"=>0.05,"maid"=>0.2,"Electricity"=>0.2,"TV_bill"=>0.05,"Internet"=>0.05,"Ironing"=>0.05,"Apartment_Maintainance"=>0.1];
                $sum = 0;
                $count = 0;
                $utlity =[];
                foreach($utl as $key=>$values){
                    $sum += $ut[$values];
                    $count+=1;
                    $utlity[$values] = $amount*$ut[$values];
                }
                if($count<10){
                    foreach($utl as $key=>$values){
                        $utlity[$values]+= ($sum/$count);
                    }
                }
            $insqu = "INSERT INTO hbud(amount,email,groc,fnv,gas,water,maid,power,tv,inter,ion,aptmain) VALUES('$amount','$email',0,0,0,0,0,0,0,0,0,0)";
            $qres = mysqli_query($conn,$insqu);
            if($qres){
                foreach($utl as $key=>$values){
                    $fut = $amount*$ut[$values];
                    $sut = strval($values);
                    if($sut == 'Grocery'){
                        mysqli_query($conn,"UPDATE hbud set groc = '$fut' where email = '$email'");
                    }
                    if($sut == 'gas'){
                        mysqli_query($conn,"UPDATE hbud set gas = '$fut' where email = '$email'");
                    }
                    if($sut == 'Fruits&Vegetables'){
                        mysqli_query($conn,"UPDATE hbud set fnv = '$fut' where email = '$email'");
                    }
                    if($sut == 'water'){
                        mysqli_query($conn,"UPDATE hbud set water = '$fut' where email = '$email'");
                    }
                    if($sut == 'maid'){
                        mysqli_query($conn,"UPDATE hbud set maid = '$fut' where email = '$email'");
                    }
                    if($sut =='Electricity'){
                        mysqli_query($conn,"UPDATE hbud set power = '$fut' where email = '$email'");
                    }
                    if($sut == 'TV_bill'){
                        mysqli_query($conn,"UPDATE hbud set tv = '$fut' where email = '$email'");
                    }
                    if($sut == 'Internet'){
                        mysqli_query($conn,"UPDATE hbud set inter = '$fut' where email = '$email'");
                    }
                    if($sut == 'Ironing'){
                        mysqli_query($conn,"UPDATE hbud set ion = '$fut' where email = '$email'");
                    }
                    if($sut == 'Apartment_Maintainance'){
                        mysqli_query($conn,"UPDATE hbud set aptmain = '$fut' where email = '$email'");
                    }
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="salary.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/70f47a6946.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Expense','Budget'],
          <?php 
          $budg = mysqli_query($conn,"SELECT * FROM hbud WHERE email = '$email'");
          $pv = mysqli_fetch_array($budg,MYSQLI_ASSOC);
          echo"['Fruits&Vegetables',".$pv['fnv']."],";
          echo"['Maid',".$pv['maid']."],";
          echo"['Grocery',".$pv['groc']."],";
          echo"['Electricity',".$pv['power']."],";
          echo"['Gas',".$pv['gas']."],";
          echo"['Internet',".$pv['inter']."],";
          echo"['Water',".$pv['water']."],";
          echo"['Ironing',".$pv['ion']."],";
          echo"['Apartment_Maintainance',".$pv['aptmain']."],";
          echo"['Tv_bill',".$pv['tv']."],";
          ?>
        ]);

        var options = {
          title: 'Budget',
          backgroundColor : '#8ec3f0',
          width : 900,
          height : 500
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
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
        <div class="p-3 flex h=screen justify-center overflow-auto">
            <table class = "py-40 px-50 shadow-md border-double">
                    <thead class="border-b-gray-100 border-solid shadow-md divide-y divide-gray-800">
                        <tr class="bg-neutral-300">
                            <th class = "p-3 text-2xl text-center font-semibold uppercase  shadow-md">Expense</th>
                            <th class = "p-3 text-2xl text-left font-semibold uppercase  shadow-md">Budget</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <?php
                            foreach($utlity as $key=>$values){
                                $fut = $values;
                                $sut = strval($key);
                                echo("<tr class='bg-red-200 hover:bg-blue-100 hover:scale-105 cursor-pointer duration-300'><td class = 'p-3 text-md shadow-md text-left uppercase'>$sut</td><td class = 'p-3 text-md shadow-md text-center'>$fut</td></tr>");
                            }
                        ?>
                    </tbody>
            </table>
            <div id="piechart" class = "p-10 rounded-md"></div>
        </div>
    </div>
</body>
</html>