package labbook.action;

import java.util.Map;

import com.opensymphony.xwork2.ActionContext;

import labbook.service.UserService;

public class UserLogoutAction extends BaseAction{
	
	public String execute(){
		
		ActionContext ac = ActionContext.getContext();
		Map session = ac.getSession();
		session.clear();
	    return "success";
		
	}
}
