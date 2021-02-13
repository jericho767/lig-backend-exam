import React, { Component } from 'react';
import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';

import * as postsActions from 'redux/modules/posts';

import Button from 'components/Button';
import PostList from 'components/Post/List';

import './Posts.scss';

class Posts extends Component {

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
    let { page } = this.state;
    let { posts } = this.props;

    return (
      <div className="posts">
        <PostList page={page} posts={posts} />
        <Button
          type="button"
          className="posts-more-button"
          onClick={() => { this.next(); }}
        >
          More
        </Button>
      </div>
    );
  }
}

export default connect(
  state => ({ posts: state.posts }),
  dispatch => bindActionCreators(postsActions, dispatch)
)(Posts);
