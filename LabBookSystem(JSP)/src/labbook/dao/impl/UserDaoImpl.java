package labbook.dao.impl;

import java.util.Iterator;
import java.util.List;

import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.SessionFactory;
import org.hibernate.Transaction;
import org.hibernate.cfg.Configuration;

import labbook.dao.UserDao;
import labbook.model.User;

public class UserDaoImpl implements UserDao{

	private SessionFactory sessionFactory;
	
	@Override
	public void save(User user) {
		// TODO Auto-generated method stub
		try {
			Session session=sessionFactory.openSession();
			Transaction tx=session.beginTransaction();
			session.save(user);
			tx.commit();
			session.close();
			//this.getHibernateTemplate().save(user);
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	@Override
	public User find(String column, String value) {
		// TODO Auto-generated method stub
		try {
			Session session = sessionFactory.openSession();

			String hql = "from labbook.model.User as us where us."
					+ column + "='" + value + "'";
			Query query = session.createQuery(hql);
			List list = query.list();

			// List list=
			// this.getHibernateTemplate().find("from User u where u." + column
			// + "='"+ value+"'");
			if ((list.size()) == 0)
				return null;
			else
				return (User) list.get(0);
		} catch (Exception e) {
			e.printStackTrace();
		}
		return null;
	}

	@Override
	public void updateByUserid(User user) {
		// TODO Auto-generated method stub
		try {
			Session session=sessionFactory.openSession();
			Transaction tx=session.beginTransaction();
			session.update(user);
			tx.commit();
			session.close();
			//this.getHibernateTemplate().update(user);
		} catch (Exception e) {
			e.printStackTrace();
		}		
	}

	@Override
	public void deleteByUserid(User user) {
		// TODO Auto-generated method stub
		try {
			Session session=sessionFactory.openSession();
			Transaction tx=session.beginTransaction();
			session.delete(user);
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

			String hql = "from labbook.model.User as re";
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
