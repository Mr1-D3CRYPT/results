<?php

    session_start();
    $_SESSION['uname']=$_COOKIE['id'];
    $_SESSION['pass']=$_COOKIE['pass'];

    $uname = $_SESSION['uname'];
    $pass = $_SESSION['pass'];

    //connecting
    $con = mysqli_connect("localhost","root","","results");
                    
    //checking admin uname and password in the database
    $sql = mysqli_query($con,"select * from admin where Uname='$uname' AND Password='$pass'");

    $sta = mysqli_fetch_assoc($sql);
    if(!$sta){
        header("Location:admin_login.php");
    }

    else{
    }
                        
    session_destroy();
    mysqli_close($con);
    
?>

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
            margin: 3%;
            padding:5%;
            
            border: 2px;
            border-style: solid;        
        }
        .rev{
            text-decoration:none;
        }
        .error{
            color: red;
        }
        .success{
            color: green;
        }
    </style>
    
</head>


<body>

    <div class="disp">
        <h3>Mark Update</h3>
        <form method="POST" action="">
            <label for="userid">Registration number : </label>
            <input type="number" name="userid" id="userid" required> 
            <br><br>
            <label for="uname">Name : </label>
            <input type="text" name="uname" id="uname" required> 
            <br><br>
            <label for="dob">Date of Birth : </label>
            <input type="date" name="dob" id="dob" required> 
            <br><br>
            <label for="math">Maths mark : </label>
            <input type="number" min="0" max="100" name="math" id="math" required> 
            <br><br>
            <label for="english">English mark : </label>
            <input type="number" min="0" max="100" name="english" id="english" required> 
            <br><br>
            <label for="biology">Biology mark : </label>
            <input type="number" min="0" max="100" id="biology" name="biology" required> 
            <br><br>
            <label for="chemistry">Chemistry mark : </label>
            <input type="number" min="0" max="100" id="chemistry" name="chemistry" required> 
            <br><br>
            <label for="physics">Phyics mark : </label>
            <input type="number" min="0" max="100" id="physics" name="physics" required> 
            <br><br>
            
            <?php
                if(isset($_POST['submit']) and isset($_POST['userid'])){
                    if($_SERVER['REQUEST_METHOD']==='POST'){
                        session_start();
                                        
                        $_SESSION['userid']=$_POST['userid'];
                        $_SESSION['uname']=$_POST['uname'];
                        $_SESSION['dob']=$_POST['dob'];
                        $_SESSION['math']=$_POST['math'];
                        $_SESSION['english']=$_POST['english'];
                        $_SESSION['biology']=$_POST['biology'];
                        $_SESSION['chemistry']=$_POST['chemistry'];
                        $_SESSION['physics']=$_POST['physics'];

                        $userid = $_SESSION['userid'];
                        $uname = $_SESSION['uname'];
                        $db = $_SESSION['dob'];
                        $dob = date("Y-m-d", strtotime($db) );

                        $math = $_SESSION['math'];
                        $english = $_SESSION['english'];
                        $biology = $_SESSION['biology'];
                        $chemistry = $_SESSION['chemistry'];
                        $physics = $_SESSION['physics'];

                        $total=$math+$english+$biology+$chemistry+$physics;
                        $percentage=($total/500)*100;
                        if($percentage>=91){
                            $grade="A+";
                        }
                        else if($percentage>=80){
                            $grade="A";
                        }
                        else if($percentage>=70){
                            $grade="B+";
                        }
                        else if($percentage>=60){
                            $grade="B";
                        }
                        else if($percentage>=50){
                            $grade="C+";
                        }
                        else if($percentage>=40){
                            $grade="C";
                        }
                        else{
                            $grade="fail";
                        }

                        $con = mysqli_connect("localhost","root","","results");

                        $ins = mysqli_query($con,"select * from students where userid='$userid'");

                        if($ins){
                            $en = mysqli_query($con,"update students set name='$uname', dob='$dob', math='$math', english='$english', biology='$biology', chemistry='$chemistry', physics='$physics', total='$total' ,percentage='$percentage', grade='$grade' where userid = '$userid';");
                            if($en){
                                echo"<p class='success'>Update successfull!!</p>";
                            }
                            else{
                                echo "Updation failed!!";
                            }
                        }
                        else{
                           echo"<p class='error'>Updation failed</p>";
                        }
                    }
                                            
                        session_destroy();
                        mysqli_close($con);
                }
                
            ?>

            <input type="Submit" name="submit" id="submit">
        </form>
    </div>

    <div class="disp">
        <h3><a class="rev" href="view.php" target="_blank">View Marks!!</a></h3>
        <h3><a class="rev" href="admin_home.php" target="_blank">Upload Marks!!</a></h3>
        <h3><a class="rev" href="del_year.php" target="_blank">Delete Marks!!</a></h3>
        <h3><a class="rev" href="del_user.php" target="_blank">Delete User!!</a></h3>
    </div>

    <!--copyright footer-->
    <div>
        <a href="https://github.com/Mr1-D3CRYPT" target="_blank">
            <h5 style="margin-left:5%;font-family: Cardo;font-size: small;position: absolute;">© 2023 Mr1-D3CRYPT</h5>
        </a>
    </div>

</body>
</html>