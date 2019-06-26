import Vue from 'vue'
import App from './App.vue'
import VueResource from 'vue-resource'

Vue.use(VueResource)

// send the request as application/x-www-form-urlencoded
Vue.http.options.emulateJSON = true;

Vue.config.productionTip = false

new Vue({
  render: h => h(App),
}).$mount('#app')
