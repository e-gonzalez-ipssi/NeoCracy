<template>
  <div>
    <Nav :info="userInfo" />
    <NavTablet />
    <NavPhone />
    <div class="container">
      <section>
        <main id="main">
          <div class="topBox">
            <div class="blockOne">
              <img
                v-if="userInfo.organisations"
                :src="
                  userInfo.organisations[0].image ||
                  'https://via.placeholder.com/150'
                "
                alt=" no image found"
              />
              <img
                v-else
                :src="'https://via.placeholder.com/150'"
                alt=" no image found"
              />
            </div>
          </div>
          <div class="midBox">
            <div class="blockOne">
              <div class="author">
                <h5 v-if="userInfo.organisations">
                  {{ userInfo.organisations[0].nom }}
                </h5>

                <h5 v-else>Pas d'organisation</h5>

                <p v-if="userInfo.organisations">
                  Lien du site :
                  <a target="_blank" :href="userInfo.organisations[0].lienSite">
                    {{ userInfo.organisations[0].lienSite }}</a
                  >
                </p>
                <p v-else>No lien site</p>

                <p v-if="userInfo.organisations">
                  Description : {{ userInfo.organisations[0].description }}
                </p>
                <p v-else>No description org</p>
              </div>
            </div>
            <div v-if="!userInfo.organisations" class="blockTwo">
              <button type="button" @click="toggleModalFormOrganisation">
                Créer organisation
              </button>
            </div>
            <div v-else class="blockTwo">
              <main>
                <div class="blockOne">
                  <div class="author">
                    <h3>Les membres :</h3>
                    <table>
                      <tr>
                        <th>Nom</th>
                        <th>Rôle</th>
                      </tr>
                      <tr v-for="member in members" :key="member.id">
                        <td>{{ member.mail }}</td>
                        <td v-if="member[0].isAdmin">Administrateur</td>
                        <td v-else>Membre</td>
                      </tr>
                    </table>
                  </div>
                </div>
              </main>
              <div
                v-if="userInfo.mail === admin[0].mail"
                @click="toggleModaleFormAddUserOrganisation"
              >
                <button type="button">Ajouter</button>
              </div>
              <div v-else></div>
            </div>
          </div>
          <div class="bottomBox">
            <div class="blockOne"></div>
            <div class="blockTwo"></div>
            <div class="blockThree"></div>
          </div>
        </main>
        <ModalFormOrganisation
          :revele="reveleFormOrganisation"
          :toggle="toggleModalFormOrganisation"
        />
        <ModalFormAddUserOrganisation
          :revele="reveleFormAddUserOrganisation"
          :toggle="toggleModaleFormAddUserOrganisation"
        />
      </section>
    </div>
  </div>
</template>

<script>
import Nav from '@/components/Nav/Nav'
import NavPhone from '@/components/Nav/NavPhone'
import NavTablet from '@/components/Nav/NavTablet'
import ModalFormOrganisation from '@/components/Modals/Forms/ModalFormOrganisation'
import ModalFormAddUserOrganisation from '@/components/Modals/Forms/ModalFormAddUserOrganisation'

export default {
  components: {
    Nav,
    NavPhone,
    NavTablet,
    ModalFormOrganisation,
    ModalFormAddUserOrganisation,
  },
  filters: {
    ifInArray(value) {
      return this.members[0].includes(value) > -1 ? 'Yes' : 'No'
    },
  },
  data() {
    return {
      reveleFormOrganisation: false,
      reveleFormAddUserOrganisation: false,
      userInfo: {},
      members: [],
      admin: [],
    }
  },
  async mounted() {
    this.members = await this.$api.organisation.getMembersOrganisation()
    this.admin = await this.$api.organisation.getAdminOrganisation()
    try {
      this.userInfo = JSON.parse(sessionStorage.getItem('userInfo'))
      console.log(this.userInfo)
    } catch (error) {}
  },
  methods: {
    toggleModalFormOrganisation() {
      this.reveleFormOrganisation = !this.reveleFormOrganisation
    },
    toggleModaleFormAddUserOrganisation() {
      this.reveleFormAddUserOrganisation = !this.reveleFormAddUserOrganisation
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

.topBox {
  display: flex;
  justify-content: center;
  padding: 20px 30px;
  background-color: #303030;
  background: linear-gradient(317deg, #303030 30%, #494949 100%);
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
  color: #424347;
  font-weight: bold;
  font-size: 15px;
}

.topBox .blockOne {
  display: flex;
  justify-content: center;
}

.topBox img {
  width: 150px;
  border: 3px solid #00d699;
  border-radius: 9999px;
}

.midBox {
  display: flex;
  justify-content: center;
  padding: 20px 30px;
}

.midBox .blockOne,
.midBox .blockTwo {
  width: 50%;
}

.midBox .blockOne {
  display: flex;
  justify-content: flex-start;
  align-items: center;
}

.midBox .author {
  text-align: left;
}

.midBox .author h5 {
  font-size: 25px;
  font-weight: bold;
  color: #424347;
}

.midBox .author p {
  margin-top: 5px;
  font-size: 15px;
  color: #424347;
}

.midBox .blockTwo {
  display: flex;
  justify-content: flex-end;
  align-items: center;
}

.midBox .blockTwo button {
  height: 50px;
  width: 200px;
  color: #fff;
  font-size: 16px;
  font-weight: bold;
  border-radius: 20px;
  border-style: none;
  transition: 0.1s ease-in-out;
  background-color: #00d699;
  background: linear-gradient(317deg, #00d699 30%, #00eeaa 100%);
}

.midBox .blockTwo button:hover {
  color: #00d699;
  background: transparent;
  border: 2px solid #00d699;
  transition: 0.1s ease-in-out;
}
.midBox .blockTwo button i {
  padding-top: 5px;
}

.bottomBox {
  display: flex;
  justify-content: space-around;
  align-items: center;
  padding: 15px 30px 30px 30px;
  color: #424347;
  font-weight: bold;
  font-size: 15px;
}

.bottomBox .blockOne,
.bottomBox .blockTwo,
.bottomBox .blockThree {
  display: flex;
}

.bottomBox .hr {
  height: 30px;
  width: 1px;
  background: #757588;
}

.bottomBox i {
  margin-top: 2px;
}

.bottomBox p {
  margin-left: 10px;
}
</style>
