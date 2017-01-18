<?php

class Modal{

function ad(){
}

function mail($title){ echo'
<div class="container">
  <!-- Trigger the modal with a button -->
  <button  id="mail" style="display:none;baclground-color:rgba(0,0,0,1);" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"></button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">'.$title.'</h4>
        </div>
        <div class="modal-body">
        <form method="get" action="cmail.php">
          <input type="email" name="email" class="form-control" placeholder="Email" required /><br>
          <input type="submit" name="submit"  class="form-control" value="Subscribe" />
</form>
<p>'.$info.'</p>
</div></div></div></div></div>';}

function admin($title){echo'<!-- admin zone -->
  <!-- Trigger the modal with a button -->
  <button  id="admin" style="display:none;baclground-color:rgba(0,0,0,1);" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"></button>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title">'.$title.'</h4>
        </div>
        <div class="modal-body">
        <form method="get" action="dashboard.php">
          <input type="email" name="email" class="form-control" placeholder="Email" required /><br>
          <input type="password" name="password"  class="form-control" placeholder="Password" required/><br><br>
                    <input type="submit" name="submit" class="btn btn-default" value="Connect" />
</form>
</div></div></div></div>';}

function survey($title,$msg,$info,$left,$right){
echo '<div class="container">
  <!-- Trigger the modal with a button -->
<button  id="mail" style="display:none;baclground-color:rgba(0,0,0,1);" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"  ></button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">'.$title.'</h4>
        </div>
        <div class="modal-body">
          <p>'.$msg.'</p>
          <b>'.$info.'</b>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">'.$left.'</button>
          
           <button type="button" class="btn btn-default" data-dismiss="modal">'.$right.'</button>
 </div></div></div></div></div>';}

function popup($title,$msg){
echo '<!-- alert modal version -->
  <div class="modal fade" id="a" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Dashboard</h4>
        </div>
        <div class="modal-body">
          <p>'.$title.'</p>
                    <p>'.$msg.'</p>
 </div></div></div></div>';}
}
$modal=new Modal();
$modal->survey("Title","Do you like YouTube?","Uu","NO","YES");
?>
