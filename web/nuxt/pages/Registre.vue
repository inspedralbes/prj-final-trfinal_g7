<template>
  <div>
    <div class="form-container">

    
    <h2>Registro</h2>
    <form @submit.prevent="register">
      <label for="register-name">Nombre:</label>
      <input id="register-name" v-model="registerForm.name" type="text" required>

      <label for="register-email">Correo electrónico:</label>
      <input id="register-email" v-model="registerForm.email" type="email" required>

      <label for="register-password">Contraseña:</label>
      <input id="register-password" v-model="registerForm.password" type="password" required>

      <button type="submit">Registrar</button>
    </form>
  </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      registerForm: {
        name: '',
        email: '',
        password: '',
        role: 'user'
      },
      loginForm: {
        email: '',
        password: '',
      },
      ruta: 'http://trfinal.a17danvicfer.daw.inspedralbes.cat/output/laravel/public',
    };
  },
  methods: {
    async register() {
      const response = await fetch(`${this.ruta}/api/register`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(this.registerForm),
        credentials: "include",
      });

      if (response.ok) {
        console.log('Usuario registrado');
      } else {
        console.log('Error al registrar usuario');
      }
      this.$router.push('/login');
    },
  },
};
</script>
<style scoped>
.form-container {
  width: 100%;
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
}


form {
  background-color: #f8f8f8;
  padding: 20px;
  border-radius: 8px;
  margin-bottom: 20px;
}


label {
  display: block;
  margin-bottom: 5px;
}


input {
  width: 100%;
  padding: 10px;
  border-radius: 4px;
  border: 1px solid #ccc;
  margin-bottom: 20px;
}


button {
  padding: 10px 20px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}


button:hover {
  background-color: #0056b3;
}
</style>
