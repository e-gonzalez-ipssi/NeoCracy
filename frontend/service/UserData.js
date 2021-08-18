export default (axios) => ({
  getData() {
    console.log('2 getData ok')
    const res = axios
      .get('/me', { withCredentials: true })
      .then((response) => response.data.value)
      .catch((err) => console.log(err))
    console.log('3 res:', res)
    return res
  },
  getOrganisationsFromUserId() {
    console.log('2 ok')
    const userInfo = JSON.parse(localStorage.getItem('userInfo'))
    console.log('3 userInfo:', userInfo)
    const res = axios
      .get(`/user/${userInfo.id}/organisations`, { withCredentials: true })
      .then((response) => response.data.value)
      .catch((err) => console.log(err))
    console.log('4 res:', res)
    return res
  },
})
