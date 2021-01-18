import dashboard from '../components/backend/dashboard/Dashboard';
import category from '../components/backend/category/category';
import createcategory from '../components/backend/category/CreateCategory';
import EditeCategory from '../components/backend/category/editecategory';
import Tag from '../components/backend/tag/tag';
import CreateTag from '../components/backend/tag/create';
import UpdateTag from '../components/backend/tag/update';
export const routes = [

          {path: '/dashboard', component: dashboard },
          {path: '/category', component: category },
          { path: '/createcategory', component: createcategory },
          {path: '/editecategory/:slug', component: EditeCategory}

];
