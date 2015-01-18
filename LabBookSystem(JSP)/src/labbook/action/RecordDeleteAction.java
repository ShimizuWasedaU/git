package labbook.action;

import javax.servlet.ServletContext;

import labbook.service.RecordService;

import org.apache.struts2.ServletActionContext;
import org.springframework.web.context.WebApplicationContext;
import org.springframework.web.context.support.WebApplicationContextUtils;

public class RecordDeleteAction extends BaseAction{
	private RecordService recordService;
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
		recordService.deleteRecord(recordid);
		
		message="<h2 class='bg-success'>You just delete a record successfully. Please check in all borrow record</h2>";
		
		
		return "adminsuccess";
		
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
}
