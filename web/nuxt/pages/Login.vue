<!-- components/Login.vue -->

<template>
  <div class="login-container">
    <h2 class="login-title">Iniciar sesión</h2>
    <form @submit.prevent="login" class="login-form">
      <label for="login-email" class="login-label">Correo electrónico:</label>
      <input id="login-email" v-model="loginForm.email" type="email" required class="login-input">

      <label for="login-password" class="login-label">Contraseña:</label>
      <input id="login-password" v-model="loginForm.password" type="password" required class="login-input">

      <button type="submit" class="login-button">Iniciar sesión</button>
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
.login-container {
  width: 100%;
  max-width: 400px;
  margin: 0 auto;
  padding: 1rem;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  border-radius: 4px;
  margin-top: 15%;
}

.login-title {
  text-align: center;
  margin-bottom: 2rem;
}

.login-form {
  display: flex;
  flex-direction: column;
}

.login-label {
  margin-bottom: 0.5rem;
}

.login-input {
  margin-bottom: 1rem;
  padding: 0.5rem;
  border: 1px solid #ddd;
  border-radius: 4px;
}

.login-button {
  padding: 0.5rem;
  color: #fff;
  background-color: #007bff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.login-button:hover {
  background-color: #0056b3;
}
</style>