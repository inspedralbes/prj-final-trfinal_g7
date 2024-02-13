<template>
  <div>
    <h1>ID: {{ $route.params.id }}</h1>
    
    <ul v-if="canciones.length">
      <li v-for="cancion in canciones" :key="cancion.id">
        <h2>{{ cancion.nombre }}</h2>
        <p>{{ cancion.artista }}</p>
        <iframe width="200" height="115" :src="cancion.urlPlayer" title="YouTube video player" frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
          allowfullscreen></iframe>
      </li>
    </ul>
    <p v-else>No hay canciones disponibles</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      canciones: [],
      categoria: null,
      votaciones: [],
    };
  },
  created() {
    this.loadData();
  },
  methods: {
    async loadData() {
      const id = this.$route.params.id;
      const ruta = 'http://localhost:8000';
      try {
        const responseCanciones = await fetch(`${ruta}/api/lista_canciones_categoria/${id}`);
        const responseCategoria = await fetch(`${ruta}/api/categoria_por_id/${id}`);

        if (!responseCanciones.ok || !responseCategoria.ok) {
          throw new Error(`Error en la solicitud: ${responseCanciones.status} ${responseCategoria.status}`);
        }

        this.canciones = await responseCanciones.json();
        this.categoria = await responseCategoria.json();
      } catch (error) {
        console.error(error);
        this.canciones = [];
        this.categoria = null;
      }
    }
  }
};
</script>
<style scoped>
body {
  background-color: #f5f5f5;
  font-family: 'Roboto', sans-serif;
}

div {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
  font-size: 32px;
  color: #333;
  margin-bottom: 30px;
  text-align: center;
  border-bottom: 1px solid #ddd;
  padding-bottom: 10px;
}

h2 {
  font-size: 26px;
  color: #333;
  margin-bottom: 10px;
}

p {
  font-size: 18px;
  color: #666;
  margin-bottom: 20px;
}

ul {
  list-style: none;
  padding: 0;
}

li {
  background-color: #e6e6fa;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  margin-bottom: 20px;
}

iframe {
  display: block;
  margin: 0 auto;
  margin-bottom: 20px;
  border-radius: 5px;
  border: none;
}
</style>