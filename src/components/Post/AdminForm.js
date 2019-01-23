import React, { Component } from 'react';

import Button from 'components/Button';

import './AdminForm.scss';

class PostAdminForm extends Component {

  state = {
    image: this.props.post.image,
    title: this.props.post.title,
    content: this.props.post.content
  };

  componentWillReceiveProps(nextProps) {
    this.setState(nextProps.post);
  }

  render() {
    let { onSubmit } = this.props;
    let post = this.state;

    return (
      <form
        className="post-admin-form"
        onSubmit={(e) => { e.preventDefault(); onSubmit(this.state); }}
      >
        <label className="post-admin-form-label">IMAGE</label>
        <input
          className="post-admin-form-text"
          type="text"
          value={post.image}
          onChange={(e) => this.setState({ image: e.target.value })}
        />
        <label className="post-admin-form-label">TITLE</label>
        <input
          className="post-admin-form-text"
          type="text"
          value={post.title}
          onChange={(e) => this.setState({ title: e.target.value })}
        />
        <label className="post-admin-form-label">CONTENT</label>
        <textarea
          rows="10"
          className="post-admin-form-text"
          value={post.content}
          onChange={(e) => this.setState({ content: e.target.value })}
        >
        </textarea>
        <Button>Submit</Button>
      </form>
    );
  }
}

export default PostAdminForm;
