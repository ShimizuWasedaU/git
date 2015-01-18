<%@ page language="java" contentType="text/html" pageEncoding="UTF-8"%>
<%@ taglib prefix="s" uri="/struts-tags"%>
<%@ include file="layout/adminheader.jsp" %>

<form>
 <input type="hidden" id="menu" value="borrow">
 </form>
 
 
  <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>My borrow records</h2>   
                        <h5>Welcome admin <s:property value="#session.username"/> , Love to see you back. </h5>  
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
                                    
											<%
	                                          String alllist=null;
	                                          if((alllist=(String)request.getAttribute("alllist"))!=null)
		                                       out.println(alllist);
                                            %>
                                            
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
                                    
											<%
	                                          String solvedlist=null;
	                                          if((solvedlist=(String)request.getAttribute("solvedlist"))!=null)
		                                       out.println(solvedlist);
                                            %>
                                            
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
										   <%
	                                          String unsolvedlist=null;
	                                          if((unsolvedlist=(String)request.getAttribute("unsolvedlist"))!=null)
		                                       out.println(unsolvedlist);
                                            %>
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
				$('#dataTables-example2').dataTable();
				$('#dataTables-example3').dataTable();
            });
    </script>
         <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
</body>
</html>