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
