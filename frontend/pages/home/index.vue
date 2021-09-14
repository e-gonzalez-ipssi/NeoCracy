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
          />
          <div class="inputContent" @click="toggleModaleFormProposition">
            <svg
              class="icons"
              xmlns="http://www.w3.org/2000/svg"
              id="Outline"
              viewBox="0 0 24 24"
            >
              <path
                d="M22.853,1.148a3.626,3.626,0,0,0-5.124,0L1.465,17.412A4.968,4.968,0,0,0,0,20.947V23a1,1,0,0,0,1,1H3.053a4.966,4.966,0,0,0,3.535-1.464L22.853,6.271A3.626,3.626,0,0,0,22.853,1.148ZM5.174,21.122A3.022,3.022,0,0,1,3.053,22H2V20.947a2.98,2.98,0,0,1,.879-2.121L15.222,6.483l2.3,2.3ZM21.438,4.857,18.932,7.364l-2.3-2.295,2.507-2.507a1.623,1.623,0,1,1,2.295,2.3Z"
              />
            </svg>

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
                <h5>{{ post[0].author.prenom }} {{ post[0].author.nom }}</h5>
                <div>
                  <small>de</small>
                  <h6>{{ userInfo.organisations[0].nom }}</h6>
                </div>
              </div>
            </div>
            <div class="blockTwo">
              <svg
                class="icons"
                xmlns="http://www.w3.org/2000/svg"
                id="Outline"
                viewBox="0 0 24 24"
              >
                <circle cx="12" cy="2" r="2" />
                <circle cx="12" cy="12" r="2" />
                <circle cx="12" cy="22" r="2" />
              </svg>
            </div>
          </div>
          <div class="midBox">
            <div class="blockOne">
              <h3>{{ post[0].nom }}</h3>
            </div>
            <div class="blockTwo">
              <p>
                {{ post[0].description }}
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
                :src="
                  post[0].image ||
                  'https://www.justifit.fr/wp-content/uploads/2020/06/Droit-a-limage.jpg'
                "
                alt=" no image found"
              />
            </div>
          </div>
          <div class="bottomBox">
            <div class="blockOne">
              <svg
                v-if="!post[1].liked"
                class="icons"
                xmlns="http://www.w3.org/2000/svg"
                id="Outlinetest"
                viewBox="0 0 24 24"
              >
                <path
                  d="M22.773,7.721A4.994,4.994,0,0,0,19,6H15.011l.336-2.041A3.037,3.037,0,0,0,9.626,2.122L7.712,6H5a5.006,5.006,0,0,0-5,5v5a5.006,5.006,0,0,0,5,5H18.3a5.024,5.024,0,0,0,4.951-4.3l.705-5A5,5,0,0,0,22.773,7.721ZM2,16V11A3,3,0,0,1,5,8H7V19H5A3,3,0,0,1,2,16Zm19.971-4.581-.706,5A3.012,3.012,0,0,1,18.3,19H9V7.734a1,1,0,0,0,.23-.292l2.189-4.435A1.07,1.07,0,0,1,13.141,2.8a1.024,1.024,0,0,1,.233.84l-.528,3.2A1,1,0,0,0,13.833,8H19a3,3,0,0,1,2.971,3.419Z"
                />
              </svg>
              <form @submit.prevent="handleSubmitLike">
                <button type="submit">J'aime</button>
                <input
                  id="input-like"
                  ref="input"
                  :value="post[0].id"
                  type="hidden"
                />
              </form>
            </div>
            <div class="hr"></div>
            <div class="blockTwo">
              <svg
                class="icons"
                xmlns="http://www.w3.org/2000/svg"
                id="Outline"
                viewBox="0 0 24 24"
              >
                <path
                  d="M23.951,12.3l-.705-5A5.024,5.024,0,0,0,18.3,3H5A5.006,5.006,0,0,0,0,8v5a5.006,5.006,0,0,0,5,5H7.712l1.914,3.878a3.037,3.037,0,0,0,5.721-1.837L15.011,18H19a5,5,0,0,0,4.951-5.7ZM5,5H7V16H5a3,3,0,0,1-3-3V8A3,3,0,0,1,5,5Zm16.264,9.968A3,3,0,0,1,19,16H13.833a1,1,0,0,0-.987,1.162l.528,3.2a1.024,1.024,0,0,1-.233.84,1.07,1.07,0,0,1-1.722-.212L9.23,16.558A1,1,0,0,0,9,16.266V5h9.3a3.012,3.012,0,0,1,2.97,2.581l.706,5A3,3,0,0,1,21.264,14.968Z"
                />
              </svg>
              <form @submit.prevent="handleSubmitDislike">
                <button type="submit">Je n'aime pas</button>
                <input
                  id="input-dislike"
                  ref="input"
                  :value="post[0].id"
                  type="hidden"
                />
              </form>
            </div>
            <div class="hr"></div>
            <div class="blockThree">
              <svg
                class="icons"
                xmlns="http://www.w3.org/2000/svg"
                id="Outline"
                viewBox="0 0 24 24"
              >
                <path
                  d="M24,11.247A12.012,12.012,0,1,0,12.017,24H19a5.005,5.005,0,0,0,5-5V11.247ZM22,19a3,3,0,0,1-3,3H12.017a10.041,10.041,0,0,1-7.476-3.343,9.917,9.917,0,0,1-2.476-7.814,10.043,10.043,0,0,1,8.656-8.761A10.564,10.564,0,0,1,12.021,2,9.921,9.921,0,0,1,18.4,4.3,10.041,10.041,0,0,1,22,11.342Z"
                />
                <path d="M8,9h4a1,1,0,0,0,0-2H8A1,1,0,0,0,8,9Z" />
                <path d="M16,11H8a1,1,0,0,0,0,2h8a1,1,0,0,0,0-2Z" />
                <path d="M16,15H8a1,1,0,0,0,0,2h8a1,1,0,0,0,0-2Z" />
              </svg>

              <form @submit.prevent="handleSubmitComment">
                <button type="submit">Commenter</button>
                <input id="comment" type="hidden" />
              </form>
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
  data() {
    return {
      reveleFormProposition: false,
      userInfo: {},
      posts: [],
    }
  },
  async beforeCreate() {
    this.posts = await this.$api.proposition.getPropositionsByOrganisationId()
    console.log(this.posts)
    if (sessionStorage) {
      this.userInfo = JSON.parse(sessionStorage.getItem('userInfo'))
    }
  },

  methods: {
    toggleModaleFormProposition() {
      this.reveleFormProposition = !this.reveleFormProposition
    },
    async handleSubmitLike() {
      const userToken = this.$cookiz.get('userToken')
      const idPost = document.getElementById('input-like').value
      await this.$api.proposition.likeProposition(idPost, userToken)
      document.querySelector('#Outlinetest').classList.remove('icons')
      document.querySelector('#Outlinetest').classList.remove('iconsVal')
    },
    async handleSubmitDislike() {
      const userToken = this.$cookiz.get('userToken')
      const idPost = document.getElementById('input-like').value
      await this.$api.proposition.dislikeProposition(idPost, userToken)
    },
    handleSubmitComment() {
      window.alert('comment')
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

.icons {
  height: 15px;
  fill: #333;
}

.iconsVal {
  height: 15px;
  fill: rgb(68, 93, 230);
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

.topBox .blockTwo .icons {
  height: 20px;
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
