<?php require('includes/config.php'); 

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); } 

//define page title
$title = 'Admin Page';

//add new book
//if form has been submitted process it
if(isset($_POST['submit'])&&isset($_POST['action'])&&$_POST['action']=='add'){

	//very basic validation
	if(strlen($_POST['bookname'])==0){
		$error[] = 'Please input book name.';
	}
	
	if(strlen($_POST['shelf'])==0){
		$error[] = 'Please set shelfid for the book.';
	}

	//if no errors have been created carry on
	if(!isset($error)){
            $bookname=$_POST['bookname'];		
			$isbn=$_POST['isbn']; $isbn=!empty(trim($isbn))?"'$isbn'":'NULL';
			$writer=$_POST['writer']; $writer=!empty(trim($writer))?"'$writer'":'Ikenaga Takeshi';
			$publisher=$_POST['publisher']; $publisher=!empty(trim($publisher))?"'$publisher'":'Ikenaga Lab';
			$price=$_POST['price']; $price=!empty(trim($price))?"'$price'":'NULL';
			$shelf=$_POST['shelf'];
			$available=0;
			$sql = "INSERT INTO book (isbn,book_name,writer_name,publisher,price,shelf_id,available) VALUES ($isbn,'$bookname', '$writer', '$publisher', $price, '$shelf','$available')";
            if ($db->query($sql) === TRUE) {
            } else {
               echo "Error: " . $sql . "<br>" . $conn->error;
            }

			//redirect to index page
			header('Location: adminbooks.php?action=added');
			exit;
	}
}

//edit book
//if form has been submitted process it
if(isset($_POST['submit'])&&isset($_POST['action'])&&$_POST['action']=='edit'){

	//very basic validation
	if(strlen($_POST['bookname'])==0){
		$error[] = 'Please input book name.';
	}
	
	if(strlen($_POST['shelf'])==0){
		$error[] = 'Please set shelfid for the book.';
	}

	//if no errors have been created carry on
	if(!isset($error)){
		    $bookid=$_POST['bookid'];
            $bookname=$_POST['bookname'];		
			$isbn=trim($_POST['isbn']);
			$writer=trim($_POST['writer']);
			$publisher=trim($_POST['publisher']);
			$price=trim($_POST['price']);
			$shelf=$_POST['shelf'];
			$sql = "Update book SET isbn=IF('$isbn'='',NULL,'$isbn'),book_name='$bookname',writer_name=IF('$writer'='','Ikenaga Takeshi','$writer'),publisher=IF('$publisher'='','Ikenaga Lab','$publisher'),price=IF('$price'='',NULL,'$price'),shelf_id='$shelf' WHERE book_id='$bookid'";
            if ($db->query($sql) === TRUE) {
            } else {
               echo "Error: " . $sql . "<br>" . $conn->error;
            }

			//redirect to index page
			header('Location: adminbooks.php?');
			exit;
	}
}

//admin delete event
//if delete button has been clicked process it
if(isset($_GET['bookid'])&&isset($_GET['action'])&&$_GET['action']=='delete'){
	$bookid=$_GET['bookid'];
	$sql = "DELETE FROM record WHERE book_id='$bookid'";
    if ($db->query($sql) === TRUE) {
      } else {
         echo "Error: " . $sql . "<br>" . $conn->error;
      }
	
	$sql = "DELETE FROM book WHERE book_id='$bookid'";
    if ($db->query($sql) === TRUE) {
      } else {
         echo "Error: " . $sql . "<br>" . $conn->error;
      }
			
    //redirect to this page		
    header('Location: adminbooks.php?action=deleted');
    exit;		
}

//admin borrow event
//if borrow button has been clicked process it
if(isset($_GET['bookid'])&&isset($_GET['action'])&&$_GET['action']=='borrow'){
   $bookid=$_GET['bookid'];
	
   $result3 = $db->query("SELECT u.user_name FROM user u, record r WHERE u.user_id=r.user_id and r.book_id='$bookid' and r.returned=0");
   if ($result3->num_rows > 0) {
   $row3 = $result3->fetch_assoc();
   $borrower=$row3['user_name'];
   $error[] = 'The book is already borrowed by.'.$borrower;
   }
   else{
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
	header('Location: adminbooks.php?action=borrowed');
	exit;
   }	
}

//include header template
require('layout/adminheader.php'); 
?>

 <form>
 <input type="hidden" id="menu" value="book">
 </form>
 
 <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Books Management</h2>   
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

				//if action is add show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'added'){
					echo "<h2 class='bg-success'>Add new book successfully, please check the book list.</h2>";
				}
				
				//if action is delete show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'deleted'){
					echo "<h2 class='bg-success'>Delete book successfully, please check the book list.</h2>";
				}
				
				//if action is borrow show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'borrowed'){
					echo "<h2 class='bg-success'>Borrow book successfully, please check the borrow record.</h2>";
				}
				
				//if action is edit show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'edited'){
					echo "<h2 class='bg-success'>Edit book successfully, please check the book list.</h2>";
				}
				?>
				
				<a class="btn btn-success" href="" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Add New Book</a></br></br>
			
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil "></i>Add New Book</h4>
											<div class="alert alert-warning">The bookName and the shelfID blank are necessary!!</div>
                                        </div>
                                        <div class="modal-body">
										<form role="form" method="post" action="" autocomplete="off">
										 <div class="form-group">
				   <div class="input-group">
				    <span class="input-group-addon glyphicon glyphicon-book"></span>
					<input type="text" name="bookname" id="bookname" class="form-control input-sm" placeholder="Book Name" value="" tabindex="1">
				   </div>
				</div>
				
				<div class="form-group">
				  <input type="hidden" name="action" value="add">
				</div>
				
				<div class="form-group">
				  <div class="input-group">
				    <span class="input-group-addon glyphicon glyphicon-barcode"></span>
					<input type="text" name="isbn" id="isbn" class="form-control input-sm" placeholder="ISBN" value="" tabindex="2">
				  </div>
				</div>
						<div class="form-group">
						  <div class="input-group">
				            <span class="input-group-addon glyphicon glyphicon-tasks"></span>
							<input type="text" name="shelf" id="shelf" class="form-control input-sm" placeholder="ShelfID" tabindex="3">
						  </div>
						</div>  
						<div class="form-group">
						  <div class="input-group">
				            <span class="input-group-addon glyphicon glyphicon-user"></span>
							<input type="text" name="writer" id="writer" class="form-control input-sm" placeholder="Writer" tabindex="4">
						  </div>
						</div>
						<div class="form-group">
						  <div class="input-group">
				            <span class="input-group-addon glyphicon glyphicon-print"></span>
							<input type="text" name="publisher" id="publisher" class="form-control input-sm" placeholder="Publisher" tabindex="4">
						  </div>
						</div>
						<div class="form-group">
						  <div class="input-group">
				            <span class="input-group-addon">$</span>
							<input type="text" name="price" id="price" class="form-control input-sm" placeholder="Price" tabindex="4">
						  </div>
						</div>
				
				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Create New Book" class="btn btn-primary btn-block btn-sm" tabindex="5"></div>
				</div>
										</form>
										</div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>	
							
				 <!--/ROW -->			
			<div class="row">
				<div class="col-md-8 col-sm-8 fade hide" id="editPanel">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            Edit User Profile
							<div class="alert alert-warning">The bookName and the shelfID blank are necessary!!</div>
                        </div>
                        <div class="panel-body">
						
						<form role="form" method="post" action="" autocomplete="off">
										 <div class="form-group">
				   <div class="input-group">
				    <span class="input-group-addon glyphicon glyphicon-book"></span>
					<input type="text" name="bookname" id="bookname" class="form-control input-sm" placeholder="Book Name" value="" tabindex="1">
				   </div>
				</div>
				
				<div class="form-group">
				  <input type="hidden" name="action" value="edit">
				</div>
				
				<div class="form-group">
				  <input type="hidden" name="bookid" id="bookid" value="">
				</div>
				
				<div class="form-group">
				  <div class="input-group">
				    <span class="input-group-addon glyphicon glyphicon-barcode"></span>
					<input type="text" name="isbn" id="isbn" class="form-control input-sm" placeholder="ISBN" value="" tabindex="2">
				  </div>
				</div>
						<div class="form-group">
						  <div class="input-group">
				            <span class="input-group-addon glyphicon glyphicon-tasks"></span>
							<input type="text" name="shelf" id="shelf" class="form-control input-sm" placeholder="ShelfID" tabindex="3">
						  </div>
						</div>  
						<div class="form-group">
						  <div class="input-group">
				            <span class="input-group-addon glyphicon glyphicon-user"></span>
							<input type="text" name="writer" id="writer" class="form-control input-sm" placeholder="Writer" tabindex="4">
						  </div>
						</div>
						<div class="form-group">
						  <div class="input-group">
				            <span class="input-group-addon glyphicon glyphicon-print"></span>
							<input type="text" name="publisher" id="publisher" class="form-control input-sm" placeholder="Publisher" tabindex="4">
						  </div>
						</div>
						<div class="form-group">
						  <div class="input-group">
				            <span class="input-group-addon">$</span>
							<input type="text" name="price" id="price" class="form-control input-sm" placeholder="Price" tabindex="4">
						  </div>
						</div>
				
				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Edit This Book" class="btn btn-primary btn-block btn-sm" tabindex="5"></div>
				</div>
										</form>
                        </div>
							 <div class="panel-footer">
                            <a class="btn btn-default" href="javascript:close()"> Cancel</a>
                        </div>
                    </div>
                </div>
			</div>
            <!--/.ROW -->						
              
			    <!--ROW -->
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
												
												echo '<td><div class="btn-group">
                                                        <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-book"></i> Book<span class="caret"></span></a>
                                                        <ul class="dropdown-menu">
                                                        <li><a href="javascript:edit('.$bookid.')"><i class="fa fa-pencil"></i> Edit</a></li>
                                                        <li><a href="adminbooks.php?action=delete&bookid='.$bookid.'"><span class="glyphicon glyphicon-trash"></span>Delete</a></li>
														<li><a href="adminbooks.php?action=borrow&bookid='.$bookid.'"><i class="fa fa-shopping-cart"></i>Borrow</a></li>
                                                        </ul>
                                                        </div>
	                                                    </td>';	
												
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
				$('#dataTables-example2').dataTable();
				$('#dataTables-example3').dataTable();
            });
    </script>
         <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
</body>
</html>