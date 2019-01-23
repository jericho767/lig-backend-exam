import React, { Component } from 'react';
import { withRouter } from 'react-router';
import { compose } from 'recompose';
import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';

import Button from 'components/Button';
import Post from 'components/Post/Post';

import * as postActions from 'redux/modules/post';
import * as routes from 'utils/routes';
import './PostDetails.scss';

class PostDetails extends Component {

  componentDidMount() {
    let { match, getPost } = this.props;

    if (match.params.slug) {
      getPost(match.params.slug);
    }
  }

  render() {
    let { post } = this.props;

    if (!post.id) return null;

    return (
      <div className="post-details">
        <Post post={post} />
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
    state => ({ post: state.post }),
    dispatch => bindActionCreators(postActions, dispatch)
  ),
  withRouter
)(PostDetails);
