<template>
  <div v-if="revele" class="bloc-modale">
    <div class="modale">
      <button class="btn-modale" @click="toggle">
        <img class="icons" src="~/assets/uicons/svg/fi-rr-cross.svg" />
      </button>

      <form @submit.prevent="handleSubmitOrganisation">
        <h3>Créer votre Organisation</h3>
        <label>Nom de votre organisation</label>
        <input
          v-model="form.nom"
          type="text"
          placeholder="Nom de votre organisation"
          required
        />
        <label>Décrivez votre activitée</label>
        <textarea
          v-model="form.description"
          placeholder="Une description ?"
          name="message"
          required
        ></textarea>
        <label>Lien vers votre site</label>
        <input
          v-model="form.lienSite"
          type="text"
          placeholder="https://Neocracy.fr"
        />
        <button type="submit">Créer mon organisation</button>
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
      let response
      try {
        const userToken = this.$cookiz.get('userToken')
        response = await this.$api.organisation.postOrganisation(
          this.form,
          userToken
        )
      } catch (error) {
        console.error('error:', error)
      }
      try {
        const userInfo = JSON.parse(sessionStorage.getItem('userInfo'))
        userInfo.organisations =
          await this.$api.userdata.getOrganisationsFromUserId()
        userInfo.inOrg = true
        sessionStorage.setItem('userInfo', JSON.stringify(userInfo))
      } catch (error) {
        console.error('error:', error)
      }

      if (response === 200) this.$router.push('org')
    },
  },
}
</script>

<style scoped>
.icons {
  height: 18px;
}

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

.custom i {
  font-size: 18px;
  margin-right: 10px;
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
