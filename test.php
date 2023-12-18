<?php
if(isset($_POST['submit'])){


            session_start();
                            
            echo "got in!!";

            $con = mysqli_connect("localhost","root","","results");
    
            $filename=$_FILES["file"];    
            if($_FILES["file"]["size"] > 0)
            {
                $file = fopen($filename, "r");
                while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
                {
                        $sql = "INSERT into employeeinfo (emp_id,firstname,lastname,email,reg_date) 
                        values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."')";
                        $result = mysqli_query($con, $sql);
                        if(!isset($result))
                        {
                        echo "upload successful";    
                        }
                        else {
                            echo "upload failed";
                        }
                }
            
                fclose($file);  
            }
    }   
?>
<html>
<head>
 </head>
<body>
    <div id="wrap">
        <div class="container">
            <div class="row">
                <form class="form-horizontal" action="" method="POST" name="upload_excel">
                    <fieldset>
                        <!-- Form Name -->
                        <legend>Form Name</legend>
                        <!-- File Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="filebutton">Select File</label>
                            <div class="col-md-4">
                                <input type="file" name="file" id="file" class="input-large">
                            </div>
                        </div>
                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="singlebutton">Import data</label>
                            <div class="col-md-4">
                                <button type="submit" id="submit" name="submit" class="btn btn-primary button-loading" data-loading-text="Loading...">Import</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>

        </div>
    </div>
</body>
</html>
