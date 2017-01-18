<?php
define("SERVERNAME" , "sql312.byethost15.com");
define("USERNAME" , "b15_18497018");
define("PASSWORD" , "azerty");
define("DB" , "b15_18497018_users");
$conn= new mysqli(SERVERNAME, USERNAME, PASSWORD,DB);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  
  }



$min=2;
// get bio from db


$sql="SELECT email,time FROM online WHERE 1";

//fetch in datebase
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $last=$row['time'];
	$email=$row['email'];
//
$date=date('Y-m-d H:i:s');
 $date = strtotime($date);
$last = strtotime($last);

$interval=round(abs($date - $last) / 60);
echo "</br>".$email." was actif in : ".$interval." minute</br>";

if($interval>=$min){
$stat=0;
}


  $sql ="UPDATE online SET stat='$stat'  WHERE email='$email'";
  if ($conn->query($sql) === TRUE) {
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
 }
    }









?>

