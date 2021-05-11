<template>
  <div v-if="revele" class="bloc-modale">
    <div class="overlay" @click="toggleModaleFormLogin"></div>
    <div class="modale">
      <button class="btn-modale" @click="toggleModaleFormLogin">X</button>
      <h2>Le contenu de la modale Login</h2>
      <h3>Login</h3>
      <input v-model="emailLogin" type="text" placeholder="emailLogin" />
      <input
        v-model="passwordLogin"
        type="password"
        placeholder="passwordLogin"
      />
      <button @click="onLogin">Login</button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ModaleFormLogin',
  props: {
    revele: Boolean,
    toggleModaleFormLogin: { type: Function, required: true },
  },
  data() {
    return {
      emailLogin: 'test@test.com',
      passwordLogin: '0123456Az',
    }
  },
  methods: {
    async onLogin() {
      this.$cookies.set('userToken', '123')
      const userToken = this.$cookies.get('userToken')
      await this.$api.auth.login(this.emailLogin, this.passwordLogin, userToken)
    },
  },
}
</script>

<style scoped>
.bloc-modale {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  display: flex;
  justify-content: center;
  align-items: center;
}

.overlay {
  background: rgba(0, 0, 0, 0.5);
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
}

.modale {
  background: #f1f1f1;
  color: #333;
  padding: 50px;
  position: fixed;
  top: 30%;
}

.btn-modale {
  position: absolute;
  top: 10px;
  right: 10px;
}
</style>
