<template>
        <!-- Contenido Principal -->
    <main class="main">
        <!-- Breadcrumb -->
       
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Avion
                    <button type="button" @click="abrirModal('Avion', 'registrar')" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                    <option value="modeloavion">Modelo</option>
                                    <option value="marcaavion">Avion</option> 
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarAviones(1,buscar,criterio)"  class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarAviones(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Modelo de avion</th>
                                <th>Marca de avion</th>
                                <th>Tipo de avion</th>
                                <th>Codigo de Aerolinea</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="Avion in arrayAvion" :key="Avion.idAvion">
                                <td>
                                    <button type="button" @click="abrirModal('Avion', 'actualizar', Avion)" class="btn btn-warning btn-sm">
                                      <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <template v-if="Avion.estado=='1'">
                                        <button type="button" class="btn btn-danger btn-sm" @click="desactivarAvion(Avion.idavion)">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </template>
                                    <template v-else>
                                        <button type="button" class="btn btn-info btn-sm" @click="activarAvion(Avion.idavion)">
                                            <i class="icon-check"></i>
                                        </button>
                                    </template>
                                </td>
                                <td v-text="Avion.modeloavion"></td>
                                <td v-text="Avion.marcaavion"></td> 
                                <td v-text="Avion.tipoavion.nombretipoavion"></td>         
                                <td v-text="Avion.aerolinea_cod"></td>         
                                <td>
                                    <div v-if="Avion.estado=='1'">
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
                                <label class="col-md-3 form-control-label" for="text-input">Tipo de Avion</label>
                                <div class="col-md-9">
                                    <select class="form-control" v-model="tipoavion_id">
                                        <option value="0" disabled>Seleccione o agregue  un tipo de avion</option>
                                        <option v-for="tipoAvion in arrayTipoAvion" :key="tipoAvion.idtipoavion" :value="tipoAvion.idtipoavion" 
                                        v-text="tipoAvion.nombretipoavion"></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Aero Linea</label>
                                <div class="col-md-9">
                                    <select class="form-control" v-model="aerolinea_cod">
                                        <option value="" disabled>Seleccione o agregue una aerolinea</option>
                                        <option v-for="aeroLinea in arrayAeroLinea" :key="aeroLinea.codaerolinea" :value="aeroLinea.codaerolinea" 
                                        v-text="aeroLinea.nombreaerolinea"></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Modelo Avion</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="modeloavion" class="form-control" placeholder="Modelo del Avion">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Marca avion</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="marcaavion" class="form-control" placeholder="Marca del avion">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Cantidad de aviones</label>
                                <div class="col-md-9">
                                    <input type="number" v-model="cantidad" class="form-control" >
                                </div>
                            </div>
                            <div v-show="errorAvion" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjAvion" :key=error v-text="error">
                                    </div>
                                </div>        
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarAvion">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarAvion">Actualizar</button>
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
                Avion_id : 0,
                idAvion : 0,
                cantidad : 0,
                aerolinea_cod :'',
                tipoavion_id:0,
                modeloavion : '',
                marcaavion : '',                
                arrayAvion : [],
                arrayTipoAvion : [],
                arrayAeroLinea : [],
                modal : 0,
                tituloModal : '', 
                tipoAccion : 0,
                errorAvion : 0,
                errorMostrarMsjAvion: [],
                pagination : {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
                },
                offset : 3,
                criterio : '', 
                buscar : '',
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
            listarAviones(page,buscar,criterio){
                let me=this;
                var url ='/avion?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio; 
                axios.get(url).then(function (response) {
                    var respuesta = response.data;       
                    console.log(respuesta);             
                    me.arrayAvion = respuesta.aviones.data;
                    me.pagination = respuesta.pagination;
                    me.arrayTipoAvion=respuesta.tiposavion.data;
                    me.arrayAeroLinea=respuesta.aerolineas.data;
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
                me.listarAviones(page,buscar,criterio); 
            },

           registrarAvion()
           {
                if (this.validarAvion())   //evalua si el metodo validar categoria retorna 1
                {                              // y no realiza nada
                    return;
                }
                // en caso que validar categoria retorne diferente de 1 realizar lo siguiente
                let me=this;
                axios.post('/avion/registrar', {                    
                    'modeloavion': this.modeloavion,
                    'marcaavion': this.marcaavion, 
                    'tipoavion_id':this.tipoavion_id,
                    "aerolinea_cod":this.aerolinea_cod,                    
                    "cantidad":this.cantidad,   
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarAviones(1,'','modeloavion');
                }).catch(function (error) {
                    console.log(error);
                });

           },

            actualizarAvion()
           {
               if (this.validarAvion())   
                {                              
                    return;
                }

                let me=this;
                axios.put('/avion/actualizar', {
                    'idavion': this.Avion_id,
                    'modeloavion': this.modeloavion,
                    'marcaavion': this.marcaavion,
                    "tipoavion_id":this.tipoavion_id,                    
                    "aerolinea_cod":this.aerolinea_cod,                    
                    "cantidad":this.cantidad,                    
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarAviones(1,'','modeloavion');
                }).catch(function (error) {
                    console.log(error);
                });
           },

            desactivarAvion(id)
            {

                swal({
                title: '¿Estas seguro de desactivar este Avion?',
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
                    axios.put('/avion/desactivar', {
                        'id': id    
                    }).then(function (response) {
                        me.listarAviones(1,'','modeloavion');
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

            activarAvion(id)
            {

                swal({
                title: '¿Estas seguro de activar este Avion?',
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
                    axios.put('/avion/activar', {
                        'id': id    
                    }).then(function (response) {
                        me.listarAviones(1,'','modeloavion');
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

            validarAvion()
            {
                this.errorAvion=0;
                this.errorMostrarMsjAvion=[];

                if (!this.modeloavion) this.errorMostrarMsjAvion.push("modelo de avion no puede estar vacio");
                if (!this.marcaavion ) this.errorMostrarMsjAvion.push("marca de avion no puede estar vacio");
                if (this.tipoavion_id===0) this.errorMostrarMsjAvion.push("tipo de avion no puede estar vacio");
                if (this.aerolinea_cod==="") this.errorMostrarMsjAvion.push("aerolinea no puede estar vacia");
                if (this.cantidad===0|| this.cantidad<0) this.errorMostrarMsjAvion.push("cantidad no puede estar vacia y debe ser mayor a 0");
            

                if (this.errorMostrarMsjAvion.length) this.errorAvion = 1;

                return this.errorAvion;
            },

           cerrarModal()
           {
              this.modal = 0;
              this.tituloModal = '';
              this.tipoavion_id= 0;
              this.cantidad= 0;
              this.aerolinea_cod='';
              this.modeloavion = '';
              this.marcaavion = "";              
              this.errorAvion = 0;
           },

           abrirModal(modelo, accion, data = [])
           {
               switch(modelo)
               {
                   case "Avion":
                   {
                       switch(accion)
                       {
                           case 'registrar':
                           {
                               this.modal = 1;
                               this.tituloModal = 'Registrar Avion';
                               this.tipoavion_id= 0;
                               this.modeloavion = '';
                               this.marcaavion = '';
                               this.aerolinea_cod='';
                               this.cantidad= 0;
                               this.tipoAccion = 1;
                               break;
                           } 
                           case 'actualizar':
                           {
                               this.modal = 1;
                               this.tituloModal = 'Actualizar Avion';
                               this.tipoAccion = 2;
                               this.Avion_id = data['idavion'];
                               this.tipoavion_id = data['tipoavion_id'];
                               this.aerolinea_cod=data['aerolinea_cod'];
                               this.cantidad=data['cantidad'];
                               this.modeloavion = data['modeloavion'];
                               this.marcaavion = data['marcaavion'];
                               break;
                           }    
                        }
                   }    
                }                
           }
        },
        mounted() {
            this.listarAviones(1,this.buscar,this.criterio);
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