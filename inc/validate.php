<?php
require_once __DIR__."/config.php";
	class myTest
	{
	private $servername = DBSERVER;
		private $username 	= DBUSER;
		private $password 	= DBPASSWORD;
		private $database 	= DBNAME;
		public  $con;
		public $send_email = EMAIL;
		
		// Database Connection 
		public function __construct()
		{
			$this->con = new mysqli($this->servername, $this->username,$this->password,$this->database);
			if(mysqli_connect_error()) {
				trigger_error("Failed to connect to server: " . mysqli_connect_error());
			}else{
				return $this->con;
			}
		}
		
		public function sendForgetPasswordMail($user_email,$key)
		{
			$to =$user_email;
			$email= EMAIL;
			$headers = 'MIME-Version: 1.0' . "\r\n";
			$headers .= "From: " . $email . "\r\n"; // Sender's E-mail
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
			$output='<p>Dear User,</p>';
$output.='<p>Please click on the following link to reset your password.</p>';
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p><a href="https://meritplanned.com.ng/login-reg/reset-password?key='.$key.'" target="_blank">
https://meritplanned.com.ng/login-reg/reset-password?
key='.$key
.'</a></p>';		
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p>Please be sure to copy the entire link into your browser.
The link will expire after 1 day for security reason.</p>';
$output.='<p>If you did not request this forgotten password email, no action 
is needed, your password will not be reset. However, you may want to log into 
your account and change your security password as someone may have guessed it.</p>';   	
$output.='<p>Thanks,</p>';
$body = $output; 
$subject = "Password Recovery - cloudware";
		
			if (@mail($to, $subject, $body, $headers))
			{
				return true;
			}else{
				echo false;
			}
		}
		public function sendActivationMail($user_email,$key)
		{
			$to =$user_email;
			$email= EMAIL;
			$headers = 'MIME-Version: 1.0' . "\r\n";
			$headers .= "From: " . $email . "\r\n"; // Sender's E-mail
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
			$output='<p>Dear User,</p>';
$output.='<p>Please click on the following link to activate your account.</p>';
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p><a href="https://meritplanned.com.ng/login-reg/?key='.$key.'" target="_blank">
https://meritplanned.com.ng/login-reg/?
key='.$key
.'</a></p>';		
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p>Please be sure to copy the entire link into your browser.
The link will expire after 1 day for security reason.</p>';
$body = $output; 
$subject = "Account Activation - cloudware";
		
			if (@mail($to, $subject, $body, $headers))
			{
				return true;
			}else{
				echo false;
			}
		}
		//form validation methid
		public function validate_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		  }
		 
//fetch single data from database method 
public function selectQuery($query)
{
	$result_search= $this->con->query($query);
	if ($result_search->num_rows > 0) {
		$row = $result_search->fetch_assoc();
		return $row;
		}
		else
		{
			return false;
		}
}
//run query method
public function runQuery($query)
		{
		$sql=$this->con->query($query);
		if($sql==true)
		{
			return true;
		}
		else
		{
			return false;
		}
}
		  //login method
   public function user_login($post)
		{
			$username = $this->validate_input(filter_var($_POST['username'],FILTER_SANITIZE_STRING));
			$password = $this->validate_input(filter_var($_POST['password'],FILTER_SANITIZE_STRING));
				// search if user exist
				$check=$this->selectQuery("SELECT * FROM tbl_users WHERE username='$username' or user_email='$username'");
			   if ($check==false) {
				    $response=['status'=>false,'message'=>'Incorrect Username or Email'];
				return json_encode($response);
					exit();
			   }
			   elseif($check['activate_user']=='0'){
				$response=['status'=>false,'message'=>'Account not activated'];
				return json_encode($response);
					exit();
			   }
			   else{
				if(password_verify($password,$check['user_password']))
				{
				$_SESSION['user_reg_id']=$check['user_id'];
				if(!empty($_POST['remember']))
				{
				setcookie('user_reg_id',$check['user_id'],time()+86400,'/');
				}
				$response=['status'=>true,'message'=>'Success'];
				return json_encode($response);
				exit();
				}
				else{
					$response=['status'=>false,'message'=>'Incorrect Password'];
				return json_encode($response);
					exit();
				}
			   }
		
		}
		//resend activation link
		public function resendActivationLink($post)
		{
			$email=$this->validate_input(filter_var($_POST['email'],FILTER_SANITIZE_EMAIL));
			//select user email
            $query=$this->selectQuery("SELECT * FROM tbl_users WHERE user_email='$email'");
			if($query==false){
				$response=['status'=>false,'message'=>'Incorrect Email'];
						return json_encode($response);
							exit();
			}
			elseif($query['activate_user']=='1'){
				$response=['status'=>false,'message'=>'You have already activate your account'];
						return json_encode($response);
							exit();
			}
			else{
				$key=$query['reg_key'];
				$sendMail=$this->sendActivationMail($email,$key);
				if($sendMail==true){
					$response=['status'=>true,'message'=>'message has been sent to your email, check your mail to activate your account'];
					return json_encode($response);
						exit();
			}
			
		}
	}
		//forget password
		public function forgetPassword($post)
		{
			$email=$this->validate_input(filter_var($_POST['email'],FILTER_SANITIZE_EMAIL));
			//select user email
            $query=$this->selectQuery("SELECT user_email FROM tbl_users WHERE user_email='$email'");
			if($query==true){
				$expFormat = mktime(
					date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
					);
					$expDate = date("Y-m-d H:i:s",$expFormat);
					$key = md5(2418*2+$email);
					$addKey = substr(md5(uniqid(rand(),1)),3,10);
					$key = $key . $addKey;
					//save the reset key into db
               $insert="INSERT INTO `password_reset` (`email`, `checkKey`, `expDate`) VALUES ('$email','$key','$expDate')";
                 $sql=$this->con->query($insert);
				 if($sql==true)
				 {
					 //send mail for forget password
                    $sendMail=$this->sendForgetPasswordMail($email,$key);
					if($sendMail==true){
						$response=['status'=>true,'message'=>'message has been sent to your email, check your mail to proceed'];
						return json_encode($response);
							exit();
					}
					else{
						$response=['status'=>false,'message'=>'Error in sending email'];
						return json_encode($response);
							exit();
					}
				 }
				 else
				 {
					  $response=['status'=>false,'message'=>'Error'];
						return json_encode($response);
							exit();
				 }
			}
			else{
				$response=['status'=>false,'message'=>'Incorrect Email'];
						return json_encode($response);
							exit();
			}
		}
		//reset password
		public function resetPassword($post)
		{
			$key = $this->validate_input(filter_var($_POST['key'],FILTER_SANITIZE_STRING));
			$password = $this->validate_input(filter_var($_POST['password'],FILTER_SANITIZE_STRING));
			$e_pass=password_hash($password,PASSWORD_DEFAULT);
				// search if key exist
				$check=$this->selectQuery("SELECT * FROM password_reset WHERE checkKey='$key'");
			   if ($check==false) {
				    $response=['status'=>false,'message'=>'Invalid email/key'];
						return json_encode($response);
							exit();
			   }
			   else{
				$curDate = date("Y-m-d H:i:s");
				$expDate=$check['expDate'];
				$email=$check['email'];
				if($curDate>=$expDate)
				{
					$response=['status'=>false,'message'=>'Link Expired'];
					return json_encode($response);
						exit();
				}
				else{
					$update="UPDATE tbl_users SET user_password='$e_pass' WHERE user_email='$email'";
					$sql=$this->con->query($update);
					if($sql==true)
					{
						$this->con->query("DELETE FROM password_reset  WHERE email='$email' AND checkKey='$key'");
					$response=['status'=>true,'message'=>'Your password has been  reset. Sign in with new password'];
					return json_encode($response);
						exit();
					}
					else{
						$response=['status'=>false,'message'=>'Password reset fail'];
					return json_encode($response);
						exit();
					}

				}
			   }
		
		}
//add user to database method
public function add_user($post)
		   {
			   $fullname = $this->validate_input(filter_var($_POST['fullname'],FILTER_SANITIZE_STRING));
			  $username= $this->validate_input(filter_var($_POST['username'],FILTER_SANITIZE_STRING));
			  $role= $this->validate_input(filter_var($_POST['role'],FILTER_SANITIZE_STRING));
			   $email=$this->validate_input(filter_var($_POST['email'],FILTER_SANITIZE_EMAIL));
			   $password=$this->validate_input($_POST['password']);
			   $encrypt_password=password_hash($password,PASSWORD_DEFAULT);
			   $reg_date=date("d-m-Y h:i:a");
			   // search whether username or email exist
			   $check=$this->selectQuery("SELECT username FROM tbl_users WHERE username='{$username}'");
			   $check2=$this->selectQuery("SELECT user_email FROM tbl_users WHERE user_email='{$email}'");
			   if ($check==true) {
				   $response=['status'=>false,'message'=>'There is customer with this username'];
				return json_encode($response);
					exit();
			   }
			   if($check2==true)
				   {
					$response=['status'=>false,'message'=>'There is customer with this email'];
					return json_encode($response);
						exit();
				   }
			   else{
				$expFormat = mktime(
					date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
					);
					$expDate = date("Y-m-d H:i:s",$expFormat);
					$key = md5(2418*2+$email);
					$addKey = substr(md5(uniqid(rand(),1)),3,10);
					$key = $key . $addKey;
				//Insert user data into db
			$insert="INSERT INTO tbl_users(full_name,user_email,username,user_role,user_password,reg_date,activate_user,reg_key,exp_date) VALUES('$fullname','$email','$username','$role','$encrypt_password','$reg_date','0','$key','$expDate')";
			$sql = $this->con->query($insert);
			if ($sql==true) {
				$this->sendActivationMail($email,$key);
			 $response=['status'=>true,'message'=>'Registered Successful'];
				 return json_encode($response);
					 exit();
			}
			else{
			 $response=['status'=>false,'message'=>'Registration fail!!'];
				 return json_encode($response);
					 exit();
			}
		 
			   }
			   
		   } 
		 
	}
?>