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
})
