<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,  maximum-scale=1, user-scalable=no" >
    <title>Cheater Caught</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 750px;
            margin: 0 auto;}
    </style>
</head>
<body>
<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                          <h1>Hi, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>. </h1>
                    </div>
                    <div class="alert alert-danger fade in">
                        <p>Tryna Cheat? Sad lyf. :( 
                    </div>
                         <p><a href="logout.php" class="btn btn-danger">I'm Sorry!</a></p>
                 </div>
            </div>        
        </div>
    </div>             
 </body>
</html>