import axios from 'axios';

import config from 'config';

const SET = 'lig/comments/SET';

const initialState = [
];

export default function reducer(state = initialState, action = {}) {
  switch(action.type) {
    case SET:
      return action.comments;
    default:
      return state;
  }
}

export function getComments(post) {
  return (dispatch) => {
    return axios({
      baseURL: config.api,
      url: '/posts/' + post.slug + '/comments',
      method: 'GET'
    })
    .then((res) => {
      dispatch(setComments(res.data.data));
    });
  };
}

export function sendComment(post, data) {
  return (dispatch) => {
    return axios({
      baseURL: config.api,
      url: '/posts/' + post.slug + '/comments',
      method: 'POST',
      headers: {
        Authorization: `Bearer ${localStorage.getItem('token')}`
      },
      data
    })
    .then((res) => {
      dispatch(getComments(post));
    });
  };
}

export function setComments(comments) {
  return {
    type: SET,
    comments
  };
}
