<template>
  <div>
    <div>
      <ModalSuccess
        :revele="reveleSuccess"
      ></ModalSuccess>
      <ModalFail
        :revele="reveleFail"
      ></ModalFail>
      <ModalFormRegister
        :revele="reveleFormRegister"
        :reveleSuccess="reveleSuccess"
        :reveleFail="reveleFail"
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
import ModalSuccess from '@/components/Modals/ModalSuccess'
import ModalFail from '@/components/Modals/ModalFail'
export default {
  components: {
    ModalFormRegister,
    ModalFormLogin,
    ModalSuccess,
    ModalFail,
  },
  data() {
    return {
      reveleFormRegister: false,
      reveleFormLogin: false,
      reveleSuccess: false,
      reveleFail: false,
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
