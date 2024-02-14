<!-- ~/pages/User.vue -->

<template>
    <div>
      Username: {{ userStore.username }}
    </div>
  </template>
  
  <script>
  import { useUserStore } from '~/stores/users';
  
  export default {
    setup() {
      const userStore = useUserStore();
  
      return { userStore };
    },
  };
  </script>