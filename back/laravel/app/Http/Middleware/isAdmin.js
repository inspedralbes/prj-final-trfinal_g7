// middleware/isAdmin.js

export default function ({ store, redirect }) {
    // Si el usuario no es un administrador, redirige a la página de inicio
    if (store.state.user.role !== 'admin') {
      return redirect('/');
    }
  }