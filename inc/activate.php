<?php
if(isset($_GET['key']))
{
	require_once __DIR__."/validate.php";
	$queryFunction=new myTest();
	$key=$_GET['key'];
	$check=$queryFunction->selectQuery("SELECT * FROM tbl_users WHERE reg_Key='$key'");
	if ($check==false) {
		echo "<script>
		alert('Invalid Key');
		var delay = 1000;
		setTimeout(function(){ window.location ='./' }, delay);
        </script>
		";
   }
   else{
	$curDate = date("Y-m-d H:i:s");
	$expDate=$check['exp_date'];
	if($curDate>=$expDate)
	{
		echo "<script>
		alert('Link Expired');
		var delay = 1000;
		setTimeout(function(){ window.location ='./' }, delay);
        </script>
		";
	}
	else{
		$query=$queryFunction->runQuery("UPDATE tbl_users SET activate_user='1',reg_key='used' WHERE reg_key='$key'");
		if($query==true){
			echo "<script>
			alert('Activate Successful');
			var delay = 1000;
			setTimeout(function(){ window.location ='./' }, delay);
            </script>
			";
		}
		else{
			echo "<script>
			alert('Activate Fail');
			var delay = 1000;
			setTimeout(function(){ window.location ='./' }, delay);
            </script>
			";
		}
	}
	
}
}
?>