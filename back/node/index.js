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
    console.log('Votaciones actuales:', votaciones);
    socket.emit('actualizacionVotos', votaciones);
    socket.on('votar', (cancionId) => {
        // Verificar si el cliente ya ha votado por esta canción
        if (votaciones.some(voto => voto.id === socket.id && voto.cancionId === cancionId)) {
            console.log('El cliente ya ha votado por esta canción:', cancionId);
            return;
        }

        votaciones.push({ id: socket.id, cancionId });
        console.log('Voto registrado para la canción con ID:', cancionId);

        io.emit('actualizacionVotos', votaciones);
    });

    socket.on('chat message', (message) => {
        messages.push(message);
        socket.broadcast.emit('chat message', message);
    });

    socket.on('enviarVotosPorCancion', (votosPorCancion) => {
        console.log('Votos por canción recibidos:', votosPorCancion);

        // Transformar votosPorCancion al formato de votaciones
        votaciones = votosPorCancion.flatMap(voto =>
            Array(voto.numeroVotos).fill({ id: null, cancionId: voto.idCancion })
        );

        // Emitir el evento actualizacionVotos para actualizar los clientes
        io.emit('actualizacionVotos', votaciones);
    });

    socket.on('disconnect', () => {
        console.log("Se ha desconectado alguien!! con id " + socket.id);
    });
});

server.listen(port, () => {
    console.log('Server running on port:' + port);
});