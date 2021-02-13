import React, { Component } from 'react';
import moment from 'moment';
import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';

import * as commentsActions from 'redux/modules/comments';

import './Comment.scss';

class PostComment extends Component {
  state = {
    reply: false,
    body: ''
  };

  sendComment() {
    let { body } = this.state;
  }

  render() {
    let { comment, post } = this.props;
    let { reply, body } = this.state;

    return (
      <div className="post-comment">
        <time
          className="post-comment-date"
          dateTime={comment.created_at}
        >
          {moment(comment.created_at).fromNow()}
        </time>
        <p className="post-comment-message">{comment.body}</p>
        <div>
          <button
            className="post-comment-reply-button"
            style={{display: reply ? 'none' : 'none'}}
            onClick={() => this.setState({ reply: true })}
          >
            Reply
          </button>
          <div
            className="post-comment-reply"
            style={{display: reply ? 'none' : 'none'}}
          >
            <textarea
              className="post-comment-reply-text"
              rows="3"
              value={body}
              onChange={(e) => this.setState({ body: e.target.value }) }
            ></textarea>
            <button
              className="post-comment-send-button"
              onClick={() => { this.sendComment(); }}
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

export default PostComment;
