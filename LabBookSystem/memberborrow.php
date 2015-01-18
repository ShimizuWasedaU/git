<?php require('includes/config.php'); 

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); } 

//define page title
$title = 'Members Page';

//user return event
//if button has been clicked process it
if(isset($_GET['record'])){
	$recordid=$_GET['record'];
	$time=date("Y/m/d H:i:s");
	$sql = "UPDATE book b, record r SET r.return_date='$time', returned=true, b.available=0 WHERE record_id='$recordid' and b.book_id=r.book_id and r.returned=0";
            if ($db->query($sql) === TRUE) {
            } else {
               echo "Error: " . $sql . "<br>" . $conn->error;
            }
			
	//redirect to this page		
	header('Location: memberborrow.php?action=joined');
	exit;		
}

//include header template
require('layout/memberheader.php'); 
?>

 <form>
 <input type="hidden" id="menu" value="borrow">
 </form>

 <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>My borrow records</h2>   
                        <h5>Welcome <?php echo $_SESSION['username']?> , Love to see you back. </h5>  
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
					echo "<h2 class='bg-success'>You just returned a book successfully. Please check in your borrow record</h2>";
				}
				?>
				 
		    <!--  ROW  -->
            <div class="row">
                <div class="col-md-12 col-sm-12">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#all" data-toggle="tab">All Records</a>
                                </li>
                                <li class=""><a href="#solved" data-toggle="tab">Solved Records</a>
                                </li>
                                <li class=""><a href="#unsolved" data-toggle="tab">Unsolved Records</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="all">
                                    
					<!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            All Borrow Record
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>BookName</th>
                                            <th>ISBN</th>
											<th>Shelf</th>
                                            <th>BorrowDate</th>
                                            <th>ReturnDate</th>
											<th>isReturned</th>
                                        </tr>
                                    </thead>
                                    <tbody>
											<?php
											 $username=$_SESSION['username'];
		                                     $result = $db->query("SELECT b.book_name, b.isbn, b.shelf_id, r.borrow_date, r.return_date, r.returned FROM book b, record r, user u WHERE b.book_id=r.book_id and u.user_id=r.user_id and u.user_name='$username'");
											 if ($result->num_rows > 0) {
												 
											  while($row = $result->fetch_assoc()){
												echo "<tr>";  
												echo "<td>".$row['book_name']."</td>";
                                                if($row['isbn']!=null){echo "<td>".$row['isbn']."</td>";}else{echo "<td>"."Collection"."</td>";}
 												echo "<td>".$row['shelf_id']."</td>";
												echo "<td>".$row['borrow_date']."</td>";
												echo "<td>".$row['return_date']."</td>";
												if($row['returned']==0){echo "<td>NO</td>";}else{echo "<td>YES</td>";}
												echo '</tr>';
											  }
											 }
											?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
									
                                </div>
                                <div class="tab-pane fade" id="solved">
                                    
									<!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Solved Borrow Record
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                    <thead>
                                        <tr>
                                            <th>BookName</th>
                                            <th>ISBN</th>
											<th>Shelf</th>
                                            <th>BorrowDate</th>
                                            <th>ReturnDate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
											<?php
											 $username=$_SESSION['username'];
		                                     $result = $db->query("SELECT b.book_name, b.isbn, b.shelf_id, r.borrow_date, r.return_date FROM book b, record r, user u WHERE b.book_id=r.book_id and u.user_id=r.user_id and u.user_name='$username' and r.returned=1");
											 if ($result->num_rows > 0) {
												 
											  while($row = $result->fetch_assoc()){
												echo "<tr>";  
												echo "<td>".$row['book_name']."</td>";
                                                if($row['isbn']!=null){echo "<td>".$row['isbn']."</td>";}else{echo "<td>"."Collection"."</td>";}
 												echo "<td>".$row['shelf_id']."</td>";
												echo "<td>".$row['borrow_date']."</td>";
												echo "<td>".$row['return_date']."</td>";
												echo '</tr>';
											  }
											 }
											?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
									
                                </div>
                                <div class="tab-pane fade" id="unsolved">
                                    
													<!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Unsolved Borrow Record
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example3">
                                    <thead>
                                        <tr>
                                            <th>BookName</th>
                                            <th>ISBN</th>
											<th>Shelf</th>
                                            <th>BorrowDate</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
											<?php
											 $username=$_SESSION['username'];
		                                     $result = $db->query("SELECT b.book_name, b.isbn, b.shelf_id, b.book_id, r.borrow_date, r.record_id FROM book b, record r, user u WHERE b.book_id=r.book_id and u.user_id=r.user_id and u.user_name='$username' and r.returned=0");
											 if ($result->num_rows > 0) {
												 
											  while($row = $result->fetch_assoc()){
												$recordid=$row['record_id'];
												echo "<tr>";  
												echo "<td>".$row['book_name']."</td>";
                                                if($row['isbn']!=null){echo "<td>".$row['isbn']."</td>";}else{echo "<td>"."Collection"."</td>";}
 												echo "<td>".$row['shelf_id']."</td>";
												echo "<td>".$row['borrow_date']."</td>";
												echo '<td><a class="btn btn-small btn-primary" href="memberborrow.php?record='.$recordid.'"><i class="fa fa-reply"></i> return</a></td>';
												
												echo '</tr>';
											  }
											 }
											?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
									
                                </div>
                            </div>
                </div>
			</div>
			<!--/. ROW-->
				    
            </div>
             <!-- /. PAGE INNER  -->
        </div>
         <!-- /. PAGE WRAPPER  -->
</div>
	</div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
				$('#dataTables-example2').dataTable();
				$('#dataTables-example3').dataTable();
            });
    </script>
         <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
</body>
</html>