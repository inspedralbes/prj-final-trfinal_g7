// store.js
import { defineStore } from 'pinia';

export const useCounterStore = defineStore({
  id: 'counter',
  state: () => ({
    count: 0,
    auth: {
      token: null,
    },
  }),
  actions: {
    setToken(newToken) {
      this.auth.token = newToken;
    },
  },
});