<?php
session_start();
setcookie('user_reg_id','',time()-86400,'/');
unset($_SESSION['_token']);
unset($_SESSION['user_reg_id']);
header("Location:./");
?>