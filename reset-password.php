<?php 
require_once __DIR__."/inc/token_generate.php";
if(isset($_SESSION['user_reg_id']) || isset($_COOKIE['user_reg_id']))
{
	header("Location:home");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Change Password</title>
	<?php require_once __DIR__."/inc/head.php";?>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
				<h4 style="text-align: center;">CLOUDWARE TASK ONE</h4>
				<form class="login100-form validate-form flex-sb flex-w" id="reset-form">
					<span class="login100-form-title p-b-32" style="text-align: center;">
						Change Password
					</span>

					<span class="txt1 p-b-11">
					Password
					</span>
					<div class="wrap-input100  m-b-36">
						<input class="input100" type="password" name="password" id="password"  autocomplete="off">
						<span class="focus-input100"></span>
					</div>
					
                    <span class="txt1 p-b-11">
					Confirm Password
					</span>
					<div class="wrap-input100  m-b-36">
						<input class="input100" type="password" name="cpassword" id="cpassword" autocomplete="off">
						<span class="focus-input100"></span>
                      <input type="hidden" name="key" id="key" value="<?php echo $_GET['key'];?>">
					</div>

					<div class="container-login100-form-btn" style="padding-left:30%;">
                    <input type="hidden" value="<?php echo $_SESSION['_token'];?>" name="token" id="token">
						<button type="submit" name="reset" id="reset" class="login100-form-btn" style="background: #57b846;">
							Change Password
						</button>
					</div><br><br>
					<div style="margin: auto;">
						<a href="./">
							<span style="font-weight: bold;font-size: 14px;">Login</span>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	<!--===============================================================================================-->

    <?php require_once __DIR__."/inc/script.php";?>
    <!--=======================Form Validation===========================================-->
<script>
  $(document).ready(function () {
    $('#reset-form').validate({
      rules: {
        password: {
          required: true,
          minlength: 8
        },
        cpassword: {
          required: true,
          equalTo: "#password"
        }
      },
      messages: {
        password: {
          required: 'Please enter Password.',
          minlength: 'Password must be at least 8 characters long.'
        },
        cpassword: {
          required: 'Please confirm password.',
          equalTo: 'Confirm password not match with password.'
        }
      },
      submitHandler: function (form) {
		                    	$.ajax({
									type: "POST",
									url: "inc/logic",
									data:  new FormData(form),
			                         contentType: false,
    	                               cache: false,
			                        processData:false,
									 beforeSend: function () {
	                                      $("#reset").attr('disabled', true).html("proccessing...");
	                                       },
                                    success: function(data){
										var res=JSON.parse(data);
										var status=res.status;
										if(status==true)
									{ 
										
                                        swal(res.message, "", "success");
									var delay = 2000;
										setTimeout(function(){ window.location ='./' }, delay);
									}
									else
									{
										swal(res.message, "", "error");
                                        $("#reset").attr('disabled', false).html("Change Password");
									}
									}
								});
								return false;
      }
    });
  });
</script>
</body>
</html>