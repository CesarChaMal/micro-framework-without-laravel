require('./bootstrap');

window.Vue = require('vue');
import loading from 'vue-full-loading'
import { ContentLoader } from 'vue-content-loader'

Vue.component('base-nav', require('./components/UI/BaseNav').default);
Vue.component('base-header', require('./components/UI/BaseHeader').default);
Vue.component('base-panel', require('./components/UI/BasePanel').default);
Vue.component('base-sidebar', require('./components/UI/BaseSidebar').default);
Vue.component('client-form', require('./components/Pay/ClientForm').default);
Vue.component('pay-home', require('./components/Pay/PayHome').default);
Vue.component('total-form', require('./components/Pay/TotalForm').default);
Vue.component('total-card', require('./components/Pay/TotalCard').default);
Vue.component('wallet-form', require('./components/Pay/WalletForm').default);
Vue.component('pay-form', require('./components/Pay/PayForm').default);
Vue.component('pay-confirmed', require('./components/Pay/ConfirmedForm').default);
Vue.component('loading', loading);
Vue.component('content-loader', ContentLoader);

const app = new Vue({
    el: '#app',
});
