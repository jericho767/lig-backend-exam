import axios from 'axios';

import config from 'config';

const SET = 'lig/post/SET';

const initialState = {
  id: 0,
  title: '',
  content: '',
  image: ''
};

export default function reducer(state = initialState, action = {}) {
  switch(action.type) {
    case SET:
      return action.post;
    default:
      return state;
  }
}

export function getPost(id) {
  return (dispatch) => {
    return axios({
      baseURL: config.api,
      url: '/posts/' + id,
      method: 'GET',
    })
    .then((res) => {
      dispatch(setPost(res.data.data));
    });
  };
}

export function createPost(data) {
  return (dispatch) => {
    return axios({
      baseURL: config.api,
      url: '/posts',
      method: 'POST',
      headers: {
        Authorization: `Bearer ${localStorage.getItem('token')}`
      },
      data
    })
    .then((res) => {
      return res.data;
    }, (err) => {
      return err;
    });
  };
}

export function updatePost(data) {
  return (dispatch) => {
    return axios({
      baseURL: config.api,
      url: '/posts/' + data.slug,
      method: 'PATCH',
      headers: {
        Authorization: `Bearer ${localStorage.getItem('token')}`
      },
      data
    })
    .then((res) => {
      dispatch(setPost(res.data.data));
      return res.data;
    }, (err) => {
      return err;
    });
  };
}

export function setPost(post) {
  return {
    type: SET,
    post
  };
}
