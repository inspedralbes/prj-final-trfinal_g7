<template>
    <div>
      <h3>Lista más votada</h3>
      <ul v-if="songs.length">
        <li v-for="song in songs" :key="song.id">
          {{ song.name }} - {{ song.votes }} votos
        </li>
      </ul>
      <p v-else>No hay canciones disponibles</p>
    </div>
  </template>
  
  <script>
  export default {
    name: 'MostVotedList',
    data() {
      return {
        songs: [],
      };
    },
    async created() {
   
   
      //const response = await fetch('http://localhost:8000/api/most_voted_songs');
      //this.songs = await response.json();
    },
  };
  </script>