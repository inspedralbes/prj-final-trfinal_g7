<!-- components/Login.vue -->

<template>
  <div>
    <h2>Iniciar sesión</h2>
    <form @submit.prevent="login">
      <label for="login-email">Correo electrónico:</label>
      <input id="login-email" v-model="loginForm.email" type="email" required>

      <label for="login-password">Contraseña:</label>
      <input id="login-password" v-model="loginForm.password" type="password" required>

      <button type="submit">Iniciar sesión</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      username: '',
      password: '',
      loginForm: {
        email: '',
        password: '',
      }
    };
  },
  methods: {
    async login() {
      const response = await fetch(`${this.ruta}/api/login`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(this.loginForm),
      });
      if (response.ok) {
       console.log('Usuario logeado');
      } else {
      console.log('Error al logear usuario');
      }
      this.$router.push('/app');
    },
  },
};
</script>

<style scoped>
/* Agrega estilos según tus preferencias */
</style>
