<?php
$servername = "i0rgccmrx3at3wv3.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "oloyrxt0pqkuhxtc";
$password = "a7k037pgjg1k3trc";
$dbname = "gt8hiqpp1jb3daxp";
// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);
		
		// Check connection
		if($conn === false){
			die("ERROR: Could not connect. "
				. mysqli_connect_error());
		}
 ?>