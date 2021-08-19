export default (axios) => ({
  postProposition(form, userToken) {
    // image,url
    const res = axios
      .post('proposition', null, {
        params: {
          title: form.title,
          description: form.description,
          orgId: form.organisation,
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
    console.log('userInfo:', userInfo)
    const res = axios
      .get(`proposition/organisation/${userInfo.organisations[0].id}`, {
        withCredentials: true,
      })
      .then((response) => response.data.value)
      .catch((err) => console.log(err))

    return res
  },
})
