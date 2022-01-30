<?php
/*
ini_set('display_errors', 1);
ini_set("SMTP","smtp.gmail.com" );
ini_set("smtp_server","smtp.gmail.com" );
ini_set('auth_username',"dumyui81@gmail.com");
ini_set('auth_password','dumyme67771@');
ini_set("smtp_port","465");
ini_set('sendmail_from', 'dumyui81@gmail.com');       
ini_set('smtp_ssl','ssl');
ini_set('host','smtp.gmail.com');
echo "1";

echo ini_get("password");
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
  
  */
  # This call sends a message to one recipient.
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, 'https://api.mailjet.com/v3.1/send');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n\t\t\"Messages\":[\n\t\t\t\t{\n\t\t\t\t\t\t\"From\": {\n\t\t\t\t\t\t\t\t\"Email\": \"dumyui81@gmail.com\",\n\t\t\t\t\t\t\t\t\"Name\": \"Mailjet Pilot\"\n\t\t\t\t\t\t},\n\t\t\t\t\t\t\"To\": [\n\t\t\t\t\t\t\t\t{\n\t\t\t\t\t\t\t\t\t\t\"Email\": \"aakashbhatia030@gmail.com\",\n\t\t\t\t\t\t\t\t\t\t\"Name\": \"passenger 1\"\n\t\t\t\t\t\t\t\t}\n\t\t\t\t\t\t],\n\t\t\t\t\t\t\"Subject\": \"Your email flight plan!\",\n\t\t\t\t\t\t\"TextPart\": \"Dear passenger 1, welcome to Mailjet! May the delivery force be with you!\",\n\t\t\t\t\t\t\"HTMLPart\": \"<h3>Dear passenger 1, welcome to <a href=\"https://www.mailjet.com/\">Mailjet</a>!</h3><br />May the delivery force be with you!\"\n\t\t\t\t}\n\t\t]\n\t}");
  curl_setopt($ch, CURLOPT_USERPWD, $_ENV["640cc816ae9eb44cdb24fba03f76fae5"] . ':' . $_ENV["22e821b5edd3a898deb4ae9eed50b574"]);
  
  $headers = array();
  $headers[] = 'Content-Type: application/json';
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  
  $result = curl_exec($ch);
  if (curl_errno($ch)) {
      echo 'Error:' . curl_error($ch);
  }
  curl_close($ch);
  ?>