<%@ page language="java" contentType="text/html" pageEncoding="UTF-8"%>
<%@ taglib prefix="s" uri="/struts-tags"%>
<%@ include file="layout/adminheader.jsp" %>

 <form>
 <input type="hidden" id="menu" value="profile">
 </form>
 
 
 <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>My Profile</h2>   
                        <h5>Welcome Admin <s:property value="#session.username"/> , Love to see you back. </h5>
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
				 
				 <%
	                String message=null;
	                if((message=(String)request.getAttribute("message"))!=null)
		            out.println(message);
                %>

		     <!--START OF PROFILE-->
             <div class="col-sm-6">
              <ul class="list-group">
                <li class="list-group-item text-muted" contenteditable="false">Profile</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">username</strong></span><s:property value="#session.username"/> </li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">email</strong></span> <s:property value="#session.email"/></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">identity</strong></span> <s:property value="#session.identity"/></li>
				<li class="list-group-item text-right"><span class="pull-left"><strong class="">authority</strong></span> <s:property value="#session.authority"/></li>
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
										<form role="form" method="post" action="<s:url namespace="" action="modify"/>" autocomplete="off">
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
 
 
 
 
 
<%@ include file="layout/adminfooter.jsp" %>