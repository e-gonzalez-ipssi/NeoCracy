import Auth from '@/service/Auth'
import UserData from '@/service/UserData'
import Proposition from '@/service/Proposition'
import Organisation from '@/service/Organisation'

export default (context, inject) => {
  // Initialize API factories
  const factories = {
    auth: Auth(context.$axios),
    userdata: UserData(context.$axios),
    proposition: Proposition(context.$axios),
    organisation: Organisation(context.$axios),
  }

  // Inject $api
  inject('api', factories)
}
