import axios from 'axios';

import config from 'config';

const SET = 'lig/posts/SET';

const initialState = [ ];

export default function reducer(state = initialState, action = {}) {
  switch(action.type) {
    case SET:
      return action.posts;
    default:
      return state;
  }
}

export function listPosts(page = 1) {
  return (dispatch) => {
    axios({
      baseURL: config.api,
      url: '/posts',
      method: 'GET',
      params: {
        page
      }
    })
    .then((res) => {
      dispatch(setPosts(res.data.data));
    });
  };
}

export function setPosts(posts) {
  return {
    type: SET,
    posts
  };
}
