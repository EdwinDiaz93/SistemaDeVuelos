<template>
        <!-- Contenido Principal -->
    <main class="main">
        
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Costos
                    <button type="button" @click="abrirModal('costo', 'registrar')" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                <option value="nomtipocosto">Tipo de costo</option> 
                                  <option value="descripcion">Descripción</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarCostos(1,buscar,criterio)"  class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarCostos(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Tipo de costo</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="costo in arrayCosto" :key="costo.idcosto">
                                <td>
                                    <button type="button" @click="abrirModal('costo', 'actualizar', costo)" class="btn btn-warning btn-sm">
                                      <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <template v-if="costo.estado=='1'">
                                        <button type="button" class="btn btn-danger btn-sm" @click="desactivarCosto(costo.idcosto)">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </template>
                                    <template v-else>
                                        <button type="button" class="btn btn-info btn-sm" @click="activarCosto(costo.idcosto)">
                                            <i class="icon-check"></i>
                                        </button>
                                    </template>
                                </td>
                                <td v-text="costo.nombre_tipocosto"></td>
                                <td v-text="costo.descripcion"></td> 
                                <td v-text="costo.cantidad"></td>         
                                <td>
                                    <div v-if="costo.estado=='1'">
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
                                <label class="col-md-3 form-control-label" for="text-input">Tipo de costo</label>
                                <div class="col-md-9">
                                    <select class="form-control" v-model="idtipocosto">
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="tipoCosto in arrayTipoCosto" :key="tipoCosto.idtipocosto" :value="tipoCosto.idtipocosto" 
                                        v-text="tipoCosto.nomtipocosto"></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="descripcion" class="form-control" placeholder="Descripcion del costo">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Cantidad</label>
                                <div class="col-md-9">
                                    <input type="number" v-model="cantidad" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div v-show="errorCosto" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjCosto" :key=error v-text="error">
                                    </div>
                                </div>        
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarCosto">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarCosto">Actualizar</button>
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
                costo_id : 0,
                idtipocosto : 0,
                nombre_tipocosto : '',
                cantidad : 0,
                descripcion : '', 
                arrayCosto : [],
                modal : 0,
                tituloModal : '', 
                tipoAccion : 0,
                errorCosto : 0,
                errorMostrarMsjCosto: [],
                pagination : {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
                },
                offset : 3,
                criterio : 'nomtipocosto', 
                buscar : '',
                arrayTipoCosto : []   //almacena el listado de las categorias 

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
            listarCostos(page,buscar,criterio){
                let me=this;
                var url = '/costos?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio; 
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayCosto = respuesta.costos.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {
                });
            },

             selectTipoCosto(){
                let me=this;
                var url = '/tipocosto/selectTipoCosto' ; 
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayTipoCosto = respuesta.tipoCostos;
                    //console.log(response);
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
                me.listarCostos(page,buscar,criterio); 
            },

           registrarCosto()
           {
                if (this.validarCosto())   //evalua si el metodo validar categoria retorna 1
                {                              // y no realiza nada
                    return;
                }
                // en caso que validar categoria retorne diferente de 1 realizar lo siguiente
                let me=this;
                axios.post('/costos/registrar', {
                    'idtipocosto': this.idtipocosto,
                    'cantidad': this.cantidad,
                    'descripcion': this.descripcion 
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarCostos(1,'','descripcion');
                }).catch(function (error) {
                    console.log(error);
                });

           },

            actualizarCosto()
           {
               if (this.validarCosto())   
                {                              
                    return;
                }

                let me=this;
                axios.put('/costos/actualizar', {
                    'idtipocosto': this.idtipocosto,
                    'cantidad': this.cantidad,
                    'descripcion': this.descripcion, 
                    'id': this.costo_id    
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarCostos(1,'','descripcion');
                }).catch(function (error) {
                    console.log(error);
                });
           },

            desactivarCosto(id)
            {

                swal({
                title: '¿Estas seguro de desactivar este costo?',
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
                    axios.put('/costos/desactivar', {
                        'id': id    
                    }).then(function (response) {
                        me.listarCostos(1,'','descripcion');
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

            activarCosto(id)
            {

                swal({
                title: '¿Estas seguro de activar este costo?',
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
                    axios.put('/costos/activar', {
                        'id': id    
                    }).then(function (response) {
                        me.listarCostos(1,'','descripcion');
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

            validarCosto()
            {
                this.errorCosto=0;
                this.errorMostrarMsjCosto=[];

                if (this.idtipocosto==0) this.errorMostrarMsjCosto.push("Seleccione un tipo de costo");
                if (!this.descripcion) this.errorMostrarMsjCosto.push("La descripcion del costo no puede estar vacio");
                if (!this.cantidad) this.errorMostrarMsjCosto.push("La cantidad del costo debe ser un numero y no puede estar vacio");
            

                if (this.errorMostrarMsjCosto.length) this.errorCosto = 1;

                return this.errorCosto;
            },

           cerrarModal()
           {
              this.modal = 0;
              this.tituloModal = '';
              this.idtipocosto= 0;
              this.nombre_tipocosto = '';
              this.cantidad = 0;
              this.descripcion='';
              this.errorCosto = 0;
           },

           abrirModal(modelo, accion, data = [])
           {
               switch(modelo)
               {
                   case "costo":
                   {
                       switch(accion)
                       {
                           case 'registrar':
                           {
                               this.modal = 1;
                               this.tituloModal = 'Registrar Costo';
                               this.idtipocosto= 0;
                               this.nombre_tipocosto = '';
                               this.cantidad = 0;
                               this.descripcion='';
                               this.tipoAccion = 1;
                               break;
                           } 
                           case 'actualizar':
                           {
                               this.modal = 1;
                               this.tituloModal = 'Actualizar Costo';
                               this.tipoAccion = 2;
                               this.costo_id = data['idcosto'];
                               this.idtipocosto = data['idtipocosto'];
                               this.cantidad = data['cantidad'];
                               this.descripcion = data['descripcion'];
                               break;
                           }    
                        }
                   }    
                }
                this.selectTipoCosto();
           }
        },
        mounted() {
            this.listarCostos(1,this.buscar,this.criterio);
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