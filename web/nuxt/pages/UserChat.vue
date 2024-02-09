<template>
    <div>
        <h3>Chat de usuarios</h3>
        <div class="chat-container">
            <div v-for="(message, index) in messages" :key="index">
                <strong>{{ message.user }}:</strong> {{ message.text }}
            </div>
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
            console.log('Enviando mensaje', this.newMessage);
            const message = { user: 'Usuario 1', text: this.newMessage };
            this.socket.emit('chat message', message);
            this.messages.push(message);
            this.newMessage = '';
        },
    },
};
</script>

<style scoped>
.chat-container {
    height: 300px;
    overflow-y: auto;
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 10px;
}

.chat-message {
    margin-bottom: 10px;
}
</style>