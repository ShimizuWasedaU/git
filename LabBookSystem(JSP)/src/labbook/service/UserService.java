package labbook.service;

import java.io.IOException;
import java.util.List;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import labbook.dao.UserDao;
import labbook.model.User;

public interface UserService {

	public UserDao getUserDao();
	public void setUserDao(UserDao userDao);
	
	public User login(String user_name, String password);
	
	public void update(User user);

	public void sentErrorMessage(String message,HttpServletRequest req,HttpServletResponse resp) 
					throws ServletException,IOException;

	public void sentMessage(String message,HttpServletRequest req,HttpServletResponse resp) 
					throws ServletException,IOException;
	
	public User findUser(String user_name);
	
	public User findEmail(String email);
	
	public void addUser(User user);
	
	public List listUsers();
	
	public User find(String userid);
	
	public void deleteUser(User user);
	
	public void makeAdmin(User user);
}
