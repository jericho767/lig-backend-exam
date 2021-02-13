import React from 'react';

import PostCard from 'components/Post/Card';

import './List.scss';

const PostList = ({ posts }) => (
  <ul className="post-list">
    {
      posts.map((post) => (
        <PostCard key={post.id} post={post} />
      ))
    }
  </ul>
);

export default PostList;
