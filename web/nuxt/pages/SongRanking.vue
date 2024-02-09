<template>
    <div>
      <h3>Ranking de canciones</h3>
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
    name: 'SongRanking',
    data() {
      return {
        songs: [],
      };
    },
    async created() {
      //obtener el ranking de canciones
      //const response = await fetch('http://localhost:8000/api/songs_ranking');
      //this.songs = await response.json();
    },
  };
  </script>