<template>
  <div>
    <header class="navLaptop">
      <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link
          rel="stylesheet"
          href="https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css"
        />
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link
          href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap"
          rel="stylesheet"
        />
        <title>Home</title>
      </head>
      <nav>
        <div class="navLeft">
          <h1>Neocracy<span>.</span></h1>
          <ul>
            <h2>Menu</h2>

            <li>
              <NuxtLink to="/home">
                <div></div>
                <i class="fi-rr-home"></i><span>Accueil</span>
              </NuxtLink>
            </li>
            <li>
              <NuxtLink to="/profil">
                <div></div>
                <i class="fi-rr-user"></i><span>Mon profil</span>
              </NuxtLink>
            </li>
            <li>
              <NuxtLink to="/org">
                <div></div>
                <i class="fi-rr-bank"></i><span>Mon organisation</span>
              </NuxtLink>
            </li>
            <li>
              <NuxtLink to="/subscribe">
                <div></div>
                <i class="fi-rr-following"></i><span>Mes abonnements</span>
              </NuxtLink>
            </li>
          </ul>
          <ul>
            <h2>Général</h2>

            <li>
              <NuxtLink to="/contact">
                <div></div>
                <i class="fi-rr-following"></i><span>Nous contacter</span>
              </NuxtLink>
            </li>
            <li>
              <NuxtLink to="/parametre">
                <div></div>
                <i class="fi-rr-following"></i><span>Mes paramètres</span>
              </NuxtLink>
            </li>
            <li>
              <a @click="onLogout">
                <div></div>
                <i class="fi-rr-power"></i><span>Déconnexion</span>
              </a>
            </li>
          </ul>

          <!-- <div class="footer">
            <i class="fi-rr-copyright"></i><i class="fi-rr-incognito"></i
            ><i class="fi-rr-bell-ring"></i>
          </div> -->
        </div>
        <div class="navTop">
          <div class="navBox1">
            <div class="arrows">
              <NuxtLink to="/home"><img src="@/assets/logo.svg" /></NuxtLink>
            </div>
            <div class="search">
              <a href="#"><i class="loupe fi-rr-search"></i></a>
              <input type="text" placeholder="Rechercher..." />
            </div>
          </div>
          <div class="navBox2">
            <h3>
              {{ info.prenom }} {{ info.nom }}<br />
              <small>Neocracy</small>
            </h3>
            <img src="https://via.placeholder.com/150" />
          </div>
        </div>
        <div class="navRight">
          <a href="#"
            ><div id="more"><i class="fi-rr-plus"></i></div
          ></a>
          <div><img src="https://via.placeholder.com/150" /></div>
          <div><img src="https://via.placeholder.com/150" /></div>
          <div><img src="https://via.placeholder.com/150" /></div>
          <div><img src="https://via.placeholder.com/150" /></div>
          <div><img src="https://via.placeholder.com/150" /></div>
        </div>
      </nav>
    </header>
  </div>
</template>

<script>
export default {
  name: 'Nav',
  props: {
    info: { type: Object, required: true },
  },
  methods: {
    async onLogout() {
      const userToken = 'userToken=' + this.$cookiz.get('userToken')
      await this.$api.auth.logout(userToken)
      this.$router.push('/')
    },
  },
}
</script>

<style>
@media (max-width: 1340px) {
  .navTop .navBox2 h3,
  .navTop .navBox2 small {
    display: none;
  }
}

@media (max-width: 1190px) {
  .navTop .navBox2 img {
    display: none;
  }
}

@media (min-width: 1050px) {
  .navLaptop {
    display: block;
  }

  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  .navLaptop {
    position: fixed;
    z-index: 5;
    font-family: 'Open Sans', sans-serif;
    background: transparent;
  }

  .navTop {
    position: fixed;
    z-index: 1;
    height: 100px;
    width: 100%;
    display: flex;
    align-items: center;
    padding-left: 300px;
    padding-right: 120px;
    box-sizing: border-box;
    background-color: #fff;
    border-bottom: rgba(0, 0, 0, 0.1) 1px solid;
  }

  .navTop a {
    text-decoration: none;
  }

  .navBox1 {
    position: relative;
    width: 100%;
    height: 100px;
    display: flex;
    box-sizing: border-box;
    align-items: center;
    font-size: 30px;
  }

  .navBox1 img {
    width: 60px;
    margin-top: 10px;
    margin-left: 30px;
    color: #ec7533;
  }

  .navBox1 img:hover {
    color: #424347;
  }

  .navBox1 .search {
    position: absolute;
    left: 125px;
  }

  .navBox1 .loupe {
    z-index: 2;
    position: absolute;
    left: 20px;
    top: 15px;
    font-size: 20px;
    color: #424347;
  }

  .navBox1 input {
    position: relative;
    width: 100%;
    min-width: 500px;
    height: 50px;
    padding: 5px 20px 5px 50px;
    border-radius: 20px;
    border: none;
    background: #ddd;
    transition: 0.3s ease-in-out;
  }

  .navBox1 input::placeholder {
    font-family: 'Open Sans', sans-serif;
    font-weight: bold;
    font-size: 15px;
  }

  .navBox1 input:focus {
    border: 1px solid #aaaaaa;
    padding: 5px 20px 5px 55px;
    transition: 0.3s ease-in-out;
    outline: none;
  }

  .navBox2 {
    position: relative;
    width: 50%;
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    box-sizing: border-box;
    align-items: center;
  }

  .navBox2 img {
    margin-right: 30px;
    border-radius: 9999px;
    width: 60px;
    background: transparent;
    border: 2px solid #ec7533;
  }

  .navBox2 h3 {
    margin-right: 15px;
    color: #424347;
    font-weight: bold;
  }

  .navLeft {
    position: fixed;
    display: flex;
    align-items: center;
    flex-direction: column;
    z-index: 2;
    width: 300px;
    height: 100%;
    background-color: #fff;
    box-sizing: border-box;
    border-right: rgba(0, 0, 0, 0.1) 1px solid;
  }

  .navLeft h1 {
    display: flex;
    justify-content: center;
    margin-top: 20px;
    box-sizing: content-box;
    font-size: 40px;
    color: #424347;
  }

  .navLeft h1 span {
    font-size: 40px;
    color: #ec7533;
  }

  .navLeft h2 {
    margin: 50px 0 50px 0;
    font-size: 15px;
    font-weight: bold;
    color: #bbbbbb;
  }

  .navLeft ul {
    margin-left: 40px;
  }

  .navLeft ul li {
    display: flex;
    align-items: center;
    height: 50px;
    width: 250px;
    list-style: none;
    cursor: pointer;
  }

  .navLeft a {
    text-decoration: none;
  }

  .navLeft i {
    margin-right: 15px;
    font-size: 17px;
    color: #424347;
  }

  .navLeft li:hover i {
    color: #ec7533;
    font-weight: 900;
  }

  .navLeft a.nuxt-link-active i {
    color: #ec7533;
    font-weight: 900;
  }

  .navLeft li:hover div {
    position: absolute;
    left: 0;
    height: 25px;
    width: 6px;
    background-color: #ec7533;
    background: linear-gradient(317deg, #ec7533 30%, #ca622a 100%);
    border-radius: 999px;
  }

  .navLeft a.nuxt-link-active div {
    position: absolute;
    left: 0;
    height: 25px;
    width: 6px;
    background-color: #ec7533;
    background: linear-gradient(317deg, #ec7533 30%, #ca622a 100%);
    border-radius: 999px;
  }

  .navLeft span {
    font-weight: bold;
    font-size: 17px;
    color: #424347;
    padding-bottom: 5px;
  }

  .navLeft li:hover span {
    color: #ec7533;
    font-weight: bold;
  }

  .navLeft a.nuxt-link-active span {
    color: #ec7533;
    font-weight: bold;
  }

  .navLeft .footer {
    position: absolute;
    bottom: 30px;
    left: 30px;
    width: 80%;
    height: 100px;
    border-radius: 30px;
    background-color: #ec7533;
    background: linear-gradient(317deg, #ec7533 30%, #ca622a 100%);
    box-shadow: rgba(100, 100, 111, 0.5) 0px 7px 29px 0px;
  }

  .navRight {
    z-index: 2;
    position: fixed;
    right: 0;
    width: 120px;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 100px 20px 100px 20px;
    background-color: white;
    box-sizing: border-box;
    border-left: rgba(0, 0, 0, 0.1) 1px solid;
  }

  .navRight a {
    text-decoration: none;
  }

  .navRight #more {
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 25px;
    color: #fff;
    padding-top: 5px;
    background-color: #ec7533;
    background: linear-gradient(317deg, #ec7533 30%, #ca622a 100%);
    border: transparent;
  }

  .navRight div {
    width: 65px;
    height: 65px;
    margin: auto;
    border-radius: 9999px;
  }

  .navRight img {
    display: flex;
    width: 65px;
    height: 65px;
    border-radius: 9999px;
  }
}

@media (max-width: 1050px) {
  .navLaptop {
    display: none;
  }
}
</style>
