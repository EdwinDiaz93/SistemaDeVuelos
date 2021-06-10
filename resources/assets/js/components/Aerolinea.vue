<template>
        <!-- Contenido Principal -->
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Escritorio</a></li>
        </ol>
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Aerolinea
                    <button type="button" @click="abrirModal('aeroLinea', 'registrar')" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                  <option value="codaerolinea">Codigo de Aerolinea</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarAerolineas(1,buscar,criterio)"  class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarAerolineas(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Codigo Aerolinea</th>
                                <th>Nombre Aerolinea</th>
                                <th>Nombre Representante</th>
                                <th>Fecha Fundacion</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="aeroLinea in arrayAerolineas" :key="aeroLinea.codaerolinea">
                                <td>
                                    <button type="button" @click="abrirModal('aeroLinea', 'actualizar', aeroLinea)" class="btn btn-warning btn-sm">
                                      <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <template v-if="aeroLinea.estado=='1'">
                                        <button type="button" class="btn btn-danger btn-sm" @click="desactivarAeroLinea(aeroLinea.codaerolinea)">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </template>
                                    <template v-else>
                                        <button type="button" class="btn btn-info btn-sm" @click="activarAeroLinea(aeroLinea.codaerolinea)">
                                            <i class="icon-check"></i>
                                        </button>
                                    </template>
                                </td>
                                <td v-text="aeroLinea.codaerolinea"></td>
                                <td v-text="aeroLinea.nombreaerolinea"></td>
                                <td v-text="aeroLinea.nombrerepresentante"></td>
                                <td v-text="aeroLinea.fechafundacion"></td>
                                <td>
                                    <div v-if="aeroLinea.estado == '1'">
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
                                <label class="col-md-3 form-control-label" for="text-input">Codigo de Aerolinea</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="codaerolinea" class="form-control" placeholder="codigo de aerolinea">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre de Aerolinea</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="nombreaerolinea" class="form-control" placeholder="nombre de aerolinea" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre Oficial</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="nombreoficial" class="form-control" placeholder="nombre oficial" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre Corto</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="nombrecorto" class="form-control" placeholder="nombre corto" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre de Representante</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="nombrerepresentante" class="form-control"  placeholder="nombre de representante">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Fecha de Fundacion</label>
                                <div class="col-md-9">
                                    <input type="date" v-model="fechafundacion" class="form-control" >
                                </div>
                            </div>
                                                        
                            <div v-show="errorAerolinea" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjAerolinea" :key=error v-text="error">

                                    </div>
                                </div>        
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarAeroLinea">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarAeroLinea">Actualizar</button>
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
                codaerolinea : '',                
                nombreaerolinea : '',                
                nombreoficial : '',                
                nombrecorto : '',                
                nombrerepresentante : '',                
                fechafundacion : '',                
                arrayAerolineas : [],
                modal : 0,
                tituloModal : '', 
                tipoAccion : 0,
                errorAerolinea : 0,
                errorMostrarMsjAerolinea: [],
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

            
            listarAerolineas(page,buscar,criterio){
                let me=this;
                var url = '/aerolinea?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio; 
                axios.get(url).then(function (response) {                    
                    var respuesta = response.data;                                        
                    me.arrayAerolineas = respuesta.aerolineas.data;
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
                me.listarAerolineas(page,buscar,criterio); 
            },
           
           registrarAeroLinea()
           {
                if (this.validarAeroLinea())   //evalua si el metodo validar categoria retorna 1
                {                              // y no realiza nada
                    return;
                }
                // en caso que validar categoria retorne diferente de 1 realizar lo siguiente
                let me=this;
                axios.post('/aerolinea/registrar', {
                    'codaerolinea': this.codaerolinea,
                    "nombreaerolinea":this.nombreaerolinea,
                    "nombreoficial":this.nombreoficial,
                    "nombrecorto":this.nombrecorto,
                    "nombrerepresentante":this.nombrerepresentante,
                    "fechafundacion":this.fechafundacion,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarAerolineas(1,'','codaerolinea');
                }).catch(function (error) {
                    console.log(error);
                });

           },

            actualizarAeroLinea()
           {
               if (this.validarAeroLinea())   //evalua si el metodo validar categoria retorna 1
                {                              // y no realiza nada
                    return;
                }
                // en caso que validar categoria retorne diferente de 1 realizar lo siguiente
                let me=this;
                axios.put('/aerolinea/actualizar', {
                    'codaerolinea': this.codaerolinea,
                    "nombreaerolinea":this.nombreaerolinea,
                    "nombreoficial":this.nombreoficial,
                    "nombrecorto":this.nombrecorto,
                    "nombrerepresentante":this.nombrerepresentante,
                    "fechafundacion":this.fechafundacion,                    
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarAerolineas(1,'','codaerolinea');
                }).catch(function (error) {
                    console.log(error);
                });
           },

            desactivarAeroLinea(id)
            {

                swal({
                title: '¿Estas seguro de desactivar esta aerolinea?',
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
                    axios.put('/aerolinea/desactivar', {
                        'id': id    
                    }).then(function (response) {
                        me.listarAerolineas(1,'','codaerolinea');
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

            activarAeroLinea(id)
            {

                swal({
                title: '¿Estas seguro de activar esta aerolinea?',
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
                    axios.put('/aerolinea/activar', {
                        'id': id    
                    }).then(function (response) {
                        me.listarAerolineas(1,'','codaerolinea');
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

            validarAeroLinea()
            {
                this.errorAerolinea=0;
                this.errorMostrarMsjAerolinea=[];

                if (!this.codaerolinea) this.errorMostrarMsjAerolinea.push("El codigo de la aerolina no puede estar vacio ni se puede repetir");
                if (!this.nombreaerolinea) this.errorMostrarMsjAerolinea.push("El nombre de la aerolinea no puede estar vacio");
                if (!this.nombreoficial) this.errorMostrarMsjAerolinea.push("El nombre oficial no puede estar vacio");
                if (!this.nombrecorto) this.errorMostrarMsjAerolinea.push("El nombre corto no puede estar vacio");
                if (!this.nombrerepresentante) this.errorMostrarMsjAerolinea.push("El nombre del representante no puede estar vacio");
                if (!this.fechafundacion) this.errorMostrarMsjAerolinea.push("La fecha no puede estar vacia");

                if (this.errorMostrarMsjAerolinea.length) this.errorAerolinea = 1;

                return this.errorAerolinea;
            },

           cerrarModal()
           {
                this.modal=0;
                this.tituloModal='';
                this.codaerolinea='';
                this.nombreaerolinea='';
                this.nombreoficial='';
                this.nombrecorto='';
                this.nombrerepresentante='';
                this.fechafundacion='';
           },

           abrirModal(modelo, accion, data = [])
           {
               switch(modelo)
               {
                   case "aeroLinea":
                   {
                       switch(accion)
                       {
                           case 'registrar':
                           {
                                this.modal = 1;
                                this.tipoAccion = 1;
                                this.tituloModal = 'Registrar AeroLinea';
                                this.codaerolinea='';
                                this.nombreaerolinea='';
                                this.nombreoficial='';
                                this.nombrecorto='';
                                this.nombrerepresentante='';
                                this.fechafundacion=''                                
                               break;
                           } 
                           case 'actualizar':
                           {
                               this.modal = 1;
                               this.tipoAccion = 2;
                               this.tituloModal = 'Actualizar AeroLinea';
                               this.codaerolinea=data['codaerolinea'];
                                this.nombreaerolinea=data['nombreaerolinea'];
                                this.nombreoficial=data['nombreoficial'];
                                this.nombrecorto=data['nombrecorto'];
                                this.nombrerepresentante=data['nombrerepresentante'];
                                this.fechafundacion=data['fechafundacion'];
                               break;
                           }    
                        }
                   }    
                }

           }
        },
        mounted() {
            this.listarAerolineas(1,this.buscar,this.criterio);
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