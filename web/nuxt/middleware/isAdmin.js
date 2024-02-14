// middleware/isAdmin.js

export default function ({ redirect, app }) {
  
  const userStore = app.$pinia.use('user');

  if (!userStore.isAdmin.value) {
    return redirect('/');
  }
}