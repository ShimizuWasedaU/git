package labbook.service.impl;

import java.io.IOException;
import java.sql.Date;
import java.text.SimpleDateFormat;
import java.util.Calendar;
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
import labbook.service.BookService;
import labbook.service.RecordService;

public class RecordServiceImpl implements RecordService{
	private RecordDao recordDao;
	private UserDao userDao;
	private BookDao bookDao;
	
    
	@Override
	public RecordDao getRecordDao() {
		// TODO Auto-generated method stub
		return null;
	}

	@Override
	public void setRecordDao(RecordDao recordDao) {
		// TODO Auto-generated method stub
		this.recordDao=recordDao;
	}

	@Override
	public String findBorrower(String bookid) {
		// TODO Auto-generated method stub
		Record record=recordDao.findBorrowed("book_id",bookid);
		if(record!=null&&!record.isReturned()){
			User user=userDao.find("user_id", Long.toString(record.getUser_id()));
			return user.getUser_name();
		}
		else return null;
	}

	@Override
	public void sentErrorMessage(String message, HttpServletRequest req,
			HttpServletResponse resp) throws ServletException, IOException {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void sentMessage(String message, HttpServletRequest req,
			HttpServletResponse resp) throws ServletException, IOException {
		// TODO Auto-generated method stub
		
	}

	@Override
	public UserDao getUSerDao() {
		// TODO Auto-generated method stub
		return null;
	}

	@Override
	public void setUserDao(UserDao userDao) {
		// TODO Auto-generated method stub
		this.userDao=userDao;
	}

	@Override
	public BookDao getBookDao() {
		// TODO Auto-generated method stub
		return null;
	}

	@Override
	public void setBookDao(BookDao bookDao) {
		// TODO Auto-generated method stub
		this.bookDao=bookDao;
	}

	@Override
	public void borrow(long bookid, long userid) {
		// TODO Auto-generated method stub
		Record record=new Record();
		record.setBook_id(bookid);
		record.setUser_id(userid);
		Calendar calendar=Calendar.getInstance();
		Date date=new Date(calendar.getTimeInMillis());
		record.setBorrow_date(date);
		recordDao.save(record);
		Book book=bookDao.find("book_id",Long.toString(bookid));
		book.setAvailable(true);
		bookDao.updateByBookid(book);
	}

	@Override
	public void returnBook(String recordid) {
		// TODO Auto-generated method stub
		Record record=recordDao.find("record_id", recordid);
		record.setReturned(true);
		Calendar calendar=Calendar.getInstance();
		Date date=new Date(calendar.getTimeInMillis());
		record.setReturn_date(date);
		recordDao.updateByRecordid(record);
		Book book=bookDao.find("book_id",Long.toString(record.getBook_id()));
		book.setAvailable(false);
		bookDao.updateByBookid(book);
	}

	@Override
	public List listRecord() {
		// TODO Auto-generated method stub
		return recordDao.list();
	}

	@Override
	public Book getBook(Record record) {
		// TODO Auto-generated method stub
		return bookDao.find("book_id",Long.toString(record.getBook_id()));
	}

	@Override
	public List listUserRecord(long userid) {
		// TODO Auto-generated method stub
		return recordDao.list(userid);
	}

	@Override
	public void deleteRecord(String recordid) {
		// TODO Auto-generated method stub
		Record record=recordDao.find("record_id", recordid);
		if(!record.isReturned()){
		   Book book=bookDao.find("book_id",Long.toString(record.getBook_id()));
		  if(book!=null){
		   book.setAvailable(false);
		   bookDao.updateByBookid(book);
		   }
		  }
		recordDao.deleteByRecordid(record);
	}

	@Override
	public User getBorrower(Record record) {
		// TODO Auto-generated method stub
		return userDao.find("user_id",Long.toString(record.getUser_id()));
	}

	@Override
	public List listBookRecord(long bookid) {
		// TODO Auto-generated method stub
		return recordDao.listBookRecord(bookid);
	}

}
