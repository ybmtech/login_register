<?php
session_start();
if(isset($_SESSION['user_reg_id']) || isset($_COOKIE['user_reg_id']))
{
	if(!isset($_SESSION['user_reg_id']) && isset($_COOKIE['user_reg_id']))
	{
		$_SESSION['user_reg_id']=$_COOKIE['user_reg_id'];
	}
    require_once __DIR__."/validate.php";
$query=new myTest();
$id=$_SESSION['user_reg_id'];
$myDetail=$query->selectQuery("SELECT * FROM tbl_users WHERE user_id='$id'");
}

else
{
	header("Location:./");
}
?>