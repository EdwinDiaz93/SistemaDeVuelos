<template>
        <!-- Contenido Principal -->
    <main class="main">
        <!-- Breadcrumb -->
       
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Tipo de Avion
                    <button type="button" @click="abrirModal('tipoAvion', 'registrar')" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                  <option value="nombretipoavion">Tipo de avion</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarTiposAvion(1,buscar,criterio)"  class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarTiposAvion(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="tipoAvion in arrayTiposAvion" :key="tipoAvion.idtipoavion">
                                <td>
                                    <button type="button" @click="abrirModal('tipoAvion', 'actualizar', tipoAvion)" class="btn btn-warning btn-sm">
                                      <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <template v-if="tipoAvion.estado=='1'">
                                        <button type="button" class="btn btn-danger btn-sm" @click="desactivarTipoAvion(tipoAvion.idtipoavion)">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </template>
                                    <template v-else>
                                        <button type="button" class="btn btn-info btn-sm" @click="activarTipoAvion(tipoAvion.idtipoavion)">
                                            <i class="icon-check"></i>
                                        </button>
                                    </template>
                                </td>
                                <td v-text="tipoAvion.nombretipoavion"></td>
                                <td v-text="tipoAvion.cantidadasientos"></td>
                                <td>
                                    <div v-if="tipoAvion.estado == '1'">
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
                                <label class="col-md-3 form-control-label" for="text-input">Nombre Tipo Avion</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="nombre" class="form-control" placeholder="Nombre Tipo Avion">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Cantidad de asientos</label>
                                <div class="col-md-9">
                                    <input type="number" v-model="cantidad" class="form-control" >
                                </div>
                            </div>
                            
                            <div v-show="errorTipoAvion" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjTipoAvion" :key=error v-text="error">

                                    </div>
                                </div>        
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarTipoAvion">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarTipoAvion">Actualizar</button>
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
                tipoavion_id : 0,
                nombre : '',                
                cantidad : 0,                
                arrayTiposAvion : [],
                modal : 0,
                tituloModal : '', 
                tipoAccion : 0,
                errorTipoAvion : 0,
                errorMostrarMsjTipoAvion: [],
                pagination : {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
                },
                offset : 3,
                criterio : 'nombretipoavion', 
                buscar : ""

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

            
            listarTiposAvion(page,buscar,criterio){
                let me=this;
                var url = '/tipoavion?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio; 
                axios.get(url).then(function (response) {                    
                    var respuesta = response.data;                    
                    console.log(respuesta);
                    me.arrayTiposAvion = respuesta.tiposavion.data;
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
                me.listarTiposAvion(page,buscar,criterio); 
            },
           
           registrarTipoAvion()
           {
                if (this.validarTiposAvion())   //evalua si el metodo validar categoria retorna 1
                {                              // y no realiza nada
                    return;
                }
                // en caso que validar categoria retorne diferente de 1 realizar lo siguiente
                let me=this;
                axios.post('/tipoavion/registrar', {
                    'nombre': this.nombre,
                    "cantidad":this.cantidad,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarTiposAvion(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                });

           },

            actualizarTipoAvion()
           {
               if (this.validarTiposAvion())   //evalua si el metodo validar categoria retorna 1
                {                              // y no realiza nada
                    return;
                }
                // en caso que validar categoria retorne diferente de 1 realizar lo siguiente
                let me=this;
                axios.put('/tipoavion/actualizar', {
                    'nombre': this.nombre,
                    "cantidad":this.cantidad,
                    'tipoavion_id': this.tipoavion_id,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarTiposAvion(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                });
           },

            desactivarTipoAvion(id)
            {

                swal({
                title: '¿Estas seguro de desactivar este tipo de avion?',
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
                    axios.put('/tipoavion/desactivar', {
                        'id': id    
                    }).then(function (response) {
                        me.listarTiposAvion(1,'','nombre');
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

            activarTipoAvion(id)
            {

                swal({
                title: '¿Estas seguro de activar este tipo de avion?',
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
                    axios.put('/tipoavion/activar', {
                        'id': id    
                    }).then(function (response) {
                        me.listarTiposAvion(1,'','nombre');
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

            validarTiposAvion()
            {
                this.errorTipoAvion=0;
                this.errorMostrarMsjTipoAvion=[];

                if (!this.nombre) this.errorMostrarMsjTipoAvion.push("El nombre del tipo de avion no puede estar vacio");
                if (!this.cantidad || this.cantidad<0) this.errorMostrarMsjTipoAvion.push("La cantidad de aviones no puede estar vacio y debe ser mayor a 0");

                if (this.errorMostrarMsjTipoAvion.length) this.errorTipoAvion = 1;

                return this.errorTipoAvion;
            },

           cerrarModal()
           {
              this.modal=0;
              this.tituloModal='';
              this.nombre='';
              this.cantidad=0;
           },

           abrirModal(modelo, accion, data = [])
           {
               switch(modelo)
               {
                   case "tipoAvion":
                   {
                       switch(accion)
                       {
                           case 'registrar':
                           {
                               this.modal = 1;
                               this.tituloModal = 'Registrar Tipo de avion';
                               this.nombre = '';
                               this.cantidad =0;
                               this.tipoAccion = 1;
                               break;
                           } 
                           case 'actualizar':
                           {
                               this.modal = 1;
                               this.tituloModal = 'Actualizar Tipo de avion';
                               this.tipoAccion = 2;
                               this.tipoavion_id = data['idtipoavion'];
                               this.nombre = data['nombretipoavion'];
                               this.cantidad = data['cantidadasientos'];
                               break;
                           }    
                        }
                   }    
                }

           }
        },
        mounted() {
            this.listarTiposAvion(1,this.buscar,this.criterio);
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