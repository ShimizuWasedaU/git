package labbook.dao.impl;

import java.util.List;

import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.SessionFactory;
import org.hibernate.Transaction;
import org.hibernate.cfg.Configuration;

import labbook.dao.BookDao;
import labbook.model.Book;
import labbook.model.User;

public class BookDaoImpl implements BookDao{

	private SessionFactory sessionFactory;
	@Override
	public void save(Book book) {
		// TODO Auto-generated method stub
		try {
			Session session=sessionFactory.openSession();
			Transaction tx=session.beginTransaction();
			session.save(book);
			tx.commit();
			session.close();
			//this.getHibernateTemplate().save(user);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	@Override
	public Book find(String column, String value) {
		// TODO Auto-generated method stub
		try {
			Session session = sessionFactory.openSession();

			String hql = "from labbook.model.Book as bo where bo."
					+ column + "='" + value + "'";
			Query query = session.createQuery(hql);
			List list = query.list();

			// List list=
			// this.getHibernateTemplate().find("from User u where u." + column
			// + "='"+ value+"'");
			if ((list.size()) == 0)
				return null;
			else
				return (Book) list.get(0);
		} catch (Exception e) {
			e.printStackTrace();
		}
		return null;
	}

	@Override
	public void updateByBookid(Book book) {
		// TODO Auto-generated method stub
		try {
			Session session=sessionFactory.openSession();
			Transaction tx=session.beginTransaction();
			session.update(book);
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
	public void deleteByBookid(Book book) {
		// TODO Auto-generated method stub
		try {
			Configuration config = new Configuration().configure();
			@SuppressWarnings("deprecation")
			SessionFactory sessionFactory = config.buildSessionFactory();
			Session session=sessionFactory.openSession();
			Transaction tx=session.beginTransaction();
			session.delete(book);
			tx.commit();
			session.close();
			//this.getHibernateTemplate().update(user);
		} catch (Exception e) {
			e.printStackTrace();
		}	
	}

	@Override
	public List list() {
		// TODO Auto-generated method stub
		try {
			Session session = sessionFactory.openSession();

			String hql = "from labbook.model.Book as bo";
			Query query = session.createQuery(hql);
			List list = query.list();

			// List list=
			// this.getHibernateTemplate().find("from User u where u." + column
			// + "='"+ value+"'");
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
