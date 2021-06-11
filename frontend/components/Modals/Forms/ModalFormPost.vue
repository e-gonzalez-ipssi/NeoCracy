<template>
  <div v-if="revele" class="bloc-modale">
    <div class="modale">
      <button class="btn-modale" @click="toggleModaleFormPost">X</button>

      <form @submit.prevent="handleSubmit">
        <h3>Créer un Post</h3>
        <p>Ajouter un titre</p>
        <input
          v-model="form.titre"
          type="text"
          placeholder="Titre du post"
          required
        />
        <p>Contenu du post</p>
        <textarea
          v-model="form.contenu"
          placeholder="Que voulez vous dire ?"
          name="message"
          required
        ></textarea>
        <p>Publier une image</p>
        <input ref="image" type="file" @change="onFileChange" />
        <p>Utiliser un url</p>
        <input v-model="url" type="text" placeholder="url" />
        <p>Ajouter des tags</p>
        <input v-model="tags" type="text" placeholder="#Neocracy" />
        <button type="submit">Send</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ModaleFormPost',
  props: {
    revele: Boolean,
    toggleModaleFormPost: { type: Function, required: true },
  },
  data() {
    return {
      form: {
        titre: 'titre',
        contenu: 'contenu',
        url: 'url',
        tags: 'tags',
        image: [],
      },
    }
  },
  methods: {
    onFileChange() {
      const files = this.$refs.image.files
      const data = new FormData()
      data.append('image', files[0])
    },
    handleSubmit() {
      console.log(this.form)

      // await this.$api.auth
      //   .register(formData)
      //   .then(({ data }) => {
      //     console.log(data)
      //   })
      //   .catch((e) => {
      //     console.log(e)
      //   })
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
