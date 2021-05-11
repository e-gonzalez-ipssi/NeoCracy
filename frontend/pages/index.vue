<template>
  <div>
    <div>
      <ModalFormRegister
        :revele="reveleFormRegister"
        :toggle-modale-form-register="toggleModaleFormRegister"
      ></ModalFormRegister>
      <button @click="toggleModaleFormRegister">Inscription</button>
    </div>
    <div>
      <ModalFormLogin
        :revele="reveleFormLogin"
        :toggle-modale-form-login="toggleModaleFormLogin"
      ></ModalFormLogin>
      <button @click="toggleModaleFormLogin">Connexion</button>
    </div>
    <div>
      <button @click="onLogout">Logout</button>
    </div>
    <nuxt-link to="/acceuil">Page d'accueil</nuxt-link>
  </div>
</template>

<script>
import ModalFormRegister from '@/components/Modals/Auth/ModalFormRegister'
import ModalFormLogin from '@/components/Modals/Auth/ModalFormLogin'
export default {
  components: {
    ModalFormRegister,
    ModalFormLogin,
  },
  data() {
    return {
      reveleFormRegister: false,
      reveleFormLogin: false,
    }
  },

  methods: {
    toggleModaleFormRegister() {
      this.reveleFormRegister = !this.reveleFormRegister
    },
    toggleModaleFormLogin() {
      this.reveleFormLogin = !this.reveleFormLogin
    },
    async onLogout() {
      await this.$api.auth.logout()
    },
  },
}
</script>

<style></style>
