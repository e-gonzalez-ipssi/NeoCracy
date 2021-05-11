export default (axios) => ({
  login(mail, password, userToken) {
    const res = axios
      .post(
        'connect',
        {
          withCredentials: true,
          headers: {
            Accept: 'application/json',
            Authorization: `Bearer ${userToken}`,
          },
        },
        {
          params: {
            mail,
            password,
          },
        }
      )
      .then((response) => response)
      .catch((err) => console.warn(err.message))
    return res
  },

  logout() {
    const res = axios
      .post('disconnect')
      .then((response) => response.status)
      .catch((err) => console.warn(err.message))
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
