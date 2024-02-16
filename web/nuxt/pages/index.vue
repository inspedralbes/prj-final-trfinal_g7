<template>
  <div class="container">
    <h1 class="title">{{ pageTitle }}</h1>

    <div class="navigation-links">
      <router-link class="link" to="/Login">Login</router-link>
      <router-link class="link" to="/Registre">Register</router-link>
      <router-link class="link" to="/Registre">Registre</router-link>
    </div>
    <router-view></router-view>
    <div class="options">
      
    </div>
  </div>
</template>

<script>
import io from 'socket.io-client';

export default {
  data() {
    return {
      pageTitle: 'SoundSync - Música en tiempo real',
      socket: null,
      usuariosJuego: [],
    };
  },
};
</script>

<style scoped>
.container {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  height: 100vh;
  font-family: Arial, sans-serif;
}

.title {
  font-size: 24px;
  color: #fdfdfd;
  text-align: center;
  margin-bottom: 20px;
}

.navigation-links {
  display: flex;
  flex-direction: column;
  width: 100%;
}

.link {
  display: flex;
  justify-content: center;
  align-items: center;
  color: #337ab7;
  text-decoration: none;
  background-color: #f2f2f2;
  height: 60px;
  margin: 10px 20%;
}

.link:hover {
  color: #225588;
}
</style>