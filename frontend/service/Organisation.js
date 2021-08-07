export default (axios) => ({
  postOrganisation(form, userToken) {
    console.log('Organisation', form.nom)
    console.log('Organisation', form.description)
    console.log('Organisation', form.lienSite)
    // http://localhost:8000/api/organisation?description=test2&lienSite=test2&nom=test2
    const res = axios
      .post('/organisation', null, {
        params: {
          nom: form.nom,
          description: form.description,
          lienSite: form.lienSite,
          userToken,
        },
      })
      .then((response) => console.log(response.status))
      .catch((err) => console.warn(err))
    return res
  },
})