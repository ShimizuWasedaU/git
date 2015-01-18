<?php require('includes/config.php'); 

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); } 

//define page title
$title = 'Members Page';

//user borrow event
//if button has been clicked process it
if(isset($_GET['book'])){
	$bookid=$_GET['book'];
	$time=date("Y/m/d H:i:s");
	$sql = "INSERT INTO record (user_id, book_id,borrow_date) VALUES ('$_SESSION[userid]','$bookid', '$time')";
            if ($db->query($sql) === TRUE) {
            } else {
               echo "Error: " . $sql . "<br>" . $conn->error;
            }
			
	$sql2 = "UPDATE book SET available=1 WHERE book_id='$bookid'";
            if ($db->query($sql2) === TRUE) {
            } else {
               echo "Error: " . $sql2 . "<br>" . $conn->error;
            }		
	//redirect to this page		
	header('Location: memberbook.php?action=joined');
	exit;		
}

//include header template
require('layout/memberheader.php'); 
?>

 <form>
 <input type="hidden" id="menu" value="book">
 </form>

 <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Find Books</h2>   
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
					echo "<h2 class='bg-success'>You just borrowed the book successfully. Please check in your borrow list</h2>";
				}
				?>
				 
			    <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Book List
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>BookName</th>
                                            <th>ISBN</th>
                                            <th>Writer</th>
                                            <th>Publisher</th>
											<th>Price</th>
                                            <th>Shelf</th>
											<th>Available</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
											<?php
		                                     $result = $db->query("SELECT * FROM book");
		                                     
											 if ($result->num_rows > 0) {
												 
											  while($row = $result->fetch_assoc()){ 
												$bookid=$row['book_id'];
												$available=$row['available'];
												$borrower=null;
												echo "<tr>";  
												echo "<td>".$row['book_name']."</td>";
                                                if($row['isbn']!=null){echo "<td>".$row['isbn']."</td>";}else{echo "<td>"."Collection"."</td>";}
 												echo "<td>".$row['writer_name']."</td>";
												echo "<td>".$row['publisher']."</td>";
												
												if($row['price']!=null){echo "<td>".$row['price']."</td>";}else{echo "<td>none</td>";}
												
												echo "<td>".$row['shelf_id']."</td>";
												if($row['available']==0){echo "<td>"."YES"."</td>";}else{echo "<td>"."NO"."</td>";}
												echo '<td>
						<div class="panel-body">
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal'.$bookid.'">
                              <i class="fa fa-shopping-cart "></i>Borrow
                            </button>
                            <div class="modal fade" id="myModal'.$bookid.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Borrowing Book</h4>
                                        </div>
                                        <div class="modal-body">';
										if($available==0){
									     echo '<h4>Are you sure you want to borrow the book?</h4>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick=javascript:window.location.href="memberbook.php?book='.$bookid.'">YES</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
							</div>
										</td>';}
										else{
											$result3 = $db->query("SELECT u.user_name FROM user u, record r WHERE u.user_id=r.user_id and r.book_id='$bookid' and r.returned=0");
											if ($result3->num_rows > 0) {
												$row3 = $result3->fetch_assoc();$borrower=$row3['user_name'];}
											echo '<h4>Sorry the book is already borrowed by '.$borrower.'</h4>
                                        </div>
                                        <div class="modal-footer">
                                        </div>
                                    </div>
                                </div>
                            </div>
							</div>
										</td>';}
												echo "</tr>"; 
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
                <!-- /. ROW  -->
               
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
            });
    </script>
         <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
</body>
</html>