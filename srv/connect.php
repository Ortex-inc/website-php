<?php
include 'sql_conn.php';

session_start();
$found=false;

if(!isset($_COOKIE['email']) || !isset($_COOKIE['password'])){
$email=htmlspecialchars ($_COOKIE['email']);
$pswd=htmlspecialchars ($_COOKIE['password']);
}
else if(!isset($_SESSION['email']) || !isset($_SESSION['password'])){
$email=htmlspecialchars ($_SESSION['email']);
$pswd=htmlspecialchars ($_SESSION['password']);


} else {
   header('location: login.php');
}
$req="SELECT email,password FROM users";
//fetch in datebase and verify
$result = $conn->query($req);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if($email==$row['email'] && $pswd==$row['password']){
          $found=true;
		break;
        }
        }
  }

    if($found){
      echo "You are already logged in..";
  sleep(2);
  // header('location: profile.php');
    
 
    }


$found=false;
$i=1;

          $email=htmlspecialchars ($_GET['email']);
          $pswd=htmlspecialchars ($_GET['password']);

$req="SELECT email,password,lastname,firstname FROM users";
//fetch in datebase and verify
$result = $conn->query($req);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if($email==$row['email'] && $pswd==$row['password']){
          $firstname=htmlspecialchars ($row['firstname']);
          $lastname=htmlspecialchars ($row['lastname']);
          $found=true;break;
        }

        }
    }
 

    if(!$found){


$url = "login.php?i=".$i;
header("Location: ".$url);
    }
    else if ($found){


if(!isset($_GET['cbox'])){
session_start();
$_SESSION['email']=$email;
$_SESSION['password']=$pswd;
$_SESSION['firstname']=$firstname;
$_SESSION['lastname']=$lastname;

echo 'Session activated and setted! ';
//header ('location: dashboard.php');
}
else if(isset($_GET['cbox'])){
$delay=3600;
      setcookie('firstname',$firstname,time()+$delay);
      setcookie('lastname',$lastname,time()+$delay);
      setcookie('email',$email,time()+$delay);
      setcookie('password',$pswd,time()+$delay);
echo 'Cookie activated and setted! ';

}
     header('location: profile.php');
    }


?>
