<template>
  <div v-if="revele" class="bloc-modale">
    <div class="modale">
      <button class="btn-modale" @click="toggle">X</button>

      <form @submit.prevent="handleSubmitProposition">
        <h3>Créer un Post</h3>
        <p>Pour quelle organisation</p>
        <input
          v-model="form.organisation"
          type="text"
          placeholder="organisation"
        />
        <p>Ajouter un titre</p>
        <input
          v-model="form.title"
          type="text"
          placeholder="Titre du post"
          required
        />
        <p>Contenu du post</p>
        <textarea
          v-model="form.description"
          placeholder="Que voulez vous dire ?"
          name="message"
          required
        ></textarea>
        <p>Ajouter des tags</p>
        <input v-model="tags" type="text" placeholder="#Neocracy" />
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
        title: 'Un titre',
        description: 'le contenu',
        organisation: 'Neocracy',
        tags: '#Neocracy',
      },
    }
  },
  methods: {
    async handleSubmitProposition() {
      const userToken = document.cookie
      console.log(this.form.title)
      console.log(this.form.description)
      console.log(this.form.organisation)
      console.log(this.form.tags)
      await this.$api.proposition.postProposition(this.form, userToken)
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
