<!-- components/Login.vue -->

<template>
    <div>
      <h2>Login</h2>
  
        <label for="username">Nombre:</label>
        <input type="text" id="username" v-model="username" required>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" v-model="password" required>
        <button @click="login">Entrar</button>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        username: '',
        password: '',
      };
    },
    methods: {
      login() {
        // Puedes agregar lógica de autenticación aquí
        // Por ahora, simplemente redireccionamos a la página App
        this.$router.push('/app');
      },
    },
  };
  </script>
  
  <style scoped>
  /* Agrega estilos según tus preferencias */
  </style>
  