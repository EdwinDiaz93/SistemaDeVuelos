<template>
        <!-- Contenido Principal -->
    <main class="main">
        <!-- Breadcrumb -->
       
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Precio
                    <button type="button" @click="abrirModal('precio', 'registrar')" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                  <option value="cantidadprecio">Precio</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarPrecio(1,buscar,criterio)"  class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarPrecio(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>                                
                                <th>Cantidad Precio</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="precio in arrayPrecio" :key="precio.idprecio">
                                <td>
                                    <button type="button" @click="abrirModal('precio', 'actualizar', precio)" class="btn btn-warning btn-sm">
                                      <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <template v-if="precio.estado=='1'">
                                        <button type="button" class="btn btn-danger btn-sm" @click="desactivarPrecio(precio.idprecio)">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </template>
                                    <template v-else>
                                        <button type="button" class="btn btn-info btn-sm" @click="activarPrecio(precio.idprecio)">
                                            <i class="icon-check"></i>
                                        </button>
                                    </template>
                                </td>                                
                                <td v-text="precio.cantidadprecio"></td>
                                <td>
                                    <div v-if="precio.estado == '1'">
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
                                <label class="col-md-3 form-control-label" for="text-input">Cantidad Precio</label>
                                <div class="col-md-9">
                                    <input type="number" v-model="cantidadprecio" class="form-control" >
                                </div>
                            </div>
                            
                            <div v-show="errorPrecio" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjPrecio" :key=error v-text="error">

                                    </div>
                                </div>        
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarPrecio">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarPrecio">Actualizar</button>
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
                precio_id : 0,                              
                cantidadprecio : 0,                
                arrayPrecio : [],
                modal : 0,
                tituloModal : '', 
                tipoAccion : 0,
                errorPrecio : 0,
                errorMostrarMsjPrecio: [],
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

            
            listarPrecio(page,buscar,criterio){
                let me=this;
                var url = '/precio?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio; 
                axios.get(url).then(function (response) {                    
                    var respuesta = response.data;                    
                    console.log(respuesta);
                    me.arrayPrecio = respuesta.precios.data;
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
                me.listarPrecio(page,buscar,criterio); 
            },
           
           registrarPrecio()
           {
                if (this.validarPrecio())   //evalua si el metodo validar categoria retorna 1
                {                              // y no realiza nada
                    return;
                }
                // en caso que validar categoria retorne diferente de 1 realizar lo siguiente
                let me=this;
                axios.post('/precio/registrar', {                    
                    "cantidadprecio":this.cantidadprecio,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarPrecio(1,'','cantidadprecio');
                }).catch(function (error) {
                    console.log(error);
                });

           },

            actualizarPrecio()
           {
               if (this.validarPrecio())   //evalua si el metodo validar categoria retorna 1
                {                              // y no realiza nada
                    return;
                }
                // en caso que validar categoria retorne diferente de 1 realizar lo siguiente
                let me=this;
                axios.put('/precio/actualizar', {                    
                    'precio_id': this.precio_id,
                    "cantidadprecio":this.cantidadprecio,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarPrecio(1,'','cantidadprecio');
                }).catch(function (error) {
                    console.log(error);
                });
           },

            desactivarPrecio(id)
            {

                swal({
                title: '¿Estas seguro de desactivar este precio?',
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
                    axios.put('/precio/desactivar', {
                        'id': id    
                    }).then(function (response) {
                        me.listarPrecio(1,'','cantidadprecio');
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

            activarPrecio(id)
            {

                swal({
                title: '¿Estas seguro de activar este precio?',
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
                    axios.put('/precio/activar', {
                        'id': id    
                    }).then(function (response) {
                        me.listarPrecio(1,'','cantidadprecio');
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

            validarPrecio()
            {
                this.errorPrecio=0;
                this.errorMostrarMsjPrecio=[];                

                if (!this.cantidadprecio || this.cantidadprecio<=0) this.errorMostrarMsjPrecio.push("La cantidad precio no puede estar vacio y debe ser mayor a 0");

                if (this.errorMostrarMsjPrecio.length) this.errorTipoAvion = 1;

                return this.errorPrecio;
            },

           cerrarModal()
           {
              this.modal=0;
              this.tituloModal='';              
              this.cantidadprecio=0;
           },

           abrirModal(modelo, accion, data = [])
           {
               switch(modelo)
               {
                   case "precio":
                   {
                       switch(accion)
                       {
                           case 'registrar':
                           {
                               this.modal = 1;
                               this.tituloModal = 'Registrar Precio';                               
                               this.cantidadprecio =0;
                               this.tipoAccion = 1;
                               break;
                           } 
                           case 'actualizar':
                           {
                               this.modal = 1;
                               this.tituloModal = 'Actualizar precio';
                               this.tipoAccion = 2;
                               this.precio_id = data['idprecio'];
                               this.cantidadprecio = data['cantidadprecio'];
                               break;
                           }    
                        }
                   }    
                }

           }
        },
        mounted() {
            this.listarPrecio(1,this.buscar,this.criterio);
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