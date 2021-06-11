/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('clasevuelo', require('./components/ClaseVuelo.vue').default);
Vue.component('tipocosto', require('./components/TipoCosto.vue').default);
Vue.component('rol', require('./components/Rol.vue').default);
Vue.component('tipodocumento', require('./components/TipoDocumento.vue').default);
Vue.component('horario', require('./components/Horario.vue').default);
Vue.component('costos', require('./components/Costos.vue').default);
Vue.component("tipoavion",require("./components/TipoAvion.vue").default);
Vue.component("avion",require("./components/Avion.vue").default);
Vue.component("aerolinea",require("./components/Aerolinea.vue").default)
Vue.component("aeropuerto",require("./components/Aeropuerto.vue").default);

Vue.component("cliente",require("./components/Cliente.vue").default);

Vue.component("precio",require("./components/Precio.vue").default);
Vue.component("vuelo",require("./components/Vuelo.vue").default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data :{
        menu : 0
    }
});
