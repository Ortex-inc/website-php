<?php
include 'sql_conn.php';





include 'alert.php';
if($_GET['i']==1){
$alert->warning(" Account not found try to correct you email or password");
}

else if($_GET['i']==2){
$alert->warning(" You are not logged in");
}




?>
<html>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>
<style>
html,body{
width:100%;
height:100%;
margin:0px;
text-align:center;
margin:auto;
background-color:#dddddd;
}
.input-group{
text-align:center;margin:auto;
position:relative;width:40%;
}
</style>
 </head>
 <body>


<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Login</a>
    </div>
  </div>
</nav>

  <form method="get" action="connect.php">
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input id="email" type="email" class="form-control" name="email" placeholder="Email" required/>
    </div>
<br>
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
      <input id="password" type="password" class="form-control" name="password" placeholder="Password" required/>
    </div>
    <br>
   

 <label> remember me?
  <input type="checkbox" name="cbox" value="value1"/>
 
</label>
<br>
     <a class="subscribe" href="sign_up.php">S'inscrire</a>
 <button  name="submit" class=" btn btn-default">Connecion</button>

 </form>


 <lu class="link">
 <a href="about.html">A propos</a>
   <a href="privacy.html">Privacy</a>
   <a href="contact.html">Contact us</a>
 </lu>
 </body>
<script src='js/jq.js'></script>
<script src='js/npm.js'></script>
<script src='js/bootstrap.min.js'></script>
 </html>
