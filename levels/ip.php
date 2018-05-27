<?php

   //Trying to get user ip
   function getRealIpAddr() {
    if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip=$_SERVER['HTTP_CLIENT_IP']; // share internet
    } elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR']; // pass from proxy
    } else {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
  }
  $ip = getRealIpAddr(); // Get the visitor's IP

?>