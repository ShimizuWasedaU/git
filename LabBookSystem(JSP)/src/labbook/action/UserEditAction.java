package labbook.action;

import javax.servlet.ServletContext;

import labbook.model.User;
import labbook.service.UserService;

import org.apache.struts2.ServletActionContext;
import org.springframework.web.context.WebApplicationContext;
import org.springframework.web.context.support.WebApplicationContextUtils;

public class UserEditAction extends BaseAction{
	private UserService userService;
	private String error="";
	private String message="";
	private String username;
	private String email;
	private String password;
	private String passwordConfirm;
	private String identity;
	private String authority;
	private String userid;
	
	
	public String execute(){
		message="";
		error="";
		long id=Long.parseLong(userid);
	    if(userService==null){
	    	 ServletContext servletContext = ServletActionContext.getServletContext();
	         WebApplicationContext webApplicationContext= WebApplicationContextUtils.getRequiredWebApplicationContext(servletContext);
	         userService=(UserService)webApplicationContext.getBean("UserService");
	    }
	    if(username.length()<=3){
	    	error+="<p class='bg-danger'>Username is too short.</p>";
	    }
	    else{
	    	if(userService.findUser(username)!=null&&userService.findUser(username).getUser_id()!=id)error+="<p class='bg-danger'>Username provided is already in use.</p>";	
	    }
	    if(password.length()<=3){
	    	error+="<p class='bg-danger'>Password is too short.</p>";
	    }
	    else{
	    	if(!password.equals(passwordConfirm))error+="<p class='bg-danger'>Password do not match.</p>";
	    }
	    if(!email.matches("[\\w\\.\\-]+@([\\w\\-]+\\.)+[\\w\\-]+")){
	    	error+="<p class='bg-danger'>Please enter a valid email address.</p>";
	    }
	    else{
	    	if(userService.findEmail(email)!=null&&userService.findEmail(email).getUser_id()!=id)error+="<p class='bg-danger'>Email provided is already in use.</p>";
	    }
	    
	    if(error.length()<=0){
	    	User user=userService.find(userid);
	    	user.setUser_name(username);
	    	user.setPassword(password);
            user.setEmail(email);
            user.setIdentity(identity);
            user.setAuthority(authority);
            userService.update(user);
            message+="<h2 class='bg-success'>User profile change successfully, please check new user list.</h2>";
            return "adminsuccess";
	    }
	        return "fail";
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
	public String getUsername() {
		return username;
	}
	public void setUsername(String username) {
		this.username = username;
	}
	public String getEmail() {
		return email;
	}
	public void setEmail(String email) {
		this.email = email;
	}
	public String getPassword() {
		return password;
	}
	public void setPassword(String password) {
		this.password = password;
	}
	public String getPasswordConfirm() {
		return passwordConfirm;
	}
	public void setPasswordConfirm(String passwordConfirm) {
		this.passwordConfirm = passwordConfirm;
	}
	public String getIdentity() {
		return identity;
	}
	public void setIdentity(String identity) {
		this.identity = identity;
	}
	public String getAuthority() {
		return authority;
	}
	public void setAuthority(String authority) {
		this.authority = authority;
	}

	public String getUserid() {
		return userid;
	}

	public void setUserid(String userid) {
		this.userid = userid;
	}

}
