import Vue from 'vue';
import Router from 'vue-router';
import StockList from '@/components/StockList';

Vue.use(Router);

export default new Router({
  routes: [
    {
      path: '/',
      name: 'StockList',
      component: StockList,
    },
  ],
});
