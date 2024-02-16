<template>
    <div class="landing">
      <h1>Bienvenido a nuestra plataforma de música</h1>
  
      <div class="landing-section">
        <h2>Lista más votada</h2>
        <MostVotedList />
      </div>
  
      <div class="landing-section">
        <h2>Chat de usuarios</h2>
        <UserChat />
      </div>
  
      <div class="landing-section">
        <h2>Ranking de canciones</h2>
        <SongRanking />
      </div>
      <div class="landing-section">
        <h2>Lista semanal para votar</h2>
        <ListaSemanal/>
      </div>
    </div>
  </template>
  
  <script>
  import MostVotedList from './MostVotedList.vue';
  import UserChat from './UserChat.vue';
  import SongRanking from './SongRanking.vue';
  import ListaSemanal from './ListaSemanal.vue';

  export default {
    components: {
      MostVotedList,
      UserChat,
      SongRanking,
      ListaSemanal
    },
  };
  </script>
  
  <style scoped>
  .landing {
    width: 80%;
    margin: 0 auto;
  }
  
  .landing-section {
    margin-bottom: 20px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
  }
  </style>