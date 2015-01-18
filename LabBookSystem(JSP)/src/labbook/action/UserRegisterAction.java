package labbook.action;

import java.util.ArrayList;
import java.util.List;

import javax.servlet.ServletContext;

import org.apache.struts2.ServletActionContext;
import org.springframework.web.context.WebApplicationContext;
import org.springframework.web.context.support.WebApplicationContextUtils;

import labbook.model.User;
import labbook.service.UserService;

public class UserRegisterAction extends BaseAction{
	private UserService userService; // IOC
	public UserService getUserService() {
		return userService;
	}

	public void setUserService(UserService userService) {
		this.userService = userService;
	}

	private String username;
	private String email;
	private String password;
	private String passwordConfirm;
	private String identity;
	private String message="";
	
	public String execute() throws Exception
    {
		message="";
	    if(userService==null){
	    	 ServletContext servletContext = ServletActionContext.getServletContext();
	         WebApplicationContext webApplicationContext= WebApplicationContextUtils.getRequiredWebApplicationContext(servletContext);
	         userService=(UserService)webApplicationContext.getBean("UserService");
	    }
	    if(username.length()<=3){
	    	message+="<p class='bg-danger'>Username is too short.</p>";
	    }
	    else{
	    	if(userService.findUser(username)!=null)message+="<p class='bg-danger'>Username provided is already in use.</p>";	
	    }
	    if(password.length()<=3){
	    	message+="<p class='bg-danger'>Password is too short.</p>";
	    }
	    else{
	    	if(!password.equals(passwordConfirm))message+="<p class='bg-danger'>Password do not match.</p>";
	    }
	    if(!email.matches("[\\w\\.\\-]+@([\\w\\-]+\\.)+[\\w\\-]+")){
	    	message+="<p class='bg-danger'>Please enter a valid email address.</p>";
	    }
	    else{
	    	if(userService.findEmail(email)!=null)message+="<p class='bg-danger'>Email provided is already in use.</p>";
	    }
	    
	    if(message.length()<=0){
	    	User user=new User();
	    	user.setUser_name(username);
	    	user.setPassword(password);
            user.setEmail(email);
            user.setIdentity(identity);
            user.setAuthority("user");
            userService.addUser(user);
            message+="<h2 class='bg-success'>Registration successful, please login.</h2>";
            return "success";
	    }
	        return "fail";
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

	public String getMessage() {
		return message;
	}

	public void setMessage(String message) {
		this.message = message;
	}

	
}
