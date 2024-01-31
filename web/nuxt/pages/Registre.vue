<!-- components/Register.vue -->

<template>
    <div>
      <h2>Registro</h2>

        <label for="username">Nombre:</label>
        <input type="text" id="username" v-model="username" required>

        <label for="correo">Correo:</label>
        <input type="text" id="correo" v-model="correo" required>
    
        <label for="password">Contraseña:</label>
        <input type="password" id="password" v-model="password" required>
  
        <button @click="register">Registrarse</button>

    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        username: '',
        password: '',
        correo: '',
      };
    },
    methods: {
      register() {
        // Puedes agregar lógica de registro aquí
        // Por ahora, simplemente redireccionamos a la página App
        this.$router.push('/app');
      },
    },
  };
  </script>
  
  <style scoped>
  /* Agrega estilos según tus preferencias */
  </style>
  