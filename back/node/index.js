/*
PUERTO DE LOCALHOST: 3123
PUERTO DE PREPROD: 3184
PUERTO DE PROD: 3123

Substituir en la constante: port
*/

import express from 'express';
import cors from 'cors';
import { createServer } from 'http';
import { Server } from 'socket.io';

const app = express();
app.use(cors());
const port = 3123;

const server = createServer(app);
const io = new Server(server, {
  cors: {
    // origin: '*',
    methods: ['GET', 'POST'],
  },
});

const usuariosJuego = [];

io.on('connection', (socket) => {
  console.log("Se ha conectado alguien!! con id " + socket.id);

  socket.esMiTurno = false;

  socket.on('peticion_jugar', (datos) => {
    usuariosJuego.push({ id: socket.id, nombreUsuario: datos.nombreUsuario, estado: "", color: "" });
    console.log('quiere jugar', datos.nombreUsuario);

    socket.emit("peticion_jugar_aceptada", datos);
    io.emit('actualizacionUsuario', usuariosJuego);

    
  });


  socket.on('disconnect', () => {
    console.log("Se ha desconectado alguien!! con id " + socket.id);
    const index = usuariosJuego.findIndex((user) => user.id === socket.id);
    if (index !== -1) {
      usuariosJuego.splice(index, 1);

      if (socket.esMiTurno) {
        const siguienteTurno = usuariosJuego.length > 0 ? usuariosJuego[0].id : null;
        io.emit('cambiarTurno', { esMiTurno: socket.id === siguienteTurno });
      }

    }
  });

  
 });

server.listen(port, () => {
  console.log('Server running on port:'+port);
});