<template>
  <div v-if="revele" class="bloc-modale">
    <div class="modale">
      <button class="btn-modale" @click="toggle">X</button>

      <form @submit.prevent="handleSubmitProposition">
        <h3>Rédiger un post</h3>
        <!-- <p>Pour quelle organisation ?</p> -->
        <!-- <select v-model="form.organisation">
          <option disabled value>Please select one</option>
          <option v-for="(id, name) in organisation" :key="id" :value="name">
            {{ name }}
          </option>
        </select> -->
        <!-- <input
          v-model="form.organisation"
          type="number"
          placeholder="n° de l'organisation"
          required
        /> -->
        <p>Titre du post</p>
        <input
          v-model="form.title"
          type="text"
          placeholder="En-tête de votre post"
          required
        />
        <p>Contenu du post</p>
        <textarea
          v-model="form.description"
          placeholder="Que voulez vous dire ?"
          name="message"
          required
        ></textarea>
        <p>Publier une image</p>
        <input
          ref="image"
          type="file"
          placeholder="#Ajouter un fichier"
          @change="onFileChange"
        />

        <p>Utiliser une url</p>
        <input
          v-model="form.url"
          type="text"
          placeholder="https://neocracy.com"
        />
        <p>Ajouter des tags</p>
        <input v-model="form.tags" type="text" placeholder="#Neocracy" />
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
        image: {},
        url: 'https://neocracy.com',
        tags: 'Neocracy',
      },
    }
  },
  methods: {
    onFileChange() {
      this.image = this.$refs.image.files[0]
    },
    async handleSubmitProposition() {
      console.log('this.form:', this.form)
      const userToken = this.$cookiz.get('userToken')
      await this.$api.proposition.postProposition(this.form, userToken)
      this.toggle()
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
