// export default function ({ isServer, res, query }) {
//   const token = query.token
//   if (token) {
//     if (isServer) {
//       res.setHeader('Set-Cookie', [`userToken=${token}`]) // Server-side
//     } else {
//       document.cookie = `userToken=${token}` // Client-side
//     }
//   }
// }

// universal cookie
const cookieValObject = { param1: 'value1', param2: 'value2' }

// nuxt middleware
export default ({ app }) => {
  app.$cookies.set('cookie-name', 'cookie-value', {
    path: '/',
    maxAge: 60 * 60 * 24 * 7,
  })
  app.$cookies.set('cookie-name', cookieValObject, {
    path: '/',
    maxAge: 60 * 60 * 24 * 7,
  })
}
