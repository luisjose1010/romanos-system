import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '@/views/Home.vue';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
  },
  {
    path: '/clientes',
    name: 'Clients',
    component: () => import(/* webpackChunkName: "clients" */ '../views/Clients.vue'),
  },
  {
    path: '/clientes/:id',
    name: 'Sale',
    component: () => import(/* webpackChunkName: "client" */ '../views/Client.vue'),
  },
  {
    path: '/vender',
    name: 'Sell',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "sell" */ '../views/Sell.vue'),
  },
  {
    path: '/ventas',
    name: 'Sales',
    component: () => import(/* webpackChunkName: "sales" */ '../views/Sales.vue'),
  },
  {
    path: '/ventas/:id',
    name: 'Sale',
    component: () => import(/* webpackChunkName: "sale" */ '../views/Sale.vue'),
  },
];

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes,
});

export default router;
