<html>
<head>
<link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>
<style>
html,body{width:100%;height:100%;
text-align:center;
margin:auto;
  background-color:#dddddd;

}

.form-group{
text-align:center;
margin:auto;
position:relative;
width:40%;}
#gender{
margin:auto;
width:15%;}
</style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Sign up</a>
    </div>
  </div>
</nav>

<form  method="get"  action="traitement.php">
  

<div class="form-group">
  <label for="firstname"> Firstname:</label>
  <input type="text" class="form-control" id="firstname" required>
</div>

<div class="form-group">
  <label for="lastname"> Lastname:</label>
  <input type="text" class="form-control" id="lastname" required>
</div>


<div class="form-group">
  <label for="email"> Email:</label>
  <input type="email" class="form-control" id="email" required>
</div>


<div class="form-group">
  <label for="password"> Password:</label>
  <input type="password" class="form-control" id="password" required>
</div>



<div class="form-group">
  <label for="password1"> Comfirm password:</label>
  <input type="password" class="form-control" id="password1" onkeyup="checkPass()" required>
</div><br><p id="confirmMessage"></p><br>

<input class="radio" type="radio" id="gender" name="gender" value="male" checked/> Male<br>
 <input  class="radio"type="radio" id="gender"name="gender" value="female"/> Female<br><br>
 <input class="btn btn-default" name="submit" id="submit" type="submit" disabled="true" value="sign up" />

</form>
</body>
<script src='js/jq.js'></script>
<script src='js/npm.js'></script>
<script src='js/bootstrap.min.js'></script>
<script>
function checkPass()
{
    var pass1 = document.getElementById('password');
    var pass2 = document.getElementById('password1');
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessage');

    var goodColor = "#66cc66";
    var badColor = "#ff6666";

    if(pass1.value == pass2.value){
        //The passwords match.
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Passwords Match!"
        document.getElementById('submit').disabled = false;
    }else{
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Passwords Do Not Match!";
        document.getElementById('submit').disabled = true;
    }
}
</script>
</html>
