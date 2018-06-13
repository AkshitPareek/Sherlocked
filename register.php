<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$username = $password = $email = $grade = $confirm_password = "";
$username_err = $password_err = $email_err = $grade_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
 
    
    // Validate email
          if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your E-mail.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This E-mail is already registered.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }

        // Validate Grade
        if(empty(trim($_POST['grade']))){
            $grade_err = "Please enter your class.";
        }elseif(strlen(trim($_POST['grade'])) <2 ){
               $grade_err = "Class must have atleast 2 characters."; 
        }elseif(strlen(trim($_POST['grade'])) >3 ){
            $grade_err = "Class must not have more than 3 characters."; 
        } else{
             $grade = trim($_POST['grade']);
        }
    
        // Validate password
        if(empty(trim($_POST['password']))){
            $password_err = "Please enter a password.";     
        } elseif(strlen(trim($_POST['password'])) < 8){
            $password_err = "Password must have atleast 8 characters.";
        } else{
             $password = trim($_POST['password']);
        }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = 'Please confirm password.';     
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Password did not match.';
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($email_err) && empty($grade_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, email, grade, `password`) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_email, $param_grade, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_email = $email;
            $param_grade = $grade;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
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
    <link rel="icon" href=" ">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style type="text/css">
        body{  font: 14px sans-serif; background: url(images/sherlock.jpg) #333;}
        
        .wrapper{height: 670px; width: 350px; padding: 20px; background-color: white; }
        
        .hom { z-index: 3; width: 310px; text-align:left; position:absolute; bottom:0.5em; }
        .socio {  z-index: 3; width: 230px; text-align:right; position:absolute; bottom:0.5em; left:100px;}
        
    </style>

</head>
<body>

    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label for="user_name"class="control-label">Username</label>
                <input type="text" name="username" id="user_name" placeholder="Preferably your Full name."class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label for="email_id"class="control-label">E-mail</label>
                <input type="email" name="email"id="email_id" placeholder="youremail@domain.com"class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($grade_err)) ? 'has-error' : ''; ?>">
                <label for="grad" class="control-label">Class</label>
                <input type="text" name="grade"id="grad" placeholder="Eg: 12A"class="form-control" value="<?php echo $grade; ?>">
                <span class="help-block"><?php echo $grade_err; ?></span>
            </div>       
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label for="pass_word"class="control-label">Password</label>
                <input type="password" name="password" id="pass_word" placeholder="Min. 8 letters"class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label for="confirm_pass"class="control-label">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_pass" placeholder="Retype Password"class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
            
            
            <div class="hom">
            <a href="index.php" class="fa fa-home"></a>
            </div>
            <div class= "socio"> 
            <a href="https://facebook.com/ahltech" target=_blank class="fa fa-facebook"></a>
            <a href="mailto:aisdigit@gmail.com?subject=BrainScratch" target=_blank class="fa fa-google"></a>
                <a href="#" target=_blank class="fa fa-globe"></a>
            </div>
        </form>
    </div>
    

</body>
</html>