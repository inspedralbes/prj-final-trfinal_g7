<!-- pages/index.vue -->

<template>
  <div class="container">
    <h1 class="title">{{ pageTitle }}</h1>
   
    <router-link class="link" to="/Login">Login</router-link>
    <router-link class="link" to="/Admin">Admin</router-link>

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
  padding: 0 2rem;
}

.title {
  color: #2c3e50;
  font-size: 2em;
  text-align: center;
  margin-bottom: 2rem;
}

.link {
  display: block;
  color: #3498db;
  text-decoration: none;
  margin-bottom: 1rem;
}
</style>