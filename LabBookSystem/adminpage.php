<?php require('includes/config.php'); 

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); } 

//define page title
$title = 'Admin Page';

//change profile of user
//if form has been submitted process it
if(isset($_POST['submit'])){

	//very basic validation
	if(strlen($_POST['username']) < 3){
		$error[] = 'Username is too short.';
	} else {
	 if($_POST['username']!=$_SESSION['username']){
		$tmp=$_POST['username'];
		$result = $db->query("SELECT user_name FROM user WHERE user_name = '$tmp'");
		$row = $result->fetch_assoc();

		if(!empty($row['user_name'])){
			$error[] = 'Username provided is already in use.';
		}
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
            $id=$_SESSION['userid'];		
			$username=$_POST['username'];
			$password=$_POST['password'];
			$email=$_POST['email'];
			$sql = "UPDATE user SET user_name='$username', password='$password',email='$email' where user_id='$id'";
            if ($db->query($sql) === TRUE) {
            } else {
               echo "Error: " . $sql . "<br>" . $conn->error;
            }

			//send email
			$to = $_POST['email'];
			$subject = "Information Change Confirmation";
			$body = "You just change your personal information. Please confirm";
			$additionalheaders = "From: <".SITEEMAIL.">\r\n";
			$additionalheaders .= "Reply-To: $".SITEEMAIL."";
			mail($to, $subject, $body, $additionalheaders);
			
			//update session
			$_SESSION['username']=$username;
			$_SESSION['password']=$password;
			$_SESSION['email']=$email;

			//redirect to index page
			header('Location: adminpage.php?action=joined');
			exit;
	}

}

//include header template
require('layout/adminheader.php'); 
?>

 <form>
 <input type="hidden" id="menu" value="profile">
 </form>
 
 <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>My Profile</h2>   
                        <h5>Welcome Admin <?php echo $_SESSION['username']?> , Love to see you back. </h5>
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
				 
				 <?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}

				//if action is joined show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'joined'){
					echo "<h2 class='bg-success'>Profile change successful, please check your new profile.</h2>";
				}
				?>

		     <!--START OF PROFILE-->
             <div class="col-sm-6">
              <ul class="list-group">
                <li class="list-group-item text-muted" contenteditable="false">Profile</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">username</strong></span> <?php echo $_SESSION['username']; ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">email</strong></span> <?php echo $_SESSION['email']; ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">identity</strong></span> <?php echo $_SESSION['identity']; ?></li>
				<li class="list-group-item text-right"><span class="pull-left"><strong class="">authority</strong></span> <?php echo $_SESSION['authority']; ?></li>
              </ul>
			  <button class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit "></i> Edit</button>
			 </div>
			 <!--/. PROFILE END-->
			 
			                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil "></i>Change user profile</h4>
                                        </div>
                                        <div class="modal-body">
										<form role="form" method="post" action="" autocomplete="off">
										 <div class="form-group">
				   <div class="input-group">
				    <span class="input-group-addon glyphicon glyphicon-user"></span>
					<input type="text" name="username" id="username" class="form-control input-lg" placeholder="New Name" value="" tabindex="1">
				   </div>
				</div>
				<div class="form-group">
				  <div class="input-group">
				    <span class="input-group-addon">@</span>
					<input type="email" name="email" id="email" class="form-control input-lg" placeholder="New Email" value="" tabindex="2">
				  </div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
						  <div class="input-group">
				            <span class="input-group-addon glyphicon glyphicon-lock"></span>
							<input type="password" name="password" id="password" class="form-control input-lg" placeholder="New Password" tabindex="3">
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
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Save changes" class="btn btn-primary btn-block btn-lg" tabindex="5"></div>
				</div>
										</form>
										</div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
            </div>
             <!-- /. PAGE INNER  -->
        </div>
         <!-- /. PAGE WRAPPER  -->
<?php 
//include header template
require('layout/adminfooter.php'); 
?>