<template>
    <div>
      <h3>Chat de usuarios</h3>
      <div v-for="message in messages" :key="message.id">
        <strong>{{ message.user }}:</strong> {{ message.text }}
      </div>
      <input v-model="newMessage" @keyup.enter="sendMessage">
    </div>
  </template>
  
  <script>
  import io from 'socket.io-client';
  
  export default {
    name: 'UserChat',
    data() {
      return {
        messages: [],
        newMessage: '',
        socket: null,
      };
    },
    created() {
      this.socket = io('http://localhost:3123');
      this.socket.on('chat message', (message) => {
        this.messages.push(message);
      });
    },
    methods: {
      sendMessage() {
        this.socket.emit('chat message', { user: 'Usuario 1', text: this.newMessage });
        this.newMessage = '';
      },
    },
  };
  </script>