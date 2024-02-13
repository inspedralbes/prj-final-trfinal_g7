<template>
  <div>
    <h2>Lista semanal para votar</h2>
    <ul>
      <li v-for="cancion in canciones" :key="cancion.id">
        <h2>{{ cancion.nombre }}</h2>
        <p>{{ cancion.artista }}</p>
        <button @click="votar(cancion.id)" :disabled="votos.length >= 7 || votos.includes(cancion.id)">
          Votar
        </button>
        <span>{{ obtenerVotos(cancion.id) }}</span>
      </li>
    </ul>
    <button @click="borrarListaSemanal">Borrar lista semanal</button>
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
      const token = localStorage.getItem('token');
      console.log(token); // Añade esta línea
      try {
        if (!token) {
          // El token de autenticación no está presente, redirige al usuario a la página de inicio de sesión
          this.$router.push('/login');
          return;
        }
        const headers = new Headers();
        headers.append("Content-Type", "application/json");
        headers.append("Accept", 'application/json');
        headers.append("Authorization", `Bearer ${token}`);

        const response = await fetch(`${this.ruta}/api/votar`, {
          method: "POST",
          headers: headers,
          body: JSON.stringify({
            cancionId: cancionId,
          }),
        });
        if (!response.ok) {
          throw new Error(`Error en la solicitud: ${response.status}`);
        }
        const data = await response.json();
        console.log(data.message);

        if (this.votos.length >= 7) {
          console.log("Ya has votado 7 veces");
          return;
        }
        if (this.votos.some((voto) => voto.id === cancionId)) {
          console.log("Ya has votado por esta canción");
          return;
        }

        this.votos.push({ id: cancionId });
      } catch (error) {
        console.error("Error al votar:", error);
      }

      this.socket.emit("votar", cancionId);
    },
    borrarListaSemanal() {
      fetch(`${this.ruta}/api/borrar-lista-semanal`, {
        method: 'DELETE',
      })
        .then(response => response.json())
        .then(data => console.log(data))
        .catch((error) => {
          console.error('Error:', error);
        });
    },
    obtenerVotos(cancionId) {
      return this.votos.filter((voto) => voto.cancionId === cancionId).length;
    },
  },
};
</script>
<style></style>
