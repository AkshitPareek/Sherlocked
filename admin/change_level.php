<?php
// Include config file
require_once 'config.php';


session_start();
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("location: /sherlocked/login.php");
    exit;
  }
  if($_SESSION["role"]!=2){
    header('Location: /sherlocked/dq.php');
  }
 
// Define variables and initialize with empty values
$level = "";
$level_err= "";
 
// Processing form data when form is submitted
if(isset($_POST["username"]) && !empty($_POST["username"])){
    // Get hidden input value
    $username = $_POST["username"];
    
    //validate level
    $input_level = trim($_POST["level"]);
    if(empty($input_level)){
        $level_err = "Please enter a valid Level";     
    } elseif(!ctype_digit($input_level)){
        $level_err = 'Please enter a positive integer value.';
    }elseif(strlen($input_level) > 2){
        $level_err = 'Please Enter A Valid Level';
    } 
    else{
        $level = $input_level;
    }
    
    // Check input errors before inserting in database
    if(empty($level_err) ){
        // Prepare an update statement
        $sql = "UPDATE `gameplay` SET `level`=? WHERE `username`=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_level, $param_username);
            
            // Set parameters
            $param_level = $level;
            $param_username = $username;
            
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of username parameter before processing further
    if(isset($_GET["username"]) && !empty(trim($_GET["username"]))){
        // Get URL parameter
        $username =  trim($_GET["username"]);
        
        // Prepare a select statement
        $sql = "SELECT `level` FROM `gameplay` WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $level = $row["level"];
                    
                } else{
                    // URL doesn't contain valid id. Redirect to error page
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
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Update Record</title>
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
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($level_err)) ? 'has-error' : ''; ?>">
                            <label>Level</label>
                            <input type="text" name="level" class="form-control" value="<?php echo $level; ?>">
                            <span class="help-block"><?php echo $level_err;?></span>
                        </div>
                        
                        <input type="hidden" name="username" value="<?php echo $username; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>