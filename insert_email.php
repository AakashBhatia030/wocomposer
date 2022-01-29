<!DOCTYPE html>
<html>

<head>
	<title>Insert Page page</title>
</head>

<body>
		<?php
session_start();

require 'database.php';
// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);
		
		// Check connection
		if($conn === false){
			die("ERROR: Could not connect. "
				. mysqli_connect_error());
		}
		$vtoken=rand(10,99);
		$unsub_token=rand(100,200);
        $id_toinsert=2;
		if(isset($_REQUEST['user_email']))
		{$user_email_toinsert = $_REQUEST['user_email'];}
		if (!filter_var($user_email_toinsert, FILTER_VALIDATE_EMAIL)) {
			echo "Invalid email format";
		  }
        $verified_toinsert=$vtoken;
		$subscribed_toinsert=0;
        $num_email=0;
	
	//	$sql = "INSERT INTO email_table (email_id,verification_status,subscription_status,num_email,unsub_token) VALUES (
	//		'$user_email_toinsert','$verified_toinsert','$subscribed_toinsert','$num_email','$unsub_token')";
	$sql = "INSERT INTO email_table (email_id,verification_status,subscription_status,num_email,unsub_token) VALUES (
		?,?,?,?,?)";

if($stmt = mysqli_prepare($conn, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "sssss", $user_email_toinsert,$verified_toinsert,$subscribed_toinsert,$num_email,$unsub_token);
    }
    

		try {
			if(mysqli_stmt_execute($stmt)){
				echo "<h3>data stored in a database successfully</h3>";
				$_SESSION['email_passer'] = $user_email_toinsert;

				echo nl2br("\n$user_email_toinsert\n $verified_toinsert\n "
					. "$subscribed_toinsert\n");
				include 'verify_email_send.php';
				
				
				}
		} catch (\Throwable $th) {
			//throw $th
			
			echo "ERROR";
                if(mysqli_errno($conn)==1062)
                {
                    echo "already subscribed";
                }

		}
		
	
		
		//include 'email_sender.php';
		// Close connection
		mysqli_close($conn);
		?>
</body>

</html>
