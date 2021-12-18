<?php 
require_once __DIR__."/inc/session.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home</title>
	<?php require_once __DIR__."/inc/head.php";?>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
				<h4>WELCOME TO <u><?php echo strtoupper($myDetail['full_name']);?></u></h4><br><br>
                <a href="logout">Logout</a>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	<!--===============================================================================================-->

    <?php require_once __DIR__."/inc/script.php";?>
    <!--=======================Form Validation===========================================-->

</body>
</html>