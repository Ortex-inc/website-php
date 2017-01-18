<!DOCTYPE html>
<html lang="en">
<head>
  <title>24 News</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="journal.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<style>
#logout{width:100%;border:0;padding:3px 20px;} #hover:hover{ background-color:#d24444;}
</style>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">24 News</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Journal</a></li>

      <li><a href="http://arabuntu.byethost15.com/live.php">Chat</a></li>
    </ul>
<ul class="nav navbar-nav navbar-right">
<?php

include 'profile-nav.php';
profile();



?>
</ul>
    <form class="navbar-form navbar-left">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search">
        <div class="input-group-btn">
          <button class="btn btn-default" type="submit">
            <i class="glyphicon glyphicon-search"></i>
          </button>
          
        </div>
      </div>
    </form>
  </div>
</nav>

<br><br>



<?php
//logout
if (isset($_GET['logout'])) {
setcookie('firstname','',time()-3600);
setcookie('lastname','',time()-3600);
setcookie('email','',time()-3600);
setcookie('password','',time()-3600);
header('location: journal.php');
}

?>
<?php
  include 'sql_conn.php';
  $req="SELECT * FROM posts ORDER BY createddate DESC";
      $result = $conn->query($req);
  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
$title=$row['title'];
$content=$row['content'];
$likes=$row['likes'];
$shares=$row['shares'];
$img_url=$row['img_url'];
$date=$row['createddate'];
        echo '

<br><br>
   <div class="card">
      <a href="#"><p class="title" >'.$title.'</p></a>
   <img src="'.$img_url.'"></div>
      <div class="action">
       <button class="like" name="like">'.$likes.'</button>
       <button class="share" name="share">'.$share.'</button>
      </div>

  <br><br>';

        }
      }



 $req="SELECT * FROM status ";
      $result = $conn->query($req);
  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
$expeditor=$row['email'];
$status=$row['status'];
$link=$row['link'];
$date=$row['date'];

$likes=$row['likes'];
$shares=$row['shares'];

echo' <br><br><div class="card">
 <p class="poster">'.$expeditor.'</p>
    <p class="status">'.$status.'</p>
 <a href="#">'.$link.'</a>
    <p class="time">'.$date.'</p>
 </div>
      <div class="action">

       <button class="like" name="like">'.$likes.'</button>
       <button class="share" name="share">'.$share.'</button>
      </div>
 <br><br>';
}
}
      ?>

</body>
<script src='js/jq.js'></script>
<script src='js/npm.js'></script>
<script src='js/bootstrap.min.js'></script>
</html>


