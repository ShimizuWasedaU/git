package labbook.action;

import java.util.List;

import javax.servlet.ServletContext;

import org.apache.struts2.ServletActionContext;
import org.springframework.web.context.WebApplicationContext;
import org.springframework.web.context.support.WebApplicationContextUtils;

import labbook.model.User;
import labbook.service.RecordService;
import labbook.service.UserService;

public class UserListAction extends BaseAction{
	private UserService userService;
	private String error="";
	private String message="";
	private String userlist="";
	
	
	public String execute(){
		if(userService==null){
	    	 ServletContext servletContext = ServletActionContext.getServletContext();
	         WebApplicationContext webApplicationContext= WebApplicationContextUtils.getRequiredWebApplicationContext(servletContext);
	         userService=(UserService)webApplicationContext.getBean("UserService");
	    }
		List users=userService.listUsers();
		
		for(int i=0; i<users.size();i++){
			User user=(User)users.get(i);
			userlist+="<tr>";
			userlist=userlist+"<td>"+user.getUser_name()+"</td>";
			userlist=userlist+"<td>"+user.getEmail()+"</td>";
			userlist=userlist+"<td>"+user.getIdentity()+"</td>";
			userlist=userlist+"<td>"+user.getAuthority()+"</td>";
			userlist=userlist+"<td><div class='btn-group'><a class='btn btn-primary dropdown-toggle' data-toggle='dropdown' href='#'><i class='fa fa-user'></i> User<span class='caret'></span></a>";
			userlist=userlist+"<ul class='dropdown-menu'>";
			userlist=userlist+"<li><a href='javascript:edit("+user.getUser_id()+")'><i class='fa fa-pencil'></i> Edit</a></li>";
			userlist=userlist+"<li><a href='deleteuser?userid="+user.getUser_id()+"'><span class='glyphicon glyphicon-trash'></span>Delete</a></li>";
			userlist=userlist+"<li class='divider'></li>";
			userlist=userlist+"<li><a href='makeadmin?userid="+user.getUser_id()+"'><i class='i'></i> Make admin</a></li>";
			userlist=userlist+"</ul>";
			userlist=userlist+"</div>";
			userlist=userlist+"</td>";
			userlist=userlist+"</tr>";
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
	public String getUserlist() {
		return userlist;
	}
	public void setUserlist(String userlist) {
		this.userlist = userlist;
	}		
}
