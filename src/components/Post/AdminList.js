import React from 'react';

import PostAdminCard from 'components/Post/AdminCard';

import './AdminList.scss';

const PostAdminList = ({ posts }) => (
  <ul className="post-admin-list">
    {
      posts.map((post) => (
        <li className="post-admin-list-item" key={post.id}>
          <PostAdminCard post={post} />
        </li>
      ))
    }
  </ul>
);

export default PostAdminList;
