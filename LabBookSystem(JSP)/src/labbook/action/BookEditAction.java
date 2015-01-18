package labbook.action;

import javax.servlet.ServletContext;

import labbook.model.Book;
import labbook.service.BookService;

import org.apache.struts2.ServletActionContext;
import org.springframework.web.context.WebApplicationContext;
import org.springframework.web.context.support.WebApplicationContextUtils;

public class BookEditAction extends BaseAction{
	private BookService bookService;
    
	private String bookid;
	private String bookname;
	private String isbn;
	private String writer;
	private String publisher;
	private String price;
	private String shelf;
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
		    if(bookname.length()<=0)error+="<p class='bg-danger'>Please input book name.</p>";
		    if(shelf.length()<=0)error+="<p class='bg-danger'>Please set shelfid for the book.</p>";
		    
		    if(error.length()<=0){
		    	writer=(writer.length()<=0)?"Ikenaga Takeshi":writer;
				publisher=(publisher.length()<=0)?"Ikenaga Lab":publisher;
				isbn=(isbn.length()<=0)?null:isbn;
				price=(price.length()<=0)?null:price;
		        Book book=bookService.findBook(bookid);
		        book.setBook_name(bookname);
		        book.setShelf_id(shelf);
		        book.setIsbn(isbn);
		        book.setPrice(price);
		        book.setWriter_name(writer);
		        book.setPublisher(publisher);
		        book.setAvailable(false);
		        bookService.editBook(book);
		        message="<h2 class='bg-success'>Edit book successfully, please check the book list.</h2>";
			    return "success";
		    }
		    return "fail";
		}		
	
	public BookService getBookService() {
		return bookService;
	}
	public void setBookService(BookService bookService) {
		this.bookService = bookService;
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

	public String getBookname() {
		return bookname;
	}

	public void setBookname(String bookname) {
		this.bookname = bookname;
	}

	public String getIsbn() {
		return isbn;
	}

	public void setIsbn(String isbn) {
		this.isbn = isbn;
	}

	public String getWriter() {
		return writer;
	}

	public void setWriter(String writer) {
		this.writer = writer;
	}

	public String getPublisher() {
		return publisher;
	}

	public void setPublisher(String publisher) {
		this.publisher = publisher;
	}

	public String getPrice() {
		return price;
	}

	public void setPrice(String price) {
		this.price = price;
	}

	public String getShelf() {
		return shelf;
	}

	public void setShelf(String shelf) {
		this.shelf = shelf;
	}

	public String getBookid() {
		return bookid;
	}

	public void setBookid(String bookid) {
		this.bookid = bookid;
	}
}
