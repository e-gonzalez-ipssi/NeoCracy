<template>
  <div>
    <Nav :info="userInfo" />
    <NavTablet />
    <NavPhone />
    <div class="container">
      <section>
        <main id="main">
          <div class="topBox">
            <h1>Vos paramètres</h1>
            <img src="@/assets/illustrationsParamètres.svg" />
            <button type="button" @click="toggleModaleFormUser">
              Informations personnelles
            </button>
          </div>
          <div class="bottomBox">
            <div class="blockOne"></div>
            <div class="blockTwo"></div>
            <div class="blockThree"></div>
          </div>
        </main>

        <ModalFormUser
          :revele="reveleFormUser"
          :toggle="toggleModaleFormUser"
        />
      </section>
    </div>
  </div>
</template>

<script>
import Nav from '@/components/Nav/Nav'
import NavPhone from '@/components/Nav/NavPhone'
import NavTablet from '@/components/Nav/NavTablet'
import ModalFormUser from '@/components/Modals/Forms/ModalFormUser'

export default {
  components: {
    Nav,
    NavPhone,
    NavTablet,
    ModalFormUser,
  },
  data() {
    return {
      reveleFormUser: false,
      userInfo: {},
    }
  },
  beforeMount() {
    this.userInfo = JSON.parse(sessionStorage.getItem('userInfo'))
  },

  methods: {
    toggleModaleFormUser() {
      this.reveleFormUser = !this.reveleFormUser
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
  background: linear-gradient(315deg, rgba(0, 0, 0, 0.01) 30%, #fff 100%);
  box-shadow: 0px 1px 10px 0px rgba(144, 144, 144, 0.5);
  -moz-box-shadow: 0px 1px 10px 0px rgba(144, 144, 144, 0.5);
  -webkit-box-shadow: 0px 1px 10px 0px rgba(144, 144, 144, 0.5);
}

.topBox {
  padding: 20px 30px;
  display: flex;
  justify-content: center;
  align-content: center;
  flex-direction: column;
  width: 100%;
}

.topBox img {
  width: 80%;
}

.topBox h1 {
  margin-bottom: 20px;
  text-align: center;
  color: #333;
  font-size: 40px;
}

.topBox button {
  margin: auto;
  margin-top: 20px;
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

.topBox button:hover {
  color: #ec7533;
  background: transparent;
  border: 2px solid #ec7533;
  transition: 0.1s ease-in-out;
}
</style>
