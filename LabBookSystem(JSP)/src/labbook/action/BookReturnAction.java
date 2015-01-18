package labbook.action;

import javax.servlet.ServletContext;

import org.apache.struts2.ServletActionContext;
import org.springframework.web.context.WebApplicationContext;
import org.springframework.web.context.support.WebApplicationContextUtils;

import labbook.service.RecordService;

public class BookReturnAction extends BaseAction{
	private RecordService recordService;
	private String way="";
	private String error="";
	private String message="";
	private String recordid;
	
	public String execute(){
	    String result="";
		error="";
		message="";
		if(recordService==null){
	    	 ServletContext servletContext = ServletActionContext.getServletContext();
	         WebApplicationContext webApplicationContext= WebApplicationContextUtils.getRequiredWebApplicationContext(servletContext);
	         recordService=(RecordService)webApplicationContext.getBean("RecordService");
	    }
		recordService.returnBook(recordid);
		
		message="<h2 class='bg-success'>You just returned a book successfully. Please check in your borrow record</h2>";
		
		
		if(way.equals("users"))return "usersuccess";
		
		return "success";
		
	}
		
	public RecordService getRecordService() {
		return recordService;
	}
	public void setRecordService(RecordService recordService) {
		this.recordService = recordService;
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
	public String getRecordid() {
		return recordid;
	}
	public void setRecordid(String recordid) {
		this.recordid = recordid;
	}

	public String getWay() {
		return way;
	}

	public void setWay(String way) {
		this.way = way;
	}

}
