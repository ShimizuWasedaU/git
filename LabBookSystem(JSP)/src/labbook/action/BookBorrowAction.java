package labbook.action;

import javax.servlet.ServletContext;

import org.apache.struts2.ServletActionContext;
import org.springframework.web.context.WebApplicationContext;
import org.springframework.web.context.support.WebApplicationContextUtils;

import labbook.service.BookService;
import labbook.service.RecordService;
import labbook.service.UserService;

public class BookBorrowAction extends BaseAction{
	private RecordService recordService;

	private String bookid;
	private String error="";
	private String message="";
	
	
	public String execute(){
		error="";
		message="";
		if(recordService==null){
	    	 ServletContext servletContext = ServletActionContext.getServletContext();
	         WebApplicationContext webApplicationContext= WebApplicationContextUtils.getRequiredWebApplicationContext(servletContext);
	         recordService=(RecordService)webApplicationContext.getBean("RecordService");
	    }
		String borrower=recordService.findBorrower(bookid);
		if(borrower!=null){
			error+="<p class='bg-danger'>Sorry the book is already borrowed by "+borrower+"</p>";
			return "fail";
		}
		else{
			long userid=(long) this.request().getSession().getAttribute("userid");
			recordService.borrow(Long.parseLong(bookid), userid);
			message+="<h2 class='bg-success'>You just borrowed the book successfully. Please check in your borrow list</h2>";
			return "success";
		}		
	}
	
	public RecordService getRecordService() {
		return recordService;
	}
	public void setRecordService(RecordService recordService) {
		this.recordService = recordService;
	}
	public String getBookid() {
		return bookid;
	}
	public void setBookid(String bookid) {
		this.bookid = bookid;
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
}
