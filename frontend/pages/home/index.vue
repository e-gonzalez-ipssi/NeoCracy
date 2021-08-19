<template>
  <div>
    <Nav :info="userInfo" />
    <NavTablet />
    <NavPhone />
    <div class="container">
      <section>
        <div id="writeContent">
          <ModalFormProposition
            :revele="reveleFormProposition"
            :toggle="toggleModaleFormProposition"
            :organisation="organisation"
          />
          <div class="inputContent" @click="toggleModaleFormProposition">
            <i class="fi-rr-pencil"></i>
            <h3>Rédiger une proposition ...</h3>
          </div>
        </div>
      </section>

      <section>
        <main v-for="post in posts" id="main" :key="post.id">
          <div class="topBox">
            <div class="blockOne">
              <img src="https://via.placeholder.com/150" />
              <div class="author">
                <h5>{{ post.author.prenom }} {{ post.author.nom }}</h5>
                <div>
                  <small>de</small>
                  <h6>Neocracy</h6>
                </div>
              </div>
            </div>
            <div class="blockTwo">
              <i class="fi-rr-menu-dots-vertical"></i>
            </div>
          </div>
          <div class="midBox">
            <div class="blockOne">
              <h3>{{ post.nom }}</h3>
            </div>
            <div class="blockTwo">
              <p>
                {{ post.description }}
              </p>
            </div>
            <div
              v-for="tag in post.tags"
              id="main"
              :key="tag.id"
              class="blockThree"
            >
              <p>#{{ tag.name }}</p>
            </div>
            <div class="blockFour">
              <img
                src="https://www.justifit.fr/wp-content/uploads/2020/06/Droit-a-limage.jpg"
              />
            </div>
          </div>
          <div class="bottomBox">
            <div class="blockOne">
              <i class="fi-rr-thumbs-up"></i>
              <p>J'aime</p>
            </div>
            <div class="hr"></div>
            <div class="blockTwo">
              <i class="fi-rr-thumbs-down"></i>
              <p>Je n'aime pas</p>
            </div>
            <div class="hr"></div>
            <div class="blockThree">
              <i class="fi-rr-comment"></i>
              <p>Commenter</p>
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
import ModalFormProposition from '@/components/Modals/Forms/ModalFormProposition'

export default {
  components: {
    Nav,
    NavPhone,
    NavTablet,
    ModalFormProposition,
  },
  async asyncData({ $api }) {
    const posts = await $api.proposition.getPropositionsByOrganisationId()
    console.log('posts:', posts)
    return { posts }
  },
  data() {
    return {
      reveleFormProposition: false,
      userInfo: {},
    }
  },
  fetch() {
    this.userInfo = JSON.parse(sessionStorage.getItem('userInfo'))
  },
  methods: {
    toggleModaleFormProposition() {
      this.reveleFormProposition = !this.reveleFormProposition
    },
  },
}
</script>

<style scoped>
.container {
  width: 100%;
  z-index: 1;
  display: flex;
  justify-content: center;
  flex-direction: column;
  padding-top: 120px;
  background: #f1f1f1;
  font-family: 'Open Sans', sans-serif;
}

a {
  text-decoration: none;
}

section {
  height: auto;
  width: 100%;
  padding-left: 150px;
  padding-right: 150px;
  display: flex;
  flex-direction: column;
  margin: auto;
}

#writeContent {
  cursor: pointer;
  width: 50%;
  margin: auto;
  padding: 20px 30px;
  border-radius: 10px;
  background-color: rgba(0, 0, 0, 0.01);
  background-image: linear-gradient(315deg, rgba(0, 0, 0, 0.01) 30%, #fff 100%);
  box-shadow: 0px 1px 10px 0px rgba(144, 144, 144, 0.5);
  -moz-box-shadow: 0px 1px 10px 0px rgba(144, 144, 144, 0.5);
  -webkit-box-shadow: 0px 1px 10px 0px rgba(144, 144, 144, 0.5);
}

.inputContent {
  display: flex;
  align-items: center;
  height: 50px;
  padding: 15px;
  box-sizing: border-box;
  border-radius: 20px;
  background: #ddd;
  transition: 0.3s ease-in-out;
}

.inputContent:hover {
  border: 1px solid #aaaaaa;
  outline: none;
  transition: 0.3s ease-in-out;
}

.inputContent i {
  font-size: 15px;
  color: #757588;
  margin-top: 2px;
}

.inputContent h3 {
  font-size: 15px;
  color: #757588;
  margin-left: 10px;
}

#main {
  box-sizing: border-box;
  width: 50%;
  margin: 20px auto;
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
  color: #424347;
  font-weight: bold;
  font-size: 15px;
}

.topBox img {
  width: 60px;
  border: 2px solid #ec7533;
  border-radius: 9999px;
}

.topBox .blockOne,
.topBox .blockTwo {
  width: 50%;
}

.topBox .blockOne {
  display: flex;
  justify-content: flex-start;
  align-items: center;
}

.topBox .author {
  margin-left: 20px;
}

.topBox .author h5 {
  font-size: 18px;
  font-weight: bold;
  color: #424347;
}

.topBox .author div {
  display: flex;
}

.topBox .author h6 {
  margin-left: 5px;
  font-size: 15px;
  font-weight: bold;
  color: #424347;
}

.topBox .author small {
  margin-top: 5px;
  font-size: 10px;
  color: #757588;
}

.topBox .blockTwo {
  display: flex;
  justify-content: flex-end;
  align-items: center;
}

.topBox .blockTwo i {
  font-size: 20px;
}

.midBox {
  display: inline;
  justify-content: center;
  text-align: center;
}

.midBox .blockOne h3 {
  width: 90%;
  margin: auto;
  font-size: 20px;
  font-weight: bold;
  text-align: left;
  color: #424347;
  margin-bottom: 10px;
}

.midBox .blockTwo p {
  width: 90%;
  margin: auto;
  text-align: left;
  font-size: 15px;
  color: #424347;
  margin-bottom: 15px;
}

.midBox .blockFour {
  margin: auto;
}

.midBox .blockFour img {
  width: 100% !important;
  max-height: 500px;
}

.bottomBox {
  display: flex;
  justify-content: space-around;
  align-items: center;
  padding: 20px 30px;
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
  background: rgba(0, 0, 0, 0.1);
}

.bottomBox i {
  margin-top: 2px;
}

.bottomBox p {
  margin-left: 10px;
}

/* ON LITTLE SCREEN FOR LAPTOP */

@media (max-width: 1300px) {
  section {
    padding-left: 200px;
    padding-right: 100px;
  }

  #writeContent {
    width: 60%;
  }

  #main {
    width: 60%;
  }
}

/* ******************** */

/* ON TABLETTE */

@media (max-width: 1050px) {
  .container {
    padding-top: 65px;
  }

  section {
    padding-left: 0;
    padding-right: 0;
  }

  #writeContent {
    width: 70%;
  }

  .inputContent {
    height: 30px;
    padding: 10px;
    width: 90%;
    margin: auto;
  }

  .inputContent h3,
  .inputContent i {
    font-size: 12px;
  }

  #main {
    width: 70%;
    margin: 10px auto;
  }

  .topBox {
    padding: 10px 20px;
  }

  .topBox .author {
    margin-left: 10px;
  }

  .topBox img {
    width: 40px;
  }

  .topBox .author h5 {
    font-size: 15px;
  }

  .topBox .author h6 {
    margin-top: 2px;
    font-size: 13px;
  }

  .topBox .author small {
    font-size: 9px;
  }

  .topBox .blockTwo i {
    font-size: 15px;
  }

  .midBox .blockOne h3 {
    font-size: 15px;
  }

  .midBox .blockTwo p {
    font-size: 12px;
  }

  .bottomBox {
    font-size: 12px;
    padding: 10px 20px;
  }
}

/* ******************** */

/* ON PHONE */

@media (max-width: 650px) {
  .container {
    padding-top: 65px;
  }

  section {
    padding-left: 0;
    padding-right: 0;
  }

  #writeContent {
    width: 98%;
    padding: 5px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    box-shadow: none;
    -moz-box-shadow: none;
    -webkit-box-shadow: none;
  }

  .inputContent {
    height: 30px;
    padding: 10px;
    width: 90%;
    margin: auto;
  }

  .inputContent h3,
  .inputContent i {
    font-size: 12px;
  }

  #main {
    width: 98%;
    margin: 5px auto;
    padding: 5px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    box-shadow: none;
    -moz-box-shadow: none;
    -webkit-box-shadow: none;
  }

  .topBox img {
    width: 40px;
  }

  .topBox .author h5 {
    font-size: 13px;
  }

  .topBox .author h6 {
    margin-top: 2px;
    font-size: 11px;
  }

  .topBox .author small {
    font-size: 9px;
  }

  .topBox .blockTwo i {
    font-size: 13px;
  }

  .midBox .blockOne h3 {
    font-size: 13px;
  }

  .midBox .blockTwo p {
    font-size: 10px;
  }

  .bottomBox {
    font-size: 10px;
    padding: 10px 20px;
  }
}
</style>
