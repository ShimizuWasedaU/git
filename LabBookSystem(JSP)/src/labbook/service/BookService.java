package labbook.service;

import java.io.IOException;
import java.util.List;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import labbook.dao.BookDao;
import labbook.model.Book;
import labbook.model.User;

public interface BookService {
	public BookDao getBookDao();
	public void setBookDao(BookDao bookDao);
	
	public List listBook();
	

	public void sentErrorMessage(String message,HttpServletRequest req,HttpServletResponse resp) 
					throws ServletException,IOException;

	public void sentMessage(String message,HttpServletRequest req,HttpServletResponse resp) 
					throws ServletException,IOException;
	
	public void deleteBook(Book book);
	
	public Book findBook(String bookid);
	
	public void addBook(Book book);
	
	public void editBook(Book book);
}
