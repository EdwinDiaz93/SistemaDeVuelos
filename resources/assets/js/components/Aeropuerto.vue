<template>
        <!-- Contenido Principal -->
    <main class="main">
        <!-- Breadcrumb -->
       
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Aeropuerto
                    <button type="button" @click="abrirModal('aeropuerto', 'registrar')" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                     <button type="button" @click="cargarPdf()" class="btn btn-info">
                        <i class="icon-doc"></i>&nbsp;Reporte
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                <option value="codaeropuerto">Codigo del Aeropuerto</option> 
                                  <option value="nomaeropuerto">Nombre del Aeropuerto</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarAeropuerto(1,buscar,criterio)"  class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarAeropuerto(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Codigo Aeropuerto</th>
                                <th>Nombre Aeropuerto</th>
                                <th>Telefono</th>
                                <th>Responsable del Aeropuerto</th>
                                <th>Numero de Bahias</th>
                                <th>Pais</th>
                                <th>Ciudad</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="aeropuerto in arrayAeropuerto" :key="aeropuerto.id">
                                <td>
                                    <button type="button" @click="abrirModal('aeropuerto', 'actualizar', aeropuerto)" class="btn btn-warning btn-sm">
                                      <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <template v-if="aeropuerto.estado=='1'">
                                        <button type="button" class="btn btn-danger btn-sm" @click="desactivarAeropuerto(aeropuerto.id)">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </template>
                                    <template v-else>
                                        <button type="button" class="btn btn-info btn-sm" @click="activarAeropuerto(aeropuerto.id)">
                                            <i class="icon-check"></i>
                                        </button>
                                    </template>
                                </td>
                                <td v-text="aeropuerto.codaeropuerto"></td>
                                <td v-text="aeropuerto.nomaeropuerto"></td> 
                                <td v-text="aeropuerto.telefono"></td>  
                                <td v-text="aeropuerto.nomresponsable"></td>
                                <td v-text="aeropuerto.numbahias"></td> 
                                <td v-text="aeropuerto.nompais"></td>    
                                <td v-text="aeropuerto.nomciudad"></td>     
                                <td>
                                    <div v-if="aeropuerto.estado=='1'">
                                        <span class="badge badge-success">Activo</span>
                                    </div>
                                    <div v-else>
                                        <span class="badge badge-danger">Desactivo</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item" v-if="pagination.current_page > 1">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                            </li>
                            <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '' ]">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                            </li>
                            <li class="page-item" v-if="pagination.current_page < pagination.last_page"  >
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)" >Sig</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Fin ejemplo de tabla Listado -->
        </div>
        <!--Inicio del modal agregar/actualizar-->
        <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" v-text="tituloModal"></h4>
                        <button type="button" class="close" @click="cerrarModal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                          
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Codigo del Aeropuerto</label>
                                <div class="col-md-9">                                    
                                    <div v-if="tipoAccion==1">
                                    <input type="text" v-model="codaeropuerto" class="form-control" placeholder="codigo del aeropuerto">
                                    </div>
                                    <div v-else>
                                        <input type="text" disabled v-model="codaeropuerto" class="form-control" placeholder="codigo del aeropuerto">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Nombre del Aeropuerto</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="nomaeropuerto" class="form-control" placeholder="nombre del aeropuerto">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Telefono Aeropuerto</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="telefono" class="form-control" placeholder="telefono del aeropuerto">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Responsable del Aeropuerto</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="nomresponsable" class="form-control" placeholder="responsable del aeropuerto">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Numero de Bahias</label>
                                <div class="col-md-9">
                                    <input type="number" v-model="numbahias" class="form-control" placeholder="numero de bahias">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Pais</label>
                                <div class="col-md-9">
                                    <select class="form-control" v-model="idpais">
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="pais in arrayPais" :key="pais.idpais"  :value="pais.idpais" v-text="pais.nompais" ></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Ciudad</label>
                                <div class="col-md-9">
                                    <select  class="form-control" v-model="idciudad"  >
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="ciudad in arrayCiudad" :key="ciudad.idciudad" :value="ciudad.idciudad" v-text="ciudad.nomciudad"></option>
                                    </select>
                                </div>
                            </div>

                            <div v-show="errorAeropuerto" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjAeropuerto" :key=error v-text="error">
                                    </div>
                                </div>        
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarAeropuerto()">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarAeropuerto()">Actualizar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->
        
    </main>
    <!-- /Fin del contenido principal -->
</template>

<script>
    export default {
        data(){
            return{
                aeropuerto_id : 0,
                codaeropuerto: '',
                nomaeropuerto:'',
                telefono:'',
                nomresponsable:'',
                numbahias:'',
                idpais : 0,
                nompais : '',
                idciudad : 0,
                nomciudad : '',
               
                arrayAeropuerto : [],
                modal : 0,
                tituloModal : '', 
                tipoAccion : 0,
                errorAeropuerto : 0,
                errorMostrarMsjAeropuerto: [],
                pagination : {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
                },
                offset : 3,
                criterio : 'codaeropuerto', 
                buscar : '',
                arrayPais : [],  //almacena el listado de los paises
                arrayCiudad : [], //almacena el listado de las ciudades
                
            } 
        },

        computed: {
            isActived: function(){
                return this.pagination.current_page;
            },
            pagesNumber: function()
            {
                if(!this.pagination.to){
                    return [];
                }

                var from = this.pagination.current_page - this.offset;
                if(from < 1){
                    from = 1;
                }

                var to = from + (this.offset * 2)
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }

                var pagesArray = [];
                while (from <= to ){
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }

        },

        methods: {

            listarAeropuerto(page,buscar,criterio){
                let me=this;
                var url = '/aeropuerto?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio; 
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayAeropuerto = respuesta.aeropuertos.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {
                });
            },

            selectPais(){
                let me=this;
                var url = '/pais/selectPais' ; 
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayPais = respuesta.pais;
                    
                    //console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {
                });
            },
             selectCiudad(){
                let me=this;
                var url = '/ciudad/selectCiudad' ; 
               axios.get(url).then(function (response) {
                var respuesta = response.data;
                me.arrayCiudad = respuesta.ciudad;
                    
                    //console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {
                });
            },


            cargarPdf(){
                window.open('http://127.0.0.1:8000/aeropuerto/listarPdf','_blank');
            },

            cambiarPagina(page,buscar,criterio){
                let me = this;
                //actualizar pagina actual 
                me.pagination.current_page = page;
                //enviar peticion para visualizar la data  de esa pagina
                me.listarAeropuerto(page,buscar,criterio); 
            },

           registrarAeropuerto()
           {
                if (this.validarAeropuerto())   //evalua si el metodo validar categoria retorna 1
                {                              // y no realiza nada
                    return;
                }
                // en caso que validar categoria retorne diferente de 1 realizar lo siguiente
                let me=this;
                axios.post('/aeropuerto/registrar', {
                    'codaeropuerto': this.codaeropuerto,
                    'nomaeropuerto': this.nomaeropuerto, 
                    'telefono': this.telefono,
                    'nomresponsable': this.nomresponsable,
                    'numbahias': this.numbahias,
                    'idpais': this.idpais, 
                    'idciudad':this.idciudad,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarAeropuerto(1,'','codaeropuerto');
                }).catch(function (error) {
                    console.log(error);
                });

           },

            actualizarAeropuerto()
           {
               if (this.validarAeropuerto())   
                {                              
                    return;
                }

                let me=this;
                axios.put('/aeropuerto/actualizar', {
                    'id': this.aeropuerto_id,
                    'codaeropuerto': this.codaeropuerto,
                    'nomaeropuerto': this.nomaeropuerto, 
                    'telefono': this.telefono,
                    'nomresponsable': this.nomresponsable,
                    'numbahias': this.numbahias,
                    'idpais': this.idpais, 
                    'idciudad':this.idciudad,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarAeropuerto(1,'','codaeropuerto');
                }).catch(function (error) {
                    console.log(error);
                });
           },

            desactivarAeropuerto(id)
            {

                swal({
                title: '¿Estas seguro de desactivar este Aeropuerto?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonText: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success ml-3',
                cancelButtonClass: 'btn btn-danger mr-3',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    
                    let me=this;
                    axios.put('/aeropuerto/desactivar', {
                        'id': id    
                    }).then(function (response) {
                        me.listarAeropuerto(1,'','codaeropuerto');
                        swal(
                            'Desactivado!',
                            'El registro ha sido desactivado con exito.',
                            'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                   
                } else if (
                    //Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                })
            },

            activarAeropuerto(id)
            {

                swal({
                title: '¿Estas seguro de activar este Aeropuerto?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonText: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success ml-3',
                cancelButtonClass: 'btn btn-danger mr-3',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    
                    let me=this;
                    axios.put('/aeropuerto/activar', {
                        'id': id    
                    }).then(function (response) {
                        me.listarAeropuerto(1,'','codaeropuerto');
                        swal(
                            'Activado!',
                            'El registro ha sido activado con exito.',
                            'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                   
                } else if (
                    //Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                })
            },

            validarAeropuerto()
            {
                this.errorAeropuerto=0;
                this.errorMostrarMsjAeropuerto=[];
                if (!this.codaeropuerto) this.errorMostrarMsjAeropuerto.push("El codigo del Aeropuerto no puede estar vacio");
                if (!this.nomaeropuerto) this.errorMostrarMsjAeropuerto.push("El nombre del Aeropuerto no puede estar vacio");
                if (!this.telefono) this.errorMostrarMsjAeropuerto.push("El telefono del Aeropuerto no puede estar vacio");
                if (!this.nomresponsable) this.errorMostrarMsjAeropuerto.push("El nombrel del responsabe del Aeropuerto no puede estar vacio");
                if (!this.numbahias) this.errorMostrarMsjAeropuerto.push("El Numero de Bahias del Aeropuerto debe ser un numero y no puede estar vacio");
                if (this.idpais==0) this.errorMostrarMsjAeropuerto.push("Seleccione el pais de Aeropuerto");
                if (this.idciudad==0) this.errorMostrarMsjAeropuerto.push("Seleccione la ciudad de Aeropuerto");
               

                if (this.errorMostrarMsjAeropuerto.length) this.errorAeropuerto = 1;

                return this.errorAeropuerto;
            },

           cerrarModal()
           {
               this.modal = 0;
               this.tituloModal = '';
               this.idpais= 0;
               this.nompais = '';
               this.idciudad= 0;
               this.nomciudad= '';
               this.codaeropuerto='';
               this.nomaeropuerto='';
               this.telefono='';
               this.nomresponsable='';
               this.numbahias = 0;
               this.errorAeropuerto = 0;
           },

           abrirModal(modelo, accion, data = [])
           {
               switch(modelo)
               {
                   case "aeropuerto":
                   {
                       switch(accion)
                       {
                           case 'registrar':
                           {
                               this.modal = 1;
                               this.tituloModal = 'Registrar Aeropuerto';
                               this.tipoAccion = 1;
                               this.codaeropuerto='';
                               this.nomaeropuerto='';
                               this.telefono='';
                               this.nomresponsable='';
                               this.numbahias = 0;
                               this.idpais= 0;
                               this.nompais = '';
                               this.idciudad= 0;
                               this.nomciudad= ''; 
                               break;
                           } 
                           case 'actualizar':
                           {
                               this.modal = 1;
                               this.tituloModal = 'Actualizar Aeropuerto';
                               this.tipoAccion = 2;
                               this.aeropuerto_id = data['id'];
                               this.codaeropuerto= data['codaeropuerto'];
                               this.nomaeropuerto= data['nomaeropuerto'];
                               this.telefono= data['telefono'];
                               this.nomresponsable= data['nomresponsable'];
                               this.numbahias = data['numbahias'];
                               this.idpais = data['idpais'];
                               this.idciudad= data['idciudad'];
                              
                               
                               break;
                           }    
                        }
                   }    
                }
                this.selectPais();
                this.selectCiudad();
           }
        },
        mounted() {
            this.listarAeropuerto(1,this.buscar,this.criterio);
        }
    }
</script>
<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item  !important;
        opacity: 1 !important;
        position: absolute i !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>