// ~/stores/user.js
import { defineStore } from 'pinia';

export const useUserStore = defineStore('user', {
  state: () => ({
    username: "pepe",
    isAdmin: false,
  }),
  actions: {
    setUsername(username) {
      this.username = username;
    },
    setIsAdmin(isAdmin) { 
        this.isAdmin = isAdmin;
      },
  },
});