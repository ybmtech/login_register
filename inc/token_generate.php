<?php
session_start();
$_SESSION['_token']=bin2hex(random_bytes(40));
?>