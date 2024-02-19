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
            ruta: 'http://trfinal.a17danvicfer.daw.inspedralbes.cat/output/laravel/public',
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
            /**const token = localStorage.getItem('token');
            const headers = new Headers();
            headers.append("Content-Type", "application/json");
            headers.append("Accept", 'application/json');
            headers.append("Authorization", `Bearer ${token}`);*/

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
                throw new Error(`Error en la solicitud: ${response.status}`);
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
<style scoped>
div {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f2f2f2;
    font-family: Arial, sans-serif;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    font-size: 16px;
    color: #333;
    display: block;
    margin-bottom: 5px;
}

select,
input[type="checkbox"] {
    margin-bottom: 20px;
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #337ab7;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    background-color: #225588;
}
</style>