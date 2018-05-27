<?php
session_start();
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("location: /learn/login.php");
    exit;
  }
  if($_SESSION["role"]!=2){
    header('Location: /learn/dq.php');
  } 


// Check existence of id parameter before processing further
if(isset($_GET["username"]) && !empty(trim($_GET["username"]))){
    // Include config file
    require_once 'config.php';
    
    // Prepare a select statement
    $sql = "SELECT `level`, `attempts`, `attempt_time`, `ip` FROM `log` WHERE `username` = ? ";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        
        // Set parameters
        $param_username = trim($_GET["username"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) > 0){
                $post = array();
                while($row = mysqli_fetch_assoc($result))
                {
                    $post[] = $row;
                }
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript"src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
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
                        <h1>View Attempts</h1>
                    </div>
                
                    <div class="form-group">
                        <table id="myTable" class='table table-bordered table-striped'>
                        <thead>
                                <tr>
                                    <td>Level</td>
                                    <td>Attempts</td>
                                    <td>Attempt Time</td>
                                    <td>IP Address</td>
                                </tr>
                                </thead>
                                <tbody><?php 
                             foreach ($post as $row) 
                                    {       echo "<tr>";
                                            echo "<td>" .$row['level'] . "</td>";
                                            echo "<td>" .$row['attempts'] . "</td>";
                                            echo "<td>" .$row['attempt_time'] . "</td>";
                                            echo "<td>" .$row['ip'] . "</td>";
                                            echo "</tr>";
                                     }
                         ?></tbody>
                         </table>
                         <script>
                                $(document).ready(function(){
                                    $('#myTable').dataTable();
                                });
                        </script>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>