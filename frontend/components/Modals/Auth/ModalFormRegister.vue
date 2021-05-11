<template>
  <div v-if="revele" class="bloc-modale">
    <div class="overlay" @click="toggleModaleFormRegister"></div>
    <div class="modale">
      <button class="btn-modale" @click="toggleModaleFormRegister">X</button>
      <h3>Register</h3>
      <input v-model="nom" type="text" placeholder="nom" />
      <input v-model="prenom" type="text" placeholder="prenom" />
      <input v-model="mailRegister" type="text" placeholder="mailRegister" />
      <input
        v-model="passwordRegister"
        type="password"
        placeholder="passwordRegister"
      />
      <input
        v-model="confirmPassword"
        type="password"
        placeholder="confirmPassword"
      />
      <button @click="onRegister()">Register</button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ModaleFormRegister',
  props: {
    revele: Boolean,
    reveleSuccess: Boolean,
    reveleFail: Boolean,
    toggleModaleFormRegister: { type: Function, required: true },
  },
  data() {
    return {
      nom: 'Gonzales',
      prenom: 'Esteban',
      mailRegister: 'test@test.com',
      passwordRegister: '0123456Az',
      confirmPassword: '0123456Az',
    }
  },
  methods: {
    async onRegister() {
      const res = await this.$api.auth.register(
        this.nom,
        this.prenom,
        this.mailRegister,
        this.passwordRegister,
        this.confirmPassword
      )
      if (res === 200) {
        this.reveleSuccess = !this.reveleSuccess
        this.revele = !this.revele
      } else {
        this.reveleFail = !this.reveleFail
      }
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
