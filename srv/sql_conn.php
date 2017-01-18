<?php

define("SERVERNAME" , "");
define("USERNAME" , "");
define("PASSWORD" , "");
define("DB" , "");
$conn= new mysqli(SERVERNAME, USERNAME, PASSWORD,DB);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  
  }

    $create = "CREATE TABLE IF NOT EXISTS `visitors` ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, num INT(6), month INT(6), year INT(6))";
    if ($conn->query($create) === TRUE) {

    } else {
        echo "Error : ". $conn->error;
    }

//count visitors
$year=date('Y');
$month=date('m');
$sql = "SELECT year FROM visitors ORDER BY `id` DESC  LIMIT 1 ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      if($year==$row['year']){break;}
        else {
        for($i=$month;$i<12;$i++){
          $insert="INSERT INTO visitors (num,month,year) VALUES ('0','$i','$year')";

        }

      }

    }
}

$select="SELECT * FROM visitors";

$result = $conn->query($select);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if($year==$row['year'] && $month==$row['month']){

$num=$row['num'];
$num++;
  $update="UPDATE visitors SET num='$num' WHERE month='$month' AND year='$year'";
  if ($conn->query($update) === TRUE) {

  } else {
      echo "Error: " . $conn->error;
  }
      }


}
}

//check online status


$email=$_COOKIE['email'];
$pswd=$_COOKIE['password'];
$select="SELECT email,password FROM users";
$found=false;
$result = $conn->query($select);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
if($email==$row['email'] && $pswd==$row['password']){
$found=true;
$stat=1;
}

}
}


$date=date('Y-m-d H:i:s');
  $sql ="UPDATE online SET stat='$stat' , time='$date' WHERE email='$email'";
  if ($conn->query($sql) === TRUE) {
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}





?>
