import React, { Component } from 'react';
import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';

import * as postsActions from 'redux/modules/posts';

import Button from 'components/Button';
import PostAdminList from 'components/Post/AdminList';

import * as routes from 'utils/routes';
import './AdminPosts.scss';

class AdminPosts extends Component {

  state = {
    page: 0
  };

  componentDidMount() {
    this.next();
  }

  next() {
    let { page } = this.state;

    page++;

    let { listPosts } = this.props;

    listPosts(page);

    this.setState({ page });
  }

  render() {
    let { posts } = this.props;

    return (
      <div className="admin-posts">
        <Button
          type="link"
          to={routes.generate(routes.ADMIN_POST_DETAILS, { slug: 'new'})}
        >
          New Article
        </Button>
        <PostAdminList posts={posts} />
      </div>
    );
  }
}

export default connect(
  state => ({ posts: state.posts }),
  dispatch => bindActionCreators(postsActions, dispatch)
)(AdminPosts);
