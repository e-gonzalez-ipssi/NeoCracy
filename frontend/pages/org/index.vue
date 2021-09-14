<template>
  <div>
    <Nav :info="userInfo" />
    <NavTablet />
    <NavPhone />
    <div class="container">
      <section>
        <div v-if="!userInfo.organisations" id="noOrg">
          <div class="contentNoOrg">
            <h3>Oops!</h3>
            <img
              src="@/assets/illustrationsOrg.svg"
              alt="illustration no organisation"
            />
            <h5>
              Vous n'avez pas encore d'organisation,<br />
              faites-vous inviter ou bien créez en une.
            </h5>
            <button type="button" @click="toggleModalFormOrganisation">
              Créer sa propre organisation
            </button>
          </div>
        </div>
        <div v-else>
          <main id="main">
            <div class="topBox">
              <div class="neomorph">
                <div class="object"></div>
                <div class="object"></div>
                <div class="object"></div>
                <div class="object"></div>
                <div class="object"></div>
                <div class="object"></div>
              </div>
              <img
                v-if="userInfo.organisations"
                :src="
                  userInfo.organisations[0].image ||
                  'https://source.unsplash.com/100x100/?work'
                "
                alt=" no image found"
              />
            </div>
            <div class="midBox">
              <div class="blockOne">
                <div class="author">
                  <h5 v-if="userInfo.organisations">
                    {{ userInfo.organisations[0].nom }}
                  </h5>
                  <p v-if="userInfo.organisations">
                    {{ userInfo.organisations[0].description }}
                  </p>
                </div>
              </div>
              <div class="blockTwo">
                <p v-if="userInfo.organisations">
                  <a target="_blank" :href="userInfo.organisations[0].lienSite">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="icons"
                      viewBox="0 0 24 24"
                    >
                      <path
                        d="M13.845,17.267l-3.262,3.262A5.028,5.028,0,0,1,3.472,13.42l3.262-3.265A1,1,0,0,0,5.319,8.741L2.058,12.006A7.027,7.027,0,0,0,12,21.943l3.262-3.262a1,1,0,0,0-1.414-1.414Z"
                      />
                      <path
                        d="M21.944,2.061A6.979,6.979,0,0,0,16.975,0h0a6.983,6.983,0,0,0-4.968,2.057L8.74,5.32a1,1,0,0,0,1.414,1.415l3.265-3.262A4.993,4.993,0,0,1,16.973,2h0a5.028,5.028,0,0,1,3.554,8.583l-3.262,3.262A1,1,0,1,0,18.68,15.26L21.942,12A7.037,7.037,0,0,0,21.944,2.061Z"
                      />
                      <path
                        d="M14.293,8.293l-6,6a1,1,0,1,0,1.414,1.414l6-6a1,1,0,0,0-1.414-1.414Z"
                      />
                    </svg>
                    {{ userInfo.organisations[0].lienSite }}
                  </a>
                </p>
              </div>
            </div>
          </main>
          <main id="main2">
            <div class="cardOne">
              <div class="blockOne">
                <h5>Post récent</h5>
              </div>
              <div class="hr"></div>
            </div>
            <div class="cardTwo">
              <div class="blockOne">
                <h5>
                  Membres de
                  <strong>{{ userInfo.organisations[0].nom }}</strong>
                </h5>
                <div
                  v-if="userInfo.mail === admin[0].mail"
                  @click="toggleModaleFormAddUserOrganisation"
                >
                  <button type="button">
                    <svg
                      class="iconPlus"
                      xmlns="http://www.w3.org/2000/svg"
                      id="Outline"
                      viewBox="0 0 24 24"
                    >
                      <path
                        d="M23,11H13V1a1,1,0,0,0-1-1h0a1,1,0,0,0-1,1V11H1a1,1,0,0,0-1,1H0a1,1,0,0,0,1,1H11V23a1,1,0,0,0,1,1h0a1,1,0,0,0,1-1V13H23a1,1,0,0,0,1-1h0A1,1,0,0,0,23,11Z"
                      />
                    </svg>
                  </button>
                </div>
              </div>
              <div class="hr"></div>
              <div class="blockTwo">
                <div v-for="member in members" :key="member.id">
                  <div class="flex">
                    <div>
                      <h6>{{ member.nom }} {{ member.prenom }}</h6>
                      <small>{{ member.mail }}</small>
                    </div>
                    <div>
                      <p v-if="member[0].isAdmin">Créateur</p>
                      <p v-else>Membre</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </main>
        </div>
      </section>
    </div>
    <ModalFormOrganisation
      :revele="reveleFormOrganisation"
      :toggle="toggleModalFormOrganisation"
    />
    <ModalFormAddUserOrganisation
      :revele="reveleFormAddUserOrganisation"
      :toggle="toggleModaleFormAddUserOrganisation"
    />
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
  color: #333;
  font-family: 'Open Sans', sans-serif;
}

.icons {
  height: 15px;
  fill: #333;
}

.iconPlus {
  height: 16px;
  fill: #fff;
}

a {
  text-decoration: none;
  color: #0077ff;
}

section {
  display: flex;
  flex-direction: column;
  margin: 0 auto;
  width: 50%;
}

#noOrg {
  box-sizing: border-box;
  width: 100%;
  border-radius: 10px;
  background-color: rgba(0, 0, 0, 0.01);
  background-image: linear-gradient(315deg, rgba(0, 0, 0, 0.01) 30%, #fff 100%);
  box-shadow: 0px 1px 10px 0px rgba(144, 144, 144, 0.5);
  -moz-box-shadow: 0px 1px 10px 0px rgba(144, 144, 144, 0.5);
  -webkit-box-shadow: 0px 1px 10px 0px rgba(144, 144, 144, 0.5);
}

.contentNoOrg {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  width: 100%;
  height: 100%;
  padding: 20px 30px;
  color: #333;
}

.contentNoOrg h3 {
  text-align: center;
  font-size: 40px;
  margin-bottom: 30px;
}

.contentNoOrg h5 {
  text-align: center;
  font-size: 18px;
  margin-bottom: 30px;
}

.contentNoOrg img {
  width: 40%;
  margin-bottom: 30px;
}

.contentNoOrg button {
  cursor: pointer;
  height: 50px;
  width: 450px;
  color: #fff;
  font-size: 16px;
  font-weight: bold;
  border-radius: 20px;
  border-style: none;
  transition: all, 0.1s ease-in-out;
  background-color: #ec7533;
  background: linear-gradient(317deg, #ca622a 10%, #ec7533 100%);
}

.contentNoOrg button:hover {
  color: #ec7533;
  background: transparent;
  border: 2px solid #ec7533;
  transition: 0.1s ease-in-out;
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
  overflow: hidden;
}

.topBox .neomorph {
  position: relative;
  z-index: 3;
}

.topBox .neomorph .object {
  position: absolute;
  transform: rotate(135deg);
  border-radius: 15%;
  background: #303030;
  box-shadow: inset 18px 18px 43px #1f1f1f, inset -18px -18px 43px #474747;
}

.topBox .neomorph .object:nth-child(1) {
  height: 200px;
  width: 200px;
  right: 250px;
}

.topBox .neomorph .object:nth-child(2) {
  height: 185px;
  width: 185px;
  top: 0;
  left: 50px;
}

.topBox .neomorph .object:nth-child(3) {
  height: 60px;
  width: 60px;
  left: 300px;
}

.topBox .neomorph .object:nth-child(4) {
  height: 40px;
  width: 40px;
  right: 50px;
  bottom: 0;
}

.topBox .neomorph .object:nth-child(5) {
  height: 100px;
  width: 100px;
  bottom: 80px;
  right: 80px;
}

.topBox .neomorph .object:nth-child(6) {
  height: 80px;
  width: 80px;
  left: 400px;
  top: 50px;
}

.topBox img {
  z-index: 4;
  width: 150px;
  border: 3px solid #ec7533;
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

.midBox .blockOne .author {
  text-align: left;
}

.midBox .author h5 {
  margin-bottom: 10px;
  font-size: 25px;
  font-weight: bold;
  color: #424347;
}

.midBox .author p {
  margin-top: 5px;
  font-size: 17px;
}

.midBox .blockTwo {
  display: flex;
  justify-content: flex-end;
  align-items: center;
}

#main2 {
  box-sizing: border-box;
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-content: center;
}

.cardOne,
.cardTwo {
  margin-top: 50px;
  box-sizing: border-box;
  width: 48%;
  padding: 20px 30px;
  border-radius: 10px;
  background-color: rgba(0, 0, 0, 0.01);
  background-image: linear-gradient(315deg, rgba(0, 0, 0, 0.01) 30%, #fff 100%);
  box-shadow: 0px 1px 10px 0px rgba(144, 144, 144, 0.5);
  -moz-box-shadow: 0px 1px 10px 0px rgba(144, 144, 144, 0.5);
  -webkit-box-shadow: 0px 1px 10px 0px rgba(144, 144, 144, 0.5);
}

.cardOne .blockOne {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%;
  margin-bottom: 10px;
}

.cardOne .blockOne h5 {
  font-size: 25px;
}

.cardOne .hr {
  width: 100%;
  height: 1px;
  background: #333;
}

.cardTwo .blockOne {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%;
  margin-bottom: 10px;
}

.cardTwo .blockOne h5 {
  font-size: 25px;
}

.cardTwo .blockOne button {
  cursor: pointer;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 5px;
  color: #fff;
  font-size: 16px;
  font-weight: bold;
  border-radius: 20px;
  border-style: none;
  transition: all, 0.5s ease-in-out;
  border: 2px solid #fff;
  background-color: #ec7533;
  background: linear-gradient(317deg, #ca622a 10%, #ec7533 100%);
}

.cardTwo .blockOne button:hover {
  border: 2px solid #333;
  transition: 0.5s ease-in-out;
}

.cardTwo .hr {
  width: 100%;
  height: 1px;
  background: #333;
}

.cardTwo .blockTwo {
  width: 100%;
  margin-top: 10px;
}

.cardTwo .blockTwo .flex {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.cardTwo .blockTwo .flex div {
  display: flex;
  justify-content: flex-start;
  flex-direction: column;
}

.cardTwo .blockTwo h6 {
  font-size: 15px;
  text-align: left;
}

.cardTwo .blockTwo small {
  font-size: 12px;
  text-align: left;
  color: #494949;
}

.cardTwo .blockTwo p {
  font-size: 15px;
  text-align: left;
}
</style>
