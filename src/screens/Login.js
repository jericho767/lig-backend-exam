import React from 'react';

import Button from 'components/Button';
import LoginForm from 'components/Login/Form';

import * as routes from 'utils/routes';

import './Login.scss';

const Login = () => (
  <div className="login">
    <LoginForm />
    <Button
      type="link"
      to={routes.ADMIN_REGISTER}
    >
      Register
    </Button>
  </div>
);

export default Login;
