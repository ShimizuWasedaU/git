<%@ page language="java" contentType="text/html" pageEncoding="UTF-8"%>
<%@ taglib prefix="s" uri="/struts-tags"%>
<%@ include file="layout/header.jsp" %>

<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		 <div class="panel panel-default" style="box-shadow: rgba(0, 0, 0, 0.3) 10px 10px 10px;">
		   <div class="panel-body">
			<form role="form" method="post" action="<s:url namespace="" action="register"/>" autocomplete="off">
				<h2>Please Sign Up</h2>
				<p>Already a member? <a href='login.jsp'>Login</a></p>
				<hr>
                
		       <%
	                String message=null;
	                if((message=(String)request.getAttribute("message"))!=null)
		            out.println(message);
                %>

				<div class="form-group">
				   <div class="input-group">
				    <span class="input-group-addon glyphicon glyphicon-user"></span>
					<input type="text" name="username" id="username" class="form-control input-lg" placeholder="User Name" value="" tabindex="1">
				   </div>
				</div>
				<div class="form-group">
				  <div class="input-group">
				    <span class="input-group-addon">@</span>
					<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" value="" tabindex="2">
				  </div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
						  <div class="input-group">
				            <span class="input-group-addon glyphicon glyphicon-lock"></span>
							<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="3">
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
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="5"></div>
				</div>
			</form>
		  </div>
		 </div>
		</div>
	</div>

</div>

<%@ include file="layout/footer.jsp" %>