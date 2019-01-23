import React from 'react';
import moment from 'moment';

import PostComment from 'components/Post/Comment';

import './Post.scss';

const Post = ({ post }) => {
  let { comments = [] } = post;

  return (
    <div className="post">
      <div className="post-image" style={{backgroundImage: `url(${post.image})`}}></div>
      <div className="post-info">
        <h1 className="post-title">{post.title}</h1>
        <time className="post-date" dateTime={post.date}>{moment(post.date).format('DD MMM, YYYY')}</time>
        <p className="post-content">
          {post.content}
        </p>
      </div>
      <div className="post-comments">
        {
          comments.map((comment, i) => (
            <PostComment
              comment={comment}
              key= {i}
            />
          ))
        }
        <div className="post-comment-reply">
          <p className="post-comment-reply-title">New Comment</p>
          <textarea
            className="post-comment-reply-text"
            rows="3"
          ></textarea>
          <button className="post-comment-send-button">Send</button>
          <div style={{clear: 'both'}}></div>
        </div>
      </div>
    </div>
  );
}

export default Post;
