<template>
  <div>
    <header class="navTablet">
      <nav class="topNavTablet">
        <ul>
          <div class="leftNavTablet">
            <NuxtLink to="/home">
              <img src="@/assets/logo.svg" alt="logo" />
            </NuxtLink>
            <h1>Neocracy<span>.</span></h1>
          </div>
          <div class="midNavTablet">
            <i class="loupe fi-rr-search"></i>
            <input type="text" placeholder="Rechercher" />
          </div>
          <div class="rightNavTablet">
            <h3>Louis</h3>
            <button onclick="myFunction()" class="dropbtn">
              <i class="fi-rr-caret-down"></i>
            </button>
            <div class="dropdown">
              <div id="myDropdown" class="select">
                <a href="#">
                  <i class="fi-rr-settings"></i><span>Paramètres</span>
                </a>
                <a href="#">
                  <i class="fi-rr-power"></i><span>Déconnexion</span>
                </a>
              </div>
            </div>
            <img src="https://via.placeholder.com/150" alt="Photo de profil" />
          </div>
        </ul>
      </nav>
      <nav class="bottomNav">
        <li>
          <NuxtLink to="/home">
            <div></div>
            <i class="fi-rr-home"></i><span>Acceuil</span>
          </NuxtLink>
        </li>
        <li>
          <NuxtLink to="/org">
            <div></div>
            <i class="fi-rr-bank"></i><span>Organisation</span>
          </NuxtLink>
        </li>
        <ModalFormPost
          :revele="reveleFormPost"
          :toggle-modale-form-post="toggleModaleFormPost"
        ></ModalFormPost>
        <li @click="toggleModaleFormPost">
          <div></div>
          <i class="fi-rr-pencil"></i><span>Publier</span>
        </li>
        <li>
          <NuxtLink to="/subscribe">
            <div></div>
            <i class="fi-rr-following"></i><span>Réseaux</span>
          </NuxtLink>
        </li>
        <li>
          <NuxtLink to="/profil">
            <div></div>
            <i class="fi-rr-user"></i><span>Profil</span>
          </NuxtLink>
        </li>
      </nav>
    </header>
    <script>
      function myFunction() {
        var toggle = document.getElementById('myDropdown')
        toggle.classList.toggle('show')
      }
    </script>
  </div>
</template>

<script>
import ModalFormPost from '@/components/Modals/Forms/ModalFormPost'
export default {
  components: {
    ModalFormPost,
  },
  data() {
    return {
      reveleFormPost: false,
    }
  },
  methods: {
    toggleModaleFormPost() {
      this.reveleFormPost = !this.reveleFormPost
    },
  },
}
</script>

<style>
@media (min-width: 300px) {
  .navTablet {
    display: none;
  }
}

@media (min-width: 650px) {
  .navTablet {
    display: block;
  }

  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    list-style: none;
    text-decoration: none;
  }

  .navTablet {
    z-index: 5;
    position: fixed;
    background: transparent;
    width: 100%;
    font-family: 'Open Sans', sans-serif;
  }

  .topNavTablet {
    position: fixed;
    top: 0;
    z-index: 1;
    height: 50px;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 20px;
    box-sizing: border-box;
    background-color: #fff;
    border-bottom: rgba(0, 0, 0, 0.1) 1px solid;
  }

  .topNavTablet ul {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .topNavTablet ul .leftNav {
    width: 30%;
  }

  .topNavTablet ul .midNav {
    width: 40%;
  }

  .topNavTablet ul .rightNav {
    width: 30%;
  }

  /******************/

  /* TOP LEFT NAV */

  .leftNavTablet {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .leftNavTablet img {
    height: 50px;
    width: 50px;
  }

  .leftNavTablet h1 {
    display: flex;
    justify-content: center;
    margin-left: 10px;
    font-size: 20px;
    color: #424347;
  }

  .leftNavTablet h1 span {
    color: #ec7533;
  }

  /******************/

  /* TOP MID NAV  */

  .midNavTablet {
    width: 80%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: auto;
  }

  .midNavTablet i {
    position: relative;
    z-index: 2;
    left: 30px;
    padding-top: 2px;
    font-size: 15px;
    color: #424347;
  }

  .midNavTablet input {
    position: relative;
    width: 80%;
    height: auto;
    padding: 5px 20px 5px 40px;
    border-radius: 20px;
    border: none;
    background: #ddd;
    transition: 0.2s ease-in-out;
  }

  .midNavTablet input::placeholder {
    font-family: 'Open Sans', sans-serif;
    font-size: 12px;
    color: #424347;
  }

  .midNavTablet input:focus {
    border: 1px solid #424347;
    padding: 5px 20px 5px 45px;
    transition: 0.2s ease-in-out;
    outline: none;
  }

  /******************/

  /* TOP RIGHT NAV */

  .rightNavTablet {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .rightNavTablet h3 {
    font-size: 15px;
    color: #424347;
    margin-right: 15px;
  }

  .dropdown {
    display: inline-block;
    margin-right: 15px;
  }

  .dropbtn {
    font-size: 15px;
    padding-top: 5px;
    border: none;
    background: #fff;
    fill: #424347;
  }

  .select {
    display: none;
    position: absolute;
    top: 50px;
    right: 40px;
    background: #fff;
    border-radius: 5px;
    z-index: 1;
    border: rgba(0, 0, 0, 0.1) 1px solid;
  }

  .select a {
    padding: 10px;
    text-decoration: none;
    display: block;
  }

  .select span {
    margin-left: 5px;
    font-size: 13px;
    color: #424347;
  }

  .select a:active span,
  .select a:hover span {
    color: #ec7533;
  }

  .select i {
    padding-top: 5px;
    font-size: 10px;
    color: #424347;
    fill: #424347;
  }

  .select a:active i,
  .select a:hover i {
    color: #ec7533;
  }

  .show {
    display: block;
  }

  .rightNavTablet img {
    border-radius: 9999px;
    width: 40px;
    border: 2px solid #ec7533;
  }

  /******************/

  /********** BOTTOM NAV **********/

  .bottomNav {
    position: fixed;
    bottom: 0;
    z-index: 1;
    height: 50px;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 30px;
    box-sizing: border-box;
    background-color: #fff;
    border-top: rgba(0, 0, 0, 0.1) 1px solid;
  }

  .bottomNav li {
    height: 100%;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .bottomNav i {
    margin-right: 10px;
    font-size: 15px;
    color: #424347;
  }

  .bottomNav a.nuxt-link-active li:hover div,
  .bottomNav a.nuxt-link-active div {
    position: relative;
    bottom: 15px;
    height: 2px;
    width: 100%;
    background-color: #ec7533;
    background: linear-gradient(317deg, #ec7533 30%, #ca622a 100%);
  }

  .bottomNav li:hover i,
  .bottomNav a.nuxt-link-active i {
    color: #ec7533;
    font-weight: 900;
  }

  .bottomNav span {
    font-weight: bold;
    font-size: 15px;
    color: #424347;
    padding-bottom: 5px;
  }

  .bottomNav li:hover span,
  .bottomNav a.nuxt-link-active span {
    color: #ec7533;
    font-weight: bold;
  }
}

@media (min-width: 1050px) {
  .navTablet {
    display: none;
  }
}
</style>
