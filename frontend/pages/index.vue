<template>
  <div>
    <div class="container">
      <header>
        <nav>
          <ul>
            <li><img src="@/assets/logo.svg" alt="logo" /></li>
            <li>
              <h2>Neocracy<span>.</span></h2>
            </li>
          </ul>
          <ul>
            <li>
              <a href="#" class="link" @click="toggleModaleFormLogin"
                >Se connecter
                <div id="underline"></div
              ></a>
            </li>
            <li>
              <a href="#" class="btn" @click="toggleModaleFormRegister"
                >S'inscrire</a
              >
            </li>
          </ul>
        </nav>
      </header>
      <ModalFormRegister
        :revele="reveleFormRegister"
        :toggle="toggleModaleFormRegister"
      />

      <ModalFormLogin
        :revele="reveleFormLogin"
        :toggle="toggleModaleFormLogin"
      />

      <main>
        <section>
          <h1>Une sphère dédiée aux entreprises</h1>
          <p>
            <strong>Neocracy</strong> est un réseau social qui permet
            <strong>d'échanger entre professionels</strong> afin d'élargir leur
            visibilité sur le web.
          </p>
          <a href="#" class="btn register" @click="toggleModaleFormRegister"
            >S'inscrire</a
          >
          <a href="#" class="link login" @click="toggleModaleFormLogin"
            >Se connecter
            <div id="underline"></div
          ></a>
          <small>N'hésitez plus, rejoignez-nous !</small>
        </section>
        <section>
          <img src="@/assets/illustrationsIndex.svg" alt="illustration" />
        </section>
      </main>
      <footer>
        <h5>&copy; Neocracy 2021</h5>
      </footer>
    </div>
  </div>
</template>

<script>
import ModalFormLogin from '@/components/Modals/Forms/ModalFormLogin'
import ModalFormRegister from '@/components/Modals/Forms/ModalFormRegister'

export default {
  components: {
    ModalFormLogin,
    ModalFormRegister,
  },
  data() {
    return {
      nom: 'Gonzalez',
      prenom: 'Esteban',
      mailRegister: 'test@test.com',
      passwordRegister: '0123456Az',
      confirmPassword: '0123456Az',
      emailLogin: 'test@test.com',
      passwordLogin: '0123456Az',
      reveleFormLogin: false,
      reveleFormRegister: false,
    }
  },

  methods: {
    toggleModaleFormLogin() {
      this.reveleFormLogin = !this.reveleFormLogin
    },
    toggleModaleFormRegister() {
      this.reveleFormRegister = !this.reveleFormRegister
    },
    async onLogout() {
      const userToken = 'userToken=' + this.$cookiz.get('userToken')
      await this.$api.auth.logout(userToken)
    },
  },
}
</script>

<style scoped>
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  list-style: none;
  text-decoration: none;
  font-family: 'Open Sans', sans-serif;
  color: #333;
}

body {
  background-image: linear-gradient(315deg, rgba(0, 0, 0, 0.01) 30%, #fff 100%);
}

.container {
  width: 100%;
  height: auto;
  margin: auto;
}

header {
  width: 100%;
}

nav {
  width: 80%;
  height: 80px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin: auto;
}

header nav ul {
  display: flex;
  justify-content: center;
  align-items: center;
}

header nav ul:nth-child(1) {
  display: flex;
  justify-content: flex-start;
}

header nav ul:nth-child(2) {
  display: flex;
  justify-content: flex-end;
}

header nav img {
  width: 60px;
}

header nav h2 {
  display: flex;
  justify-content: center;
  margin-left: 20px;
  font-size: 40px;
  color: #424347;
}

header nav h2 span {
  font-size: 40px;
  color: #ec7533;
}

nav ul:nth-child(2) li {
  width: 125px;
}

ul li a {
  font-size: 17px;
}

.link {
  color: #333;
  cursor: pointer;
}

.link:hover #underline {
  background: #ec7533;
  height: 2px;
  width: 105px;
  animation: all, underline 0.5s;
}

@keyframes underline {
  0% {
    width: 0px;
  }

  100% {
    width: 105px;
  }
}

.btn {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 50px;
  width: 200px;
  padding: 10px 20px;
  text-align: center;
  color: #fff;
  border-radius: 20px;
  border-style: none;
  transition: all, 0.1s ease-in-out;
  background-color: #ec7533;
  cursor: pointer;
}

.btn:hover {
  color: #ec7533;
  background: transparent;
  border: 2px solid #ec7533;
  transition: all, 0.1s ease-in-out;
}

.login {
  margin-top: 15px;
  margin-bottom: 15px;
  display: none;
  border-bottom: 2px solid #ec7533;
}

main {
  width: 80%;
  height: auto;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 100px 0;
  margin: auto;
}

main section:nth-child(1) {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  width: 100%;
}

main section:nth-child(1) h1 {
  text-align: left;
  font-size: 90px;
  font-family: none;
  margin-bottom: 30px;
}

main section:nth-child(1) p {
  text-align: left;
  font-size: 20px;
  margin-bottom: 50px;
}

main section:nth-child(1) a.register {
  width: 300px;
}

main section:nth-child(1) small {
  margin-top: 10px;
  font-weight: bold;
  font-size: 13px;
}

main section:nth-child(2) {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
}

main section:nth-child(2) img {
  width: 90%;
  margin: auto;
}

footer {
  position: fixed;
  bottom: 10px;
  display: flex;
  justify-content: center;
  width: 100%;
  text-align: center;
  font-size: 20px;
}

@media (max-width: 1050px) {
  header nav ul:nth-child(2) {
    display: none;
  }

  header nav ul:nth-child(1) {
    width: 100%;
    justify-content: center;
  }

  #underline {
    display: none;
  }

  main {
    justify-content: none;
    align-items: none;
    flex-direction: column;
    width: 100%;
  }

  main section:nth-child(1) h1 {
    text-align: center;
    font-size: 70px;
    margin-bottom: 15px;
  }

  main section:nth-child(1) p {
    text-align: center;
    font-size: 15px;
    margin-bottom: 25px;
  }

  main section:nth-child(2) img {
    margin-top: 50px;
    width: 90%;
  }

  .login {
    display: block;
  }
}

@media (max-width: 650px) {
  main {
    flex-direction: column;
    width: 100%;
  }

  section {
    width: 100%;
  }

  main section:nth-child(1) h1 {
    font-size: 50px;
  }

  main section:nth-child(2) img {
    margin-top: 25px;
    width: 100%;
  }

  .login {
    display: block;
  }
}
</style>
