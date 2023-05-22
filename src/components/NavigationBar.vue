<template>
  <header class="navbar">
    <div class="navbar-logo">
      <!-- Insert your logo or brand name here -->
    </div>
    <div class="navbar-links">
      <a href="/" class="nav-link">Home</a>
      <a href="/create" class="nav-link">Criar</a>
      <a href="/list" class="nav-link">Listar</a>
    </div>
    <div class="navbar-account">
      <!-- Account-related links or user profile info -->
    </div>
  </header>
</template>

<script>
export default {
  name: 'NavigationBar',
  // Component logic and methods
}
</script>

<style>
.navbar {
  display: flex;
  align-items: center;
  background-color: #232f3e;
  color: #fff;
  padding: 10px 20px;
}

.navbar-logo {
  /* Style your logo or brand element */
}

.navbar-links {
  display: flex;
  gap: 20px;
}

.nav-link {
  color: inherit;
  text-decoration: none;
}

.navbar-account {
  /* Style account-related links or user profile info */
}
</style>
