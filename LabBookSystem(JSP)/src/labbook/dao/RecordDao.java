package labbook.dao;

import java.util.List;

import labbook.model.Record;

public interface RecordDao {

	/*
	 * insert a new record in database
	 */
	public void save(Record record);
	
	
	/*
	 * find a record by a certain column
	 */
	public Record find(String column,String value);
	
	
	/*
	 * update record by record_id
	 */
	public void updateByRecordid(Record record);
	
	/*
	 * delete record by record_id
	 */
	public void deleteByRecordid(Record record);
	
	/*
	 * list all records
	 */
	public List list();
	
	/*
	 * list all records of user
	 */
	public List list(long userid);
	/*
	 * list all records of book
	 */
	public List listBookRecord(long bookid);
	
	/*
	 * find borrower 
	 */
	public Record findBorrowed(String column,String value);

}
