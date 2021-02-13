import React from 'react';
import { Switch, Route } from 'react-router';

import Posts from 'screens/Posts';
import PostDetails from 'screens/PostDetails';
import Login from 'screens/Login';
import Register from 'screens/Register';
import AdminPosts from 'screens/AdminPosts';
import AdminPostDetails from 'screens/AdminPostDetails';

import * as routes from 'utils/routes';

const Pages = () => {
  return (
    <main>
      <Switch>
        <Route
          exact
          path={routes.INDEX}
          component={Posts}
        />
        <Route
          exact
          path={routes.POSTS}
          component={Posts}
        />
        <Route
          exact
          path={routes.POST_DETAILS}
          component={PostDetails}
        />
        <Route
          exact
          path={routes.ADMIN_LOGIN}
          component={Login}
        />
        <Route
          exact
          path={routes.ADMIN_REGISTER}
          component={Register}
        />
        <Route
          exact
          path={routes.ADMIN_POSTS}
          component={AdminPosts}
        />
        <Route
          exact
          path={routes.ADMIN_POST_DETAILS}
          component={AdminPostDetails}
        />
      </Switch>
    </main>
  );
};

export default Pages;
