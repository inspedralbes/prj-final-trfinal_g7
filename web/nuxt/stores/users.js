// ~/stores/user.js
import { defineStore } from 'pinia';

export const useUserStore = defineStore('user', {
  state: () => ({
    username: "pepe",
  }),
  actions: {
    setUsername(username) {
      this.username = username;
    },
  },
});