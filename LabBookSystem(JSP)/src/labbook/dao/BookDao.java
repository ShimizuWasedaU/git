package labbook.dao;

import java.util.List;

import labbook.model.Book;

public interface BookDao {

	/*
	 * insert a new book in database
	 */
	public void save(Book book);
	
	
	/*
	 * find a book by a certain column
	 */
	public Book find(String column,String value);
	
	
	/*
	 * update book by book_id
	 */
	public void updateByBookid(Book book);
	
	/*
	 * delete book by book_id
	 */
	public void deleteByBookid(Book book);
	
	/*
	 * list all books
	 */
	public List list();

}
