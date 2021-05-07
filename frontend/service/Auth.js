export default (axios) => ({
  login(mail, password, userToken) {
    console.log('2 email -->', mail)
    console.log('2 password -->', password)
    console.log('2 userToken -->', userToken)
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
      .then((response) => response.status)
      .catch((err) => alert(err.message))
    return res
  },

  logout() {
    const res = axios
      .post('disconnect')
      .then((response) => response.status)
      .catch((err) => alert(err.message))
    return res
  },

  register(nom, prenom, mail, password, confirmPassword) {
    console.log('2 nom -->', nom)
    console.log('2 prenom -->', prenom)
    console.log('2 mail -->', mail)
    console.log('2 password -->', password)
    console.log('2 confirmPassword -->', confirmPassword)
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
