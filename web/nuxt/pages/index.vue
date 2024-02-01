<!-- pages/index.vue -->

<template>
  <div>
    <h1>{{ pageTitle }}</h1>
    <router-link to="/Registre">Registro</router-link>
    <router-link to="/Login">Login</router-link>
    <router-link to="/Admin">Admin</router-link>

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