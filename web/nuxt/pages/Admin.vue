<!-- components/Login.vue -->

<template>
  <div>
    <h2>Login</h2>

    <label for="username">Nombre:</label>
    <input type="text" id="username" v-model="username" required>
    <label for="password">Contraseña:</label>
    <input type="password" id="password" v-model="password" required>
    <button @click="login">Entrar</button>
    
    <input v-model="nuevaCancion.nombre" type="text" placeholder="Nombre de la canción" required>
    <input v-model="nuevaCancion.grupo" type="text" placeholder="Nombre del grupo" required>
    <input v-model="nuevaCancion.url" type="text" placeholder="URL de la canción" required>
    <button @click="agregarCancion()">Añadir Cancion</button>



  </div>
</template>
  
<script>
export default {
  data() {
    return {
      username: '',
      password: '',
      nuevaCancion: {
      nombre: '',
      grupo: '',
      url: ''
    },
    };
  },
  methods: {
    login() {
      // Puedes agregar lógica de autenticación aquí
      // Por ahora, simplemente redireccionamos a la página App
      this.$router.push('/app');
    },
    async eliminarCancion(idCancion) {
      try {
        const response = await fetch(`${this.ruta}/api/eliminar-cancion/${idCancion}`, {
          method: 'DELETE'
        });

        if (!response.ok) {
          throw new Error(`Error en la solicitud: ${response.status}`);
        }

        const data = await response.json();
        //this.canciones = this.canciones.filter(cancion => cancion.id !== idCancion);
        console.log(data.message);

        console.log("Canción eliminada");
      } catch (error) {
        console.error('Error al eliminar la canción:', error);
        throw error;
      }
    },
    async agregarCancion(nuevaCancion) {
      try {
        const response = await fetch(`${this.ruta}/api/agregar-cancion`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(nuevaCancion)
        });

        if (!response.ok) {
          throw new Error(`Error en la solicitud: ${response.status}`);
        }

        const data = await response.json();
        this.canciones.push(nuevaCancion);
        console.log(data.message);

        console.log("Canción agregada");
      } catch (error) {
        console.error('Error al agregar la canción:', error);
        throw error;
      }
    },

  },
};
</script>
  
<style scoped>
/* Agrega estilos según tus preferencias */
</style>
  