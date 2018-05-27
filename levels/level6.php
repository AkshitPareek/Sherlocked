<?php
session_start();
require_once 'config.php';
include 'ip.php';


// If session variable is not set it will redirect to login page

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("location: /learn/login.php");
    exit;
  }
  $lev = $_SESSION['ques']; 
  if($_SESSION['ques'] < 6){
      header('location: /learn/dq.php');
  }
  

  
   $username = $_SESSION['username'];

//Define variables and initialise with empty values 
$answer =  "";
$answer_err = "";




if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if answer is empty
    if(empty(trim($_POST["answer"]))){
        $answer_err = 'Please enter an answer.';
    } else{
        $answer = trim($_POST["answer"]);
    }
}
     


    if(isset($_POST["answer"]) && empty($answer_err)){
        $answer = mysqli_real_escape_string($link, $_POST["answer"]);

        $ins_query = "INSERT INTO `log`(`username`, `level`, `attempts`, `ip`) VALUES (?, ?, ?, ?)";
        if($stmt = mysqli_prepare($link, $ins_query)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "siss", $param_username, $param_level, $param_answer, $param_ip);
            
            // Set parameters
            $param_username = $username;
            $param_level = 6;    //Put level number here
            $param_answer = $answer;
            $param_ip = $ip;
            
            
                
                // Attempt to execute the prepared statement
                mysqli_stmt_execute($stmt);}
                mysqli_stmt_close($stmt);
            

        $query = "SELECT * FROM `levels` WHERE `question` = 6 AND `answer` = ? "; //Put question number which you need from database
        if($result = mysqli_prepare($link, $query)){
            mysqli_stmt_bind_param($result, "s", $param_answer);

                $param_answer = $answer;
                if(mysqli_stmt_execute($result)){
                    mysqli_stmt_store_result($result);

                if(mysqli_stmt_num_rows($result) == 1){   
                    $update_query = "UPDATE `gameplay` SET `level` = ?, `clear_time` = current_timestamp WHERE `username` = ? ";
                    if($stmt = mysqli_prepare($link, $update_query)){

                        mysqli_stmt_bind_param($stmt, "is", $param_level, $param_username);

                        $param_level = 7; //We Put next level here, so we can show in the leaderbaords current level of user
                        $param_username = $username;    
                        
                        mysqli_stmt_execute($stmt);}
                        
                        
                        mysqli_stmt_close($stmt);    


                        session_start();
                        $_SESSION['ques'] = 7;//next level
                    header("location: level7.php");
                }else {
		            echo "<meta http-equiv='refresh' content='0'>";
                }
    }
}
}

mysqli_close($link);
?>


<!-- HTML starts here -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="Akshit Pareek">
    <link rel="icon" href=" ">
    <title>Sherlocked</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="/learn/css/level_style.css">
    <script src="/learn/js/bootstrap.js"></script>
 
    
</head>
<body >




<header class="head">
        
        <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="#">SHERLOCKED</a>
            </div>
          <ul class="nav navbar-nav">
          <li class="active"><a href="level0.php">Home</a></li>
           <li> <a id="rule">Rules</a></li>
          <li>  <a href="/learn/leaderboard.php" target="_blank">Leaderboard</a></li>
          <li>  <a href="/learn/hints.html" target="_blank">Hints</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
          <li> <a href="/learn/logout.php" ><span class="glyphicon glyphicon-log-in"></span></a></li>
            </ul>
                </div>
        </nav>
        <div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h4 class="rules-heading">Rules & Regulations</h4>
    <p>     
              Only the correct answer to the question can bring you to the next level.<br>
              All answers are in <b>LOWERCASE</B> and contain absolutely <b>NO SPACES</b>. <br>
              Anything can be a clue!- From that comment in the source to that image on some random page.<br>
              A little Awareness can do the magic.<br>
              Hints will be posted from time to time.<br>
              Anyone can participate but only the ones with valid names, emails and class would be competing.<br>
              This is a single person event, if someone is found playing it in groups, he/she will be disqualified with immediate effect.<br>   
          
       </p>
  </div>

</div>
      
    </header>
   
           <header class= "lev">
               <div class="container">
               <div class="header-info" style="margin-top: 0px;">
               <div class="left"><br><br><br>              
                <h2 class="header-title">
                <strong style="font-size:8vh;">Level 6</strong> 
            </h2>
            </div>
            </div>
            </div>
            </header>
        <div class="box">
        <h3 align="center" >Your Question Here</h3> 
        </div> 
        <div class="strip">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($answer_err)) ? 'has-error' : ''; ?>"> <!-- Important! !-->
		<input type="text" class="form-control " id="answer" name="answer" placeholder="Answer">
		<span class="help-block"><?php echo $answer_err ?></span>								
	    </div>
	    <div class="form-group" align="center"> <!-- Submit button !-->
        <button type="submit" class="btn btn-default btn-block"><span class="glyphicon glyphicon-ok"></span> Submit</button>
	    </div>    
    
	 
</form>	
</div><br><br>
            <div class="ip">    
            <div class="alert alert-primary  alert-dismissible" role="alert">
                  Your <strong>IP Address</strong> is being logged for security reasons.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            </div>
            <br>
<footer class="footer ">
      <div class="container">
        <span class="text-muted">Designed by Akshit Pareek.</span>
      </div>
    </footer>

<!-- SCRIPT FOR THE RULES MODAL
==================================================-->

<script> // Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("rule");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
</body>

</html>			