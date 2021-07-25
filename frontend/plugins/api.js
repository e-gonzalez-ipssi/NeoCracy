import Auth from '@/service/Auth'
import Data from '@/service/Data'

export default (context, inject) => {
  // Initialize API factories
  const factories = {
    auth: Auth(context.$axios),
    data: Data(context.$axios),
  }

  // Inject $api
  inject('api', factories)
}
