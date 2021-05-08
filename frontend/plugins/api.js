import Auth from '@/service/Auth'

export default (context, inject) => {
  // Initialize API factories
  const factories = {
    auth: Auth(context.$axios),
  }

  // Inject $api
  inject('api', factories)
}
