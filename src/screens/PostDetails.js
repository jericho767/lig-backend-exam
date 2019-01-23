import React, { Component } from 'react';
import { withRouter } from 'react-router';
import { compose } from 'recompose';
import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';

import Button from 'components/Button';
import Post from 'components/Post/Post';

import * as postActions from 'redux/modules/post';
import * as commentsActions from 'redux/modules/comments';
import * as routes from 'utils/routes';
import './PostDetails.scss';

class PostDetails extends Component {

  componentDidMount() {
    let { match, getPost, getComments } = this.props;

    if (match.params.slug) {
      getPost(match.params.slug)
        .then((post) => {
          getComments(post);
        });
    }
  }

  render() {
    let { post, comments } = this.props;

    if (!post.id) return null;

    return (
      <div className="post-details">
        <Post
          post={post}
          comments={comments}
        />
        <div className="post-details-top-button">
          <Button
            type="link"
            to={routes.INDEX}
          >
            TOP
          </Button>
        </div>
      </div>
    );
  }
}

export default compose(
  connect(
    state => ({ post: state.post, comments: state.comments }),
    dispatch => bindActionCreators({ ...postActions, ...commentsActions }, dispatch)
  ),
  withRouter
)(PostDetails);
