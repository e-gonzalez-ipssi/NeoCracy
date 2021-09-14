<template>
  <div>
    <Nav :info="userInfo" />
    <NavTablet />
    <NavPhone />
    <div class="container">
      <section>
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
              src="https://source.unsplash.com/100x100/?people"
              alt=" no image found"
            />
          </div>
          <div class="midBox">
            <div class="blockOne">
              <div class="author">
                <h5>{{ userInfo.prenom }} {{ userInfo.nom }}</h5>
                <p v-if="userInfo.organisations">
                  Membre de <strong>{{ userInfo.organisations[0].nom }}</strong>
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
    }
  },
  fetch() {
    this.userInfo = JSON.parse(sessionStorage.getItem('userInfo'))
  },
  beforeMount() {
    this.userInfo = JSON.parse(sessionStorage.getItem('userInfo'))
  },
  mounted() {
    this.userInfo = JSON.parse(sessionStorage.getItem('userInfo'))
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

.icons {
  height: 15px;
  fill: #333;
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
