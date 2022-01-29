<?php
session_start();
$email_value = $_SESSION['email_passer'];

  require 'vendor/autoload.php';
  require 'database.php';
  



$key=getenv('thekey');
$value=getenv('thevalue');

  use \Mailjet\Resources;
  $mj = new \Mailjet\Client($key,$value,true,['version' => 'v3.1']);

  $sql = "SELECT * FROM email_table WHERE email_id='$email_value'";
$result = mysqli_query($conn, $sql);
/*if(mysqli_num_rows($result) >0){
echo $sql."  number rows - ".mysqli_num_rows($result)."   ";}*/
while($row = $result->fetch_assoc()) {
$verification_token=md5($row['verification_status']);
//echo $verification_token;
}


$body = [
    'Messages' => [
      [
        'From' => [
          'Email' => "dumyui81@gmail.com",
          'Name' => "Aakash"
        ],
        'To' => [
          [
            'Email' =>$email_value,
            'Name' => "Subscriber"
          ]
        ],
        'Subject' => "Please verify your email",
        'TextPart' => "Verification email",
        'HTMLPart' => "<html>
        <head>
        <title>Your email  is listed in our XKCD comics subscribers.</title>
        </head>
        <body> 
        <a href='https://phpassignment-xkcd.herokuapp.com/verify_email_final.php?key=".$email_value."&verif_token=".$verification_token."'>Click and Verify Email</a>;
<br>

        After verification you will start receiving the comics!!
        </body>
        </html>",
        'CustomID' => "AppGettingStartedTest"
      ]
    ]
  ];
  $response = $mj->post(Resources::$Email, ['body' => $body]);
  $response->success() && var_dump($response->getData());

  //
?>
