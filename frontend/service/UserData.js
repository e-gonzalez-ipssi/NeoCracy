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
})
