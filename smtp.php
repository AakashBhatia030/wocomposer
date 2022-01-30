<?php
ini_set("SMTP","smtp.gmail.com" );
ini_set("smtp_server","smtp.gmail.com" );
ini_set('username',"dumyui81@gmail.com");
ini_set('password','dumyme67771@');
ini_set("smtp_port","465");
ini_set('sendmail_from', 'dumyui81@gmail.com');       
ini_set('smtp_ssl','ssl');
ini_set('host','smtp.gmail.com');
echo "1";

echo ini_get("SMTP");
$to = "aakashbhatia030@gmail.com";
$subject = "Test mail";
$message = "Hello! This is a simple email message.";
$from = "dumyui81@gmail.com";
$headers = "From:" . $from;
$retval = mail($to,$subject,$message,$headers);
   if( $retval == true )  
   {
      echo "Message sent successfully...";
   }
   else
   {
      echo "Message could not be sent...";}
   ?>