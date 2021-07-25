<template>
  <div>
    <header class="navPhone">
      <nav class="topNav">
        <ul>
          <div class="leftNav">
            <i class="loupe fi-rr-search"></i>
            <input type="text" placeholder="Rechercher" />
          </div>
          <div class="rightNav">
            <button onclick="myFunctionTwo()" class="dropbtn">
              <i class="fi-rr-caret-down"></i>
            </button>
            <div class="dropdown">
              <div id="myDropdownTwo" class="select">
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
            <div><i class="fi-rr-home"></i><span>Acceuil</span></div>
          </NuxtLink>
        </li>
        <li>
          <NuxtLink to="/org">
            <div><i class="fi-rr-bank"></i><span>Organisation</span></div>
          </NuxtLink>
        </li>
        <li>
          <NuxtLink to="#">
            <div><i class="fi-rr-pencil"></i><span>Publier</span></div>
          </NuxtLink>
        </li>
        <li>
          <NuxtLink to="/subscribe">
            <div><i class="fi-rr-following"></i><span>Réseaux</span></div>
          </NuxtLink>
        </li>
        <li>
          <NuxtLink to="/profil">
            <div><i class="fi-rr-user"></i><span>Profil</span></div>
          </NuxtLink>
        </li>
      </nav>
    </header>
  </div>
</template>
<script>
export default {
  userInfo: {},
  fetch() {
    this.userInfo = JSON.parse(localStorage.getItem('userInfo'))
  },
  methods: {
    myFunctionTwo() {
      const toggle = document.getElementById('myDropdownTwo')
      toggle.classList.toggle('show')
    },
    async onLogout() {
      await this.$api.auth.logout(document.cookie)
      this.$router.push('/')
    },
  },
}
</script>

<style>
@media (min-width: 200px) {
  .navPhone {
    display: block;
  }

  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    list-style: none;
    text-decoration: none;
  }

  .navPhone {
    position: fixed;
    background: transparent;
    z-index: 5;
    width: 100%;
    height: 100vh;
    font-family: 'Open Sans', sans-serif;
  }

  .topNav {
    position: fixed;
    top: 0;
    z-index: 1;
    height: 50px;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 10px;
    box-sizing: border-box;
    background-color: #fff;
    border-bottom: rgba(0, 0, 0, 0.1) 1px solid;
  }

  .topNav ul {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .topNav ul .leftNav {
    width: 70%;
  }

  .topNav ul .rightNav {
    width: 30%;
  }

  /******************/

  /* TOP LEFT NAV */

  .leftNav {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .leftNav i {
    position: relative;
    z-index: 2;
    left: 30px;
    padding-top: 2px;
    font-size: 15px;
    color: #424347;
  }

  .leftNav input {
    position: relative;
    width: 100%;
    height: auto;
    padding: 5px 20px 5px 40px;
    border-radius: 20px;
    border: none;
    background: #ddd;
    transition: 0.2s ease-in-out;
  }

  .leftNav input::placeholder {
    font-family: 'Open Sans', sans-serif;
    font-size: 12px;
    color: #424347;
  }

  .leftNav input:focus {
    border: 1px solid #424347;
    padding: 5px 20px 5px 43px;
    transition: 0.2s ease-in-out;
    outline: none;
  }

  /******************/

  /* TOP RIGHT NAV */

  .rightNav {
    display: flex;
    justify-content: center;
    align-items: center;
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
    right: 20px;
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

  .rightNav img {
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
    padding: 0 5px;
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
    flex-direction: column;
  }

  .bottomNav li div {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .bottomNav i {
    font-size: 11px;
    color: #424347;
  }

  .bottomNav li:hover i,
  .bottomNav a.nuxt-link-active i {
    color: #ec7533;
    font-weight: 900;
  }

  .bottomNav span {
    font-weight: bold;
    font-size: 11px;
    color: #424347;
    padding-bottom: 5px;
  }

  .bottomNav li:hover span,
  .bottomNav a.nuxt-link-active span {
    color: #ec7533;
    font-weight: bold;
  }
}

@media (min-width: 650px) {
  .navPhone {
    display: none;
  }
}
</style>
