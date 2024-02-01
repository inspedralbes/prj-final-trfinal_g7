<template>
    <div>
        <label for="cancion">Selecciona una cancion:</label>
        <select v-model="cancionSeleccionada" id="cancion">
            <option v-for="cancion in canciones" :key="cancion.id" :value="cancion.id">{{ cancion.nombre }}</option>
        </select>

        <label for="categorias">Seleccionar categorias:</label>
        <div id="categorias">
            <div v-for="categoria in categorias" :key="categoria.id">
                <input type="checkbox" :value="categoria.id" v-model="categoriaSeleccionada">
                <label>{{ categoria.nombre }}</label>
            </div>
        </div>

        <button @click="asignarCategoria()">AsignarCategoria</button>
    </div>
</template>
  
<script>
export default {
    data() {
        return {
            canciones: [],
            categorias: [],
            cancionSeleccionada: null,
            categoriaSeleccionada: [],
            ruta: 'http://localhost:8000',
        };
    },
    methods: {
        async mostrarCanciones() {
            try {

                const response = await fetch(`${this.ruta}/api/mostrar-canciones`, {
                    method: 'GET',
                });

                if (!response.ok) {
                    throw new Error(`Error en la solicitud: ${response.status}`);
                }

                const data = await response.json();
                this.canciones = data.canciones;
                console.log(data.message);

                console.log("Canciones mostradas");
            } catch (error) {
                console.error('Error al mostrar ocupantes:', error);
                throw error;
            }
        },
        async mostrarCategorias() {
            try {

                const response = await fetch(`${this.ruta}/api/mostrar-categorias`, {
                    method: 'GET',
                });

                if (!response.ok) {
                    throw new Error(`Error en la solicitud: ${response.status}`);
                }

                const data = await response.json();
                this.categorias = data.categoria;
                console.log(data.message);

                console.log("Categorias mostradas");
            } catch (error) {
                console.error('Error al mostrar ocupantes:', error);
                throw error;
            }
        },
        async asignarCategoria() {
            const response = await fetch(`${this.ruta}/api/assign-categories`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    idCancion: this.cancionSeleccionada,
                    idsCategorias: this.categoriaSeleccionada,
                }),
            });

            if (!response.ok) {
                // Handle error
            }
        },
    },
    async created() {
        try {
            await this.mostrarCanciones();
            await this.mostrarCategorias();
        } catch (error) {
            console.error('Error al obtener las canciones:', error);
        }
    },
};
</script>
  
  