<template>
  <div>
    <header class="navLaptop">
      <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="@/assets/uicons/css/uicons.css" />
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link
          rel="stylesheet"
          href="https://cdn-uicons.flaticon.com/uicons-regular-straight/css/uicons-regular-straight.css"
        />
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
                <svg
                  class="icons"
                  xmlns="http://www.w3.org/2000/svg"
                  id="Outline"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M23.121,9.069,15.536,1.483a5.008,5.008,0,0,0-7.072,0L.879,9.069A2.978,2.978,0,0,0,0,11.19v9.817a3,3,0,0,0,3,3H21a3,3,0,0,0,3-3V11.19A2.978,2.978,0,0,0,23.121,9.069ZM15,22.007H9V18.073a3,3,0,0,1,6,0Zm7-1a1,1,0,0,1-1,1H17V18.073a5,5,0,0,0-10,0v3.934H3a1,1,0,0,1-1-1V11.19a1.008,1.008,0,0,1,.293-.707L9.878,2.9a3.008,3.008,0,0,1,4.244,0l7.585,7.586A1.008,1.008,0,0,1,22,11.19Z"
                  />
                </svg>
                <span>Accueil</span>
              </NuxtLink>
            </li>
            <li>
              <NuxtLink to="/profil">
                <div></div>
                <svg
                  class="icons"
                  xmlns="http://www.w3.org/2000/svg"
                  id="Outline"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M12,12A6,6,0,1,0,6,6,6.006,6.006,0,0,0,12,12ZM12,2A4,4,0,1,1,8,6,4,4,0,0,1,12,2Z"
                  />
                  <path
                    d="M12,14a9.01,9.01,0,0,0-9,9,1,1,0,0,0,2,0,7,7,0,0,1,14,0,1,1,0,0,0,2,0A9.01,9.01,0,0,0,12,14Z"
                  />
                </svg>
                <span>Mon profil</span>
              </NuxtLink>
            </li>
            <li>
              <NuxtLink to="/org">
                <div></div>
                <svg
                  class="icons"
                  id="Layer_1"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                  data-name="Layer 1"
                >
                  <path
                    d="m24 23a1 1 0 0 1 -1 1h-22a1 1 0 0 1 0-2h22a1 1 0 0 1 1 1zm-23.709-14.448a2.443 2.443 0 0 1 .153-2.566 4.716 4.716 0 0 1 1.668-1.5l7.501-3.904a5.174 5.174 0 0 1 4.774 0l7.5 3.907a4.716 4.716 0 0 1 1.668 1.5 2.443 2.443 0 0 1 .153 2.566 2.713 2.713 0 0 1 -2.416 1.445h-.292v8h1a1 1 0 0 1 0 2h-20a1 1 0 0 1 0-2h1v-8h-.292a2.713 2.713 0 0 1 -2.417-1.448zm4.709 9.448h3v-8h-3zm5-8v8h4v-8zm9 0h-3v8h3zm-16.937-2.375a.717.717 0 0 0 .645.375h18.584a.717.717 0 0 0 .645-.375.452.452 0 0 0 -.024-.5 2.7 2.7 0 0 0 -.949-.864l-7.5-3.907a3.176 3.176 0 0 0 -2.926 0l-7.5 3.907a2.712 2.712 0 0 0 -.949.865.452.452 0 0 0 -.026.499z"
                  /></svg
                ><span>Mon organisation</span>
              </NuxtLink>
            </li>
            <li>
              <NuxtLink to="/subscribe">
                <div></div>
                <svg
                  class="icons"
                  xmlns="http://www.w3.org/2000/svg"
                  id="Outline"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M9,12A6,6,0,1,0,3,6,6.006,6.006,0,0,0,9,12ZM9,2A4,4,0,1,1,5,6,4,4,0,0,1,9,2Z"
                  />
                  <path
                    d="M9,14a9.011,9.011,0,0,0-9,9,1,1,0,0,0,2,0,7,7,0,0,1,14,0,1,1,0,0,0,2,0A9.011,9.011,0,0,0,9,14Z"
                  />
                  <path
                    d="M22,7.875a2.107,2.107,0,0,0-2,2.2,2.107,2.107,0,0,0-2-2.2,2.107,2.107,0,0,0-2,2.2c0,1.73,2.256,3.757,3.38,4.659a.992.992,0,0,0,1.24,0c1.124-.9,3.38-2.929,3.38-4.659A2.107,2.107,0,0,0,22,7.875Z"
                  />
                </svg>
                <span>Suivre une Organisation</span>
              </NuxtLink>
            </li>
          </ul>
          <ul>
            <h2>Général</h2>

            <li>
              <NuxtLink to="/contact">
                <div></div>
                <svg
                  class="icons"
                  xmlns="http://www.w3.org/2000/svg"
                  id="Outline"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M12,0A12,12,0,1,0,24,12,12.013,12.013,0,0,0,12,0Zm0,22A10,10,0,1,1,22,12,10.011,10.011,0,0,1,12,22Z"
                  />
                  <path
                    d="M12.717,5.063A4,4,0,0,0,8,9a1,1,0,0,0,2,0,2,2,0,0,1,2.371-1.967,2.024,2.024,0,0,1,1.6,1.595,2,2,0,0,1-1,2.125A3.954,3.954,0,0,0,11,14.257V15a1,1,0,0,0,2,0v-.743a1.982,1.982,0,0,1,.93-1.752,4,4,0,0,0-1.213-7.442Z"
                  />
                  <rect x="11" y="17" width="2" height="2" rx="1" />
                </svg>

                <span>Nous contacter</span>
              </NuxtLink>
            </li>
            <li>
              <NuxtLink to="/parametre">
                <div></div>
                <svg
                  class="icons"
                  xmlns="http://www.w3.org/2000/svg"
                  id="Outline"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z"
                  />
                  <path
                    d="M21.294,13.9l-.444-.256a9.1,9.1,0,0,0,0-3.29l.444-.256a3,3,0,1,0-3-5.2l-.445.257A8.977,8.977,0,0,0,15,3.513V3A3,3,0,0,0,9,3v.513A8.977,8.977,0,0,0,6.152,5.159L5.705,4.9a3,3,0,0,0-3,5.2l.444.256a9.1,9.1,0,0,0,0,3.29l-.444.256a3,3,0,1,0,3,5.2l.445-.257A8.977,8.977,0,0,0,9,20.487V21a3,3,0,0,0,6,0v-.513a8.977,8.977,0,0,0,2.848-1.646l.447.258a3,3,0,0,0,3-5.2Zm-2.548-3.776a7.048,7.048,0,0,1,0,3.75,1,1,0,0,0,.464,1.133l1.084.626a1,1,0,0,1-1,1.733l-1.086-.628a1,1,0,0,0-1.215.165,6.984,6.984,0,0,1-3.243,1.875,1,1,0,0,0-.751.969V21a1,1,0,0,1-2,0V19.748a1,1,0,0,0-.751-.969A6.984,6.984,0,0,1,7.006,16.9a1,1,0,0,0-1.215-.165l-1.084.627a1,1,0,1,1-1-1.732l1.084-.626a1,1,0,0,0,.464-1.133,7.048,7.048,0,0,1,0-3.75A1,1,0,0,0,4.79,8.992L3.706,8.366a1,1,0,0,1,1-1.733l1.086.628A1,1,0,0,0,7.006,7.1a6.984,6.984,0,0,1,3.243-1.875A1,1,0,0,0,11,4.252V3a1,1,0,0,1,2,0V4.252a1,1,0,0,0,.751.969A6.984,6.984,0,0,1,16.994,7.1a1,1,0,0,0,1.215.165l1.084-.627a1,1,0,1,1,1,1.732l-1.084.626A1,1,0,0,0,18.746,10.125Z"
                  />
                </svg>
                <span>Mes paramètres</span>
              </NuxtLink>
            </li>
            <li>
              <a @click="onLogout">
                <div></div>
                <svg
                  class="icons"
                  xmlns="http://www.w3.org/2000/svg"
                  id="Outline"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M15,3.849h0a1.02,1.02,0,0,0,.629.926A9,9,0,0,1,21,13.292,9,9,0,0,1,3,13,9,9,0,0,1,8.371,4.776,1.023,1.023,0,0,0,9,3.848H9a1,1,0,0,0-1.374-.929,11,11,0,1,0,8.751,0A1,1,0,0,0,15,3.849Z"
                  />
                  <rect x="11" width="2" height="8" rx="1" />
                </svg>
                <span>Déconnexion</span>
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
              <a
                ><svg
                  class="loupe"
                  xmlns="http://www.w3.org/2000/svg"
                  id="Outline"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M23.707,22.293l-5.969-5.969a10.016,10.016,0,1,0-1.414,1.414l5.969,5.969a1,1,0,0,0,1.414-1.414ZM10,18a8,8,0,1,1,8-8A8.009,8.009,0,0,1,10,18Z"
                  />
                </svg>
              </a>
              <input type="text" placeholder="Rechercher..." />
            </div>
          </div>
          <div class="navBox2">
            <h3>
              {{ info.prenom }} {{ info.nom }}<br />
              <small v-if="info.organisations">{{
                info.organisations[0].nom
              }}</small>
            </h3>
            <img src="https://via.placeholder.com/150" />
          </div>
        </div>
        <div class="navRight">
          <a href="#"
            ><div id="more">
              <svg
                class="icons"
                xmlns="http://www.w3.org/2000/svg"
                id="Outline"
                viewBox="0 0 24 24"
              >
                <path
                  d="M23,11H13V1a1,1,0,0,0-1-1h0a1,1,0,0,0-1,1V11H1a1,1,0,0,0-1,1H0a1,1,0,0,0,1,1H11V23a1,1,0,0,0,1,1h0a1,1,0,0,0,1-1V13H23a1,1,0,0,0,1-1h0A1,1,0,0,0,23,11Z"
                />
              </svg></div
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
  mounted() {
    console.log(this.info)
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
/* @import url('https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'); */

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
    height: 20px;
    fill: #424347;
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

  .navLeft .icons {
    margin-right: 15px;
    height: 17px;
    fill: #424347;
  }

  .navLeft li:hover .icons {
    fill: #ec7533;
    font-weight: 900;
  }

  .navLeft a.nuxt-link-active .icons {
    fill: #ec7533;
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
    fill: #fff;
    padding-top: 5px;
    background-color: #ec7533;
    background: linear-gradient(317deg, #ec7533 30%, #ca622a 100%);
    border: transparent;
  }

  .navRight .icons {
    height: 25px;
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
