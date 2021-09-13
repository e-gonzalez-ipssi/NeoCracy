export default (axios) => ({
  postOrganisation(form, userToken) {
    const res = axios
      .post('organisation', null, {
        params: {
          nom: form.nom,
          description: form.description,
          lienSite: form.lienSite,
          userToken,
        },
      })
      .then((response) => response.status)
      .catch((err) => console.warn(err))
    return res
  },
  getMembersOrganisation() {
    const userInfo = JSON.parse(sessionStorage.getItem('userInfo'))
    let res
    console.log('userInfo:', userInfo)
    try {
      res = axios
        .get(`organisation/${userInfo.organisations[0].id}/members`, {
          withCredentials: true,
        })
        .then((response) => response.data.value)
    } catch (error) {
      console.log(error)
    }

    return res
  },
})
