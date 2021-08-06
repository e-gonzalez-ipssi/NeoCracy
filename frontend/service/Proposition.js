export default (axios) => ({
  postProposition(form, userToken) {
    console.log('Proposition', form.title)
    console.log('Proposition', form.description)
    console.log('Proposition', form.organisation)
    console.log('Proposition', form.tags)
    const res = axios
      .post('proposition', null, {
        params: {
          title: form.title,
          description: form.description,
          organisation: form.organisation,
          tags: form.tags,
          userToken,
        },
      })
      .then((response) => response.status)
      .catch((err) => console.warn(err))
    return res
  },
})
