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

    try {
      res = axios
        .get(`organisation/${userInfo.organisations[0].id}/members`, {
          withCredentials: true,
        })
        .then((response) => response.data.value)
    } catch (error) {}

    return res
  },

  AddMemberOrganisation(form, userToken) {
    const userInfo = JSON.parse(sessionStorage.getItem('userInfo'))
    const res = axios
      .post(
        `organisation/${userInfo.organisations[0].id}/members`,
        { withCredentials: true },
        {
          params: {
            email: form.email,
            userToken,
          },
        }
      )
      .then((response) => response.status)
      .catch((err) => console.warn(err))
    return res
  },
})
