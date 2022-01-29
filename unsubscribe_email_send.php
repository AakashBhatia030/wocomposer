<?php
require 'database.php';

if(isset($_GET['key']) && !empty($_GET['key']) AND isset($_GET['unsubscribe_token']) && !empty($_GET['unsubscribe_token']))
{
$token_received=strval($_GET['unsubscribe_token']);
$email_to_unsubscribe=$_GET['key'];

    $sql = "SELECT * FROM email_table WHERE email_id='$email_to_unsubscribe'";

$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) >0){
    while($row = $result->fetch_assoc()) {
$unsub_token=md5($row['unsub_token']);}


$unsub_value_succcess=0;

 if($token_received==$unsub_token)
 {
     $sql2="DELETE FROM email_table WHERE email_id='$email_to_unsubscribe'";
 if(mysqli_query($conn, $sql2))
 echo " your email has been unsubscribed";

}
}}
else
{echo "error";}
 ?>
