<?php
session_start();
require_once __DIR__."/validate.php";
$myFunction=new myTest();
if(isset($_POST['login'])){
    $token=filter_input(INPUT_POST,'token',FILTER_SANITIZE_STRING);
    if(!$token || $token!==$_SESSION['_token']){
 header($_SERVER['SERVER_PROTOCOL'].'405 Method Not Allowed');
    }
    else{
    $msg=$myFunction->user_login($_POST);
   echo $msg;
    }
				
}
if(isset($_POST['register'])){
    $token=filter_input(INPUT_POST,'token',FILTER_SANITIZE_STRING);
    if(!$token || $token!==$_SESSION['_token']){
 header($_SERVER['SERVER_PROTOCOL'].'405 Method Not Allowed');
    }
    else {
        $msg=$myFunction->add_user($_POST);
        echo $msg;
    }
   
}
if(isset($_POST['forget'])){
    $token=filter_input(INPUT_POST,'token',FILTER_SANITIZE_STRING);
    if(!$token || $token!==$_SESSION['_token']){
 header($_SERVER['SERVER_PROTOCOL'].'405 Method Not Allowed');
    }
    else{
    $msg=$myFunction->forgetPassword($_POST);
    echo $msg;
    }
}
if(isset($_POST['reset'])){
    $token=filter_input(INPUT_POST,'token',FILTER_SANITIZE_STRING);
    if(!$token || $token!==$_SESSION['_token']){
 header($_SERVER['SERVER_PROTOCOL'].'405 Method Not Allowed');
    }
    else{
    $msg=$myFunction->resetPassword($_POST);
    echo $msg;
    }
}
if(isset($_POST['resend'])){
    $token=filter_input(INPUT_POST,'token',FILTER_SANITIZE_STRING);
    if(!$token || $token!==$_SESSION['_token']){
 header($_SERVER['SERVER_PROTOCOL'].'405 Method Not Allowed');
    }
    else{
    $msg=$myFunction->resendActivationLink($_POST);
    echo $msg;
    }
}
?>