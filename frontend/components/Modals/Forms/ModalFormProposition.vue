<template>
  <div v-if="revele" class="bloc-modale">
    <div class="modale">
      <button class="btn-modale" @click="toggle">
        <img class="icons" src="~/assets/uicons/svg/fi-rr-cross.svg" />
      </button>

      <form @submit.prevent="handleSubmitProposition">
        <h3>Rédiger un post</h3>
        <label
          >Titre du post
          <p>* Champs obligatoires</p></label
        >
        <input
          v-model="form.title"
          type="text"
          placeholder="En-tête de votre post"
          required
        />
        <label
          >Contenu du post
          <p>* Champs obligatoires</p></label
        >
        <textarea
          v-model="form.description"
          placeholder="Que voulez vous dire ?"
          name="message"
          required
        ></textarea>
        <label>Publier une image</label>
        <label for="file" class="custom">
          <svg
            class="icons"
            id="Layer_1"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
            data-name="Layer 1"
          >
            <path
              d="m16 16a1 1 0 0 1 -1 1h-2v2a1 1 0 0 1 -2 0v-2h-2a1 1 0 0 1 0-2h2v-2a1 1 0 0 1 2 0v2h2a1 1 0 0 1 1 1zm6-5.515v8.515a5.006 5.006 0 0 1 -5 5h-10a5.006 5.006 0 0 1 -5-5v-14a5.006 5.006 0 0 1 5-5h4.515a6.958 6.958 0 0 1 4.95 2.05l3.484 3.486a6.951 6.951 0 0 1 2.051 4.949zm-6.949-7.021a5.01 5.01 0 0 0 -1.051-.78v4.316a1 1 0 0 0 1 1h4.316a4.983 4.983 0 0 0 -.781-1.05zm4.949 7.021c0-.165-.032-.323-.047-.485h-4.953a3 3 0 0 1 -3-3v-4.953c-.162-.015-.321-.047-.485-.047h-4.515a3 3 0 0 0 -3 3v14a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3z"
            />
          </svg>
          Ajouter un fichier</label
        >
        <input
          id="file"
          ref="image"
          type="file"
          placeholder="#Ajouter un fichier"
          @change="onFileChange"
        />
        <label>Utiliser un url</label>
        <input
          v-model="form.url"
          type="text"
          placeholder="https://neocracy.com"
        />
        <label>Ajouter des tags</label>
        <input v-model="form.tags" type="text" placeholder="#Neocracy" />
        <button type="submit">Publier le post</button>
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
        title: '',
        description: '',
        image: {},
        url: '',
        tags: '',
      },
    }
  },
  methods: {
    onFileChange() {
      this.image = this.$refs.image.files[0]
    },
    async handleSubmitProposition() {
      const userToken = this.$cookiz.get('userToken')
      const userOrg = JSON.parse(sessionStorage.getItem('userInfo'))
      await this.$api.proposition.postProposition(this.form, userToken, userOrg)
      this.toggle()
      location.reload()
    },
  },
}
</script>

<style scoped>
.bloc-modale {
  z-index: 6;
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  background: rgba(0, 0, 0, 0.75);
}

.overlay {
  z-index: 4;
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
}

.modale {
  z-index: 5;
  color: #333;
  position: fixed;
  padding: 20px 30px;
  border-radius: 10px;
  background-color: #fff;
  width: 30%;
}

.btn-modale {
  position: absolute;
  cursor: pointer;
  top: 10px;
  right: 15px;
  width: 30px;
  height: 30px;
  display: flex;
  justify-content: center;
  align-items: center;
  padding-top: 2px;
  border: 2px solid transparent;
  color: #424347;
  font-weight: bold;
  font-family: 'Open Sans', sans-serif;
  transition: 0.3s ease-in-out;
}

.btn-modale:hover {
  border: 2px solid #aaaaaa;
  border-radius: 5px;
  transition: 0.3s ease-in-out;
}

.modale form {
  display: flex;
  justify-content: center;
  flex-direction: column;
}

.modale h3 {
  margin-bottom: 10px;
  text-align: center;
  font-size: 20px;
}

.modale p {
  margin-left: 10px;
  margin-top: 5px;
  color: #008000;
  font-size: 10px;
}

.modale .hr {
  background: #bebebe;
  width: 95%;
  height: 1px;
  margin: auto;
  margin-top: 10px;
  margin-bottom: 10px;
}

.modale label {
  margin-bottom: 5px;
  font-size: 17px;
  color: 424347;
  display: flex;
}

.modale input,
.modale textarea {
  padding: 15px;
  margin-bottom: 10px;
  border-radius: 20px;
  border: 1px solid #ddd;
  background: #ddd;
  color: #424347;
  font-size: 15px;
  font-family: 'Open Sans', sans-serif;
  transition: 0.3s ease-in-out;
}

.modale input[type='file'] {
  display: none;
}

.modale .custom {
  padding: 13px;
  cursor: pointer;
  margin-bottom: 10px;
  border-radius: 20px;
  border: 1px solid #ddd;
  background: #ddd;
  color: #8d8d8d;
  font-size: 15px;
  font-family: 'Open Sans', sans-serif;
  transition: 0.3s ease-in-out;
}

.modale .custom:hover,
.modale .custom:focus {
  padding-left: 20px;
  transition: 0.3s ease-in-out;
  border: 1px solid #aaaaaa;
  outline: none;
}

.custom .icons {
  font-size: 18px;
  margin-right: 10px;
}

.icons {
  height: 18px;
}

#Layer_1 {
  fill: #8d8d8d;
}

.modale input::placeholder,
.modale textarea::placeholder {
  font-size: 15px;
  font-family: 'Open Sans', sans-serif;
}

.modale input:hover,
.modale textarea:hover {
  padding-left: 20px;
  transition: 0.3s ease-in-out;
  border: 1px solid #aaaaaa;
  outline: none;
}

.modale input:focus,
.modale textarea:focus {
  padding-left: 20px;
  transition: 0.3s ease-in-out;
  border: 1px solid #aaaaaa;
  outline: none;
}

.modale form button {
  margin-top: 10px;
  cursor: pointer;
  padding: 15px;
  border: 2px solid transparent;
  border-radius: 22px;
  color: #fff;
  background-color: #ec7533;
  background: linear-gradient(317deg, #ca622a 10%, #ec7533 100%);
  box-shadow: rgba(100, 100, 111, 0.5) 0px 7px 29px 0px;
  font-size: 15px;
  font-weight: bold;
  font-family: 'Open Sans', sans-serif;
  transition: 0.3s ease-in-out;
}

.modale form button:hover {
  border: 2px solid #ec7533;
  font-weight: bold;
  color: #ec7533;
  background: none;
  transition: 0.3s ease-in-out;
}

/* ON LITTLE SCREEN FOR LAPTOP */

@media (max-width: 1300px) {
  .bloc-modale {
    padding-left: 100px;
  }
  .modale {
    z-index: 5;
    width: 45%;
  }
}

/* ******************** */

/* ON TABLETTE */

@media (max-width: 1050px) {
  .bloc-modale {
    padding-left: 0;
  }
  .modale {
    z-index: 5;
    width: 50%;
  }
}

/* ******************** */

/* ON PHONE */

@media (max-width: 650px) {
  .modale {
    z-index: 5;
    width: 90%;
  }
}

/* ******************** */
</style>
