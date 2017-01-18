<?php
include 'sql_conn.php';
$sql="CREATE TABLE IF NOT EXISTS mailing ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, email VARCHAR(30), date_get DATETIME)";
if ($conn->query($sql) === TRUE) {

} else {echo $conn->error;}

$req="SELECT email FROM mailing WHERE  1";
$found=false;
    $email=htmlspecialchars ($_POST['email']);
if($email!=''){
//fetch in datebase and verify
$result = $conn->query($req);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if($email==$row['email']){$found=true;break;}
   }
 }
}
if(!$found && $email!=''){
  $date=date('Y-m-d');
  $query="INSERT INTO mailing (email,date_get) VALUES ('$email','$date')";
  if ($conn->query($query) === TRUE) {

  } else {
      echo "Error inserting in table: " . $conn->error;
  }
}
 ?>
