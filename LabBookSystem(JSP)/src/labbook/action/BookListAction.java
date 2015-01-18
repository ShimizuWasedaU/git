package labbook.action;

import java.util.List;

import javax.servlet.ServletContext;

import org.apache.struts2.ServletActionContext;
import org.springframework.web.context.WebApplicationContext;
import org.springframework.web.context.support.WebApplicationContextUtils;

import labbook.model.Book;
import labbook.service.BookService;
import labbook.service.UserService;

public class BookListAction extends BaseAction{
	private BookService bookService;
	private String booklist="";
	private String error="";
	private String message="";
	
	public String execute(){
		    String result="";
		    
		    if(bookService==null){
		    	 ServletContext servletContext = ServletActionContext.getServletContext();
		         WebApplicationContext webApplicationContext= WebApplicationContextUtils.getRequiredWebApplicationContext(servletContext);
		         bookService=(BookService)webApplicationContext.getBean("BookService");
		    }
		    
		    List books=bookService.listBook();
		
			 if(this.request().getSession().getAttribute("authority").equals("user")){
				 
				 for(int i=0; i<books.size();i++){
				    	Book book=(Book)books.get(i);
				    	booklist+="<tr>";  
				    	booklist=booklist+"<td>"+book.getBook_name()+"</td>";
		                if(book.getIsbn()!=null){booklist=booklist+ "<td>"+book.getIsbn()+"</td>";}else{booklist+= "<td>Collection</td>";}
							booklist=booklist+"<td>"+book.getWriter_name()+"</td>";
						booklist=booklist+"<td>"+book.getPublisher()+"</td>";
						
						if(book.getPrice()!=null){booklist=booklist+"<td>"+book.getPrice()+"</td>";}else{booklist+="<td>none</td>";}
						
						booklist=booklist+"<td>"+book.getShelf_id()+"</td>";
						if(!book.isAvailable()){ booklist=booklist+"<td>YES</td>";}else{booklist=booklist+"<td>NO</td>";}
						booklist=booklist+"<td><button class='btn btn-warning btn-sm' onclick=javascript:window.location.href='borrowbook?bookid="+book.getBook_id()+"'><i class='fa fa-shopping-cart'></i>Borrow</button></td></tr>";
				    }
				 
				 result="success";}
				else{
					if(this.request().getSession().getAttribute("authority").equals("admin")){
						 for(int i=0; i<books.size();i++){
						    	Book book=(Book)books.get(i);
						    	booklist+="<tr>";  
						    	booklist=booklist+"<td>"+book.getBook_name()+"</td>";
				                if(book.getIsbn()!=null){booklist=booklist+ "<td>"+book.getIsbn()+"</td>";}else{booklist+= "<td>Collection</td>";}
									booklist=booklist+"<td>"+book.getWriter_name()+"</td>";
								booklist=booklist+"<td>"+book.getPublisher()+"</td>";
								
								if(book.getPrice()!=null){booklist=booklist+"<td>"+book.getPrice()+"</td>";}else{booklist+="<td>none</td>";}
								
								booklist=booklist+"<td>"+book.getShelf_id()+"</td>";
								if(!book.isAvailable()){ booklist=booklist+"<td>YES</td>";}else{booklist=booklist+"<td>NO</td>";}
								booklist=booklist+"<td><div class='btn-group'>";
								booklist=booklist+"<a class='btn btn-primary dropdown-toggle' data-toggle='dropdown' href='#'><i class='fa fa-book'></i> Book<span class='caret'></span></a>";
								booklist=booklist+"<ul class='dropdown-menu'>";
								booklist=booklist+"<li><a href='javascript:edit("+book.getBook_id()+")'><i class='fa fa-pencil'></i> Edit</a></li>";
								booklist=booklist+"<li><a href='deletebook?bookid="+book.getBook_id()+"'><span class='glyphicon glyphicon-trash'></span>Delete</a></li>";
								booklist=booklist+"<li><a href='borrowbook?bookid="+book.getBook_id()+"'><i class='fa fa-shopping-cart'></i>Borrow</a></li>";
								booklist=booklist+"</ul></div></td>";
						    }		
							result="adminsuccess";
						}
				   }
		return result;	
	}

	public BookService getBookService() {
		return bookService;
	}

	public void setBookService(BookService bookService) {
		this.bookService = bookService;
	}

	public String getBooklist() {
		return booklist;
	}

	public void setBooklist(String booklist) {
		this.booklist = booklist;
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
