const { default: axios } = require("axios");
const { method } = require("lodash");

const app = new Vue({
    el: '#app',
    data :{
        selected_pais: '',
        selected_ciudad: '',
        ciudad:[],

    },
     methods:{
    loadciudad(){
        axios.get('ciudad',{parms: {idpais: this.selected_pais}}).then((response)=>{
            this.ciudad=response.data;
        });
    
    }
}
});