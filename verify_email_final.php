<?php
require 'database.php';

if(isset($_GET['key']) && !empty($_GET['key']) AND isset($_GET['verif_token']) && !empty($_GET['verif_token']))
{
$token_received=strval($_GET['verif_token']);
$email_to_verify=$_GET['key'];
    $sql = "SELECT * FROM email_table WHERE email_id='$email_to_verify'";

$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) >0){
//echo $sql."  number rows - ".mysqli_num_rows($result)."   ";
while($row = $result->fetch_assoc()) {
$verification_token=md5($row['verification_status']);}

//$token_received=substr($token_received,0,strlen($token_received)-1);
//echo $token_received." ".$verification_token;
$verified_value_succcess=1;
$subscribed_value_succcess=1;

 if($token_received==$verification_token)
 {
     $sql2="UPDATE email_table SET verification_status='$verified_value_succcess' WHERE email_id='$email_to_verify'";
 if(mysqli_query($conn, $sql2))
 echo "Congratulations your email has been verified";

 $sql3="UPDATE email_table SET subscription_status='$subscribed_value_succcess' WHERE email_id='$email_to_verify'";

 if(mysqli_query($conn, $sql3))
 {
     echo nl2br("<font color='red'>You are now subscribed to xkcd mailer\n You will receive random xkcd comic in your email every 5 minutes \n\rEnjoy</font>");  
 }
 include 'comic_email_sender.php';
}
}}
else
{echo "error";}
 ?>
