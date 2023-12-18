<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>

    <!--Page icon-->
    <link rel="icon" type="image/x-icon" href="results.png">        
    
    <style>
        .disp{
            text-align: center;
            margin: 10%;
            padding:5%;
            
            border: 2px;
            border-style: solid;
        }
        .disp2{
            text-align: center;
            margin: 10%;
            padding:2%;
            
            border: 2px;
            border-style: solid;
        }
        .err{
            color: red;
        }
        .success{
            color: green;
        }
        table, th, td{
            width:50%;
            border: 1px solid black;
        }
    </style>
    
</head>


<body>

    <div class="disp">
    <h4 style="color:red;">Welcome to this page!! Enter the details to view the results of VHSE 2023!!</h4>
        <form action="" method="GET">
            <label for="regno">Resgistration Number : </label>
            <input type="number" id="regno" name="regno" min="101" required>
            <br><br>
            <label for="dob">Date of birth : </label>
            <input type="Date" name="dob" id="dob" required>
            <br>
            <p class="txt"></p>
            <input type="submit" id="submit" name="submit" value="View results"/>
        </form>
    </div>

    <div class="disp2">
        <?php
            if(isset($_GET['submit'])){
                if($_SERVER['REQUEST_METHOD']==='GET'){
                
                    session_start();

                    $_SESSION['regno']=$_GET['regno'];
                    $_SESSION['dob']=$_GET['dob'];

                    $regno = $_SESSION['regno'];
                    $dob = $_SESSION['dob'];

                    $con = mysqli_connect("localhost","root","","results");
                    $ins = mysqli_query($con,"select math,english,biology,chemistry,physics,total,percentage,grade from students where userid='$regno' and dob='$dob'");
                    
                    $row = mysqli_fetch_assoc($ins);
                    if(!$row){
                        echo "<p class='err'>Please enter the correct details!</p>";
                    }
                    else{
                        $ins = mysqli_query($con,"select math,english,biology,chemistry,physics,total,percentage,grade from students where userid='$regno' and dob='$dob'");
                        $val = mysqli_fetch_array($ins);

                        echo"<table>";

                        echo"<tr>";
                        echo"<th>Subject</th>";
                        echo"<th>Mark</th>";
                        echo"</tr>";

                        echo"<tr>";
                        echo"<td>Maths</td>";
                        echo"<td>$val[0]</td>";
                        echo"</tr>";

                        echo"<tr>";
                        echo"<td>English</td>";
                        echo"<td>$val[1]</td>";
                        echo"</tr>";

                        echo"<tr>";
                        echo"<td>Biology</td>";
                        echo"<td>$val[2]</td>";
                        echo"</tr>";

                        echo"<tr>";
                        echo"<td>Chemistry</td>";
                        echo"<td>$val[3]</td>";
                        echo"</tr>";

                        echo"<tr>";
                        echo"<td>Physics</td>";
                        echo"<td>$val[4]</td>";
                        echo"</tr>";

                        echo"<tr>";
                        echo"<td>Total</td>";
                        echo"<td>$val[5]/500</td>";
                        echo"</tr>";

                        echo"<tr>";
                        echo"<td>Percentage</td>";
                        echo"<td>";echo number_format($val[6],2);echo"%</td>";
                        echo"</tr>";

                        echo"<tr>";
                        echo"<td>Grade</td>";
                        echo"<td>$val[7]</td>";
                        echo"</tr>";

                        echo"</table>";
                    }
                    session_destroy();
                    mysqli_close($con);
                }
            }
        ?>
    </div>

    <!--copyright footer-->
    <div>
        <a href="https://github.com/Mr1-D3CRYPT" target="_blank">
            <h5 style="margin-left:10%;margin-bottom:5%;font-family: Cardo;font-size: small;position: absolute;">© 2023 Mr1-D3CRYPT</h5>
        </a>
    </div>

</body>
</html>