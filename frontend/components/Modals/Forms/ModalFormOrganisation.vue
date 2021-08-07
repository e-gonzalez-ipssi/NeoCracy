<template>
  <div v-if="revele" class="bloc-modale">
    <div class="modale">
      <button class="btn-modale" @click="toggle">X</button>

      <form @submit.prevent="handleSubmitOrganisation">
        <h3>Créer une Organisation</h3>
        <p>Ajouter un titre</p>
        <input
          v-model="form.nom"
          type="text"
          placeholder="Nom de l'organisation"
          required
        />
        <p>Contenu de la description</p>
        <textarea
          v-model="form.description"
          placeholder="Une description ?"
          name="message"
          required
        ></textarea>
        <p>Ajouter un lien</p>
        <input
          v-model="form.lienSite"
          type="text"
          placeholder="https://google.fr"
        />
        <button type="submit">Send</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ModaleFormOrganisation',
  props: {
    revele: Boolean,
    toggle: { type: Function, required: true },
  },
  data() {
    return {
      form: {
        nom: 'google',
        description: 'GOOGLE',
        lienSite: 'https://google.fr',
      },
    }
  },
  methods: {
    async handleSubmitOrganisation() {
      const userToken = this.$cookiz.get('userToken')
      console.log('userToken:', userToken)
      console.log(this.form.nom)
      console.log(this.form.description)
      console.log(this.form.lienSite)
      console.log(userToken)
      await this.$api.organisation.postOrganisation(this.form, userToken)
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
