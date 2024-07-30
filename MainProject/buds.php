<?php 
    include("connection.php");
    session_start();
    if(isset($_SESSION))
    {
        $email = $_SESSION['us'];
        $sql = "select * from sbud where email = '$email'";
        $result = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($result);
        if($count>0){
            $budg = mysqli_query($conn,"SELECT * FROM sbud WHERE email = '$email'");
            $pv = mysqli_fetch_array($budg,MYSQLI_ASSOC);
            $amount = $pv['amount'];
            $frent = $pv['rent'];
            $ftrs = $pv['trspt'];
            $lesuie = $pv['les'];
            $em = $pv['emer'];
            $sav = $pv['savs'];
            $utlity =[];
            if($pv['food']>0){
                $utlity['food'] = $pv['food'];
            }
            if($pv['stuex']>0){
                $utlity['stuex'] = $pv['stuex'];
            }
            if($pv['inph']>0){
                $utlity['internet+phone'] = $pv['inph'];
            }
            if($pv['station']>0){
                $utlity['station'] = $pv['station'];
            }
        }
        else{
            if(isset($_POST['subS'])){
                $amount  = $_POST['amount'];
                $rent  = $_POST['rent'];
                $trp  = $_POST['Transport'];
                $utl = $_POST['Utility'];
                $le  = $_POST['leisure'];}
                $ar = ["amount" =>  $amount,
                            "rent" => 0.3,
                            "trs" => 0.1,
                            "ls" => 0.075,
                            "emer" => 0.05,
                            "sav" => 0.1
                            ];
                $ut = ['food'=>0.2,'Student_Expenditure'=>0.1,'internet+phone'=>0.05,'Stationary'=>0.025];
                if($rent == 1){
                    $frent = $ar['amount']*$ar['rent'];
                }
                else{
                    $frent = 0;
                    $ar['rent'] = 0;
                    $ar['trs'] += 0.1;
                    $ut['food'] += 0.05; 
                    $ut['Student_Expenditure'] += 0.1;
                    $ar['ls'] += 0.025;
                    $ar['sav'] += 0.025;  
                }
                if($trp == 0 || $trp == 1){
                    $ftrs = $amount*($ar['trs']);
                }
                $sum = 0;
                $utlity =[];
                foreach($utl as $key=>$values){
                    $sum += $ut[$values];
                    $utlity[$values] = $ar['amount']*$ut[$values];
                }
                $ar['sav'] += (0.375 - $sum);
                if($le == 2){
                    $lesuie = $ar['amount']*$ar['ls'];
                }
                elseif($le == 1){
                    $ar['ls'] = 0.05;
                    $ar['sav'] += 0.025;
                    $lesuie = $ar['amount']*$ar['ls'];
                }
                elseif($le == 0){
                    $ar['ls'] = 0.03;
                    $ar['sav'] += 0.045;
                    $lesuie = $ar['amount']*$ar['ls'];
                }
                $em = $ar['amount']*$ar['emer'];
                $sav = $ar['amount']*$ar['sav'];
            $insqu = "INSERT INTO sbud(amount,rent,trspt,les,emer,savs,email,food,stuex,inph,station) VALUES('$amount','$frent','$ftrs','$lesuie','$em','$sav','$email',0,0,0,0)";
            $qres = mysqli_query($conn,$insqu);
            if($qres){
                foreach($utl as $key=>$values){
                    $fut = $ar['amount']*$ut[$values];
                    $sut = strval($values);
                    if($sut == 'food'){
                        mysqli_query($conn,"UPDATE sbud set food = '$fut' where email = '$email'");
                    }
                    if($sut == 'Student_Expenditure'){
                        mysqli_query($conn,"UPDATE sbud set stuex = '$fut' where email = '$email'");
                    }
                    if($sut == 'internet+phone'){
                        mysqli_query($conn,"UPDATE sbud set inph = '$fut' where email = '$email'");
                    }
                    if($sut == 'Stationary'){
                        mysqli_query($conn,"UPDATE sbud set station = '$fut' where email = '$email'");
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
    <link rel="stylesheet" href="amount.css">
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
          $budg = mysqli_query($conn,"SELECT * FROM sbud WHERE email = '$email'");
          $pv = mysqli_fetch_array($budg,MYSQLI_ASSOC);
          echo"['Rent',".$pv['rent']."],";
          echo"['Transport',".$pv['trspt']."],";
          echo"['Food',".$pv['food']."],";
          echo"['Stationary',".$pv['station']."],";
          echo"['Internet&Phone',".$pv['inph']."],";
          echo"['Student_Expenses',".$pv['stuex']."],";
          echo"['Lesuier',".$pv['les']."],";
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