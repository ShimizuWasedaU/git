package labbook.action;

import java.util.List;

import javax.servlet.ServletContext;

import org.apache.struts2.ServletActionContext;
import org.springframework.web.context.WebApplicationContext;
import org.springframework.web.context.support.WebApplicationContextUtils;

import labbook.model.Book;
import labbook.model.Record;
import labbook.service.BookService;
import labbook.service.RecordService;

public class RecordListAction extends BaseAction{
	private RecordService recordService;
	private String error="";
	private String message="";
	private String alllist="";
	private String solvedlist="";
	private String unsolvedlist="";
	
	public String execute(){
		String result="";
		if(recordService==null){
	    	 ServletContext servletContext = ServletActionContext.getServletContext();
	         WebApplicationContext webApplicationContext= WebApplicationContextUtils.getRequiredWebApplicationContext(servletContext);
	         recordService=(RecordService)webApplicationContext.getBean("RecordService");
	    }
		long userid=(long) this.request().getSession().getAttribute("userid");
		
		List recordlist=recordService.listUserRecord(userid);
		if(recordlist!=null){
		 for(int i=0; i<recordlist.size();i++){
			    Record record=(Record)recordlist.get(i);
			    Book book=recordService.getBook(record);
				alllist+="<tr>";  
				alllist=alllist+"<td>"+book.getBook_name()+"</td>";
             if(book.getIsbn()!=null){alllist=alllist+"<td>"+book.getIsbn()+"</td>";}else{alllist=alllist+"<td>Collection</td>";}
				alllist=alllist+"<td>"+book.getShelf_id()+"</td>";
				alllist=alllist+"<td>"+record.getBorrow_date()+"</td>";
				alllist=alllist+"<td>"+record.getReturn_date()+"</td>";
				if(record.isReturned()){alllist+="<td>YES</td>";}else{alllist+="<td>NO</td>";}
				alllist+="</tr>";
				
			 if(record.isReturned()){
					solvedlist+="<tr>";  
					solvedlist=solvedlist+"<td>"+book.getBook_name()+"</td>";
	             if(book.getIsbn()!=null){solvedlist=solvedlist+"<td>"+book.getIsbn()+"</td>";}else{solvedlist=solvedlist+"<td>Collection</td>";}
	             solvedlist=solvedlist+"<td>"+book.getShelf_id()+"</td>";
	             solvedlist=solvedlist+"<td>"+record.getBorrow_date()+"</td>";
	             solvedlist=solvedlist+"<td>"+record.getReturn_date()+"</td>";
					solvedlist+="</tr>";
			 }
			 else{
				 unsolvedlist+="<tr>";  
				 unsolvedlist=unsolvedlist+"<td>"+book.getBook_name()+"</td>";
	             if(book.getIsbn()!=null){unsolvedlist=unsolvedlist+"<td>"+book.getIsbn()+"</td>";}else{unsolvedlist=unsolvedlist+"<td>Collection</td>";}
	             unsolvedlist=unsolvedlist+"<td>"+book.getShelf_id()+"</td>";
	             unsolvedlist=unsolvedlist+"<td>"+record.getBorrow_date()+"</td>";
	             unsolvedlist=unsolvedlist+"<td><a class='btn btn-small btn-primary' href='returnbook?recordid="+record.getRecord_id()+"'><i class='fa fa-reply'></i> return</a></td>";
	             unsolvedlist+="</tr>";
			 }
		  }
		 }
		 if(this.request().getSession().getAttribute("authority").equals("user")){result="success";}
			else{ if(this.request().getSession().getAttribute("authority").equals("admin"))result="adminsuccess";}
		  return result;	
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

	public RecordService getRecordService() {
		return recordService;
	}

	public void setRecordService(RecordService recordService) {
		this.recordService = recordService;
	}

	public String getAlllist() {
		return alllist;
	}

	public void setAlllist(String alllist) {
		this.alllist = alllist;
	}

	public String getSolvedlist() {
		return solvedlist;
	}

	public void setSolvedlist(String solvedlist) {
		this.solvedlist = solvedlist;
	}

	public String getUnsolvedlist() {
		return unsolvedlist;
	}

	public void setUnsolvedlist(String unsolvedlist) {
		this.unsolvedlist = unsolvedlist;
	}
}
