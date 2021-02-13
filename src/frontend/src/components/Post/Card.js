import React from 'react';
import { Link } from 'react-router-dom';
import moment from 'moment';

import * as routes from 'utils/routes';

import './Card.scss';

const PostCard = ({ post }) => (
  <article className="post-card">
    <Link
      className="post-card-link"
      to={routes.generate(routes.POST_DETAILS, post)}
    >
      <div className="post-card-image" style={{backgroundImage: `url(${post.image})`}}></div>
      <div className="post-card-info">
        <h2 className="post-card-title">{post.title}</h2>
        <time className="post-card-date" dateTime={post.date}>{moment(post.date).format('DD MMM, YYYY')}</time>
      </div>
    </Link>
  </article>
);

export default PostCard;
