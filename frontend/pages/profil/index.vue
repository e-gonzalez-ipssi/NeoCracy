<template>
  <div>
    <Nav />
    <NavTablet />
    <NavPhone />
    <div class="container">
      <section>
        <main id="main">
          <div class="topBox">
            <div class="blockOne">
              <img src="https://via.placeholder.com/150" />
            </div>
          </div>
          <div class="midBox">
            <div class="blockOne">
              <div class="author">
                <h5>Louis Poulin</h5>
                <p>CEO chez Neocracy</p>
              </div>
            </div>
            <div class="blockTwo">
              <button type="button">S'abonner</button>
            </div>
          </div>
          <div class="bottomBox">
            <div class="blockOne"></div>
            <div class="blockTwo"></div>
            <div class="blockThree"></div>
          </div>
        </main>
      </section>
    </div>
  </div>
</template>

<script>
export default {}
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
}

.topBox .blockOne {
  display: flex;
  justify-content: center;
}

.topBox img {
  width: 150px;
  border: 3px solid #00d699;
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
