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
                    <i class="fa fa-align-justify"></i> Usuarios
                    <button type="button" @click="abrirModal('usuario', 'registrar')" class="btn btn-secondary">
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
                                <option value="nomusuario">Usuario</option> 
                                  <option value="nomrol">Rol</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarUsuarios(1,buscar,criterio)"  class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarUsuarios(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>ID</th>
                                <th>Nombre de Usuario</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="usuario in arrayUsuario" :key="usuario.idusuario">
                                <td>
                                    <button type="button" @click="abrirModal('usuario', 'actualizar', usuario)" class="btn btn-warning btn-sm">
                                      <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <template v-if="usuario.estado=='1'">
                                        <button type="button" class="btn btn-danger btn-sm" @click="desactivarUsuario(usuario.idusuario)">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </template>
                                    <template v-else>
                                        <button type="button" class="btn btn-info btn-sm" @click="activarUsuario(usuario.idusuario)">
                                            <i class="icon-check"></i>
                                        </button>
                                    </template>
                                </td>
                                <td v-text="usuario.idusuario"></td>
                                <td v-text="usuario.nomusuario"></td> 
                                <td v-text="usuario.email"></td>     
                                 <td v-text="usuario.nombre_rol"></td>   
                                <td>
                                    <div v-if="usuario.estado=='1'">
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
                                <label class="col-md-3 form-control-label" for="usuario">Usuario</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="nomusuario" class="form-control" placeholder="Usuario">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="email">Email</label>
                                <div class="col-md-9">
                                    <input type="email" v-model="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="password">Password</label>
                                <div class="col-md-9">
                                    <input type="password" v-model="password1" class="form-control" placeholder="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Rol</label>
                                <div class="col-md-9">
                                    <select class="form-control" v-model="idrol">
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="rol in arrayRol" :key="rol.idrol" :value="rol.idrol" 
                                        v-text="rol.nomrol"></option>
                                    </select>
                                </div>
                            </div>
                        
                            <div v-show="errorUsuario" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjUsuario" :key=error v-text="error">
                                    </div>
                                </div>        
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarUsuario">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarUsuario">Actualizar</button>
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
                idusuario : 0,
                idpersona : 0,
                idrol : 0,
                nomusuario : '',
                email : '',
                password1 : '',
                password2 : '', 
                arrayUsuario : [],
                modal : 0,
                tituloModal : '', 
                tipoAccion : 0,
                errorUsuario : 0,
                errorMostrarMsjUsuario: [],
                pagination : {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
                },
                offset : 3,
                criterio : 'nomusuario', 
                buscar : '',
                arrayRol : []   //almacena el listado de los roles 

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
            listarUsuarios(page,buscar,criterio){
                let me=this;
                var url = '/user?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio; 
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayUsuario = respuesta.usuarios.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {
                });
            },

              selectRol(){
                let me=this;
                var url = '/rol/selectRol' ; 
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayRol = respuesta.roles;
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {
                });
            },
              cargarPdf(){
                window.open('http://127.0.0.1:8000/user/listarPdf','_blank');
            },

            cambiarPagina(page,buscar,criterio){
                let me = this;
                //actualizar pagina actual 
                me.pagination.current_page = page;
                //enviar peticion para visualizar la data  de esa pagina
                me.listarUsuarios(page,buscar,criterio); 
            },

           registrarUsuario()
           {
                if (this.validarUsuario())   //evalua si el metodo validar categoria retorna 1
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

            actualizarUsuario()
           {
               if (this.validarUsuario())   
                {                              
                    return;
                }

                let me=this;
                axios.put('/user/actualizar', {
                    'idusuario': this.idusuario,
                    'idpersona': this.idpersona,
                    'nomusuario': this.nomusuario,
                    'password': this.password1,
                    'email': this.email, 
                    'idrol': this.idrol    
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarUsuarios(1,'','nomusuario');
                }).catch(function (error) {
                    console.log(error);
                });
           },

            desactivarUsuario(id)
            {

                swal({
                title: '¿Estas seguro de desactivar este usuario?',
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
                    axios.put('/user/desactivar', {
                        'id': id    
                    }).then(function (response) {
                        me.listarUsuarios(1,'','nomusuario');
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

            activarUsuario(id)
            {

                swal({
                title: '¿Estas seguro de activar este usuario?',
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
                    axios.put('/user/activar', {
                        'id': id    
                    }).then(function (response) {
                        me.listarUsuarios(1,'','nomusuario');
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

            validarUsuario()
            {
                this.errorUsuario=0;
                this.errorMostrarMsjUsuario=[];
                
                if (!this.nomusuario) this.errorMostrarMsjUsuario.push("El campo usuario no puede estar vacio");
                if (!this.email) this.errorMostrarMsjUsuario.push("El campo email no puede estar vacio");
                if (!this.password1) this.errorMostrarMsjUsuario.push("El campo password no puede estar vacio");
                if (this.idrol==0) this.errorMostrarMsjUsuario.push("Seleccione un rol");
                
                if (this.errorMostrarMsjUsuario.length) this.errorUsuario = 1;

                return this.errorUsuario;
            },

           cerrarModal()
           {
              this.modal = 0;
              this.tituloModal = '';
              this.idusuario= 0;
              this.idpersona= 0;
              this.idrol= 0;
              this.nomusuario = '';
              this.email = '';
              this.password1 = '';
              this.errorUsuario = 0;
           },

           abrirModal(modelo, accion, data = [])
           {
               switch(modelo)
               {
                   case "usuario":
                   {
                       switch(accion)
                       {
                           case 'registrar':
                           {
                               this.modal = 1;
                               this.tituloModal = 'Registrar Usuario';
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
                               this.tituloModal = 'Actualizar Usuario';
                               this.tipoAccion = 2;
                               this.idusuario = data['idusuario'];
                               this.idpersona = data['idpersona'];
                               this.idrol = data['idrol'];
                               this.nomusuario = data['nomusuario'];
                               this.password1 = data['password'];
                               this.email = data['email'];
                               break;
                           }    
                        }
                   }    
                }
                this.selectRol();
           }
        },
        mounted() {
            this.listarUsuarios(1,this.buscar,this.criterio);
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