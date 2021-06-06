<template>
        <!-- Contenido Principal -->
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Sistema Vuelos</a></li>
        </ol>
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Aeropuerto
                    <button type="button" @click="abrirModal('aeropuerto', 'registrar')" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                  <option value="codaeropuerto">Codigo</option>
                                 <option value="nomaeropuerto">Nombre del Aeropuerto</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarAeropuertos(1,buscar,criterio)"  class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarAeropuertos(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Codigo Aeropuerto</th>
                                <th>Nombre Aeropuerto</th>
                                <th>Telefono Aeropuerto</th>
                                <th>Responsable</th>
                                <th>Bahias</th>
                                <th>Pais</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="aeropuerto in arrayAeropuerto" :key="aeropuerto.codaeropuerto">
                                <td>
                                    <button type="button" @click="abrirModal('aeropuerto', 'actualizar', aeropuerto)" class="btn btn-warning btn-sm">
                                      <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <template v-if="aeropuerto.estado=='1'">
                                        <button type="button" class="btn btn-danger btn-sm" @click="desactivarAeropuerto(aeropuerto.codaeropuerto)">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </template>
                                    <template v-else>
                                        <button type="button" class="btn btn-info btn-sm" @click="activarAeropuerto(aeropuerto.codaeropuerto)">
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
                            
                                
                                <td>
                                    <div v-if="aeropuerto.estado == '1'">
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
                                <label class="col-md-3 form-control-label" for="text-input">Codigo </label>
                                <div class="col-md-9">
                                    <input type="text" v-model="codaeropuerto" class="form-control" placeholder="Codigo del Aeropuerto">
                                </div>
                                </div>
                                 <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="nomaeropuerto" class="form-control" placeholder="Nombre del Aeropuerto">
                                </div>
                                </div>
                                 <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">telefono</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="telefono" class="form-control" placeholder="Telefono">
                                </div>
                                </div>
                                 <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre del Responsable</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="nomresponsable" class="form-control" placeholder="Nombre del Responsable A">
                                </div>
                                </div>
                                 <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Bahias </label>
                                <div class="col-md-9">
                                    <input type="text" v-model="numbahias" class="form-control" placeholder="Numero de Bahias">
                                </div>
                                </div>
                                <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Pais</label>
                                <div class="col-md-9">
                                   <select class="form-control" v-model="pais_id" >
                                       <option value="0">Seleccione el Pais</option>
                                       <option v-for="pais in arrayPais" :key="pais.id" :value="pais.id" v-text="pais.nompais"></option>
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
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarAeropuertos">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarAeropuertos">Actualizar</button>
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
                codigo : '',
                nombre :'',
                celular : '',
                responsable : '',
                bahias :'',
                pais : 0,
               // cuidad_id : 0,
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
                criterio : 'nomaeropuerto',
                buscar : '',
                arrayPais: [],
                

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

            
            listarAeropuertos(page,buscar,criterio){
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
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {
                });
            },
               

            cambiarPagina(page,buscar,criterio){
                let me = this;
                //actualizar pagina actual 
                me.pagination.current_page = page;
                //enviar peticion para visualizar la data  de esa pagina
                me.listarAeropuertos(page,buscar,criterio); 
            },
           
           registrarAeropuerto()
           {
                if (this.validarAeropuerto())   //evalua si el metodo validar categoria retorna 1
                {                              // y no realiza nada
                    return;
                }
                // en caso que validar categoria retorne diferente de 1 realizar lo siguiente
                let me=this;
                axios.post('/Aeropuerto/registrar', {
                    'nombre': this.nombre, 
                    'numero': this.numero,  
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarAeropuertos(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                });

           },

            actualizarAeropuerto()
           {
               if (this.validarAeropuerto())   //evalua si el metodo validar categoria retorna 1
                {                              // y no realiza nada
                    return;
                }
                // en caso que validar categoria retorne diferente de 1 realizar lo siguiente
                let me=this;
                axios.put('/Aeropuerto/actualizar', {
                    'nombre': this.nombre,
                    'numero': this.numero,
                    'Aeropuerto_id': this.Aeropuerto_id    
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarAeropuertos(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                });
           },

            desactivarAeropuerto(id)
            {

                swal({
                title: '¿Estas seguro de desactivar este tipo de documento?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonText: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    
                    let me=this;
                    axios.put('/Aeropuerto/desactivar', {
                        'id': id    
                    }).then(function (response) {
                        me.listarAeropuertos(1,'','nombre');
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
                title: '¿Estas seguro de activar este tipo de documento?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonText: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    
                    let me=this;
                    axios.put('/Aeropuerto/activar', {
                        'id': id    
                    }).then(function (response) {
                        me.listarAeropuertos(1,'','nombre');
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

            validarAeropuertos()
            {
                this.errorAeropuerto=0;
                this.errorMostrarMsjAeropuerto=[];

                if (!this.nombre) this.errorMostrarMsjAeropuerto.push("El nombre del tipo de costo no puede estar vacio");

                if (!this.numero) this.errorMostrarMsjAeropuerto.push("El nombre del tipo de costo no puede estar vacio");

                if (this.errorMostrarMsjAeropuerto.length) this.errorAeropuerto = 1;

                return this.errorAeropuerto;
            },

           cerrarModal()
           {
              this.modal=0;
              this.tituloModal='';
              this.nombre='';
              this.numero='';
              
           },

           abrirModal(modelo, accion, data = [])
           {
               switch(modelo)
               {
                   case "Aeropuerto":
                   {
                       switch(accion)
                       {
                           case 'registrar':
                           {
                               this.modal = 1;
                               this.tituloModal = 'Registrar Aeropuerto';
                               this.nombre = '';
                               this.numero = '';
                               this.tipoAccion = 1;
                               break;
                           } 
                           case 'actualizar':
                           {
                               this.modal = 1;
                               this.tituloModal = 'Actualizar Aeropuerto';
                               this.tipoAccion = 2;
                               this.Aeropuerto_id = data['codaeropuerto'];
                               this.nombre = data['nomdocumento'];
                               this.numero = data['numerodocumento'];
                               break;
                           }    
                        }
                   }    
                }
                 this.selectPais();
                 

           }
        },
        mounted() {
            this.listarAeropuertos(1,this.buscar,this.criterio);
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