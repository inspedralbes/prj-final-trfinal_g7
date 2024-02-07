<template>
    <div>
        <h2>Lista semanal para votar</h2>
        <ul>
            <li v-for="cancion in canciones" :key="cancion.id">
                <h2>{{ cancion.nombre }}</h2>
                <p>{{ cancion.artista }}</p>
                <button @click="votar(cancion.id)" :disabled="votos.length >= 7 || votos.includes(cancion.id)">Votar</button>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            canciones: [],
            ruta: 'http://localhost:8000',
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
            console.error('Error al obtener la lista semanal:', error);
        }
    },
    methods: {
        async votar(cancionId) {
            if (this.votos.length >= 7) {
                console.log('Ya has votado 7 veces');
                return;
            }

            if (this.votos.includes(cancionId)) {
                console.log('Ya has votado por esta canción');
                return;
            }

            try {
                const response = await fetch(`${this.ruta}/api/votar`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
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

               
                this.votos.push(cancionId);
            } catch (error) {
                console.error('Error al votar:', error);
            }
        },
    },
};
</script>