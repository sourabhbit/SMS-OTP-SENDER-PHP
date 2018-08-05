<!--

Author: Sourabh Kumar
SMS Company: Textlocal
DATE: 5/08/2018
-->
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>SMS OTP VERIFY</title>
</head>
<body>
<div class="container">
<h1>Sending OTP through localtext</h1>
<hr>
<div class="row">
		<?php
		if(isset($_POST['sendopt'])){
			
		require('textlocal.class.php');
		require('credential.php');

		$textlocal = new Textlocal(false, false, API_KEY);

		//$numbers = array(MOBILE);
		$numbers = array($_POST['mobile']);
		$sender = 'TXTLCL';
		$otp=mt_rand(10000,99999);
		$message = "Hello " . $_POST['uname'] . " Your Bank Account is debited by Rs 200 for confirmation. " . " This is your OTP: " . $otp;

		try {
			$result = $textlocal->sendSms($numbers, $message, $sender);
			setcookie('otp', $otp);
			echo "OTP Successfully send..";
		} catch (Exception $e) {
			die('Error: ' . $e->getMessage());
		}
		}
		
		if(isset($_POST['verifyotp'])){
			
			$otp = $_POST['otp'];
			if($_COOKIE['otp'] == $otp){
				echo"Congratulation, Your Mobile is verified";
			} else{
				echo"Please enter correct OTP";
			}
			
		}
		?>
</div>
<form role="form" method="post" enctype="multipart/form-data">
<div class="row">
<label for="uname">Name</label>
<input name="uname" required type="text"  maxlength="20" placeholder=" Enter Your Name"/>
</div>

<div class="row">
<label for="mobile">Mobile</label>
<input name="mobile" required type="text"  maxlength="10" placeholder=" Enter a valid mobile no"/>
</div>

<div class="row">
<button type="submit" name="sendopt" class="button">Send OTP</button>
</div>

</form>
	
<form method="post" action="">
<div class="row">
	<label for="otp">OTP</label>
	<input name="otp" required type="text"  id="otp" maxlength="5" placeholder=" Enter a valid mobile no"/>
</div>

<div class="row">
	<button type="submit" name="verifyotp" class="button">Verify</button>
</div>
</form>
	
</body>
</html>