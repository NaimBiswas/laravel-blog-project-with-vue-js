import dashboard from '../components/backend/dashboard/Dashboard';
import category from '../components/backend/category/category';
import createcategory from '../components/backend/category/CreateCategory';
export const routes = [

          {path: '/dashboard', component: dashboard },
          {path: '/category', component: category },
          {path: '/createcategory', component: createcategory },

];
