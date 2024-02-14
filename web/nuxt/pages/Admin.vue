<!-- components/Admin.vue -->

<template>
    <div class="admin-container">
      <h2 class="admin-title">Administrar usuarios</h2>
      <table class="admin-table">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.role }}</td>
            <td>
              <button @click="setRole(user, 'admin')">Hacer admin</button>
              <button @click="setRole(user, 'user')">Hacer usuario</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        users: [],
        ruta: 'http://localhost:8000',
      };
    },
    async created() {
      const response = await fetch(`${this.ruta}/api/users`);
      this.users = await response.json();
    },
    methods: {
      async setRole(user, role) {
        const response = await fetch(`${this.ruta}/api/users/${user.id}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({ role }),
        });
        if (response.ok) {
          user.role = role;
        }
      },
    },
  };
  </script>
  
  <style scoped>
  /* Agrega aquí tus estilos */
  </style>