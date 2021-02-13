import React from 'react';
import { withRouter } from 'react-router';
import { Link } from 'react-router-dom';

import HeaderMenu from 'components/Header/Menu';
import * as routes from 'utils/routes';

import logo from 'assets/images/logo.png';
import adminLogo from 'assets/images/admin-logo.png';
import './Header.scss';

const Header = ({ isMenuToggle, onMenuToggle }) => {
  let isAdmin = window.location.href.includes('/admin');

  return (
    <header className={`header ${isAdmin ? 'is-admin' : ''}`}>
      <Link to={routes.INDEX}>
        <img
          src={isAdmin ? adminLogo : logo}
          alt="Blog"
        />
      </Link>
      <HeaderMenu isToggle={isMenuToggle} onToggle={onMenuToggle} />
    </header>
  );
}

export default withRouter(Header);
