<?php require_once __DIR__."/inc/token_generate.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
    <!--=======================head content(style and meta)=============================================-->
    <?php require_once __DIR__."/inc/head.php";?>
	</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
			<h4 style="text-align: center;">CLOUDWARE TASK ONE</h4>
				<form class="login100-form validate-form flex-sb flex-w" id="reg-form">
					<span class="login100-form-title p-b-32" style="text-align: center;">
						Register an account
					</span>

					<span class="txt1 p-b-11">
						Full Name
					</span>
					<div class="wrap-input100  m-b-36">
						<input class="input100" type="text" name="fullname" id="fullname" placeholder="Alao Musa Chika" autocomplete="off">
						<span class="focus-input100"></span>
					</div>
					
                    <span class="txt1 p-b-11">
						Email
					</span>
					<div class="wrap-input100  m-b-36">
						<input class="input100" type="email" name="email" id="email" placeholder="example@email.com" autocomplete="off">
						<span class="focus-input100"></span>
					</div>
                
                    <span class="txt1 p-b-11">
						Role
					</span>
					<div class="wrap-input100  m-b-36" >
						<select class="input100" id="role" type="text" name="role">
                            <option selected disabled> Select Role</option>
                            <option value="backend">Backend</option>
                            <option value="frontend">Front End</option>
                            <option value="ui-ux">UI & UX</option>
                            <option value="graphic">Graphic Designer</option>
                            <option value="datascientist">Datascientist</option>
                        </select>
						<span class="focus-input100"></span>
					</div>

                    <span class="txt1 p-b-11">
						Username
					</span>
					<div class="wrap-input100  m-b-36">
						<input class="input100" type="text" name="username" id="username" placeholder="Username" autocomplete="off">
						<span class="focus-input100"></span>
					</div>

					<span class="txt1 p-b-11">
						Password
					</span>
					<div class="wrap-input100  m-b-12">
						
						<input class="input100" type="password" name="password" id="password" autocomplete="off">
						<span class="focus-input100"></span>
					</div>
					
                    <span class="txt1 p-b-11">
						Confirm Password
					</span>
					<div class="wrap-input100  m-b-12">
						
						<input class="input100" type="password" name="cpassword" id="cpassword" autocomplete="off">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn" style="padding-left:30%;">
					<input type="hidden" value="<?php echo $_SESSION['_token'];?>" name="token" id="token">
						<button type="submit" class="login100-form-btn" id="register" name="register" style="background: #57b846;">
							Register
						</button>
					</div><br><br>
					<div style="margin: auto;">
						<a href="./">
							<span style="font-weight: bold;font-size: 14px;">Already have an account?? Login</span>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
    <!--=======================scripts=============================================-->
	<?php require_once __DIR__."/inc/script.php";?>

<!--=======================Form Validation===========================================-->
<script>
  $(document).ready(function () {
    $('#reg-form').validate({
      rules: {
        fullname: {
          required: true
        },
        email: {
          required: true,
          email: true
        },
        role: {
          required: true
        },
        password: {
          required: true,
          minlength: 8
        },
        cpassword: {
          required: true,
          equalTo: "#password"
        },
        username:{
          required:true,
          minlength: 3
        }
      },
      messages: {
        fullname: {
			required:'Please enter  full name.'
		},
        email: {
          required: 'Please enter email address.',
          email: 'Please enter a valid email address.'
        },
        username: {
          required: 'Please enter username.',
          minlength: 'Username must be at least 3 characters long.'
        },
        role: {
          required: 'Please select role.'
        },
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
	                                      $("#register").attr('disabled', true).html("proceesing...");
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
                                        $("#register").attr('disabled', false).html("Register");
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