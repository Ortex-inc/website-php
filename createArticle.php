<?php
$servername = "sql312.byethost15.com";
$username = "b15_18497018";
$password = "azerty";
$db = "b15_18497018_users";
$conn= new mysqli($servername, $username, $password,$db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo "error ! can't connect to database try later.";
  }
  $query="CREATE TABLE if not exists  posts (  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, title VARCHAR (30), content VARCHAR (90), img_url VARCHAR(60),likes INT(6),shares INT(6),createddate DATETIME )";

  if ($conn->query($query) === TRUE) {

  } else {
      echo "Error creating table: " . $conn->error;
  }
      $fetch="SELECT * FROM admin WHERE 1";
      $result = $conn->query($fetch);
      //cuted from here
  $admin= false;
  $email=htmlspecialchars ($_COOKIE['email']);
  $pswd=htmlspecialchars ($_COOKIE['password']);

  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        if($row['email']==$email && $row['password']==$pswd){
          $admin=true;
          echo "Welcome sir !";
break;
        }
        else{
          $admin=false;
        echo 'You are not admin,leave this page !';
          sleep(2);
      //  header('location:login.php');
  }
        }
      }
?>

<html>
  <head>
<link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>
<style>
html,body{
width:100%;
height:100%;
  background-color:#dddddd;}

#title,#article{
position:relative;
text-align:center;
margin:auto;
width:60%; 

    border-radius:0px 0px 0px 0px;
    border-style: solid;
    border-color: black ;
    border-width: 1px;
}
#article{
height:40%;
}
#fileToUpload,#submit{width:80px;height:30px;
position:relative;
text-align:center;
margin:auto;}
</style>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
<link rel="stylesheet" type="text/css" href="creator.css">
  <title>Post</title>
</head>
<body <?php if(!$admin){ echo'onload="admin()"';}?>>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Create Article</a>
    </div>
  </div>
</nav>

<div class="main">


  <p class='gained' name='gained' >*Access gained*</p><br>
<form  action="createArticle.php" method="post" enctype="multipart/form-data">
  <input type="text" name="title" id="title" class="form-control" value="" placeholder="Type a title" required/><br>
<img src=""></img><br>
<textarea type="text" id="article" name="article" class="form-control" value="" placeholder="Type the article" required></textarea><br>
<button name="submit" class="btn btn-default" id="submit" >Post it</button>
<input type="file" name="fileToUpload" id="fileToUpload" required/>
</forum>
</div>



<!-- admin zone -->


  <!-- Trigger the modal with a button -->
  <button  id="admin" style="display:none;baclground-color:rgba(0,0,0,1);"type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"></button>

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
                    <input type="submit" name="submit"  class="form-control" value="Connect" />
</form>

        </div>
      </div>
      
    </div>
  </div>



</body>
<script>
function admin(){document.getElementById("admin").click();}
</script>
<script src='js/jq.js'></script>
<script src='js/npm.js'></script>
<script src='js/bootstrap.min.js'></script>
</html>
<?php if($admin){
$target_dir = "posts/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large. ";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
    echo "Only JPG, JPEG, PNG files are allowed. ";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Your file was not uploaded. ";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded. ";
    } else {
        echo "There was an error uploading your file. ";
    }
}

if(isset($_POST["submit"])){
  $title=htmlspecialchars ($_POST['title']);
    $article=htmlspecialchars ($_POST['article']);
    $date=date('Y-m-d h:i');
    $sql="INSERT INTO posts (title,content,img_url,likes,shares,createddate) VALUES ('$title','$article','$target_file',0,0,'$date')";
    if ($conn->query($sql) === TRUE) { echo 'Done';} else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
}
?>
