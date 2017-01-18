<?php
$servername = "";
$username = "";
$password = "";
$db = "";
$conn= new mysqli($servername, $username, $password,$db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo "error ! can't connect to database try later.";
  }
include 'alert.php';

      //cuted from here
    $sql='SELECT email,password FROM admin WHERE 1 LIMIT 0,30';

    mysql_query($sql,$conn);
    //fetch in datebase and verify
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            if($_COOKIE['email']==$row['email'] && $_COOKIE['password']==$row['password']){

$found=true;
  $admin=true;


} else {$admin=false;}

        }
      }



if(isset($_GET['submit'])){
 $email=htmlspecialchars ($_GET['email']);
          $pswd=htmlspecialchars ($_GET['password']);

$req="SELECT email,password,firstname,lastname FROM admin";
//fetch in datebase and verify
$result = $conn->query($req);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if($email==$row['email'] && $pswd==$row['password']){
          $firstname=htmlspecialchars ($row['firstname']);
          $lastname=htmlspecialchars ($row['lastname']);
          $found=true;
$admin=true;break;
        }
}
     
    }
 

    if(!$found){
      $alert->warning(" Account not found try to correct you email or password");
    }
    else if ($found){
$delay=3600;
      setcookie('firstname',$firstname,time()+$delay);
      setcookie('lastname',$lastname,time()+$delay);
      setcookie('email',$email,time()+$delay);
      setcookie('password',$pswd,time()+$delay);
    }
}

?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
<link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>


  <title>Dashboard</title>
  <style>

html,body{width:100%;height:100%;
  background-color:#dddddd;}

#table{position:relative;width:100%;}
#tb,#rp,#ac{display:none;width:80%;position:relative;margin:auto;}

.card{
margin:auto;
text-align:center;
border:2px dashed #f23434;
height:30%;
    background:white;
    padding: 20px;
    line-height: 26px;
    font-family: ubuntu, sans-serif;
    font-size: 18px;
    -webkit-box-shadow: 0px 0px 5px 0px rgba(50, 50, 50, 0.75);
    -moz-box-shadow:    0px 0px 5px 0px rgba(50, 50, 50, 0.75);
    box-shadow:         0px 0px 5px 0px rgba(50, 50, 50, 0.75);
}
u{color:#2196F3;
font-size:14px;}
.card p{
font-style:italic;
font-weight:bold;
color:#fb735c;
}


.acc{
padding:10px;
text-align:center;
min-height:20%;
border-left:5px solid #2196F3;
background-color:#ddffff;
}

  </style>

</head>
<body <?php if(!$admin){echo'onload="admin()"';}?>>



<nav style="margin-bottom:40px;" class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Dashboard</a>
</div>
   
    <button id="1" style="background-color:#222;border:0;" class="btn btn-danger navbar-btn" onclick="visitors()">Visitors</button>
    <button id="2" style="background-color:#222;border:0;" class="btn btn-danger navbar-btn" onclick="accounts()" >Accounts</button>
        <button id="3" style="background-color:#222;border:0;" class="btn btn-danger navbar-btn">Reactions</button>
            <button id="4" style="background-color:#222;border:0;" class="btn btn-danger navbar-btn" onclick="reports()" >Reports</button>
                <button style="background-color:#222;border:0;" class="btn btn-danger navbar-btn" data-toggle="modal" data-target="#a" onclick="version()">About</button>


  </div>    
</nav>


  <div class="main" >
<div id="tb">
 <table id="table" class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Visitors number</th>
        <th>Month</th>
        <th>Year</th>
      </tr>
    </thead>
    <tbody>

<?php
if($admin){
$count=0;
  $select="SELECT * FROM visitors";
  $result = $conn->query($select);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
$count++;
      echo '<tr><td><b>'.$count.'</b></td><td>'.$row['num'].'</td> <td> '.$row['month'].'</td><td>'.$row['year'].'</td></tr>';
}
      }
    }

//

?>
 
    </tbody>
  </table>
</div>
<div id="rp" class="rp">
<?php
//REPORTS
$sql='SELECT * FROM reports';

  mysql_query($sql,$conn);
  //fetch in datebase and verify
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
echo '<div class="card"><u>'.$row['email'].'</u><br><b>'.$row['select'].'</b><br><p>'.$row['feed'].'</p></div><br>';
}
}
//ACCOUNTS COUNTS
?>
</div>
<div id="ac" class="ac">
<?php
$sql='SELECT month,year FROM users';

  mysql_query($sql,$conn);
$exec=false;
$enum=0;
$change=false;
  //fetch in datebase and verify
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {

if(!$exec){

$old_year=$row['year'];
$old_month=$row['month'];
$exec=true;
}
////////////
//1if
if($old_year==$row['year']){
//same month and year
if($old_month==$row['month']){
$enum++;
$change=false;
}
}
//samee year diffent month
 if($old_month<$row['month'] || $old_year<$row['year'] ){
$change=true;

}

//ult

if($change){echo '<div class="acc"><p><u>'.$enum.'</u><b> Account was Activated in </b>'.$old_month.'-'.$old_year.'</p></div><br><br>';$enum=1;$exec=false;}
}
echo '<div class="acc"><p><u>'.$enum.'</u><b> Account was Activated in </b>'.$old_month.'-'.$old_year.'</p></div><br><br>';
}

?>
</div>
<!-- admin zone -->


  <!-- Trigger the modal with a button -->
  <button  id="admin" style="display:none;baclground-color:rgba(0,0,0,1);" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"></button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title">Admin zone</h4>
        </div>
        <div class="modal-body">
        <form method="get" action="dashboard.php">
          <input type="email" name="email" class="form-control" placeholder="Email" required /><br>
          <input type="password" name="password"  class="form-control" placeholder="Password" required/><br><br>
                    <input type="submit" name="submit"  class="btn btn-default" value="Connect" />
</form>

        </div>
      </div>
      
    </div>
  </div>
<!-- alert modal version -->












  <!-- Modal -->
  <div class="modal fade" id="a" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Dashboard</h4>
        </div>
        <div class="modal-body">
          <p>Version : V0.1 Beta</p>
          <p>Powred by : Ortex inc.</p>

        </div>
      </div>
      
    </div>
  </div>

</body>
<script>
function admin(){document.getElementById("admin").click();}
function visitors(){
document.getElementById("tb").style.display="block";
document.getElementById("ac").style.display="none";
document.getElementById("rp").style.display="none";
}
function reports(){
document.getElementById("tb").style.display="none";
document.getElementById("ac").style.display="none";
document.getElementById("rp").style.display="block"; 
}
function accounts(){
document.getElementById("tb").style.display="none";
document.getElementById("ac").style.display="block";
document.getElementById("rp").style.display="none";
}
</script>
<script src='js/jq.js'></script>
<script src='js/npm.js'></script>
<script src='js/bootstrap.min.js'></script>
</html>
<?php
if(isset($_POST['submit'])){
  $sql='SELECT email,password FROM admin LIMIT 0,30';

  mysql_query($sql,$conn);
  //fetch in datebase and verify
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
          if($_POST['email']==$row['email'] && $_POST['password']==$row['password']){
$admin=true;
setcookie('email',$_POST['email'],time()+$delay);
setcookie('password',$_POST['password'],time()+$delay);

 }

}
 }
}



 ?>
