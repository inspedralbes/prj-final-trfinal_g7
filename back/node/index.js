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
let messages = [];

io.on('connection', (socket) => {
    console.log("Se ha conectado alguien!! con id " + socket.id);
    socket.emit('actualizacionVotos', votaciones);
    socket.on('votar', (cancionId) => {
        if (!votaciones[cancionId]) {
            votaciones[cancionId] = 0;
        }
        votaciones[cancionId]++;
        console.log('Voto registrado para la canción con ID:', cancionId);

        io.emit('actualizacionVotos', votaciones);
    });

    socket.on('chat message', (message) => {
        messages.push(message);
        socket.broadcast.emit('chat message', message);
    });



    socket.on('disconnect', () => {
        console.log("Se ha desconectado alguien!! con id " + socket.id);
        io.emit('actualizacionVotos', votaciones);
    });
});

server.listen(port, () => {
    console.log('Server running on port:' + port);
});