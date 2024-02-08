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
        // origin: '*',
        methods: ['GET', 'POST'],
    },
});

const votaciones = [];

io.on('connection', (socket) => {
    console.log("Se ha conectado alguien!! con id " + socket.id);

    socket.on('votar', (cancionId) => {
        votaciones.push({ id: socket.id, cancionId });
        console.log('Voto registrado para la canción con ID:', cancionId);

        io.emit('actualizacionVotos', votaciones);
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
