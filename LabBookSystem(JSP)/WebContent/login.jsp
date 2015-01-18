<%@ page language="java" contentType="text/html" pageEncoding="UTF-8"%>
<%@ taglib prefix="s" uri="/struts-tags"%>
<%@ include file="layout/header.jsp" %>

<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		  <div class="panel panel-default" style="box-shadow: rgba(0, 0, 0, 0.3) 10px 10px 10px;">
		   <div class="panel-body">
			<form role="form" method="post" action="<s:url namespace="" action="login"/>" autocomplete="off">
				<h2>Please Login</h2>
				<p><a href='register.jsp'>Back to home page</a></p>
				<hr>
				
				<%
	                String message=null;
	                if((message=(String)request.getAttribute("message"))!=null)
		            out.println("<p class='bg-danger'>"+message+"</p>");
                %>
				
                <div class="form-group">
				  <div class="input-group">
				    <span class="input-group-addon glyphicon glyphicon-user"></span>
					<input type="text" name="user_name" id="username" class="form-control input-lg" placeholder="User Name" value="" tabindex="1">
				  </div>
			    </div>
				
				<div class="form-group">
				  <div class="input-group">
				    <span class="input-group-addon glyphicon glyphicon-lock"></span>
					<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="3">
				  </div>
				</div>
				
				
				<hr>
				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Login" class="btn btn-primary btn-block btn-lg" tabindex="5"></div>
				</div>
			</form>
			</div>
		  </div>	
		</div>
	</div>



</div>

<%@ include file="layout/footer.jsp" %>
