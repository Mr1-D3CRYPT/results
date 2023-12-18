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
    <h4 style="color:Green;">Lets view the Results!!</h4>
        <form action="" method="GET">
            <label for="regno">Seach for Students:</label>
            <br><br>
            <label for="regno">Registration Number : </label>
            <input type="number" id="regno" name="regno" min="101">
            <br><br>
            <input type="submit" id="submit1" name="submit1" value="View results"/>
            <br><br><br>
            <input type="submit" id="submit2" name="submit2" value="Click me"/> to view Entire Results!!!
        
        </form>
    </div>

    <div class="disp2">
        <?php

            if (isset($_GET['submit2'])) {
                session_start();

                $con = mysqli_connect("localhost","root","","results");
                $ins = mysqli_query($con,"select userid from students");
                
                $row = mysqli_fetch_assoc($ins);
                if(!$row){
                    echo "<p class='err'>Field empty</p>";
                }
                else{
                    $ins = mysqli_query($con,"select * from students");
                    while($val = mysqli_fetch_array($ins)){

                        echo"<table>";

                        echo"<tr>";
                        echo"<td>Registration No</td>";
                        echo"<td>$val[0]</td>";
                        echo"</tr>";

                        echo"<tr>";
                        echo"<td>Date of Birth</td>";
                        echo"<td>$val[1]</td>";
                        echo"</tr>";

                        echo"<tr>";
                        echo"<th>Subject</th>";
                        echo"<th>Mark</th>";
                        echo"</tr>";

                        echo"<tr>";
                        echo"<td>Maths</td>";
                        echo"<td>$val[2]</td>";
                        echo"</tr>";

                        echo"<tr>";
                        echo"<td>English</td>";
                        echo"<td>$val[3]</td>";
                        echo"</tr>";

                        echo"<tr>";
                        echo"<td>Biology</td>";
                        echo"<td>$val[4]</td>";
                        echo"</tr>";

                        echo"<tr>";
                        echo"<td>Chemistry</td>";
                        echo"<td>$val[5]</td>";
                        echo"</tr>";

                        echo"<tr>";
                        echo"<td>Physics</td>";
                        echo"<td>$val[6]</td>";
                        echo"</tr>";

                        echo"<tr>";
                        echo"<td>Total</td>";
                        echo"<td>$val[7]/500</td>";
                        echo"</tr>";

                        echo"<tr>";
                        echo"<td>Percentage</td>";
                        echo"<td>";echo number_format($val[8]);echo"%</td>";
                        echo"</tr>";

                        echo"<tr>";
                        echo"<td>Grade</td>";
                        echo"<td>$val[9]</td>";
                        echo"</tr>";

                        echo"</table>";
                        echo "<br>";
                    }
                }
            }

            if(isset($_GET['submit1'])){
                if($_SERVER['REQUEST_METHOD']==='GET'){
                
                    session_start();

                    $_SESSION['regno']=$_GET['regno'];

                    $regno = $_SESSION['regno'];

                    $con = mysqli_connect("localhost","root","","results");
                    $ins = mysqli_query($con,"select math,english,biology,chemistry,physics,total,percentage,grade from students where userid='$regno'");
                    
                    $row = mysqli_fetch_assoc($ins);
                    if(!$row){
                        echo "<p class='err'>Please enter the correct details!</p>";
                    }
                    else{
                        $ins = mysqli_query($con,"select * from students where userid='$regno'");
                        $val = mysqli_fetch_array($ins);

                        echo"<table>";

                        echo"<tr>";
                        echo"<td>Registration No</td>";
                        echo"<td>$val[0]</td>";
                        echo"</tr>";

                        echo"<tr>";
                        echo"<td>Date of Birth</td>";
                        echo"<td>$val[1]</td>";
                        echo"</tr>";

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

    <div class="disp">
        <h3><a class="rev" href="admin_home.php" target="_blank">Upload Marks!!</a></h3>
        <h3><a class="rev" href="admin_edit.php" target="_blank">Edit Marks!!</a></h3>
        <h3><a class="rev" href="del_year.php" target="_blank">Delete Marks!!</a></h3>
        <h3><a class="rev" href="del_user.php" target="_blank">Delete User!!</a></h3>
    </div>


    <!--copyright footer-->
    <div>
        <a href="https://github.com/Mr1-D3CRYPT" target="_blank">
            <h5 style="margin-left:10%;margin-bottom:5%;font-family: Cardo;font-size: small;position: absolute;">© 2023 Mr1-D3CRYPT</h5>
        </a>
    </div>

</body>
</html>