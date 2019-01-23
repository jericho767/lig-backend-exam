import React, { Component } from 'react';
import moment from 'moment';
import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';

import PostComment from 'components/Post/Comment';

import * as commentsActions from 'redux/modules/comments';

import './Post.scss';

class Post extends Component {

  state = {
    body: ''
  };

  render() {
    let { post, comments, sendComment } = this.props;
    let { body } = this.state;

    return (
      <div className="post">
        <div className="post-image" style={{backgroundImage: `url(${post.image})`}}></div>
        <div className="post-info">
          <h1 className="post-title">{post.title}</h1>
          <time className="post-date" dateTime={post.created_at}>{moment(post.created_at).format('DD MMM, YYYY')}</time>
          <p className="post-content">
            {post.content}
          </p>
        </div>
        <div className="post-comments">
          {
            comments.map((comment, i) => (
              <PostComment
                post={post}
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
              value={body}
              onChange={(e) => this.setState({ body: e.target.value })}
            ></textarea>
            <button
              type="button"
              className="post-comment-send-button"
              onClick={() => { this.setState({ body: ''}); sendComment(post, { body }); }}
            >
              Send
            </button>
            <div style={{clear: 'both'}}></div>
          </div>
        </div>
      </div>
    );
  }
}

export default connect(
  null,
  dispatch => bindActionCreators(commentsActions, dispatch)
)(Post);
