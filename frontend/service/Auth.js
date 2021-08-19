export default (axios) => ({
  login(mail, password) {
    const res = axios
      .post('connect', null, {
        params: {
          mail,
          password,
        },
      })
      .then((response) => response.data.value)
      .catch((err) => alert(err.message))
    return res
  },

  logout(userToken) {
    const res = axios
      .post('disconnect', null, { params: { userToken } })
      .then((response) => response.status)
      .catch((err) => alert(err.message))
    return res
  },

  register(nom, prenom, mail, password, confirmPassword) {
    const res = axios
      .post('register', null, {
        params: {
          nom,
          prenom,
          mail,
          password,
          confirmPassword,
        },
      })
      .then((response) => response.status)
      .catch((err) => console.warn(err))
    return res
  },
})
