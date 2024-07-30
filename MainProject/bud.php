<?php 
    include("connection.php");
    session_start();
    if(isset($_SESSION))
    {
        $email = $_SESSION['us'];
        $sql = "select * from salbud where email = '$email'";
        $result = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($result);
        if($count>0){
            $budg = mysqli_query($conn,"SELECT * FROM salbud WHERE email = '$email'");
            $pv = mysqli_fetch_array($budg,MYSQLI_ASSOC);
            $salary = $pv['salary'];
            $frent = $pv['rent'];
            $ftrs = $pv['trspt'];
            $g = $pv['groc'];
            $lesuie = $pv['les'];
            $fsp = $pv['shp'];
            $em = $pv['emer'];
            $sav = $pv['savs'];
            $utlity =[];
            if($pv['elec']>0){
                $utlity['electricity'] = $pv['elec'];
            }
            if($pv['gas']>0){
                $utlity['gas'] = $pv['gas'];
            }
            if($pv['inph']>0){
                $utlity['internet+phone'] = $pv['inph'];
            }
            if($pv['water']>0){
                $utlity['water'] = $pv['water'];
            }
        }
        else{
            if(isset($_POST['subSal'])){
                $salary  = $_POST['salary'];
                $rent  = $_POST['rent'];
                $trp  = $_POST['Transport'];
                $utl = $_POST['Utility'];
                $le  = $_POST['leisure'];
                $sp  = $_POST['shop'];}
                $ar = ["salary" =>  $salary,
                            "rent" => 0.25,
                            "trs" => 0.05,
                            "gros" => 0.05,
                            "ls" => 0.075,
                            "sp" => 0.075,
                            "emer" => 0.05,
                            "sav" => 0.2
                            ];
                $ut = ['electricity'=>0.05,'gas'=>0.03,'internet+phone'=>0.03,'water'=>0.01];
                if($rent == 1){
                    $frent = $ar['salary']*$ar['rent'];
                }
                else{
                    $frent = 0;
                    $ar['rent'] = 0;
                    $ar['gros'] += 0.02;
                    $ut['electricity'] += 0.02; 
                    $ut['gas'] += 0.01;
                    $ut['internet+phone'] += 0.01;
                    $ut['water'] += 0.01;
                    $ar['emer'] += 0.03;
                    $ar['sav'] += 0.15;  
                }
                if($trp == 0 || $trp == 1){
                    $ftrs = $salary*($ar['trs']);
                }
                $sum = 0;
                $utlity =[];
                foreach($utl as $key=>$values){
                    $sum += $ut[$values];
                    $utlity[$values] = $ar['salary']*$ut[$values];
                }
                $ar['sav'] += (0.12 - $sum);
                if($le == 2){
                    $lesuie = $ar['salary']*$ar['ls'];
                }
                elseif($le == 1){
                    $ar['ls'] = 0.05;
                    $ar['sav'] += 0.025;
                    $lesuie = $ar['salary']*$ar['ls'];
                }
                elseif($le == 0){
                    $ar['ls'] = 0.03;
                    $ar['sav'] += 0.045;
                    $lesuie = $ar['salary']*$ar['ls'];
                }
                if($sp == 2){
                    $fsp = $ar['salary']*$ar['sp'];
                }
                elseif($sp == 1){
                    $ar['sp'] = 0.05;
                    $ar['sav'] += 0.025;
                    $fsp = $ar['salary']*$ar['sp'];
                }
                elseif($sp == 0){
                    $ar['ls'] = 0.03;
                    $ar['sav'] += 0.045;
                    $fsp = $ar['salary']*$ar['sp'];
                }
                $g = $ar['salary']*$ar['gros'];
                $em = $ar['salary']*$ar['emer'];
                $sav = $ar['salary']*$ar['sav'];
            $insqu = "INSERT INTO salbud(salary,rent,trspt,groc,les,shp,emer,savs,email,gas,water,inph,elec) VALUES('$salary','$frent','$ftrs','$g','$lesuie','$fsp','$em','$sav','$email',0,0,0,0)";
            $qres = mysqli_query($conn,$insqu);
            if($qres){
                foreach($utl as $key=>$values){
                    $fut = $ar['salary']*$ut[$values];
                    $sut = strval($values);
                    if($sut == 'electricity'){
                        mysqli_query($conn,"UPDATE salbud set elec = '$fut' where email = '$email'");
                    }
                    if($sut == 'gas'){
                        mysqli_query($conn,"UPDATE salbud set gas = '$fut' where email = '$email'");
                    }
                    if($sut == 'internet+phone'){
                        mysqli_query($conn,"UPDATE salbud set inph = '$fut' where email = '$email'");
                    }
                    if($sut == 'water'){
                        mysqli_query($conn,"UPDATE salbud set water = '$fut' where email = '$email'");
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
          $budg = mysqli_query($conn,"SELECT * FROM salbud WHERE email = '$email'");
          $pv = mysqli_fetch_array($budg,MYSQLI_ASSOC);
          echo"['Rent',".$pv['rent']."],";
          echo"['Transport',".$pv['trspt']."],";
          echo"['Grocery',".$pv['groc']."],";
          echo"['Electricity',".$pv['elec']."],";
          echo"['Gas',".$pv['gas']."],";
          echo"['Internet&Phone',".$pv['inph']."],";
          echo"['Water',".$pv['water']."],";
          echo"['Lesuier',".$pv['les']."],";
          echo"['Shoping',".$pv['shp']."],";
          echo"['Emergency',".$pv['emer']."],";
          echo"['Savings',".$pv['savs']."]";
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
                        <tr class="bg-blue-200 hover:bg-blue-100 hover:scale-105 cursor-pointer duration-300">
                            <td class = "p-3 text-md shadow-md text-left uppercase"><?php echo("Rent") ?></td>
                            <td class = "p-3 text-md shadow-md text-center"><?php echo($frent) ?></td>
                        </tr>
                        <tr class="bg-blue-300 hover:bg-blue-100 hover:scale-105 cursor-pointer duration-300">
                            <td class = "p-3 text-md shadow-md text-left uppercase"><?php echo("Transport") ?></td>
                            <td class = "p-3 text-md shadow-md text-center"><?php echo($ftrs) ?></td>
                        </tr>
                        <tr class="bg-blue-400 hover:bg-blue-100 hover:scale-105 cursor-pointer duration-300">
                            <td class = "p-3 text-md shadow-md text-left uppercase"><?php echo("Grocery") ?></td>
                            <td class = "p-3 text-md shadow-md text-center"><?php echo($g) ?></td>
                        </tr>
                        <?php
                            foreach($utlity as $key=>$values){
                                $fut = $values;
                                $sut = strval($key);
                                echo("<tr class='bg-blue-200 hover:bg-blue-100 hover:scale-105 cursor-pointer duration-300'><td class = 'p-3 text-md shadow-md text-left uppercase'>$sut</td><td class = 'p-3 text-md shadow-md text-center'>$fut</td></tr>");
                            }
                        ?>
                        <tr class="bg-blue-300 hover:bg-blue-100 hover:scale-105 cursor-pointer duration-300">
                            <td class = "p-3 text-md shadow-md text-left uppercase"><?php echo("Leisure") ?></td>
                            <td class = "p-3 text-md shadow-md text-center"><?php echo($lesuie) ?></td>
                        </tr>
                        <tr class="bg-blue-400 hover:bg-blue-100 hover:scale-105 cursor-pointer duration-300">
                            <td class = "p-3 text-md shadow-md text-left uppercase"><?php echo("Shopping") ?></td>
                            <td class = "p-3 text-md shadow-md text-center"><?php echo($fsp) ?></td>
                        </tr>
                        <tr class="bg-blue-500 hover:bg-blue-100 hover:scale-105 cursor-pointer duration-300">
                            <td class = "p-3 text-md shadow-md text-left uppercase "><?php echo("Emergency") ?></td>
                            <td class = "p-3 text-md shadow-md text-center"><?php echo($em) ?></td>
                        </tr>
                        <tr class="bg-blue-600 hover:bg-blue-100 hover:scale-105 cursor-pointer duration-300">
                            <td class = "p-3 text-md shadow-md text-left uppercase"><?php echo("Savings") ?></td>
                            <td class = "p-3 text-md shadow-md text-center"><?php echo($sav) ?></td>
                        </tr>
                    </tbody>
            </table>
            <div id="piechart" class = "p-10 rounded-md"></div>
        </div>
    </div>
</body>
</html>