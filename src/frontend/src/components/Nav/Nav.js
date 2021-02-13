import React from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router-dom';

import * as routes from 'utils/routes';
import './Nav.scss';

const Nav = ({ isShow, onHide, user }) => {
  let isAdmin = window.location.href.includes('/admin');

  return (
    <nav className={`nav ${isShow ? 'is-open' : ''} ${isAdmin ? 'is-admin' : ''}`}>
      <ul className="nav-list">
        <li>
          <Link
            to={routes.INDEX}
            className="nav-link"
            onClick={onHide}
          >
            TOP
          </Link>
        </li>
        <li style={{display: user.token ? 'none' : ''}}>
          <Link
            to={routes.ADMIN_LOGIN}
            className="nav-link"
            onClick={onHide}
          >
            Login
          </Link>
        </li>
        <li style={{display: user.token ? 'none' : ''}}>
          <Link
            to={routes.ADMIN_REGISTER}
            className="nav-link"
            onClick={onHide}
          >
            Register
          </Link>
        </li>
        <li style={{display: user.token ? '' : 'none'}}>
          <Link
            to={routes.ADMIN_POSTS}
            className="nav-link"
            onClick={onHide}
          >
            Admin
          </Link>
        </li>
        <li style={{display: user.token ? '' : 'none'}}>
          <Link
            to={routes.ADMIN_LOGOUT}
            className="nav-link"
            onClick={onHide}
          >
            Logout
          </Link>
        </li>
      </ul>
    </nav>
  );
}

export default connect(
  state => ({ user: state.user })
)(Nav);
