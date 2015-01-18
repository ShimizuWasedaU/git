package labbook.service.impl;

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
import labbook.service.UserService;

public class UserServiceImpl implements UserService{
	
	private UserDao userDao;
	private RecordDao recordDao;
	private BookDao bookDao;
	
    
	public BookDao getBookDao() {
		return bookDao;
	}

	public void setBookDao(BookDao bookDao) {
		this.bookDao = bookDao;
	}

	public RecordDao getRecordDao() {
		return recordDao;
	}

	public void setRecordDao(RecordDao recordDao) {
		this.recordDao = recordDao;
	}

	@Override
	public UserDao getUserDao() {
		// TODO Auto-generated method stub
		System.out.println("getUserdao");
		return userDao;
	}

	@Override
	public void setUserDao(UserDao userDao) {
		// TODO Auto-generated method stub
		this.userDao=userDao;
		System.out.println("setUserdao");
		
	}

	
	@Override
	public void sentErrorMessage(String message, HttpServletRequest req,
			HttpServletResponse resp) throws ServletException, IOException {
		// TODO Auto-generated method stub
		req.setAttribute("message",message);
		
	}

	@Override
	public void sentMessage(String message, HttpServletRequest req,
			HttpServletResponse resp) throws ServletException, IOException {
		// TODO Auto-generated method stub
		req.setAttribute("message",message);
		
	}

	@Override
	public User login(String user_name, String password) {
		// TODO Auto-generated method stub
		User user=userDao.find("user_name",user_name);
		if(user!=null&&password.equals(user.getPassword()))
		return user;
		else return null;
	}

	@Override
	public void update(User user) {
		// TODO Auto-generated method stub
		userDao.updateByUserid(user);
	}

	@Override
	public User findUser(String user_name) {
		// TODO Auto-generated method stub
		User user=userDao.find("user_name",user_name);
		return user;
	}

	@Override
	public User findEmail(String email) {
		// TODO Auto-generated method stub
		User user=userDao.find("email",email);
		return user;
	}

	@Override
	public void addUser(User user) {
		// TODO Auto-generated method stub
		userDao.save(user);
	}

	@Override
	public List listUsers() {
		// TODO Auto-generated method stub
		return userDao.list();
	}

	@Override
	public User find(String userid) {
		// TODO Auto-generated method stub
		User user=userDao.find("user_id",userid);
		return user;
	}

	@Override
	public void deleteUser(User user) {
		// TODO Auto-generated method stub
		List recordlist=recordDao.list(user.getUser_id());
		if(recordlist!=null){
		for(int i=0;i<recordlist.size();i++){
			Record record=(Record) recordlist.get(i);
			if(!record.isReturned()){
			   Book book=bookDao.find("book_id",Long.toString(record.getBook_id()));
			  if(book!=null){
			   book.setAvailable(false);
			   bookDao.updateByBookid(book);
			   }
			  }
			recordDao.deleteByRecordid(record);
		}
		}
		userDao.deleteByUserid(user);
	}

	@Override
	public void makeAdmin(User user) {
		// TODO Auto-generated method stub
		user.setAuthority("admin");
		userDao.updateByUserid(user);
	}	

}
