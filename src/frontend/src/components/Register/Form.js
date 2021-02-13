import React, { Component } from 'react';
import { compose } from 'recompose';
import { withRouter } from 'react-router';
import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';

import * as userActions from 'redux/modules/user';
import * as routes from 'utils/routes';

import './Form.scss';

class RegisterForm extends Component {

  state = {
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
  };

  submit(e) {
    e.preventDefault();

    let { register, history } = this.props;

    register(this.state)
      .then((res) => {
        if (res.id) {
          this.setState({ error: '' });
          alert('Registration successful!');
          history.push(routes.ADMIN_LOGIN);
        }
        else {
          this.setState({ error: res })
        }
      });

    return false;
  }

  render() {
    let { error } = this.state;

    return (
      <form
        className="register-form"
        onSubmit={(e) => { this.submit(e); }}
      >
        <label className="register-form-label">Name</label>
        <input
          className="register-form-text"
          type="text"
          onChange={(e) => { this.setState({ name: e.target.value }); }}
        />
        <label className="register-form-label">Email</label>
        <input
          className="register-form-text"
          type="email"
          onChange={(e) => { this.setState({ email: e.target.value }); }}
        />
        <label className="register-form-label">Password</label>
        <input
          className="register-form-text"
          type="password"
          onChange={(e) => { this.setState({ password: e.target.value }); }}
        />
        <label className="register-form-label">Confirm Password</label>
        <input
          className="register-form-text"
          type="password"
          onChange={(e) => { this.setState({ password_confirmation: e.target.value }); }}
        />
        <button
          className="register-form-button button"
        >
          Register
        </button>
        <span
          className="login-form-error"
          style={{display: error ? '' : 'none'}}
        >
          {error}
        </span>
      </form>
    );
  }
}

export default compose(
  connect(
    null,
    dispatch => bindActionCreators(userActions, dispatch)
  ),
  withRouter
)(RegisterForm);
