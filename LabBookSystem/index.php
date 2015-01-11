<?php require('includes/config.php'); 

//if logged in redirect to members page
if( $user->is_logged_in() ){if($user->is_admin()) {header('Location: adminpage.php');}else {header('Location: memberpage.php');} } 

//if form has been submitted process it
if(isset($_POST['submit'])){

	//very basic validation
	if(strlen($_POST['username']) < 3){
		$error[] = 'Username is too short.';
	} else {
		$tmp=$_POST['username'];
		$result = $db->query("SELECT user_name FROM user WHERE user_name = '$tmp'");
		$row = $result->fetch_assoc();

		if(!empty($row['user_name'])){
			$error[] = 'Username provided is already in use.';
		}
			
	}

	if(strlen($_POST['password']) < 3){
		$error[] = 'Password is too short.';
	}

	if(strlen($_POST['passwordConfirm']) < 3){
		$error[] = 'Confirm password is too short.';
	}

	if($_POST['password'] != $_POST['passwordConfirm']){
		$error[] = 'Passwords do not match.';
	}

	//email validation
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	    $error[] = 'Please enter a valid email address';
	} else {
		$tmp=$_POST['email'];
		$result = $db->query("SELECT email FROM user WHERE email = '$tmp'");;
		$row = $result->fetch_assoc();

		if(!empty($row['email'])){
			$error[] = 'Email provided is already in use.';
		}
			
	}


	//if no errors have been created carry on
	if(!isset($error)){			
			$username=$_POST['username'];
			$password=$_POST['password'];
			$email=$_POST['email'];
			$idetity=$_POST['identity'];
			$authority='user';
			$sql = "INSERT INTO user (user_name,password,email,identity,authority) VALUES ('$username', '$password', '$email', '$idetity', '$authority')";
            if ($db->query($sql) === TRUE) {
            } else {
               echo "Error: " . $sql . "<br>" . $conn->error;
            }

			//send email
			$to = $_POST['email'];
			$subject = "Registration Confirmation";
			$body = "Thank you for registering at demo site.\n\n Regards Site Admin \n\n";
			$additionalheaders = "From: <".SITEEMAIL.">\r\n";
			$additionalheaders .= "Reply-To: $".SITEEMAIL."";
			mail($to, $subject, $body, $additionalheaders);

			//redirect to index page
			header('Location: index.php?action=joined');
			exit;
	}

}

//define page title
$title = 'Ike-Lab Book System';

//include header template
require('layout/header.php'); 
?>


<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		 <div class="panel panel-default" style="box-shadow: rgba(0, 0, 0, 0.3) 10px 10px 10px;">
		   <div class="panel-body">
			<form role="form" method="post" action="" autocomplete="off">
				<h2>Please Sign Up</h2>
				<p>Already a member? <a href='login.php'>Login</a></p>
				<hr>

				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}

				//if action is joined show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'joined'){
					echo "<h2 class='bg-success'>Registration successful, please check your email to activate your account.</h2>";
				}
				?>

				<div class="form-group">
				   <div class="input-group">
				    <span class="input-group-addon glyphicon glyphicon-user"></span>
					<input type="text" name="username" id="username" class="form-control input-lg" placeholder="User Name" value="<?php if(isset($error)){ echo $_POST['username']; } ?>" tabindex="1">
				   </div>
				</div>
				<div class="form-group">
				  <div class="input-group">
				    <span class="input-group-addon">@</span>
					<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" value="<?php if(isset($error)){ echo $_POST['email']; } ?>" tabindex="2">
				  </div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
						  <div class="input-group">
				            <span class="input-group-addon glyphicon glyphicon-lock"></span>
							<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="3">
						  </div>
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
						  <div class="input-group">
				            <span class="input-group-addon glyphicon glyphicon-lock"></span>
							<input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Confirm Password" tabindex="4">
						  </div>
						</div>
					</div>
				</div>
				
				<div class="row">
				    <div class="col-xs-4 col-sm-4 col-md-4">
					    <div class="form-group">
						     <label class="checkbox-inline">
                                <input type="radio" name="identity" id="optionsRadios" value="master" checked> master
                             </label>
						</div>
					</div>
					<div class="col-xs-4 col-sm-4 col-md-4">
					    <div class="form-group">
						     <label class="checkbox-inline">
                                <input type="radio" name="identity" id="optionsRadios" value="doctor"> doctor
                             </label>
						</div>
					</div>
					<div class="col-xs-4 col-sm-4 col-md-4">
					    <div class="form-group">
						     <label class="checkbox-inline">
                                <input type="radio" name="identity" id="optionsRadios" value="assist"> assist
                             </label>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="5"></div>
				</div>
			</form>
		  </div>
		 </div>
		</div>
	</div>

</div>

<?php 
//include header template
require('layout/footer.php'); 
?>