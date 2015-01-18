package labbook.action;

import javax.servlet.ServletContext;

import labbook.model.User;
import labbook.service.UserService;

import org.apache.struts2.ServletActionContext;
import org.springframework.web.context.WebApplicationContext;
import org.springframework.web.context.support.WebApplicationContextUtils;

public class MakeAdminAction extends BaseAction{
	private UserService userService;
	private String error="";
	private String message="";
	private String userid;
	
	public String execute(){
		if(userService==null){
	    	 ServletContext servletContext = ServletActionContext.getServletContext();
	         WebApplicationContext webApplicationContext= WebApplicationContextUtils.getRequiredWebApplicationContext(servletContext);
	         userService=(UserService)webApplicationContext.getBean("UserService");
	    }
		User user=userService.find(userid);
		if(user.getAuthority().equals("admin")){
			error="<p class='bg-danger'>The user is already an admin!</p>";
		}else{
			userService.makeAdmin(user);
			message="<h2 class='bg-success'>Make admin successfully, please check new user list.</h2>";
		}
		
		return "adminsuccess";
	}
	
	
	public UserService getUserService() {
		return userService;
	}
	public void setUserService(UserService userService) {
		this.userService = userService;
	}
	public String getError() {
		return error;
	}
	public void setError(String error) {
		this.error = error;
	}
	public String getMessage() {
		return message;
	}
	public void setMessage(String message) {
		this.message = message;
	}
	public String getUserid() {
		return userid;
	}
	public void setUserid(String userid) {
		this.userid = userid;
	}	
	
}
