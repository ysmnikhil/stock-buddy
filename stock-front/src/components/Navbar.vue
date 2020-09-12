<template>
  <div class="navbar">
    <vs-navbar shadow center-collapsed v-model="active">
      <template #left>
        <vs-button @click="activeSidebar = false; activeSidebar = true" flat icon>
          <i class='bx bx-menu'></i>
        </vs-button>
        <p class="heading">Stock Buddy</p>
      </template>
      <!--
      <vs-navbar-item :active="active === 'home'" id="home">
        Home
      </vs-navbar-item> -->
    </vs-navbar>
    <div class="table">
      <slot></slot>
    </div>
    <app-sidebar
      :activeSidebar="activeSidebar"
    ></app-sidebar>
  </div>
</template>
<script>
import AppSidebar from "./Sidebar";

export default {
  components: {
    AppSidebar,
  },
  data:() => ({
    activeSidebar: false,
    active: 'home',
    color: '#10b0b4'
  })
}
</script>

