package labbook.action;

import javax.servlet.ServletContext;

import labbook.model.Book;
import labbook.service.BookService;

import org.apache.struts2.ServletActionContext;
import org.springframework.web.context.WebApplicationContext;
import org.springframework.web.context.support.WebApplicationContextUtils;

public class BookDeleteAction extends BaseAction{
	private BookService bookService;

	private String bookid;
	private String error="";
	private String message="";
	
	
	public String execute(){
		error="";
		message="";
		if(bookService==null){
	    	 ServletContext servletContext = ServletActionContext.getServletContext();
	         WebApplicationContext webApplicationContext= WebApplicationContextUtils.getRequiredWebApplicationContext(servletContext);
	         bookService=(BookService)webApplicationContext.getBean("BookService");
	    }
		    Book book=bookService.findBook(bookid);
		    bookService.deleteBook(book);
		    message="<h2 class='bg-success'>Delete book successfully, please check the book list.</h2>";
			return "success";
		}		
	
	public BookService getBookService() {
		return bookService;
	}
	public void setBookService(BookService bookService) {
		this.bookService = bookService;
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
