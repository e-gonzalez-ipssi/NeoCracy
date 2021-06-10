<template>
  <div>
    <Nav />
    <div class="container">
      <section>
        <div id="writeContent">
          <ModalFormPost
            :revele="reveleFormPost"
            :toggle-modale-form-post="toggleModaleFormPost"
          ></ModalFormPost>
          <div class="inputContent" @click="toggleModaleFormPost">
            <i class="fi-rr-pencil"></i>

            Rédiger un article ...
          </div>
        </div>
        <main>
          <div class="topBox">
            <div class="blockOne">
              <img src="https://via.placeholder.com/150" />
              <div class="author">
                <h5>Louis Poulin</h5>
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
              <h3>Titre du poste</h3>
            </div>
            <div class="blockTwo">
              <p>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Enim
                iure voluptate distinctio optio sed sint vitae ab nulla eius
                libero. Assumenda obcaecati, dolores minus voluptatibus ipsa
                omnis sit quibusdam odit!
              </p>
            </div>
            <div class="blockThree">
              <img
                src="https://nsa40.casimages.com/img/2020/09/20/200920115309285360.jpg"
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
.container {
  width: 100%;
  z-index: 1;
  display: flex;
  justify-content: center;
  flex-direction: column;
  font-family: 'Open Sans', sans-serif;
}

a {
  text-decoration: none;
}

section {
  display: flex;
  flex-direction: column;
  margin: 0 auto;
  margin-top: 120px;
}

#writeContent {
  width: 700px;
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
  background: #eeeeee;
  transition: 0.1s ease-in-out;
}

.inputContent:hover {
  border: 1px solid #424347;
  outline: none;
  transition: 0.1s ease-in-out;
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

main {
  box-sizing: border-box;
  width: 700px;
  margin-top: 20px;
  margin-bottom: 100px;
  border-radius: 10px;
  background-color: rgba(0, 0, 0, 0.01);
  background-image: linear-gradient(315deg, rgba(0, 0, 0, 0.01) 30%, #fff 100%);
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

.midBox .blockThree {
  background: #eeeeee;
  max-height: 500px;
  max-width: 700px;
}

.midBox .blockThree img {
  max-height: 500px;
  max-width: 700px;
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
  background: #757588;
}

.bottomBox i {
  margin-top: 2px;
}

.bottomBox p {
  margin-left: 10px;
}
</style>
