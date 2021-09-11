<template>
  <div v-if="revele" class="bloc-modale">
    <div class="modale">
      <button class="btn-modale" @click="toggle">X</button>

      <form @submit.prevent="handleSubmitUser">
        <h3>Modifier vos informations</h3>

        <p>Nom</p>
        <input id="nom" v-model="form.nom" type="text" required />
        <p>Prenom</p>
        <input id="prenom" v-model="form.prenom" type="text" required />

        <p>Email</p>
        <input id="mail" v-model="form.email" type="text" />
        <button type="submit">Send</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ModaleFormProposition',
  props: {
    revele: Boolean,
    toggle: { type: Function, required: true },
  },
  data() {
    return {
      form: {
        nom: undefined,
        prenom: undefined,
        email: undefined,
      },
    }
  },
  methods: {
    onFileChange() {
      this.image = this.$refs.image.files[0]
    },
    async handleSubmitUser() {
      const userToken = this.$cookiz.get('userToken')
      await this.$api.userdata.updateUserDetail(this.form, userToken)

      const userData = await this.$api.userdata.getData()
      sessionStorage.setItem('userInfo', JSON.stringify(userData))

      this.toggle()
      location.reload()
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
