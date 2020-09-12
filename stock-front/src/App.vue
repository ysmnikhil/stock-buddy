<template>
  <div id="app">
    <app-navbar>
      <router-view/>
    </app-navbar>
  </div>
</template>

<script>
import stockVueData from './data.js';
import AppNavbar from './components/Navbar';

window.stockVueData = window.stockVueData || stockVueData;

export default {
  components: {
    AppNavbar,
  },
  name: 'App',
};
</script>
