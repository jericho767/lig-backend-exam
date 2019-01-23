import React, { Component } from 'react';
import { withRouter } from 'react-router';
import { compose } from 'recompose';
import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';

import Button from 'components/Button';
import PostAdminForm from 'components/Post/AdminForm';

import * as postActions from 'redux/modules/post';
import * as routes from 'utils/routes';
import './AdminPostDetails.scss';


class AdminPostDetails extends Component {

  componentDidMount() {
    let { match, getPost } = this.props;

    if (match.params.slug !== 'new') {
      getPost(match.params.slug);
    }
  }

  submit(post) {
    let { createPost, updatePost, history, match } = this.props;

    if (match.params.slug === 'new') {
      createPost(post)
        .then((res) => {
          alert('Post successfully created!');
          history.push(routes.ADMIN_POSTS);
        });
    }
    else {
      updatePost(post)
        .then((res) => {
          alert('Post successfully updated!');
          history.push(routes.ADMIN_POSTS);
        });
    }
  }

  render() {
    let { post } = this.props;

    return (
      <div className="admin-post-details">
        <PostAdminForm
          post={post}
          onSubmit={(e) => { this.submit(e); }}
        />
        <Button
          className="admin-post-details-back"
          type="link"
          to={routes.ADMIN_POSTS}
        >
          Back
        </Button>
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
)(AdminPostDetails);
