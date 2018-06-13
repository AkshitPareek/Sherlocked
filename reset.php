<?php
require_once 'config.php';

function generateNewString($len = 10) {
    $token = "abcdefghijklmnopqrstuvwxyz1234567890";
    $token = str_shuffle($token);
    $token = substr($token, 0, $len);

    return $token;
}

function redirectToLoginPage() {
    header('Location: login.php');
    exit();
}


if (isset($_GET['email']) && isset($_GET['token'])) {
    $email = $link->real_escape_string($_GET['email']);
    $token = $link->real_escape_string($_GET['token']);

    $sql = $link->query("SELECT id FROM users WHERE email='$email' AND token='$token' AND token<>'' AND tokenExpire > NOW() ");

    if ($sql->num_rows > 0) {
        
        $newPassword = generateNewString();
        $newPasswordEncrypted = password_hash($newPassword, PASSWORD_DEFAULT);
        $link->query("UPDATE users SET token='', password = '$newPasswordEncrypted' WHERE email='$email' ");

    } else
        redirectToLoginPage();
} else {
    redirectToLoginPage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Password Reset</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 750px;
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
                        <h1>Password Reset</h1>
                    </div>
                    <div class="alert alert-primary fade in">
                        <p>Your new password is <strong><?php echo $newPassword ?></strong></p>
                        <p>Make sure to copy this password and save it in a secure location.</p>
                    </div>
                    </div>
                         <p><a href="login.php" class="btn btn-primary">Login</a></p>
                 </div>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>