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
import io from 'socket.io-client';

export default {
  data() {
    return {
      pageTitle: 'Mi Página con Vue y Nuxt',
      socket: null,
      usuariosJuego: [],
    };
  },
  mounted() {
 
    this.socket = io('http://localhost:3123');


    this.socket.on('connect', () => {
      console.log('Conectado al servidor de Socket.io');
    });

    this.socket.on('peticion_jugar_aceptada', (datos) => {
      console.log('Petición de juego aceptada', datos);
    });

    this.socket.on('actualizacionUsuario', (usuarios) => {
      this.usuariosJuego = usuarios;
    });
  },
  methods: {
    redirectToLogin() {
   
      this.$router.push('/components/Login');
    },
    register() {
      alert('Botón de Registro presionado');
      
    },
    admin() {
      alert('Botón de Admin presionado');

    },
    peticionJugar() {
      const datos = {
        nombreUsuario: 'nombreUsuario',
        correo: 'correo',
        contrasenya: 'contrasenya',
      };
      this.socket.emit('peticion_jugar', datos);
    },
  },
};
</script>
<style scoped>
.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f2f2f2;
  font-family: Arial, sans-serif;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.title {
  font-size: 24px;
  color: #333;
  text-align: center;
  margin-bottom: 20px;
}

.navigation-links {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}

.link {
  color: #337ab7;
  text-decoration: none;
}

.link:hover {
  color: #225588;
}
</style>