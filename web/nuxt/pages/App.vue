<template>
  <div>
    <h2>¡Bienvenido, {{ username }}!</h2>
    <p>Has iniciado sesión correctamente.</p>
    <input type="text" v-model="filtro" placeholder="Buscar canción o artista">
    <ul>
      <li v-for="cancion in cancionesFiltradas" :key="cancion.id">
        <h2>{{ cancion.nombre }}</h2>
        <p>{{ cancion.artista }}</p>
        <div>
          <ul>
            <li class="categorias" v-for="categoria in cancion.categorias" :key="categoria.id">
              <nuxt-link :to="`/${categoria.id}`">
                {{ categoria.nombre }}
              </nuxt-link>
            </li>
          </ul>
        </div>
        <!-- <iframe width="200" height="115" :src="cancion.urlPlayer" title="YouTube video player" frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
          allowfullscreen></iframe> -->
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
      filtro: '',
      ruta: 'http://localhost:8000',
    };
  },
  computed: {
    cancionesFiltradas() {
      return this.canciones.filter(cancion =>
        cancion.nombre.toLowerCase().includes(this.filtro.toLowerCase()) ||
        cancion.artista.toLowerCase().includes(this.filtro.toLowerCase())
      );
    }
  },
  methods: {

    async mostrarCanciones() {
      try {
        const response = await fetch(`${this.ruta}/api/mostrar-canciones-con-categorias`, {
          method: 'GET',
        });

        if (!response.ok) {
          throw new Error(`Error en la solicitud: ${response.status}`);
        }

        const data = await response.json();
        this.canciones = data.canciones;
        console.log(data.message);
        console.log(this.canciones)
        console.log("Canciones mostradas");
      } catch (error) {
        console.error('Error al mostrar ocupantes:', error);
        throw error;
      }
    },
  },
  async created() {
    console.log("APP CREAR");
    try {
      await this.mostrarCanciones();
    } catch (error) {
      console.error('Error al obtener las canciones:', error);
    }
  },
};
</script>
    
<style scoped>
body {
  background-color: #f2f2f2
}

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

.categorias {
  display: inline;
  margin: 0 5px;
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #f2f2f2;
  color: #000;
  font-size: 12px;
  font-weight: bold;
  text-transform: uppercase;
  cursor: pointer;
  margin-left: 25%;
}
</style>