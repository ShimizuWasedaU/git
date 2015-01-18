package labbook.service;

import java.io.IOException;
import java.util.List;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import labbook.dao.BookDao;
import labbook.dao.RecordDao;
import labbook.dao.UserDao;
import labbook.model.Book;
import labbook.model.Record;
import labbook.model.User;

public interface RecordService {
	public BookDao getBookDao();
	public void setBookDao(BookDao bookDao);
	public UserDao getUSerDao();
	public void setUserDao(UserDao userDao);
	public RecordDao getRecordDao();
	public void setRecordDao(RecordDao recordDao);
	
	public String findBorrower(String bookid);
	
	public void borrow(long bookid, long userid);
	
	public void returnBook(String recordid);
	
    public List listRecord();
    
    public List listUserRecord(long userid);
    
    public List listBookRecord(long bookid);
    
    public Book getBook(Record recod);
    
    public User getBorrower(Record record);
    
    public void deleteRecord(String recordid);

	public void sentErrorMessage(String message,HttpServletRequest req,HttpServletResponse resp) 
					throws ServletException,IOException;

	public void sentMessage(String message,HttpServletRequest req,HttpServletResponse resp) 
					throws ServletException,IOException;
}
