const express = require('express');
const cors = require('cors');
const http = require('http');
const { Server } = require('socket.io');

const app = express();
app.use(cors());
const port = 3123;

const server = http.createServer(app);
const io = new Server(server, {
    cors: {
        methods: ['GET', 'POST'],
    },
});

let votaciones = [];
let messages = []; // Almacena los mensajes del chat

io.on('connection', (socket) => {
    console.log("Se ha conectado alguien!! con id " + socket.id);

    socket.on('votar', (cancionId) => {
        votaciones.push({ id: socket.id, cancionId });
        console.log('Voto registrado para la canción con ID:', cancionId);

        io.emit('actualizacionVotos', votaciones);
    });

    // Cuando el cliente emite un evento 'chat message'
    socket.on('chat message', (message) => {
        // Añade el mensaje al array
        messages.push(message);
        // Emite un evento 'chat message' a todos los clientes con el mensaje
        io.emit('chat message', message);
    });

    socket.on('disconnect', () => {
        console.log("Se ha desconectado alguien!! con id " + socket.id);
        votaciones = votaciones.filter(voto => voto.id !== socket.id);
        io.emit('actualizacionVotos', votaciones);
    });
});

server.listen(port, () => {
    console.log('Server running on port:' + port);
});