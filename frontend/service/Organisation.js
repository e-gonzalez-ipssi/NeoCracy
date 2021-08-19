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
  getUserOrganisation() {},
})
