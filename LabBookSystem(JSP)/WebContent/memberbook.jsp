<%@ page language="java" contentType="text/html" pageEncoding="UTF-8"%>
<%@ taglib prefix="s" uri="/struts-tags"%>
<%@ include file="layout/memberheader.jsp" %>

<form>
 <input type="hidden" id="menu" value="book">
 </form>

 <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Find Books</h2>   
                        <h5>Welcome <s:property value="#session.username"/> , Love to see you back. </h5>
                       
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