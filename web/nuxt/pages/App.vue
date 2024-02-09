<template>
  <div>
    <h2>¡Bienvenido, {{ username }}!</h2>
    <p>Has iniciado sesión correctamente.</p>
    <input type="text" v-model="filtro" placeholder="Buscar canción o artista">
    <nuxt-link :to="`/prova`">Votaciones Abiertas</nuxt-link>

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
        <iframe width="200" height="115" :src="cancion.urlPlayer" title="YouTube video player" frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
          allowfullscreen></iframe> 
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
      categorias: [],
      categoriaSeleccionada: '',

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
    async mostrarCategorias() {
      try {
        const response = await fetch(`${this.ruta}/api/mostrar-categorias`, {
          method: 'GET',
        });

        if (!response.ok) {
          throw new Error(`Error en la solicitud: ${response.status}`);
        }

        const data = await response.json();
        this.categorias = data.categorias;
        console.log(data.message);
        console.log(this.categorias)
        console.log("Categorías mostradas");
      } catch (error) {
        console.error('Error al mostrar categorías:', error);
        throw error;
      }
    },
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
  background-color: #f2f2f2;
  font-family: Arial, sans-serif;
}

div {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}

h2 {
  font-size: 24px;
  color: #333;
  margin-bottom: 10px;
}

p {
  font-size: 16px;
  color: #666;
  margin-bottom: 20px;
}

input[type="text"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-bottom: 20px;
}

nuxt-link {
  display: inline-block;
  padding: 10px 20px;
  background-color: #337ab7;
  color: #fff;
  text-decoration: none;
  border-radius: 5px;
  margin-bottom: 20px;
}

ul {
  list-style: none;
  padding: 0;
}

li {
  background-color: #d2c4ff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  margin-bottom: 20px;
}

.categorias {
  display: inline-block;
  margin-right: 10px;
  padding: 5px 10px;
  background-color: #eee;
  border-radius: 5px;
  font-size: 14px;
  text-transform: uppercase;
  color: #333;
}
</style>