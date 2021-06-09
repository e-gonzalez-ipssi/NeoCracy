<template>
  <div class="container">
    <Nav />
    <section>
      <div id="writeContent">
        <a href="#">
          <div class="inputContent">
            <i class="fi-rr-pencil"></i>
            <h3>Rédiger un article ...</h3>
          </div>
        </a>
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
          <div class="blockTwo"><i class="fi-rr-menu-dots-vertical"></i></div>
        </div>
        <div class="midBox">
          <div class="blockOne">
            <h3>Titre du poste</h3>
          </div>
          <div class="blockTwo">
            <p>
              Lorem ipsum dolor, sit amet consectetur adipisicing elit. Enim
              iure voluptate distinctio optio sed sint vitae ab nulla eius
              libero. Assumenda obcaecati, dolores minus voluptatibus ipsa omnis
              sit quibusdam odit!
            </p>
          </div>
          <div class="blockThree">
            <img
              src="https://www.so-buzz.fr/wp-content/uploads/2020/08/img-dev-sobuzz.jpg"
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
</template>

<script>
export default {}
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
  margin-top: 150px;
}

#writeContent {
  width: 700px;
  padding: 30px;
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
  border: 2px solid #424347;
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
  transition: 0.1s ease-in-out;
}

.inputContent:hover h3 {
  margin-left: 15px;
  transition: 0.1s ease-in-out;
}

main {
  box-sizing: border-box;
  width: 700px;
  margin-top: 30px;
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
  padding: 30px;
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
  color: #424347;
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

.midBox .blockThree img {
  width: 100%;
  height: 100%;
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
