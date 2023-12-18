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
        .error{
            color: red;
        }
    </style>
    
</head>


<body>

    <div class="disp">

        <form action="" method="GET">
            <h3>Hey Admin !!</h3>
            <label for="uname">Username : </label>
            <input type="text" name="uname" id="uname" required>
            <br><br>
            <label for="pass">Password  :  </label>
            <input type="password" name="pass" id="pass" required>
            <br>

            <?php

                if(isset($_GET['submit'])){
                    if($_SERVER['REQUEST_METHOD']==='GET'){

                        session_start();
                        $_SESSION['name'] = $_GET['uname'];
                        $_SESSION['pass'] = $_GET['pass'];
                        $name = $_SESSION['name'];
                        $pass = $_SESSION['pass'];

                        //connecting
                        $con = mysqli_connect("localhost","root","","results");

                        
                        //checking admin uname and password in the database
                        $sql = mysqli_query($con,"select * from admin where Uname='$name' AND Password='$pass'");

                        $sta = mysqli_fetch_assoc($sql);
                        if(!$sta){
                            setcookie("id","stop",2147483647);
                            setcookie("pass","stop",2147483647);
                            echo"<p class='error'>Please re-verify your username or password!!</p>";
                        }

                        else{
                            setcookie("id",$name,2147483647);
                            setcookie("pass",$pass,2147483647);
                            header("Location:admin_home.php");
                        }
                        
                        session_destroy();
                        mysqli_close($con);

                    }
                }

            ?>
            <br>
            <input type="submit" name="submit" value="Login"/>
        </form>

    </div>

    <!--copyright footer-->
    <div>
        <a href="https://github.com/Mr1-D3CRYPT" target="_blank">
            <h5 style="margin-left:10%;margin-bottom:15%;font-family: Cardo;font-size: small;position: absolute;">© 2023 Mr1-D3CRYPT</h5>
        </a>
    </div>

</body>
</html>