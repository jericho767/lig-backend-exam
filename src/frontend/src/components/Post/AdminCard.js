import React from 'react';
import moment from 'moment';
import { Link } from 'react-router-dom';

import * as routes from 'utils/routes';

import './AdminCard.scss';

const PostAdminCard = ({ post }) => (
  <article className="post-admin-card">
    <Link
      to={routes.generate(routes.ADMIN_POST_DETAILS, post)}
      className="post-admin-card-link"
    >
      <time className="post-admin-card-date" dateTime={post.date}>{moment(post.date).format('DD MMM, YYYY')}</time>
      <h2 className="post-admin-card-title">{post.title}</h2>
    </Link>
  </article>
);

export default PostAdminCard;
