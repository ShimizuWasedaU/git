<%@ page language="java" contentType="text/html" pageEncoding="UTF-8"%>
<%@ taglib prefix="s" uri="/struts-tags"%>
<%@ include file="layout/adminheader.jsp" %>

 <form>
 <input type="hidden" id="menu" value="users">
 </form>
 
 <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Users Management</h2>   
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
                                    
                                            <%
	                                          String userlist=null;
	                                          if((userlist=(String)request.getAttribute("userlist"))!=null)
		                                       out.println(userlist);
                                            %>
                                    
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
						<form role="form" method="post" action="<s:url namespace="" action="edituser"/>" autocomplete="off">
										 <div class="form-group">
				   <div class="input-group">
				    <span class="input-group-addon glyphicon glyphicon-user"></span>
					<input type="text" name="username" id="username" class="form-control input-sm" placeholder="New Name" value="" tabindex="1">
				   </div>
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
										<form role="form" method="post" action="<s:url namespace="" action="adduser"/>" autocomplete="off">
										 <div class="form-group">
				   <div class="input-group">
				    <span class="input-group-addon glyphicon glyphicon-user"></span>
					<input type="text" name="username" id="username" class="form-control input-sm" placeholder="Name" value="" tabindex="1">
				   </div>
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
         
         
          
<%@ include file="layout/adminfooter.jsp" %>