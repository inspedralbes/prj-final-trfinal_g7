<template>
    <div>
        <h2>Lista semanal para votar</h2>
        <ul>
            <li v-for="cancion in canciones" :key="cancion.id">
                <h2>{{ cancion.nombre }}</h2>
                <p>{{ cancion.artista }}</p>
                <button @click="votar(cancion.id)" :disabled="votos.length >= 7 || votos.includes(cancion.id)">Votar</button>
                <span>{{ obtenerVotos(cancion.id) }}</span>
            </li>
        </ul>
    </div>
</template>
<script>
import io from 'socket.io-client';

export default {
    data() {
        return {
            canciones: [],
            ruta: 'http://localhost:3123', // Ruta del servidor Socket.IO
            votos: [],
        };
    },
    mounted() {
        // Inicializar la conexión con el servidor de Socket.IO
        this.socket = io(this.ruta);
        this.socket.on('actualizacionVotos', (votaciones) => {
            this.votos = votaciones;
        });
    },
    methods: {
        async votar(cancionId) {
            // Verificar si ya se ha votado por esta canción
            if (this.votos.some(voto => voto.id === cancionId)) {
                console.log('Ya has votado por esta canción');
                return;
            }

            try {
                // Realizar la llamada al servidor para votar
                const response = await fetch(`${this.ruta}/votar`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ cancionId }),
                });

                if (!response.ok) {
                    throw new Error(`Error en la solicitud: ${response.status}`);
                }

                const data = await response.json();
                console.log(data.message);
            } catch (error) {
                console.error('Error al votar:', error);
            }
        },
        obtenerVotos(cancionId) {
            // Contar los votos para la canción actual
            return this.votos.filter(voto => voto.id === cancionId).length;
        },
    },
};
</script>