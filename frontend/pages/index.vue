<template>
  <div>
    <div class="inputContent" @click="toggleModaleFormRegister">
      <i class="fi-rr-pencil"></i>
      <h3>Register.</h3>
    </div>
    <ModalFormRegister
      :revele="reveleFormRegister"
      :toggle="toggleModaleFormRegister"
    />
    <div class="inputContent" @click="toggleModaleFormLogin">
      <i class="fi-rr-pencil"></i>
      <h3>Login</h3>
    </div>
    <ModalFormLogin :revele="reveleFormLogin" :toggle="toggleModaleFormLogin" />
    <div>
      <h3>Logout</h3>
      <button @click="onLogout">Logout</button>
    </div>
    <div>
      <h1>Page d'accueil</h1>
      <NuxtLink to="/home">Home page</NuxtLink>
    </div>
  </div>
</template>

<script>
import ModalFormLogin from '@/components/Modals/Forms/ModalFormLogin'
import ModalFormRegister from '@/components/Modals/Forms/ModalFormRegister'

export default {
  components: {
    ModalFormLogin,
    ModalFormRegister,
  },
  data() {
    return {
      nom: 'Gonzalez',
      prenom: 'Esteban',
      mailRegister: 'test@test.com',
      passwordRegister: '0123456Az',
      confirmPassword: '0123456Az',
      emailLogin: 'test@test.com',
      passwordLogin: '0123456Az',
      reveleFormLogin: false,
      reveleFormRegister: false,
    }
  },

  methods: {
    toggleModaleFormLogin() {
      this.reveleFormLogin = !this.reveleFormLogin
    },
    toggleModaleFormRegister() {
      this.reveleFormRegister = !this.reveleFormRegister
    },
    async onLogout() {
      const userToken = 'userToken=' + this.$cookiz.get('userToken')
      await this.$api.auth.logout(userToken)
    },
  },
}
</script>

<style scoped>
.container {
  margin: 0 auto;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}

.title {
  font-family: 'Quicksand', 'Source Sans Pro', -apple-system, BlinkMacSystemFont,
    'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
  display: block;
  font-weight: 300;
  font-size: 100px;
  color: #35495e;
  letter-spacing: 1px;
}

.subtitle {
  font-weight: 300;
  font-size: 42px;
  color: #526488;
  word-spacing: 5px;
  padding-bottom: 15px;
}

.links {
  padding-top: 15px;
}

.inputContent {
  display: flex;
  align-items: center;
  height: 50px;
  padding: 15px;
  box-sizing: border-box;
  border-radius: 20px;
  background: #ddd;
  transition: 0.3s ease-in-out;
}
.inputContent:hover {
  border: 1px solid #aaaaaa;
  outline: none;
  transition: 0.3s ease-in-out;
}

.inputContent i {
  font-size: 15px;
  color: #757588;
  margin-top: 2px;
}

.inputContent h3 {
  font-size: 15px;
  color: #757588;
  margin-left: 10px;
}
</style>
