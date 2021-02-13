export const INDEX = '/';
export const POSTS = '/posts';
export const POST_DETAILS = '/posts/:slug';
export const ADMIN_LOGIN = '/admin/login';
export const ADMIN_REGISTER = '/admin/register';
export const ADMIN_POSTS = '/admin/posts';
export const ADMIN_POST_DETAILS = '/admin/posts/:slug';
export const ADMIN_LOGOUT = '/admin/logout';

export const generate = (route, params) => {
  let path = route.split('/');

  path.forEach((p, i) => {
    if (p.includes(':')) {
      p = p.replace(':', '');
      path[i] = params[p];
    }
  });

  return path.join('/');
};
