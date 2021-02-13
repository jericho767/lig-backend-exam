import React, { Component } from 'react';
import { compose } from 'recompose';
import { withRouter } from 'react-router';
import { bindActionCreators } from 'redux';
import { connect } from 'react-redux';

import * as userActions from 'redux/modules/user';
import * as routes from 'utils/routes';

import './Form.scss';

class LoginForm extends Component {

  state = {
    email: '',
    password: '',
    error: ''
  };

  login(e) {
    let { login, history } = this.props;
    let { email, password } = this.state;

    login(email, password).then((res) => {
      if (res.token) {
        this.setState({ error: '' });
        history.push(routes.ADMIN_POSTS);
      }
      else {
        this.setState({ error: res });
      }
    });

    e.preventDefault();
    return false;
  }

  render() {
    let { error } = this.state;

    return (
      <form className="login-form" onSubmit={(e) => { this.login(e); }}>
        <label className="login-form-label">USER ID</label>
        <input
          className="login-form-text"
          type="text"
          onChange={(e) => { this.setState({ email: e.target.value }) }}
        />
        <label className="login-form-label">PASSWORD</label>
        <input
          className="login-form-text"
          type="password"
          onChange={(e) => { this.setState({ password: e.target.value }) }}
        />
        <button className="button login-form-button">Login</button>
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
)(LoginForm);
