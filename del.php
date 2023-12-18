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
            margin: 10%;
            padding:5%;
            
            border: 2px;
            border-style: solid;
        }
        .del{
            color: red;
        }
    </style>
    
</head>

<body>

    <div class="disp">

        <h4>Shall I delete the old marks?</h4>
        <h4>If yes, click below!!</h4>

        <form action="" method="POST">
            <input type="submit" name="submit" id="submit" value="Delete">
        </form>

        <?php

            if(isset($_POST['submit'])){
                if($_SERVER['REQUEST_METHOD']==='POST'){

                    session_start();

                    $con = mysqli_connect("localhost","root","","results");
                    $del = mysqli_query($con,"select * from students where userid>'0' and userid<'100'");

                    //$status =mysqli_fetch_assoc($del); 
                    if(!$del){
                        echo"<p class='del'>No data to delete!!</p>";
                    }
                    else{
                        $del = mysqli_query($con,"delete from students where userid>'0' and userid<'100'");
                        echo"<p class='del'>Deleted!!</p>";
                    }

                    mysqli_close($con);
                    session_destroy();
                }
            }
        ?>
    </div>

    <!--copyright footer-->
    <br>
    <br>
    <br>
    <div>
        <a href="https://github.com/Mr1-D3CRYPT" target="_blank">
            <h5 style="margin:10%;margin-top:15%;font-family: Cardo;font-size: small;position: absolute;">© 2023 Mr1-D3CRYPT</h5>
        </a>
    </div>

</body>
</html>