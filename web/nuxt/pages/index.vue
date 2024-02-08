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
    // Inicializar la conexión con el servidor de Socket.IO
    this.socket = io('http://localhost:3123');

    // Escuchar eventos del servidor
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
