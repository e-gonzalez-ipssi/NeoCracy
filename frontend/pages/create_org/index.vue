<template>
  <div>
    <Nav :info="userInfo" />
    <NavTablet />
    <NavPhone />
    <div class="container">
      <section>
        <main id="main">
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
        </main>
      </section>
    </div>
  </div>
</template>

<script>
import Nav from '@/components/Nav/Nav'
import NavPhone from '@/components/Nav/NavPhone'
import NavTablet from '@/components/Nav/NavTablet'
export default {
  components: {
    Nav,
    NavPhone,
    NavTablet,
  },
  data() {
    return {
      userInfo: {},
      form: {
        nom: 'google',
        description: 'GOOGLE',
        lienSite: 'https://google.fr',
      },
    }
  },
  mounted() {
    this.userInfo = JSON.parse(sessionStorage.getItem('userInfo'))
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
.container {
  margin: 0 auto;
  width: 100%;
  z-index: 1;
  display: flex;
  justify-content: center;
  flex-direction: column;
  padding-top: 120px;
  font-family: 'Open Sans', sans-serif;
}

a {
  text-decoration: none;
}

section {
  display: flex;
  flex-direction: column;
  margin: 0 auto;
  width: 50%;
}

#main {
  box-sizing: border-box;
  width: 100%;
  border-radius: 10px;
  background-color: rgba(0, 0, 0, 0.01);
  background-image: linear-gradient(315deg, rgba(0, 0, 0, 0.01) 30%, #fff 100%);
  box-shadow: 0px 1px 10px 0px rgba(144, 144, 144, 0.5);
  -moz-box-shadow: 0px 1px 10px 0px rgba(144, 144, 144, 0.5);
  -webkit-box-shadow: 0px 1px 10px 0px rgba(144, 144, 144, 0.5);
}
</style>
