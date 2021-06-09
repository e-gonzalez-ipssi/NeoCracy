<template>
  <div>
    <div>
      <h3>Register</h3>
      <input v-model="nom" type="text" placeholder="nom" />
      <input v-model="prenom" type="text" placeholder="prenom" />
      <input v-model="mailRegister" type="text" placeholder="mailRegister" />
      <input
        v-model="passwordRegister"
        type="password"
        placeholder="passwordRegister"
      />
      <input
        v-model="confirmPassword"
        type="password"
        placeholder="confirmPassword"
      />
      <button @click="onRegister">Register</button>
    </div>
    <div>
      <h3>Login</h3>
      <input v-model="emailLogin" type="text" placeholder="emailLogin" />
      <input
        v-model="passwordLogin"
        type="password"
        placeholder="passwordLogin"
      />
      <button @click="onLogin">Login</button>
    </div>
    <div>
      <h3>Logout</h3>
      <button @click="onLogout">Logout</button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      nom: 'Gonzalez',
      prenom: 'Esteban',
      mailRegister: 'test@test.com',
      passwordRegister: '0123456Az',
      confirmPassword: '0123456Az',
      emailLogin: 'test@test.com',
      passwordLogin: '0123456Az',
    }
  },

  methods: {
    async onRegister() {
      const response = await this.$api.auth.register(
        this.nom,
        this.prenom,
        this.mailRegister,
        this.passwordRegister,
        this.confirmPassword
      )
      console.log(response)
    },
    async onLogin() {
      console.log('1 emailLogin -->', this.emailLogin)
      console.log('1 passwordLogin -->', this.passwordLogin)
      this.$cookies.set('userToken', '123', {
        path: '/',
        maxAge: 60 * 60 * 24 * 7,
      })
      const userToken = this.$cookies.get('userToken')
      console.log('1 userToken -->', userToken)

      var xhr = new XMLHttpRequest();
      xhr.withCredentials = true;

      xhr.addEventListener("readystatechange", function() {
        if(this.readyState === 4) {
          console.log(this.responseText);
        }
      });

      xhr.open("POST", "http://localhost:8000/api/connect?password=0123456Az&mail=test@test.com");

      xhr.send();
    },
      async onLogout() {
        var xhr = new XMLHttpRequest();
        xhr.withCredentials = true;

        xhr.addEventListener("readystatechange", function() {
          if(this.readyState === 4) {
            console.log(this.responseText);
          }
        });

        xhr.open("POST", "http://localhost:8000/api/disconnect");

        xhr.send();
      },
    },
}
</script>

<style>
.container {
  margin: 0 auto;
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}

.title {
  font-family: 'Quicksand', 'Source Sans Pro', -apple-system, BlinkMacSystemFont,
    'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
  display: block;
  font-weight: 300;
  font-size: 100px;
  color: #35495e;
  letter-spacing: 1px;
}

.subtitle {
  font-weight: 300;
  font-size: 42px;
  color: #526488;
  word-spacing: 5px;
  padding-bottom: 15px;
}

.links {
  padding-top: 15px;
}
</style>
