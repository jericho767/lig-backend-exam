import React, { Component } from 'react';
import moment from 'moment';

import './Comment.scss';

class PostComment extends Component {
  state = {
    reply: false
  };

  render() {
    let { comment } = this.props;
    let { reply } = this.state;

    return (
      <div className="post-comment">
        <p className="post-comment-username">{comment.username}</p>
        <time
          className="post-comment-date"
          dateTime={comment.date}
        >
          {moment(comment.date).fromNow()}
        </time>
        <p className="post-comment-message">{comment.message}</p>
        <div>
          <button
            className="post-comment-reply-button"
            style={{display: reply ? 'none' : ''}}
            onClick={() => this.setState({ reply: true })}
          >
            Reply
          </button>
          <div
            className="post-comment-reply"
            style={{display: reply ? '' : 'none'}}
          >
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
}

export default PostComment;
