export default (axios) => ({
  login(form) {
    const res = axios
      .post('connect', null, {
        params: {
          mail: form.email,
          password: form.password,
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
    return res
  },

  register(form) {
    console.log('2 form:', form)
    const res = axios
      .post('register', null, {
        params: {
          nom: form.nom,
          prenom: form.prenom,
          mail: form.email,
          password: form.password,
          confirmPassword: form.confirmPassword,
        },
      })
      .then((response) => response.status)
      .catch((err) => console.warn(err))
    return res
  },
})
