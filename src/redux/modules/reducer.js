import { combineReducers } from 'redux';

import user from './user';
import post from './post';
import posts from './posts';
import comments from './comments';

export default combineReducers({
  user,
  post,
  posts,
  comments
});
