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
            Cookie: "userToken=l6GvF%26a14ep9bFpRkV5R9hVl1Zck%2AS%2ArhIjnhsv4kLAay6rAUA0%2AWD%26%2AzI1BIWb%2A; Path=/api; Expires=Mon, 31 May 2021 09:59:17 GMT;",
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
