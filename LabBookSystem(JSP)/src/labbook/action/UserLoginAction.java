package labbook.action;

import java.sql.Date;
import java.util.Calendar;

import javax.servlet.ServletContext;

import org.apache.struts2.ServletActionContext;
import org.springframework.web.context.WebApplicationContext;
import org.springframework.web.context.support.WebApplicationContextUtils;

import labbook.model.User;
import labbook.service.UserService;

public class UserLoginAction extends BaseAction{
	
	private UserService userService; // IOC
	private String user_name;
	private String password;
    private String message="";
	
	 public String getUser_name() {
		return user_name;
	}

	public void setUser_name(String user_name) {
		this.user_name = user_name;
	}

	public String getPassword() {
		return password;
	}

	public void setPassword(String password) {
		this.password = password;
	}

	public String execute() throws Exception
	    {   String result="";
		    message="";
		    if(userService==null){
		    	 ServletContext servletContext = ServletActionContext.getServletContext();
		         WebApplicationContext webApplicationContext= WebApplicationContextUtils.getRequiredWebApplicationContext(servletContext);
		         userService=(UserService)webApplicationContext.getBean("UserService");
		    }
		    
			User user=(userService.login(user_name,password));
			if(user!=null){
				this.request().getSession().setAttribute("userid",user.getUser_id());
				this.request().getSession().setAttribute("username",user.getUser_name());
				this.request().getSession().setAttribute("email",user.getEmail());
				this.request().getSession().setAttribute("identity",user.getIdentity());
				this.request().getSession().setAttribute("authority",user.getAuthority());
				
				if(user.getAuthority().equals("user")){result="success";}
				else{ if(user.getAuthority().equals("admin"))result="adminsuccess";}
			}
			else{
				message="Wrong username or password"; 
				userService.sentErrorMessage(message, this.request(),this.response());
				result="fail";		
			}
			return result;
	    }

	    public void setUserService(UserService userService) {
			this.userService = userService;
			System.out.println("setUserService");
		}

		public UserService getUserService() {
			return userService;
		}
}
