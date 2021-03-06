<?php 

require_once 'config.php';

$sql = "SELECT * FROM `gameplay` ORDER BY `level` DESC";
$rs_result = $link->query($sql); 
$rank = 1;
$post = array();
while($row = $rs_result->fetch_assoc()){
    $post[] = $row;
  }
  
  
  

?>

 <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Leaderboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" >
    <meta name="description" content="Sherlocked | Online Cryptic Hunt">
    <meta name="author" content="Akshit Pareek">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.3/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.3/js/dataTables.rowReorder.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
     <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="css/leader&user_attmp.css">

</head>
<body>

     <header class="head">    
        <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
        <div class="navbar-header">
                    <a class="navbar-brand" href="#">SHERLOCKED</a>
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
        </div>

        <div class="collapse navbar-collapse navHeaderCollapse">
          <ul class="nav navbar-nav">              
            <li>  <a href="login.php" target="_blank">Home</a></li>
            <li> <a id="rule">Rules</a></li>
            <li class="active">  <a href="leaderboard.php">Leaderboard</a></li>
            <li>  <a href="hints.html" target="_blank">Hints</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="user_attempts.php" target="_blank" title="My Attempts">My Attempts</a></li>
            <li> <a href="logout.php" ><span class="glyphicon glyphicon-log-in"></span></a></li>
          </ul>
        </div>


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
                <strong style="font-size:8vh;">LEADERBOARD</strong> 
            </h2>
            </div>
            </div>
            </div>
            </header>

               
            <div class="box">
                    <div class="main-content">
                    <div class="card">
                                <div class="card-body">
           
                    <table id="myTable" class="display nowrap" style= "width:100%" >
                        <thead class="thead">
                                <tr>
                                    <th scope="col">Rank</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">Clear Time</th>
                                </tr>
                                </thead>
                                <tbody class="tbody" >
                            <?php 
                                foreach ($post as $row) 
                                    {       echo "<tr>";
                                            echo "<td>" .$rank. "</td>";
                                            echo "<td>" .$row['username'] . "</td>";
                                            
                                            echo "<td>" .$row['level'] . "</td>";
                                            echo "<td>" .$row['clear_time'] . "</td>";
                                            echo "</tr>";

                                            $rank ++;
                                     }
                              ?>
                           
                         </tbody>
                         </table>
                         <script>
                                $(document).ready(function() {
                                var table = $('#myTable').DataTable( {
                                rowReorder: {
                                selector: 'td:nth-child(2)'
                                },
                                responsive: true
                                } );
                                } );
                        </script>
                  </div>       
            </div>
    </div>
 </div>    
 <br>
<footer class="footer ">
      <div class="container">
        <span class="text-muted">Designed by Akshit Pareek.</span>
        <span class="text-muted pull-right"><a href="https://facebook.com/ahltech" target=_blank class="fa fa-facebook"></a><span><strong>.</strong></span>
        <a href="mailto:aisdigit@gmail.com?subject=Sherlocked"target=_blank class="fa fa-google"></a><span><strong>.</strong></span>
        <a href="#" target=_blank class="fa fa-globe"></a></span>
      </div>
    </footer>
              
                        
                
                
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
