<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Please enter username.';
    } else{
        $username = trim($_POST["username"]);
    }
     
    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT `username`, `password` FROM `users` WHERE `username` = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            
                             $admin_query = "SELECT `status` FROM `user_status` WHERE `username` = ? ";
                            if($result = mysqli_prepare($link, $admin_query)){
                                mysqli_stmt_bind_param($result, "s", $param_username);

                                $param_username = $username;
                                if(mysqli_stmt_execute($result)){
                                    mysqli_stmt_store_result($result);
                                    if(mysqli_stmt_num_rows($result)== 1){
                                        
                                            session_start();
                                            $_SESSION['username'] = $username; 
                                            $_SESSION["role"] =  2;                 
                                        header("location: admin/index.php");}
                                        else{ $query = "SELECT `level` FROM `gameplay` WHERE `username` = ? "; //getting the current level of the user from the database      
                                            if($stmt = mysqli_prepare($link, $query)){
                                                mysqli_stmt_bind_param($stmt, "s", $param_username);
                                                
                                                $param_username = $username;
        
                                                if(mysqli_stmt_execute($stmt)){
                                                    mysqli_stmt_store_result($stmt);
        
                                                    if(mysqli_stmt_num_rows($stmt) == 1) //if current username exists
                                                    { 
                                                        mysqli_stmt_bind_result($stmt, $lev);
                                                        while( mysqli_stmt_fetch($stmt)) //fetch current level of the user
                                                        {  session_start();
                                                            $_SESSION['username'] = $username;
                                                            $_SESSION['ques'] = $lev;                               
                                                                header("location: levels/level$lev.php"); //loads the level on which user currently is.
                                                        }
        
                                                    }else {
                                                        session_start();
                                                        $_SESSION['username'] = $username;
                                                        
                                                        header("location: levels/level0.php");} //if no user found, send them to the first level i.e. level 0
        
                                                }
                                            } mysqli_stmt_close($stmt);
                                   }
                                        }
                                    }
                                
                            
                            
                                
                        } else{
                            // Display an error message if password is not valid
                            $password_err = 'The password you entered was not valid.';
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = 'No account found with that username.';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="description" content="Sherlocked | Online Cryptic Hunt">
        <meta name="author" content="Akshit Pareek">
        <title>Login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <style type="text/css">
        body{ font: 14px sans-serif; background: url(images/sherlock.jpg); }
        .wrapper{ height:670px; width: 350px; padding: 20px; background-color: white; }
        .hom { z-index: 3; width: 310px; text-align:left;  position:absolute; bottom:0.5em; }
        .socio {  z-index: 3; width: 230px; text-align:right; position:absolute; bottom:0.5em;left:100px;}
        
        </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label for="user_name"class="control-label">Username</label>
                <input type="text" name="username"id="user_name" placeholder="Enter your Username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label for="pass_word"class="control-label">Password</label>
                <input type="password" name="password"id="pass_word" placeholder="Enter your Password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" style="min-width: 80px;" value="Login">
                <a class="pull-right" href = "forgot.php"> Forgot Password</a>
            </div>
            
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
            
            <div class="hom">
            <a href="index.php" class="fa fa-home"></a></div>
            <div class= "socio"> 
                <a href="https://facebook.com/ahltech" target=_blank class="fa fa-facebook"></a>
                <a href="mailto:aisdigit@gmail.com?subject=BrainScratch" target=_blank class="fa fa-google"></a>
                <a href="#" target=_blank class="fa fa-globe"></a></div>
 
        </form>
    </div>  
     
</body>
</html>

