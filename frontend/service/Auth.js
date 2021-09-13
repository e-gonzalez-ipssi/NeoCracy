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

    sessionStorage.clear()

    // Delete all cookies after log out, used for userToken
    const cookies = document.cookie.split(';')

    for (let i = 0; i < cookies.length; i++) {
      const cookie = cookies[i]
      const eqPos = cookie.indexOf('=')
      const name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie
      document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:00 GMT'
    }

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
