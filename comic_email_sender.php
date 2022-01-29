<?php
 // require 'vendor/autoload.php';
  require 'database.php';
  use \Mailjet\Resources;
  
$key=getenv('thekey');
$value=getenv('thevalue');
  $mj = new \Mailjet\Client($key,$value,true,['version' => 'v3.1']);
  
  $url = "https://c.xkcd.com/random/comic/";
$ch  = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$a = curl_exec($ch);
$url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
$str  = file_get_contents($url.'info.0.json');
$json = json_decode($str, true);
$imageTitle = $json['title'];
$imageUrl = $json['img'];
$imageAlt = $json['alt'];
$imageFile = file_get_contents($imageUrl);

$sql = "SELECT * FROM email_table";
//$result = mysqli_query($conn, $sql);

$allUserStatement = mysqli_prepare($conn,$sql);

mysqli_stmt_execute($allUserStatement);

$result = mysqli_stmt_get_result($allUserStatement);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    if($row["verification_status"]==1 && $row["subscription_status"]==1)
    {
    echo "id: " . $row["email_id"]. "<br>";
 $unsub_token=md5($row["unsub_token"]);

$body = [
    'Messages' => [
      [
        'From' => [
          'Email' => "dumyui81@gmail.com",
          'Name' => "Aakash"
        ],
        'To' => [
          [
            'Email' =>$row["email_id"],
            'Name' => "Subscriber"
          ]
        ],
        'Subject' => "Your random xkcd comic",
        'TextPart' => "My first Mailjet email",
        'HTMLPart' => "<html>
        <head>
        <title>Your email  is listed in our XKCD comics subscribers.</title>
        </head>
        <body> 
            <h1>$imageTitle</h1>
            <img src=$imageUrl alt=$imageAlt>
            <h3><a href='$url'>Follow this link for the comic on xkcd's website</a></h3>
            <h3><a href='https://phpassignment-xkcd.herokuapp.com/unsubscribe_email_send.php?key=".$row["email_id"]."&unsubscribe_token=".$unsub_token."'>Click here to unsubscribe from xkcd mailer</a></h3>


        </body>
        </html>",
        'CustomID' => "AppGettingStartedTest"
      ]
    ]
  ];
  $response = $mj->post(Resources::$Email, ['body' => $body]);
  $response->success() && var_dump($response->getData());

}
}} else {
  echo "0 results";
}
  //
?>