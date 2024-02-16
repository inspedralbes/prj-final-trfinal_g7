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
import { useCounterStore } from '@/stores/index.js'
export default {
  data() {
    return {
      username: '',
      password: '',
      loginForm: {
        email: '',
        password: '',
      },
      ruta: 'http://localhost:8000',
    };
  },
  methods: {
    async login() {
      const store = useCounterStore();
      try {
        const response = await fetch(`${this.ruta}/api/login`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(this.loginForm),
        });

        if (response.ok) {
          const data = await response.json();
          console.log('Usuario logeado');

        
          store.setToken(data.token);

         
          if (data.user.role === 'admin') {
            this.$router.push('/Admin');
          } else {
            this.$router.push('/ListaSemanal');
          }
        } else {
          console.log('Error al logear usuario');
        }
      } catch (error) {
        console.error('Error al iniciar sesión:', error);
      }
    },
  },
};
</script>

<style scoped>
.login-container {
  width: 100%;
  max-width: 500px;
  margin: 0 auto;
  padding: 2rem;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  border-radius: 5px;
  margin-top: 10%;
  background-color: #f2f2f2;
}

.login-title {
  text-align: center;
  margin-bottom: 2rem;
  font-size: 24px;
  color: #333;
}

.login-form {
  display: flex;
  flex-direction: column;
}

.login-label {
  margin-bottom: 0.5rem;
  font-size: 18px;
  color: #333;
}

.login-input {
  margin-bottom: 1rem;
  padding: 0.5rem;
  border: 1px solid #ddd;
  border-radius: 5px;
  font-size: 16px;
}

.login-button {
  padding: 0.5rem;
  color: #fff;
  background-color: #337ab7;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 18px;
  transition: background-color 0.3s ease;
}

.login-button:hover {
  background-color: #225588;
}
</style>