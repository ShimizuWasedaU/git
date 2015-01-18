package labbook.service.impl;

import java.io.IOException;
import java.util.List;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import labbook.dao.BookDao;
import labbook.dao.RecordDao;
import labbook.model.Book;
import labbook.model.Record;
import labbook.model.User;
import labbook.service.BookService;

public class BookServiceImpl implements BookService{
	
	private BookDao bookDao;
	private RecordDao recordDao;

	public RecordDao getRecordDao() {
		return recordDao;
	}

	public void setRecordDao(RecordDao recordDao) {
		this.recordDao = recordDao;
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
	public List listBook() {
		// TODO Auto-generated method stub
		return bookDao.list();
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
	public void deleteBook(Book book) {
		// TODO Auto-generated method stub
		List recordlist=recordDao.listBookRecord(book.getBook_id());
		if(recordlist!=null){
		   for(int i=0;i<recordlist.size();i++){
			    Record record=(Record) recordlist.get(i);
			    recordDao.deleteByRecordid(record);
		      }
		}
		bookDao.deleteByBookid(book);
	}

	@Override
	public Book findBook(String bookid) {
		// TODO Auto-generated method stub
		return bookDao.find("book_id", bookid);
	}

	@Override
	public void addBook(Book book) {
		// TODO Auto-generated method stub
		bookDao.save(book);
	}

	@Override
	public void editBook(Book book) {
		// TODO Auto-generated method stub
		bookDao.updateByBookid(book);
	}

}
