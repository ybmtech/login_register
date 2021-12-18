<?php 
require_once __DIR__."/inc/token_generate.php";
if(isset($_SESSION['user_reg_id']) || isset($_COOKIE['user_reg_id']))
{
	header("Location:home");
}
require_once __DIR__."/inc/activate.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<?php require_once __DIR__."/inc/head.php";?>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
				<h4 style="text-align: center;">CLOUDWARE TASK ONE</h4>
				<form class="login100-form validate-form flex-sb flex-w" id="login-form">
					<span class="login100-form-title p-b-32" style="text-align: center;">
						Account Login
					</span>

					<span class="txt1 p-b-11">
						Username Or Email
					</span>
					<div class="wrap-input100  m-b-36">
						<input class="input100" type="text" name="username" id="username" autocomplete="off">
						<span class="focus-input100"></span>
					</div>
					
					<span class="txt1 p-b-11">
						Password
					</span>
					<div class="wrap-input100  m-b-12">
						
						<input class="input100" type="password" name="password" id="password" autocomplete="off">
						<span class="focus-input100"></span>
					</div>
					
					<div class="flex-sb-m w-full p-b-48">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="remember" type="checkbox" name="remember">
							<label class="label-checkbox100" for="remember">
								<span style="font-weight: bold;font-size: 14px;">Remember me</span>
							</label>
						</div>

						<div>
							<a href="forget-password" class="txt3">
								<span style="font-weight: bold;font-size: 14px;">Forgot Password?</span>
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn" style="padding-left:30%;">
					<input type="hidden" value="<?php echo $_SESSION['_token'];?>" name="token" id="token">
						<button type="submit" name="login" id="login" class="login100-form-btn" style="background: #57b846;">
							Login
						</button>
					</div><br><br>
					<div style="margin: auto;">
						<a href="register">
							<span style="font-weight: bold;font-size: 14px;">Don't have account? Register</span>
						</a><br>
						<a href="resend-link">
							<span style="font-weight: bold;font-size: 14px;">Don't receive link? Resend link</span>
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
    $('#login-form').validate({
      rules: {
        username: {
          required: true
        },
        password: {
          required: true,
          minlength: 8
        }
      },
      messages: {
       
        username: {
          required: 'Please enter username or email.'
        },
        password: {
          required: 'Please enter Password.',
          minlength: 'Password must be at least 8 characters long.'
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
	                                      $("#login").attr('disabled', true).html("please wait...");
	                                       },
                                    success: function(data){
										var res=JSON.parse(data);
										var status=res.status;
										if(status==true)
									{ 
										
                                        swal(res.message, "", "success");
									var delay = 2000;
										setTimeout(function(){ window.location ='home' }, delay);
									}
									else
									{
										swal(res.message, "", "error");
                                        $("#login").attr('disabled', false).html("Login");
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