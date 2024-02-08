<template>
  <div>
    <h2>Lista semanal para votar</h2>
    <ul>
      <li v-for="cancion in canciones" :key="cancion.id">
        <h2>{{ cancion.nombre }}</h2>
        <p>{{ cancion.artista }}</p>
        <button
          @click="votar(cancion.id)"
          :disabled="votos.length >= 7 || votos.includes(cancion.id)"
        >
          Votar
        </button>
        <span>{{ obtenerVotos(cancion.id) }}</span>
      </li>
    </ul>
  </div>
</template>
<script>
import io from "socket.io-client";

export default {
  data() {
    return {
      canciones: [],
      ruta: "http://localhost:8000",
      votos: [],
    };
  },
  async mounted() {
    try {
      const response = await fetch(`${this.ruta}/api/lista-semanal`);
      if (!response.ok) {
        throw new Error(`Error en la solicitud: ${response.status}`);
      }
      const data = await response.json();
      this.canciones = data;
    } catch (error) {
      console.error("Error al obtener la lista semanal:", error);
    }
    this.socket = io("http://localhost:3123");
    this.socket.on("actualizacionVotos", (votaciones) => {
      this.votos = votaciones;
    });
  },
  methods: {
    async votar(cancionId) {
      if (this.votos.length >= 7) {
        console.log("Ya has votado 7 veces");
        return;
      }
      if (this.votos.some((voto) => voto.id === cancionId)) {
        console.log("Ya has votado por esta canción");
        return;
      }
      try {
        const response = await fetch(`${this.ruta}/api/votar`, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            cancionId: cancionId,
          }),
        });
        if (!response.ok) {
          throw new Error(`Error en la solicitud: ${response.status}`);
        }
        const data = await response.json();
        console.log(data.message);

        this.votos.push({ id: cancionId });
      } catch (error) {
        console.error("Error al votar:", error);
      }
      if (this.votos.some((voto) => voto === cancionId)) {
        console.log("Ya has votado por esta canción");
        return;
      }

      // Emitir el evento 'votar' al servidor
      this.socket.emit("votar", cancionId);
    },
    obtenerVotos(cancionId) {
      // Contar los votos para la canción actual
      return this.votos.filter((voto) => voto.cancionId === cancionId).length;
    },
  },
};
</script>
<style></style>
