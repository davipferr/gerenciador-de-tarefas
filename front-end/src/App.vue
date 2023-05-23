<template>
  <div>
    <NavigationBar/>
    <div id="app">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import NavigationBar from '../src/components/NavigationBar.vue';

export default {
  name: 'App',
  components: {
    NavigationBar
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
