<?php
include 'sql_conn.php';

$membre=false;
if($_COOKIE['email']==''&&$_COOKIE['password']==''){
echo "You are not logged in";
sleep(2);
     header('location: login.php');
}
$email=htmlspecialchars ($_COOKIE['email']);
$pswd=htmlspecialchars ($_COOCKIE['password']);
//$firstname=htmlspecialchars ($_COOCKIE['firstname']);
$date=date("Y-m");

 $req="SELECT * FROM users WHERE 1";
  $result = $conn->query($req);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
if($_COOKIE['email']==$row['email']&& $_COOKIE['password']==$row['password']){ 
$firstname=$row['firstname'];
$membre=true;
break;}
}
 }


if(isset($_POST['msg'])){
$date=date('Y-m-d');
  $query="CREATE TABLE IF NOT EXISTS assistance ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, firstname VARCHAR(30) NOT NULL, msg VARCHAR(200) NOT NULL,date_reg DATE)";
  if ($conn->query($query) === TRUE) {} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
  $msg=htmlspecialchars($_POST['msg']);
  $sql="INSERT INTO assistance (firstname,msg,date_reg) VALUES ('$firstname','$msg','$date')";
 if ($conn->query($sql) === TRUE) {

  } else {
      echo "Error inserting in table: " . $conn->error;
  }
}

?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
</head>
<link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>
<style>
html,body{width:100%;height:100%;margin:0px;background-color:#dddddd;}
  h1{text-align:center;}
.chat{
  height:50%;
  width:80%;
  background-color:silver;
  margin:auto;
    box-shadow: 5px 5px 5px #888888;

}

form{position:relative;}
form ul{height:80%; width:100%;}
form ul{overflow:hidden; 
overflow-y:scroll;

}
.input-group{
position:absolute;
bottom:0;}

</style>
<body>


<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <p class="navbar-brand" style="float:right;">24 News</p>

    </div>
<p style="font-size:24px;text-align:center;margin:0;padding:0;;color:white;">Assistance</p>
  </div>
</nav>
 <p style="text-align:center;">Bienvenue sur notre assistance live !</p><br><br>
<form action='live.php'  method='post' class="chat">
 
  <ul >
   
<?php
 $select="SELECT * FROM assistance WHERE 1";
  $result = $conn->query($select);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<li><b>".$row['firstname']."</b> :".$row['msg']."</li>";
}
      }

?>
  </ul><br>


      <div class="input-group">
        <input type="text" class="form-control" placeholder="Type.." id="msg" name='msg' required>
        <div class="input-group-btn">
          <button class="btn btn-default" id="submit" name='submit' type="submit">Go</button>
          
        </div>
      </div>
    </form>

<h6 style="text-align:center;color:green;"> 100% private & secure !<br>pour nous contacter par telephone 01 XX XX XX XX</h6>
  </div>

</div>


</body>
<script src='js/jq.js'></script>
<script src='js/npm.js'></script>
<script src='js/bootstrap.min.js'></script>
</html>

