package labbook.action;

import javax.servlet.ServletContext;

import org.apache.struts2.ServletActionContext;
import org.springframework.web.context.WebApplicationContext;
import org.springframework.web.context.support.WebApplicationContextUtils;

import labbook.model.User;
import labbook.service.RecordService;
import labbook.service.UserService;

public class UserDeleteAction extends BaseAction{
	private UserService userService;
	private String error="";
	private String message="";
	private String userid;
	
	public String execute(){
		error="";
		message="";
		if(userService==null){
	    	 ServletContext servletContext = ServletActionContext.getServletContext();
	         WebApplicationContext webApplicationContext= WebApplicationContextUtils.getRequiredWebApplicationContext(servletContext);
	         userService=(UserService)webApplicationContext.getBean("UserService");
	    }
		User user=userService.find(userid);
		userService.deleteUser(user);
		message="<h2 class='bg-success'>User delete successfully, please check new user list.</h2>";
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
