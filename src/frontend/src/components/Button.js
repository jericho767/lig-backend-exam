import React from 'react';
import { Link } from 'react-router-dom';

import './Button.scss';

const Button = ({ children, type = 'submit', className, to, onClick }) => {
  if (type === 'link') {
    return (
      <Link
        className={`button ${className}`}
        to={to}
      >
        {children}
      </Link>
    );
  }
  else {
    return (
      <button
        className={`button ${className}`}
        type={type}
        onClick={onClick}
      >
        {children}
      </button>
    );
  }
};

export default Button;
