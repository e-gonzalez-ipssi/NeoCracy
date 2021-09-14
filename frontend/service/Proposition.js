export default (axios) => ({
  postProposition(form, userToken, userOrg) {
    // image,url
    const res = axios
      .post('proposition', null, {
        params: {
          title: form.title,
          description: form.description,
          orgId: userOrg.organisations[0].id,
          tags: form.tags,
          userToken,
        },
      })
      .then((response) => response.status)
      .catch((err) => console.warn(err))
    return res
  },
  getPropositionsByOrganisationId() {
    const userInfo = JSON.parse(sessionStorage.getItem('userInfo'))
    let res
    console.log('userInfo:', userInfo)
    try {
      res = axios
        .get(`proposition/organisation/${userInfo.organisations[0].id}`, {
          withCredentials: true,
        })
        .then((response) => response.data.value)
    } catch (error) {
      console.log(error)
    }

    return res
  },
  likeProposition(idPost, userToken) {
    // image,url
    const res = axios
      .post(`proposition/${idPost}/like`, null, {
        params: {
          userToken,
        },
      })
      .then((response) => response.status)
      .catch((err) => console.warn(err))
    return res
  },

  dislikeProposition(idPost, userToken) {
    // image,url
    const res = axios
      .post(`proposition/${idPost}/dislike`, null, {
        params: {
          userToken,
        },
      })
      .then((response) => response.status)
      .catch((err) => console.warn(err))
    return res
  },
})
