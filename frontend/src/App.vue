<template>
  <div>
    <nav class="navbar">
      <button class="menu-toggle" @click="toggleMenu">
        <span v-if="!isMenuOpen">☰</span>
        <span v-else>✕</span>
      </button>
      <ul :class="['nav-links', isMenuOpen ? 'open' : '']">
        <li><router-link to="/competitions">COMPETENCIAS</router-link></li>
        <li><router-link to="/teams">EQUIPOS</router-link></li>
        <li><router-link to="/players/44">JUGADORES</router-link></li>
      </ul>
    </nav>
    <div class="head-nav"></div>
    <router-view />
  </div>
</template>

<script>
export default {
  name: "App",
  data() {
    return {
      isMenuOpen: false,
    };
  },
  methods: {
    toggleMenu() {
      this.isMenuOpen = !this.isMenuOpen;
    },
  },
};
</script>

<style scoped>

</style>
