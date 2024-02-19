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
      <router-link class="link" to="/ListaSemanal">Lista Semanal</router-link>
      <router-link class="link" to="/">Canciones</router-link>
    </div>
  </template>
  
  <script>
  export default {
    middleware: 'isAdmin',
    data() {
      return {
        users: [],
        ruta: 'http://trfinal.a17danvicfer.daw.inspedralbes.cat/output/laravel/public',
       
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
  .admin-container {
    width: 100%;
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
  }
  
  .admin-title {
    text-align: center;
    margin-bottom: 20px;
  }
  
  .admin-table {
    width: 100%;
    border-collapse: collapse;
  }
  
  .admin-table th,
  .admin-table td {
    border: 1px solid #ddd;
    padding: 8px;
  }
  
  .admin-table tr:nth-child(even) {
    background-color: #f2f2f2;
  }
  
  .admin-table tr:hover {
    background-color: #ddd;
  }
  
  .admin-table th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
  }
  
  button {
    margin-right: 10px;
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    color: white;
    cursor: pointer;
  }
  
  button:last-child {
    margin-right: 0;
  }
  
  button:nth-child(1) {
    background-color: #4CAF50;
  }
  
  button:nth-child(2) {
    background-color: #f44336;
  }
  </style>