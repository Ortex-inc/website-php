
<?php
include 'sql_conn.php';
include 'alert.php';
$found=false;
$i=2;
session_start();
if($_COOKIE['email']==''){
$firstname=htmlspecialchars ($_SESSION['firstname']);
$lastname=htmlspecialchars ($_SESSION['lastname']);
$email=htmlspecialchars ($_SESSION['email']);
$pswd=htmlspecialchars ($_SESSION['password']);
}
else{
$firstname=htmlspecialchars ($_COOKIE['firstname']);
$lastname=htmlspecialchars ($_COOKIE['lastname']);
$email=htmlspecialchars ($_COOKIE['email']);
$pswd=htmlspecialchars ($_COOKIE['password']);
}

if($pswd=='' || $email==''){
 $url = "login.php?i=".$i;
header("Location: ".$url);
} else{
  $found=true;
}

// get bio from db
$query="SELECT bio,img FROM users WHERE email='$email' ";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $bio=$row['bio'];
$img_url=$row['img'];

    }
  }
?>
<html>
<head>
<style>
html,body{
  margin:0px;
  width:100%;
  height:100%;
  background-color:#dddddd;

}
.footer{
position:absolute;
  width:100%;
  height:10%;
  background-color:#222;
margin:0;
padding:0;
}

#logout{
  position:absolute;
  right:0px;
  top:200px;
}
#bio{
  width:300px;
  height:150px;
  background-color:silver;
}
.dropdown{
position:absolute;
width:10%;
height:10%;
top:0;
float:right;
}
#dd{
position:absolute;width:100%;height:100%;
background-repeat;no-repeat;
background-size:100%;
float:right;
}
.dropdown-menu{width:100px;}
li input{width:100%;}
li button{width:100%;}
nav{position:relative;}
.dropdown{position:absolute;bottom:0;margin:0;}
.container-fuild,.dropdown{display:inline-block;}
</style>
<link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>

</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
<div class="navbar-header">

      <a class="navbar-brand" href="#">Profile</a>
    </div>
<div class="dropdown">
  <button  <?php if($img_url==""){$img_url="src/profile";} echo" style='background-image:url(".$img_url."); '"; ?> id="dd" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
  <span class="caret"></span></button>


  <ul class="dropdown-menu">
<form  action="profile.php" method="post" enctype="multipart/form-data">
    <li><button class="btn btn-default" name="submit"  >Post</button></li>
<li><input type="file" name="fileToUpload" /><br></li>
</form>

  </ul>
</div>
  </div>

</nav>
 


<br>
<div class="info">
<b>Firstname: </b> <?php echo $firstname; ?><br>
<b>lastname: </b><?php echo $lastname; ?><br>
</div><br>
<form method="post" action="profile.php">
<b>Bio:
</b>
<br>
<textarea class="form-control"  id="bio" name="bio" ><?php echo $bio; ?></textarea>
<button  class=" btn btn-default" id="logout" name="logout" >Logout</button>
<br>
<button  class="btn btn-default" id="update" name="update" >Update</button>



</form>
</body>
<script>



</script>
<script src='js/jq.js'></script>
<script src='js/npm.js'></script>
<script src='js/bootstrap.min.js'></script>
</html>
<?php
//logout
if (isset($_POST['logout'])) {
setcookie('firstname','',time()-3600);
setcookie('lastname','',time()-3600);
setcookie('email','',time()-3600);
setcookie('password','',time()-3600);
session_destroy();
$conn->close();
header('location: login.php');
}
//update bio
if (isset($_GET['update'])) {
  $bio=htmlspecialchars ($_GET['bio']);
  $sql ="UPDATE `users` SET bio='$bio' WHERE email='$email'";
  if ($conn->query($sql) === TRUE) {
$alert->sucess("BIO has been uploaded");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}

$target_dir = "profils/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
     //   echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
     //   echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    //echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
   // echo "Sorry, your file is too large. ";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//echo "Only JPG, JPEG, PNG files are allowed. ";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
   // echo "Your file was not uploaded. ";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
     //   echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded. ";
    } else {
       // echo "There was an error uploading your file. ";
    }
}

if(isset($_POST["submit"])){
     $sql ="UPDATE users SET img='$target_file' WHERE email='$email'";
    if ($conn->query($sql) === TRUE) {
$alert->sucess("Image has been uploaded");

} else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
?>
