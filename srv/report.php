<?php
include 'sql_conn.php';


$email=htmlspecialchars ($_GET['email']);
$select=htmlspecialchars ($_GET['select']);
$feed=htmlspecialchars ($_GET['feed']);
$date=date("Y-m-d h:i");





  $sql="INSERT INTO `reports` (`email`,`select`,`feed`,`date`) VALUES('$email','$select','$feed','$date')";
  if ($conn->query($sql) === TRUE) {} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
echo "Thanks to your feed ".$_COOKIE['email'];


header('location: journal.php');
?>
