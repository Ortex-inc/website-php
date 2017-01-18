<?php
include 'sql_conn.php';
$sql="CREATE TABLE users ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, firstname VARCHAR(30) NOT NULL, lastname VARCHAR(30) NOT NULL, email VARCHAR(50), password VARCHAR(50), bio VARCHAR(50),date_reg DATETIME)";
if ($conn->query($sql) === TRUE) {} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$firstname= htmlspecialchars ($_GET['firstname']);
$lastname=htmlspecialchars ($_GET['lastname']);
$email=htmlspecialchars ($_GET['email']);
$pswd=htmlspecialchars ($_GET['password']);
$sql="SELECT email FROM users";
$found=false;
//fetch in datebase
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if($email==$row['email']){
          echo 'You alredy have an account! Please login..';
          $found=true;
break;
        }
      }
    }

if(!$found){
  $date=date("Y-m");
  $sql="INSERT INTO users (firstname,lastname,email,password,bio,date_reg) VALUES ('$firstname','$lastname','$email','$pswd','$bio','$date')";
  if ($conn->query($sql) === TRUE) {} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
sleep(2);
  header('location: login.php');
 ?>
