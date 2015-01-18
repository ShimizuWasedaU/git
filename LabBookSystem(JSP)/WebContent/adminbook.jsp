<%@ page language="java" contentType="text/html" pageEncoding="UTF-8"%>
<%@ taglib prefix="s" uri="/struts-tags"%>
<%@ include file="layout/adminheader.jsp" %>

 <form>
 <input type="hidden" id="menu" value="book">
 </form>
 
 
 <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Books Management</h2>   
                        <h5>Welcome Admin <s:property value="#session.username"/> , Love to see you back. </h5>
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
				 
				<%
                    String error=null;
                    if((error=(String)request.getAttribute("error"))!=null)
	                out.println(error);
	                String message=null;
	                if((message=(String)request.getAttribute("message"))!=null)
		            out.println(message);
                %>
				
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
										<form role="form" method="post" action="<s:url namespace="" action="addbook"/>" autocomplete="off">
										 <div class="form-group">
				   <div class="input-group">
				    <span class="input-group-addon glyphicon glyphicon-book"></span>
					<input type="text" name="bookname" id="bookname" class="form-control input-sm" placeholder="Book Name" value="" tabindex="1">
				   </div>
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
						
						<form role="form" method="post" action="<s:url namespace="" action="editbook"/>" autocomplete="off">
										 <div class="form-group">
				   <div class="input-group">
				    <span class="input-group-addon glyphicon glyphicon-book"></span>
					<input type="text" name="bookname" id="bookname" class="form-control input-sm" placeholder="Book Name" value="" tabindex="1">
				   </div>
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
											
											<%
	                                           String booklist=null;
	                                           if((booklist=(String)request.getAttribute("booklist"))!=null)
		                                       out.println(booklist);
                                             %>	
                                             
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
          <div class="navbar col-xs-12 col-sm-8 col-md-8 col-sm-offset-2 col-md-offset-2" >
     <div class="col-xs-12 col-sm-8 col-md-8 col-sm-offset-2 col-md-offset-2">Copyright © 2015 Ikenaga Laboratory. All right reserved.</div>
</div>
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