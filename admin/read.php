<?php

session_start();
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("location: /sherlocked/login.php");
    exit;
  }
  if($_SESSION["role"]!=2){
    header('Location: /sherlocked/dq.php');
  } 
// Check existence of id parameter before processing further
if(isset($_GET["username"]) && !empty(trim($_GET["username"]))){
    // Include config file
    require_once 'config.php';
    
    // Prepare a select statement
    $sql = "SELECT * FROM `gameplay` WHERE `username` = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        
        // Set parameters
        $param_username = trim($_GET["username"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                            
                // Retrieve individual field value
                $username = $row["username"];
                $level = $row["level"];
                $clear_time = $row["clear_time"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>View Record</h1>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <p class="form-control-static"><?php echo $row["username"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <p class="form-control-static"><?php echo $row["level"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Clear Time</label>
                        <p class="form-control-static"><?php echo $row["clear_time"]; ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a>
                       <?php echo "<a href='change_level.php?username=". $row['username'] ."' title='View Record' class='btn btn-danger'> Change Records!!!</a>";
                       ?></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>