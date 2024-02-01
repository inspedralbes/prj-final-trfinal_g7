<!-- components/App.vue -->
<template>
  <div>
    <h2>¡Bienvenido, {{ username }}!</h2>
    <p>Has iniciado sesión correctamente.</p>
    <ul>
      <li v-for="cancion in canciones" :key="cancion.id">
        <h2>{{ cancion.nombre }}</h2>
        <p>{{ cancion.artista }}</p>
        <a :href="cancion.url">Escuchar</a>
      </li>
    </ul>
  </div>
</template>
  
<script>
export default {
  props: ['username'],
  data() {
    return {
      canciones: [],
      ruta: 'http://localhost:8000',
    };

  },
  methods: {
    async mostrarCanciones() {
      try {

        const response = await fetch(`${this.ruta}/api/mostrar-canciones`, {
          method: 'GET',
        });

        if (!response.ok) {
          throw new Error(`Error en la solicitud: ${response.status}`);
        }

        const data = await response.json();
        this.canciones = data.canciones;
        console.log(data.message);

        console.log("Canciones mostradas");
      } catch (error) {
        console.error('Error al mostrar ocupantes:', error);
        throw error;
      }
    },
  },
  async created() {
    try {
      await this.mostrarCanciones();
    } catch (error) {
      console.error('Error al obtener las canciones:', error);
    }
  },
};
</script>
    
<style scoped>
ul {
  list-style-type: none;
  padding: 0;
}

li {
  margin: 10px 0;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

h2 {
  margin: 0 0 5px;
}

p {
  margin: 0 0 10px;
}

a {
  color: #337ab7;
  text-decoration: none;
}
</style>
  

  