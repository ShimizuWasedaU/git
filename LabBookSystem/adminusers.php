<?php require('includes/config.php'); 

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); } 

//define page title
$title = 'Admin Page';

//change profile of user
//if form has been submitted process it
if(isset($_POST['submit'])&&isset($_POST['action'])&&$_POST['action']=='edit'){

	//very basic validation
	if(strlen($_POST['username']) < 3){
		$error[] = 'Username is too short.';
	} else {
		$tmp=$_POST['username'];
		$tmp_id=$_POST['userid'];
		$result = $db->query("SELECT user_name FROM user WHERE user_name = '$tmp' and user_id!='$tmp_id'");
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
		$tmp_id=$_POST['userid'];
		$result = $db->query("SELECT email FROM user WHERE email = '$tmp' and user_id!='$tmp_id'");;
		$row = $result->fetch_assoc();

		if(!empty($row['email'])){
			$error[] = 'Email provided is already in use.';
		}
			
	}


	//if no errors have been created carry on
	if(!isset($error)){
            $id=$_POST['userid'];		
			$tmp=$_POST['username'];
			$password=$_POST['password'];
			$email=$_POST['email'];
			$identity=$_POST['identity'];
			$authority=$_POST['authority'];
			$sql = "UPDATE user SET user_name='$tmp', password='$password',email='$email', identity='$identity', authority='$authority' where user_id='$id'";
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

			//redirect to index page
			header('Location: adminusers.php?action=edited');
			exit;
	}
}

//add new user
//if form has been submitted process it
if(isset($_POST['submit'])&&isset($_POST['action'])&&$_POST['action']=='add'){

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
			$authority=$_POST['authority'];
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
			header('Location: adminusers.php?action=added');
			exit;
	}
}
     
//admin delete event
//if delete button has been clicked process it
if(isset($_GET['userid'])&&isset($_GET['action'])&&$_GET['action']=='delete'){
	$userid=$_GET['userid'];
	$sql = "DELETE FROM user WHERE user_id='$userid'";
    if ($db->query($sql) === TRUE) {
      } else {
         echo "Error: " . $sql . "<br>" . $conn->error;
      }
			
    //redirect to this page		
    header('Location: adminusers.php?action=deleted');
    exit;		
}

//admin make admin event
//if make admin button has been clicked process it
if(isset($_GET['userid'])&&isset($_GET['action'])&&$_GET['action']=='admin'){
	$userid=$_GET['userid'];
	$result = $db->query("SELECT authority FROM user WHERE  user_id='$userid'");
		$row = $result->fetch_assoc();

		if($row['authority']=='admin'){
			$error[] = 'The user is already admin.';
		}else{
		  $sql = "UPDATE user SET authority=admin";
          if ($db->query($sql) === TRUE) {
          } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
          }
			
          //redirect to this page		
          header('Location: adminusers.php?action=admined');
          exit;	
}		
}

//include header template
require('layout/adminheader.php'); 
?>

 <form>
 <input type="hidden" id="menu" value="users">
 </form>
 
 <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Users Management</h2>   
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

				//if action is delete show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'edited'){
					echo "<h2 class='bg-success'>Profile change successfully, please check new user list.</h2>";
				}
				
				//if action is delete show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'deleted'){
					echo "<h2 class='bg-success'>User delete successfully, please check new user list.</h2>";
				}
				
				//if action is admin show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'admined'){
					echo "<h2 class='bg-success'>Make admin successfully, please check new user list.</h2>";
				}
				
				//if action is admin show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'added'){
					echo "<h2 class='bg-success'>Add new user successfully, please check new user list.</h2>";
				}
				?>
				
              
		              <!-- /. ROW  -->
            <div class="row">
                <div class="col-md-7">
                     <!--    Hover Rows  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            User Lists
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Identity</th>
											<th>Authority</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
									         $username=$_SESSION['username'];
		                                     $result = $db->query("SELECT * FROM user WHERE user_name!='$username'");
											 if ($result->num_rows > 0) {
												 
											  while($row = $result->fetch_assoc()){
												$userid=$row['user_id'];  
												echo "<tr>";  
 												echo "<td>".$row['user_name']."</td>";
												echo "<td>".$row['email']."</td>";
												echo "<td>".$row['identity']."</td>";
												echo "<td>".$row['authority']."</td>";
											    echo '<td><div class="btn-group">
                                                        <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user"></i> User<span class="caret"></span></a>
                                                        <ul class="dropdown-menu">
                                                        <li><a href="javascript:edit('.$userid.')"><i class="fa fa-pencil"></i> Edit</a></li>
                                                        <li><a href="adminusers.php?action=delete&userid='.$userid.'"><span class="glyphicon glyphicon-trash"></span>Delete</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="adminusers.php?action=admin&userid='.$userid.'"><i class="i"></i> Make admin</a></li>
                                                        </ul>
                                                        </div>
	                                                    </td>';							
												echo '</tr>';
											  }
											 }
											?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End  Hover Rows  -->
                </div>
				
				<div class="col-md-5 col-sm-5 fade hide" id="editPanel">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            Edit User Profile
                        </div>
                        <div class="panel-body">
						<form role="form" method="post" action="" autocomplete="off">
										 <div class="form-group">
				   <div class="input-group">
				    <span class="input-group-addon glyphicon glyphicon-user"></span>
					<input type="text" name="username" id="username" class="form-control input-sm" placeholder="New Name" value="" tabindex="1">
				   </div>
				</div>
				
				<div class="form-group">
				  <input type="hidden" name="action" value="edit">
				</div>
				<div class="form-group">
				  <input type="hidden" name="userid" id="userid" value="">
				</div>
				
				<div class="form-group">
				  <div class="input-group">
				    <span class="input-group-addon">@</span>
					<input type="email" name="email" id="email" class="form-control input-sm" placeholder="New Email" value="" tabindex="2">
				  </div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
						  <div class="input-group">
				            <span class="input-group-addon glyphicon glyphicon-lock"></span>
							<input type="password" name="password" id="password" class="form-control input-sm" placeholder="New Password" tabindex="3">
						  </div>
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
						  <div class="input-group">
				            <span class="input-group-addon glyphicon glyphicon-lock"></span>
							<input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-sm" placeholder="Confirm Password" tabindex="4">
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
				    <div class="col-xs-6 col-sm-6 col-md-6">
					    <div class="form-group">
						     <label class="checkbox-inline">
                                <input type="radio" name="authority" id="optionsRadios" value="user" checked> user
                             </label>
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
					    <div class="form-group">
						     <label class="checkbox-inline">
                                <input type="radio" name="authority" id="optionsRadios" value="admin"> admin
                             </label>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Edit User Profile" class="btn btn-primary btn-block btn-sm" tabindex="5"></div>
				</div>
										</form>
						
						
                        </div>
						 <div class="panel-footer">
                            <a class="btn btn-default" href="javascript:close()"> Cancel</a>
                        </div>
                    </div>
                </div>
				
            </div>				
			<!--/. ROW -->
			<a class="btn btn-success" href="" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Add New User</a>
			
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil "></i>Add New User</h4>
                                        </div>
                                        <div class="modal-body">
										<form role="form" method="post" action="" autocomplete="off">
										 <div class="form-group">
				   <div class="input-group">
				    <span class="input-group-addon glyphicon glyphicon-user"></span>
					<input type="text" name="username" id="username" class="form-control input-sm" placeholder="Name" value="" tabindex="1">
				   </div>
				</div>
				
				<div class="form-group">
				  <input type="hidden" name="action" value="add">
				</div>
				
				<div class="form-group">
				  <div class="input-group">
				    <span class="input-group-addon">@</span>
					<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email" value="" tabindex="2">
				  </div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
						  <div class="input-group">
				            <span class="input-group-addon glyphicon glyphicon-lock"></span>
							<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password" tabindex="3">
						  </div>
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
						  <div class="input-group">
				            <span class="input-group-addon glyphicon glyphicon-lock"></span>
							<input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-sm" placeholder="Confirm Password" tabindex="4">
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
				    <div class="col-xs-6 col-sm-6 col-md-6">
					    <div class="form-group">
						     <label class="checkbox-inline">
                                <input type="radio" name="authority" id="optionsRadios" value="user" checked> user
                             </label>
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
					    <div class="form-group">
						     <label class="checkbox-inline">
                                <input type="radio" name="authority" id="optionsRadios" value="admin"> admin
                             </label>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Create New User" class="btn btn-primary btn-block btn-sm" tabindex="5"></div>
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