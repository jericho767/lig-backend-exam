import React from 'react';

import Button from 'components/Button'
import RegisterForm from 'components/Register/Form';

import * as routes from 'utils/routes';

import './Register.scss';

const Register = () => (
  <div className="register">
    <RegisterForm />
    <Button type="link" to={routes.ADMIN_LOGIN}>
      Back
    </Button>
  </div>
);

export default Register;
