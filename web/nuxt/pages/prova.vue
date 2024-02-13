<template>
    <div>
        <h2>Selecciona las canciones para la lista semanal</h2>
        <select v-model="categoriaSeleccionada">
            <option disabled value="">Selecciona una categoría</option>
            <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">
                {{ categoria.nombre }}
            </option>
        </select>
        <button @click="mostrarCancionesPorCategoria">Mostrar canciones</button>
        <ul>
            <li v-for="cancion in canciones" :key="cancion.id">
                <h2>{{ cancion.nombre }}</h2>
                <p>{{ cancion.artista }}</p>
                <button @click="agregarAListaSemanal(cancion)">Agregar a la lista semanal</button>
            </li>
        </ul>
        <button @click="aceptarListaSemanal">Aceptar lista semanal</button>
    </div>
</template>
  
<script>
export default {
    // ...
    data() {
        return {
            listaSemanal: [],
            categorias: [],
            categoriaSeleccionada: '',
            ruta: 'http://localhost:8000',
            canciones: [],
        };
    },
    methods: {
        // ...
        async mostrarCancionesPorCategoria() {
            console.log(this.categoriaSeleccionada + "categoria seleccionada");
            try {
                const response = await fetch(`${this.ruta}/api/lista_canciones_categoria/${this.categoriaSeleccionada}`, {
                    method: 'GET',
                });

                if (!response.ok) {
                    throw new Error(`Error en la solicitud: ${response.status}`);
                }

                const data = await response.json();
                this.canciones = data;
                console.log(data.message);
                console.log(this.canciones)
                console.log("Canciones mostradas");
            } catch (error) {
                console.error('Error al mostrar canciones:', error);
                throw error;
            }
        },
        agregarAListaSemanal(cancion) {
            console.log(cancion + "cancion");
            if (this.listaSemanal.length < 9) {
                this.listaSemanal.push({
                    id: cancion.id,
                    nombre: cancion.nombre
                });
            } else {
                console.log('Ya has seleccionado 10 canciones');
            }
            console.log(this.listaSemanal + "lista semanal");
        },
        async aceptarListaSemanal() {
            try {
                const response = await fetch(`${this.ruta}/api/aceptar-lista-semanal`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        categoriaId: this.categoriaSeleccionada,
                        canciones: this.listaSemanal,
                    }),
                });

                if (!response.ok) {
                    throw new Error(`Error en la solicitud: ${response.status}`);
                }

                const data = await response.json();
                console.log(data.message);
                console.log("Lista semanal aceptada");
                this.listaSemanal = [];
            } catch (error) {
                console.error('Error al aceptar la lista semanal:', error);
                throw error;
            }
        },

    },
    async created() {
        console.log("ruta:", this.ruta);
        try {
            const response = await fetch(`${this.ruta}/api/mostrar-categorias`, {
                method: 'GET',
            });

            if (!response.ok) {
                throw new Error(`Error en la solicitud: ${response.status}`);
            }

            const data = await response.json();
            this.categorias = data.categoria;
            console.log(this.categorias);
        } catch (error) {
            console.error('Error al cargar las categorías:', error);
        }
    },
    // ...
};
</script>