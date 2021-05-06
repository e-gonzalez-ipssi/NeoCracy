export default (axios) => ({
  login(email, password) {
    return axios.post('connect?mail=test@test.com&password=0123456Az', {})
  },

  register(nom, prenom, mail, password, confirmPassword) {
    return axios.post(
      'register?nom=Gonzalez&prenom=Esteban&mail=test@test.fr&password=0123456Az&confirmPassword=0123456Az'
    )
  },
})
