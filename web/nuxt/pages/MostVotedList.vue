<template>
  <div class="container">
    <h3 class="title">Lista más votada</h3>
    <ul v-if="songs.length" class="song-list">
      <li v-for="song in songs" :key="song.id" class="song-item">
        {{ song.name }} - {{ song.votes }} votos
      </li>
    </ul>
    <p v-else class="no-songs">No hay canciones disponibles</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      songs: [],
    };
  },
  async mounted() {
    const response = await fetch('http://localhost:8000/api/canciones-mas-votadas');
    const data = await response.json();
    this.songs = data;
  },
};
</script>

<style scoped>
.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f2f2f2;
  font-family: Arial, sans-serif;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.title {
  font-size: 24px;
  color: #333;
  text-align: center;
  margin-bottom: 20px;
}

.song-list {
  list-style-type: none;
  padding: 0;
}

.song-item {
  padding: 10px;
  border-bottom: 1px solid #ddd;
}

.no-songs {
  text-align: center;
  color: #999;
}
</style>