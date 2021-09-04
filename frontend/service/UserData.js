export default (axios) => ({
  getData() {
    const res = axios
      .get('me', { withCredentials: true })
      .then((response) => response.data.value)
      .catch((err) => console.log(err))

    return res
  },
  getOrganisationsFromUserId() {
    const userInfo = JSON.parse(sessionStorage.getItem('userInfo'))

    const res = axios
      .get(`user/${userInfo.id}/organisations`, { withCredentials: true })
      .then((response) => response.data.value)
      .catch((err) => console.log(err))

    return res
  },
  updateUserDetail(form, userToken) {
    const userInfo = JSON.parse(sessionStorage.getItem('userInfo'))

    const res = axios
      .post(`user/${userInfo.id}/update`, null, {
        params: {
          nom: form.nom,
          prenom: form.prenom,
          mail: form.email,
          userToken,
        },
      })
      .then((response) => response.status)
      .catch((err) => console.warn(err))
    return res
  },
})
