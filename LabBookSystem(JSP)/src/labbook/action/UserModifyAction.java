package labbook.action;

import java.util.ArrayList;
import java.util.List;

import javax.servlet.ServletContext;

import org.apache.struts2.ServletActionContext;
import org.springframework.web.context.WebApplicationContext;
import org.springframework.web.context.support.WebApplicationContextUtils;

import labbook.model.User;
import labbook.service.UserService;

public class UserModifyAction extends BaseAction{
	private UserService userService; // IOC
	private String username;
	private String email;
	private String password;
	private String passwordConfirm;
    private String message="";
    
    
    public String execute() throws Exception
    {   String result="";
    	long userid=(long) this.request().getSession().getAttribute("userid");
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
	    	if(userService.findUser(username)!=null&&userService.findUser(username).getUser_id()!=userid)message+="<p class='bg-danger'>Username provided is already in use.</p>";	
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
	    	if(userService.findEmail(email)!=null&&userService.findEmail(email).getUser_id()!=userid)message+="<p class='bg-danger'>Email provided is already in use.</p>";
	    }
	    
	    
	    if(message.length()<=0){
	    	User user=new User();
	    	user.setUser_id(userid);
	    	user.setUser_name(username);
	    	user.setPassword(password);
            user.setEmail(email);
            user.setIdentity((String)this.request().getSession().getAttribute("identity"));
            user.setAuthority((String)this.request().getSession().getAttribute("authority"));
            userService.update(user);
			this.request().getSession().setAttribute("username",user.getUser_name());
			this.request().getSession().setAttribute("email",user.getEmail());
            message+="<h2 class='bg-success'>Profile change successful, please check your new profile.</h2>";
            
            if(user.getAuthority().equals("user")){result="success";}
			else{ if(user.getAuthority().equals("admin"))result="adminsuccess";}
            return result;
	    }
	    if(this.request().getSession().getAttribute("authority").equals("user")){result="fail";}
		else{ if(this.request().getSession().getAttribute("authority").equals("admin"))result="adminfail";}
	    return result;
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

	public void setUserService(UserService userService) {
			this.userService = userService;
			System.out.println("setUserService");
		}

		public UserService getUserService() {
			return userService;
		}

		public String getMessage() {
			return message;
		}

		public void setMessage(String message) {
			this.message = message;
		}

		public void setPasswordConfirm(String passwordConfirm) {
			this.passwordConfirm = passwordConfirm;
		}

}
