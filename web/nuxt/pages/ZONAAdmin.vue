<!-- components/Login.vue -->

<template>
  <div>
    <input type="text" v-model="filtro" placeholder="Buscar canción o artista">
    <ul>
      <li v-for="cancion in cancionesFiltradas" :key="cancion.id">
        <h2>{{ cancion.nombre }}</h2>
        <p>{{ cancion.artista }}</p>
        <a :href="cancion.url">Escuchar</a>
        <button @click="eliminarCancion(cancion.id)">Eliminar Cancion</button>
      </li>
    </ul>
    <h1>Añadir cancion</h1>
    <input v-model="nuevaCancion.nombre" type="text" placeholder="Nombre de la canción" required>
    <input v-model="nuevaCancion.artista" type="text" placeholder="Nombre del grupo" required>
    <input v-model="nuevaCancion.url" type="text" placeholder="URL de la canción" required>
    <button @click="agregarCancion()">Añadir Cancion</button>

    <button @click="irCategorias()">categories</button>
    <button @click="eliminarCancion()">eliminar cancion</button>



  </div>
</template>
  
<script>
export default {
  data() {
    return {
      canciones: [],
      filtro: '',
      nuevaCancion: {
        nombre: '',
        artista: '',
        url: '',
        ruta: 'http://localhost:8000',
      },
    };

  },
  
  computed: {
    cancionesFiltradas() {
      return this.canciones.filter(cancion =>
        cancion.nombre.toLowerCase().includes(this.filtro.toLowerCase()) ||
        cancion.artista.toLowerCase().includes(this.filtro.toLowerCase())
      );
    },
  },
  methods: {
    async mostrarCanciones() {
      try {
        const response = await fetch(`http://localhost:8000/api/mostrar-canciones`, {
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
    irCategorias() {
      // Puedes agregar lógica de autenticación aquí
      // Por ahora, simplemente redireccionamos a la página App
      this.$router.push('/categorias');
    },
    async eliminarCancion(idCancion) {
      try {
        const response = await fetch(`http://localhost:8000/api/eliminar-cancion/${idCancion}`, {
          method: 'DELETE'
        });

        if (!response.ok) {
          throw new Error(`Error en la solicitud: ${response.status}`);
        }

        const data = await response.json();
        //this.canciones = this.canciones.filter(cancion => cancion.id !== idCancion);
        console.log(data.message);

        console.log("Canción eliminada");
        this.mostrarCanciones()
      } catch (error) {
        console.error('Error al eliminar la canción:', error);
        throw error;
      }
    },
    async agregarCancion(nuevaCancion) {
      try {
        const response = await fetch(`http://localhost:8000/api/crear-cancion`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(this.nuevaCancion)
        });

        if (!response.ok) {
          throw new Error(`Error en la solicitud: ${response.status}`);
        }

        const data = await response.json();
        this.canciones.push(nuevaCancion);
        console.log(data.message);

        console.log("Canción agregada");
        this.mostrarCanciones()
      } catch (error) {
        console.error('Error al agregar la canción:', error);
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
/* Agrega estilos según tus preferencias */
</style>
  