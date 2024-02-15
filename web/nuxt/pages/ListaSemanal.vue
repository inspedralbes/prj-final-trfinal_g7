<template>
  <div class="lista-semanal">
    <h2>Lista semanal para votar</h2>
    <ul>
      <li v-for="cancion in canciones" :key="cancion.id" class="cancion-item">
        <div class="cancion-info">
          <h2>{{ cancion.nombre }}</h2>
          <p>{{ cancion.artista }}</p>
        </div>
        <div class="cancion-votos">
          <button @click="votar(cancion.id)" :disabled="votos.length >= 7">Votar</button>
          <span>{{ obtenerVotos(cancion.id) }}</span>
        </div>
      </li>
    </ul>
    <button @click="borrarListaSemanal">Borrar lista semanal</button>
  </div>
</template>
<script>
import io from 'socket.io-client';

export default {
  data() {
    return {
      canciones: [],
      ruta: 'http://localhost:8000',
      votos: [],
      votaciones: {},
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
      console.error('Error al obtener la lista semanal:', error);
    }
    this.socket = io('http://localhost:3123');

    this.socket.on('actualizacionVotos', (votaciones) => {
      if (!Array.isArray(votaciones)) {
        console.error('votaciones is not an array:', votaciones);
        return;
      }

      this.votaciones = {};

      votaciones.forEach(voto => {
        if (!this.votaciones[voto.cancionId]) {
          this.votaciones[voto.cancionId] = 0;
        }
        this.votaciones[voto.cancionId]++;
      });
    });
  },
  methods: {
    async votar(cancionId) {
      const token = localStorage.getItem('token');
      console.log(token); 
      try {
        if (!token) {        
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

      this.socket.emit('votar', cancionId, 1);
      this.votos.push(cancionId);

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
<style scoped>
.lista-semanal {
  width: 100%;
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  box-sizing: border-box;
  background-color: #f2f2f2;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.lista-semanal h2 {
  margin-bottom: 20px;
  color: #333;
  text-align: center;
  font-size: 24px;
}

.lista-semanal ul {
  list-style: none;
  padding: 0;
}

.cancion-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  padding: 20px;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.cancion-info {
  flex-grow: 1;
}

.cancion-votos {
  display: flex;
  align-items: center;
}

.cancion-item h2 {
  font-size: 20px;
  color: #333;
}

.cancion-item p {
  font-size: 16px;
  color: #666;
}

.cancion-item button {
  display: inline-block;
  padding: 10px 20px;
  background-color: #337ab7;
  color: #fff;
  text-decoration: none;
  border-radius: 5px;
  border: none;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.cancion-item button:hover {
  background-color: #225588;
}
</style>