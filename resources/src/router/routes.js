import Home from '@/views/Home.vue';

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
  },
  {
    path: '/clientes',
    name: 'Clients',
    component: () => import(/* webpackChunkName: "clients" */ '@/views/Clients.vue'),
  },
  {
    path: '/clientes/:id',
    name: 'Client',
    component: () => import(/* webpackChunkName: "client" */ '@/views/Client.vue'),
  },
  {
    path: '/clientes/editar',
    name: 'ClientSearch',
    component: () => import(/* webpackChunkName: "clientSearch" */ '@/views/Client.vue'),
  },
  {
    path: '/vender',
    name: 'Sell',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "sell" */ '@/views/Sell.vue'),
  },
  {
    path: '/ventas',
    name: 'Sales',
    component: () => import(/* webpackChunkName: "sales" */ '@/views/Sales.vue'),
  },
  {
    path: '/ventas/:id',
    name: 'Sale',
    component: () => import(/* webpackChunkName: "sale" */ '@/views/Sale.vue'),
  },
  {
    path: '/usuarios',
    name: 'Users',
    component: () => import(/* webpackChunkName: "users" */ '@/views/Users.vue'),
  },
  {
    path: '/usuarios/:id',
    name: 'User',
    component: () => import(/* webpackChunkName: "user" */ '@/views/User.vue'),
  },
  {
    path: '/registrar-usuario',
    name: 'register-user',
    component: () => import(/* webpackChunkName: "user" */ '@/views/RegisterUser.vue'),
  },
  {
    path: '/copia-de-seguridad',
    name: 'Backup',
    component: () => import(/* webpackChunkName: "user" */ '@/views/Backup.vue'),
  },
  {
    path: '/logout',
    name: 'Logout',
    component: () => {
      localStorage.removeItem('user');
      window.location = '/';
    },
  },
];

export default routes