<template>
  <div>
    <Nav :info="userInfo" />
    <NavTablet />
    <NavPhone />
    <div class="container">
      <section>
        <main id="main">
          <div class="topBox">
            <h1>Soon !</h1>
            <img src="@/assets/illustrationsContact.svg" />
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
</style>
