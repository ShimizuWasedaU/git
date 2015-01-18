package labbook.dao.impl;

import java.util.List;

import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.SessionFactory;
import org.hibernate.Transaction;
import org.hibernate.cfg.Configuration;

import labbook.dao.RecordDao;
import labbook.model.Book;
import labbook.model.Record;

public class RecordDaoImpl implements RecordDao{
	private SessionFactory sessionFactory; 

	@Override
	public void save(Record record) {
		// TODO Auto-generated method stub
		try {
			Session session=sessionFactory.openSession();
			Transaction tx=session.beginTransaction();
			session.save(record);
			tx.commit();
			session.close();
			//this.getHibernateTemplate().save(user);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	@Override
	public Record find(String column, String value) {
		// TODO Auto-generated method stub
		try {
			Session session = sessionFactory.openSession();

			String hql = "from labbook.model.Record as bo where bo."
					+ column + "='" + value + "'";
			Query query = session.createQuery(hql);
			List list = query.list();

			// List list=
			// this.getHibernateTemplate().find("from User u where u." + column
			// + "='"+ value+"'");
			if ((list.size()) == 0)
				return null;
			else
				return (Record) list.get(0);
		} catch (Exception e) {
			e.printStackTrace();
		}
		return null;
	}

	@Override
	public void updateByRecordid(Record record) {
		// TODO Auto-generated method stub
		try {
			Session session=sessionFactory.openSession();
			Transaction tx=session.beginTransaction();
			session.update(record);
			tx.commit();
			session.close();
			//this.getHibernateTemplate().update(user);
		} catch (Exception e) {
			e.printStackTrace();
		}	
	}

	@Override
	public void deleteByRecordid(Record record) {
		// TODO Auto-generated method stub
		try {
			Session session=sessionFactory.openSession();
			Transaction tx=session.beginTransaction();
			session.delete(record);
			tx.commit();
			session.close();
			//this.getHibernateTemplate().update(user);
		} catch (Exception e) {
			e.printStackTrace();
		}	
	}

	public SessionFactory getSessionFactory() {
		return sessionFactory;
	}

	public void setSessionFactory(SessionFactory sessionFactory) {
		this.sessionFactory = sessionFactory;
	}

	@Override
	public List list() {
		// TODO Auto-generated method stub
		try {
			Session session = sessionFactory.openSession();

			String hql = "from labbook.model.Record as re";
			Query query = session.createQuery(hql);
			List list = query.list();

			if ((list.size()) == 0)
				return null;
			else
				return list;
		} catch (Exception e) {
			e.printStackTrace();
		}
		return null;
	}

	@Override
	public List list(long userid) {
		// TODO Auto-generated method stub
		try {
			Session session = sessionFactory.openSession();

			String hql = "from labbook.model.Record as re where re.user_id="+userid;
			Query query = session.createQuery(hql);
			List list = query.list();

			if ((list.size()) == 0)
				return null;
			else
				return list;
		} catch (Exception e) {
			e.printStackTrace();
		}
		return null;
	}

	@Override
	public Record findBorrowed(String column,String value) {
		// TODO Auto-generated method stub
		try {
			Session session = sessionFactory.openSession();

			String hql = "from labbook.model.Record as bo where bo."
					+ column + "='" + value + "' and bo.returned=false";
			Query query = session.createQuery(hql);
			List list = query.list();

			// List list=
			// this.getHibernateTemplate().find("from User u where u." + column
			// + "='"+ value+"'");
			if ((list.size()) == 0)
				return null;
			else
				return (Record) list.get(0);
		} catch (Exception e) {
			e.printStackTrace();
		}
		return null;
	}

	@Override
	public List listBookRecord(long bookid) {
		// TODO Auto-generated method stub
		try {
			Session session = sessionFactory.openSession();

			String hql = "from labbook.model.Record as re where re.book_id="+bookid;
			Query query = session.createQuery(hql);
			List list = query.list();

			if ((list.size()) == 0)
				return null;
			else
				return list;
		} catch (Exception e) {
			e.printStackTrace();
		}
		return null;
	}

}
