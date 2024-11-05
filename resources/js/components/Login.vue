<template>
    <div class="login-container">
      <h1>Login with Google</h1>
      <button @click="signInWithGoogle" class="login-button">
        Sign in with Google
      </button>
    </div>
  </template>
  
  <script>
  export default {
    methods: {
      signInWithGoogle() {
        window.location.href = '/api/auth/google';
      },
    },
  };
  </script>
  
  <style scoped>
  .login-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
  }
  .login-button {
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
  }
  </style>
  