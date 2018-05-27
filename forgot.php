<?php
   
    
    require_once 'config.php';


    //Including required PHPMailer Libraries
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;



    //Creating a function to generate a random shuffled string, to be used as token for Forgot Password
    function generateNewString($len = 10) {
        $token = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890"; 

        //Shuffling our string
        $token = str_shuffle($token);                                              

        //choosing the first 10 characters of the shuffled string
        $token = substr($token, 0, $len);                                          
    
        return $token;
    }




    if (isset($_POST['email'])) {
        
        $email = $link->real_escape_string($_POST['email']);

        $sql = $link->query("SELECT id FROM users WHERE email='$email'");
        if ($sql->num_rows > 0) {

            $token = generateNewString();

	        $link->query("UPDATE users SET token='$token', 
                      tokenExpire=DATE_ADD(NOW(), INTERVAL 5 MINUTE)
                      WHERE email='$email'
            ");

	        require_once "PHPMailer/PHPMailer.php";
            require_once "PHPMailer/Exception.php";
            require_once "PHPMailer/SMTP.php";
            
            $mail = new PHPMailer();
            
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                        // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'aisdigit@gmail.com';                // SMTP username
            $mail->Password = 'ones&zeroes';                         // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to


	        $mail->addAddress($email);                             //Send to 
	        $mail->setFrom("aisdigit@gmail.com", "Sherlocked");    //Send from 
	        $mail->Subject = "Reset Password";                     //subject
	        $mail->isHTML(true);
	        $mail->Body = "
	            Hi,<br><br>
	            
	            In order to reset your password, please click on the link below:<br>
	            <a href='
	            http://domain.com/reset.php?email=$email&token=$token        
                '>Click Here</a>
                <br>Or Copy this url to your browser address bar:<br>
                http://domain.com/reset.php?email=$email&token=$token
                <br><br>
                
                The link expires in 5 mins after you recieve this email.<br><br>

	            Regards,<br>
	            Digit OC
	        "; //replace the link with our own website link

            if ($mail->send())
    	        exit(json_encode(array("status" => 1, "msg" => 'Please Check Your Email Inbox!')));
    	    else
    	        exit(json_encode(array("status" => 0, "msg" => 'Something went wrong! Please try again!')));
        } else
            exit(json_encode(array("status" => 0, "msg" => 'Please Check Your Email!')));
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container" style="margin-top: 0px;">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3" align="center">
                <img src="images/logo.png" style="max-height: 300px; margin-top: 50px;">
                <p> Don't remember your password? No worries.<br>
                    Just Enter your Registered Email ID,
                     and we'll send you an automated mail, with a new random, hard to crack password.</p>
                <input class="form-control" id="email" placeholder="Your Email Address"><br>
                <input type="button" class="btn btn-primary" value="Reset Password">
                <br><br>
                <p id="response"></p>
            </div>
        </div>
    </div>


   



    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        var email = $("#email");

        $(document).ready(function () {
            $('.btn-primary').on('click', function () {
                if (email.val() != "") {
                    email.css('border', '1px solid green');

                    $.ajax({
                       url: 'forgot.php',
                       method: 'POST',
                       dataType: 'json',
                       data: {
                           email: email.val()
                       }, success: function (response) {
                            if (!response.success)
                                $("#response").html(response.msg).css('color', "red");
                            else
                                $("#response").html(response.msg).css('color', "green");
                        }
                    });
                } else
                    email.css('border', '1px solid red');
            });
        });
    </script>
</body>
</html>
