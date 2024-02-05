<template>
    <div>
      <h1>Canciones en la categoría: {{ categoria.nombre }}</h1>
      <ul>
        <li v-for="cancion in canciones" :key="cancion.id">
          <h2>{{ cancion.nombre }}</h2>
          <p>{{ cancion.artista }}</p>
          <iframe width="200" height="115" :src="cancion.urlPlayer" title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen></iframe>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
export default {
  async asyncData({ params }) {
    const ruta = 'http://localhost:8000';
    try {
      const responseCanciones = await fetch(`${ruta}/api/lista_canciones_categoria/${params.id}`, {
        method: 'GET',
      });

      const responseCategoria = await fetch(`${ruta}/api/categoria_por_id/${params.id}`, {
        method: 'GET',
      });

      if (!responseCanciones.ok || !responseCategoria.ok) {
        throw new Error(`Error en la solicitud: ${responseCanciones.status} ${responseCategoria.status}`);
      }

      const canciones = await responseCanciones.json();
      const categoria = await responseCategoria.json();
      return { canciones, categoria };
    } catch (error) {
      console.error(error);
      return { canciones: [], categoria: null };
    }
  },
};
</script>