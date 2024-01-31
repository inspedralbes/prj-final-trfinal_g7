<!-- components/App.vue -->
<template>
    <div>
      <h2>¡Bienvenido, {{ username }}!</h2>
      <p>Has iniciado sesión correctamente.</p>
    </div>
  </template>
  
  <script>
  export default {
    props: ['username'],
  };
  </script>
  
  <style scoped>
  /* Puedes agregar estilos específicos para este componente si es necesario */
  </style>
  