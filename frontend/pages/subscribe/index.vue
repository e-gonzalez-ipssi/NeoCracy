<template>
  <div>
    <Nav :info="userInfo" />
    <NavTablet />
    <NavPhone />
    <div class="container">
      <section>
        <main v-for="org in organisations" id="main" :key="org.id">
          <div class="topBox">
            <div class="blockOne">
              <div class="neomorph">
                <div class="object"></div>
                <div class="object"></div>
                <div class="object"></div>
                <div class="object"></div>
              </div>
              <img src="https://source.unsplash.com/100x100/?work" />
            </div>
            <div class="blockTwo">
              <div class="top">
                <h5>{{ org.nom }}</h5>
                <p>{{ org.description }}</p>
              </div>
              <div class="bottom">
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
                  {{ org.lienSite }}
                </a>
              </div>
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
      reveleFormPost: false,
      organisations: [1],
      userInfo: {},
    }
  },
  fetch() {
    this.userInfo = JSON.parse(sessionStorage.getItem('userInfo'))
  },
  async mounted() {
    this.userInfo = JSON.parse(sessionStorage.getItem('userInfo'))
    this.organisations = await this.$api.organisation.getAllOrganisation()
    console.log('organisations:', this.organisations)
    try {
      this.userInfo = JSON.parse(sessionStorage.getItem('userInfo'))
      console.log(this.userInfo)
    } catch (error) {}
  },
}
</script>

<style scoped>
.container {
  margin: 0 auto;
  z-index: 1;
  display: flex;
  justify-content: center;
  padding-top: 120px;
  font-family: 'Open Sans', sans-serif;
}

.icons {
  height: 15px;
  fill: #333;
}

a {
  text-decoration: none;
}

section {
  display: flex;
  align-items: center;
  flex-direction: column;
  margin: 0 auto;
  width: 100%;
}

#main {
  width: 40%;
  margin-bottom: 20px;
  box-sizing: border-box;
  border-radius: 10px;
  background-color: rgba(0, 0, 0, 0.01);
  background-image: linear-gradient(315deg, rgba(0, 0, 0, 0.01) 30%, #fff 100%);
  box-shadow: 0px 1px 10px 0px rgba(144, 144, 144, 0.5);
  -moz-box-shadow: 0px 1px 10px 0px rgba(144, 144, 144, 0.5);
  -webkit-box-shadow: 0px 1px 10px 0px rgba(144, 144, 144, 0.5);
  overflow: hidden;
}

.topBox {
  display: flex;
  height: auto;
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
  height: 60px;
  width: 60px;
  right: 30px;
  top: 35px;
}

.topBox .neomorph .object:nth-child(2) {
  height: 60px;
  width: 60px;
  left: 120px;
  bottom: 50px;
}

.topBox .neomorph .object:nth-child(3) {
  height: 100px;
  width: 100px;
  left: 70px;
}

.topBox .neomorph .object:nth-child(4) {
  height: 70px;
  width: 70px;
  right: 0;
  bottom: 60px;
}

.topBox .blockOne {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 40%;
  background-color: #303030;
  background: linear-gradient(317deg, #303030 30%, #494949 100%);
  border-top-left-radius: 10px;
  border-bottom-left-radius: 10px;
}

.blockOne img {
  z-index: 4;
  height: 120px;
  width: 120px;
  border: 3px solid #ec7533;
  border-radius: 9999px;
}

.topBox .blockTwo {
  display: flex;
  flex-direction: column;
  width: 60%;
  height: auto;
  padding: 20px 30px;
}

.blockTwo .top h5 {
  margin-bottom: 10px;
  font-size: 25px;
  font-weight: bold;
  color: #424347;
}

.blockTwo .top p {
  margin-bottom: 10px;
  font-size: 17px;
  color: #424347;
}
</style>
