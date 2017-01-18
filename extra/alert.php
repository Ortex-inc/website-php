<?php

class Alert
{
//variable of the class

//Functions of class
public function success($msg){


echo ' <div class="alert alert-success alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Success!</strong>'.$msg.'
  </div>';

}

public function info($msg){
echo ' <div class="alert alert-info alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Info!</strong>'.$msg.'
  </div>';
}

public function warning($msg){


echo ' <div class="alert alert-warning alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Warning!</strong>'.$msg.'
  </div>';
}

public function danger($msg){
echo ' <div class="alert alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Danger!</strong>'.$msg.'
  </div>';}
}

$alert=new Alert();

?>
