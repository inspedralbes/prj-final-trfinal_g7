<!-- pages/index.vue -->

<template>
   <div class="container">
    <h1 class="title">{{ pageTitle }}</h1>

    <div class="navigation-links">
      <router-link class="link" to="/Login">Login</router-link>
      <router-link class="link" to="/Admin">Admin</router-link>
    </div>

    <router-view></router-view>
  </div>
</template>

<script>
export default {
  data() {
    return {
      pageTitle: 'Mi Página con Vue y Nuxt',
    };
  },
  methods: {
    redirectToLogin() {
      // Redirige a la ruta '/components/Login'
      this.$router.push('/components/Login');
    },
    register() {
      alert('Botón de Registro presionado');
      // Agrega la lógica de redirección o cualquier otra acción necesaria
    },
    admin() {
      alert('Botón de Admin presionado');
      // Agrega la lógica de redirección o cualquier otra acción necesaria
    },
  },
};
</script>

<style scoped>
.container {
  margin: 0 auto;
  max-width: 800px;
  padding: 2rem;
  text-align: center;
}

.title {
  color: #2c3e50;
  font-size: 2em;
  margin-bottom: 2rem;
}

.navigation-links {
  display: flex;
  justify-content: center;
  margin-bottom: 1rem;
}

.link {
  color: #3498db;
  text-decoration: none;
  margin: 0 1rem;
  font-size: 1.2em;
}

.link:hover {
  text-decoration: underline;
}
</style>