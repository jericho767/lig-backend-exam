import React from 'react';

import './Menu.scss';

const HeaderMenu = ({ isToggle, onToggle }) => (
  <div
    className="header-menu"
    onClick={() => onToggle(!isToggle)}
  >
    <div className={`header-menu-button ${isToggle ? 'is-open' : ''}`}>
    </div>
  </div>
);

export default HeaderMenu;
