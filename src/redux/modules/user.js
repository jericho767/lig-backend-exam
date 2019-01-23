import axios from 'axios';

import config from 'config';

const SET = 'lig/user/SET';

const initialState = {
  id: '',
  name: '',
  email: '',
  token: ''
};

export default function reducer(state = initialState, action = {}) {
  switch(action.type) {
    case SET:
      return action.user;
    default:
      return state;
  }
}

export function login(email, password) {
  return (dispatch) => {
    return axios({
      baseURL: config.api,
      url: '/login',
      method: 'POST',
      data: {
        email: email,
        password: password
      }
    })
    .then((res) => {
      localStorage.setItem('token', res.data.token);
      dispatch(setUser(res.data));
      return res.data;
    }, (err) => {
      let res = err.response.data;

      return Object.keys(res.errors)
        .map((k) => {
          return res.errors[k].join('');;
        })
        .join('');
    });
  };
}

export function register(data) {
  return (dispatch) => {
    return axios({
      baseURL: config.api,
      url: '/register',
      method: 'POST',
      data
    })
    .then((res) => {
      return res.data
    }, (err) => {
      let res = err.response.data;

      return Object.keys(res.errors)
        .map((k) => {
          return res.errors[k].join('');;
        })
        .join('');
    });
  };
}

export function setUser(user) {
  return {
    type: SET,
    user
  };
}
