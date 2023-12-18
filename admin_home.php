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
        <h3>Mark Entry</h3>
        <form method="POST" action="">
            <label for="myfile">Upload your csv here : </label>
            <input type="file" name="myfile" id="myfile" required> 
            <br><br>
            
            <?php
                if(isset($_POST['submit']) and isset($_POST['myfile'])){
                    if($_SERVER['REQUEST_METHOD']==='POST'){
                        session_start();
                                        
                        $con = mysqli_connect("localhost","root","","results");

                        $val = 0;
                        $suc = 0;
                        $fail = 0;
                        $rep = 0;
                        $handle = fopen($_POST['myfile'], "r");
		                while(($data = fgetcsv($handle, 1000, ","))!== false){

                            $val++;
                            if ($val == 1){
                                continue;
                            }

                            $_SESSION['userid']=$data[0];
                            $_SESSION['name']=$data[1];
                            $_SESSION['dob']=$data[2];
                            $_SESSION['math']=$data[3];
                            $_SESSION['english']=$data[4];
                            $_SESSION['biology']=$data[5];
                            $_SESSION['chemistry']=$data[6];
                            $_SESSION['physics']=$data[7];

                            $user = $_SESSION['userid'];
                            $uname = $_SESSION['name'];
                            $dob = $_SESSION['dob'];
                            $math = $_SESSION['math'];
                            $english = $_SESSION['english'];
                            $biology = $_SESSION['biology'];
                            $chemistry = $_SESSION['chemistry'];
                            $physics = $_SESSION['physics'];
                            $total = $english + $chemistry + $physics + $math + $biology;
                            $percentage = ($total/500)*100;
                            if ($percentage >= 90) {
                                $grade = 'A';
                            } elseif ($percentage >= 80) {
                                $grade = 'B';
                            } elseif ($percentage >= 70) {
                                $grade = 'C';
                            } elseif ($percentage >= 60) {
                                $grade = 'D';
                            } else {
                                $grade = 'F';
                            }

                            $con = mysqli_connect("localhost","root","","results");

                            $ins = mysqli_query($con,"select * from students where userid='$user'");
                            $valu = mysqli_num_rows($ins);
                            if($valu==0){
                                $en = mysqli_query($con,"insert into students() values('$user','$uname','$dob','$math','$english','$biology','$chemistry','$physics','$total','$percentage','$grade')");
                                if($en){
                                    $suc++;
                                }
                                else{
                                    $fail++;
                                }
                            }
                            else{
                                $rep++;
                            }                        
                        }
                        
                        $temp = $fail+$rep;
                        echo "<p class='success'>Entry Successful for $suc valaues!!</p>";
                        echo "<p class='error'>Entry failed for $temp values</p>";
                        
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
        <h3><a class="rev" href="admin_edit.php" target="_blank">Edit Marks!!</a></h3>
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