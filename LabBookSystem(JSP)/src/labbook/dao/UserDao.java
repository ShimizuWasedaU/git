package labbook.dao;

import java.util.List;

import labbook.model.User;

public interface UserDao {
	/*
	 * insert a new user in database
	 */
	public void save(User user);
	
	
	/*
	 * find a user by a certain column
	 */
	public User find(String column,String value);
	
	
	/*
	 * update user by user_id
	 */
	public void updateByUserid(User user);
	
	/*
	 * delete user by user_id
	 */
	public void deleteByUserid(User user);
	
	/*
	 * list all records
	 */
	public List list();

}
