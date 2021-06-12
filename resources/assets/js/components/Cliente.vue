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
                    <i class="fa fa-align-justify"></i> Clientes
                    <button type="button" @click="abrirModal('cliente', 'registrar')" class="btn btn-secondary">
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
                                <input type="text" v-model="buscar" @keyup.enter="listarCliente(1,buscar,criterio)"  class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarCliente(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>P Nom</th>
                                <th>S Nom</th>
                                <th>P Ape</th>
                                <th>S Ape</th>
                                <th>DUI</th>
                                <th>NIT</th>
                                <th>Pasaporte</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="cliente in arrayCliente" :key="cliente.idcliente">
                                <td>
                                    <button type="button" @click="abrirModal('cliente', 'actualizar', cliente)" class="btn btn-warning btn-sm">
                                      <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                </td>
                                <td v-text="cliente.pnombre"></td>
                                <td v-text="cliente.snombre"></td> 
                                <td v-text="cliente.papellido"></td> 
                                <td v-text="cliente.sapellido"></td> 
                                <td v-text="cliente.dui"></td> 
                                <td v-text="cliente.nit"></td> 
                                <td v-text="cliente.pasaporte"></td>         
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
                                <label class="col-md-2 form-control-label" for="text-input">1er Nombre</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="pnombre" class="form-control" placeholder="1er Nombre persona/empresa">
                                </div>
                                <label class="col-md-2 form-control-label" for="text-input">Telefono Fijo</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="telefono" class="form-control" placeholder="Telefono persona/empresa" >
                                </div>
                            </div>                            
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="text-input">2do Nombre</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="snombre" class="form-control" placeholder="2do Nombre persona" >
                                </div>
                                <label class="col-md-2 form-control-label" for="text-input">Movil</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="movil" class="form-control" placeholder="Movil persona" >
                                </div>
                            </div>                            
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="text-input">1er Apellido</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="papellido" class="form-control"  placeholder="1er Apellido persona">
                                </div>
                                <label class="col-md-2 form-control-label" for="text-input">Estado Civil</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="estadocivil" class="form-control" placeholder="Estado civil persona">
                                </div>
                            </div>                           
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="text-input">2do Apellido</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="sapellido" class="form-control" placeholder="2do Apellido persona">
                                </div>
                                <label class="col-md-2 form-control-label" for="text-input">Genero</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="genero" class="form-control" placeholder="Genero de la persona">
                                </div>
                            </div>     
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="text-input">DUI</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="dui" class="form-control" placeholder="DUI persona">
                                </div>
                                <label class="col-md-2 form-control-label" for="text-input">Nombre Contacto</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="nomcontacto" class="form-control" placeholder="Nombre contacto empresas">
                                </div>
                            </div>    
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="text-input">NIT</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="nit" class="form-control" placeholder="NIT persona/empresa">
                                </div>
                                <label class="col-md-2 form-control-label" for="text-input">No. Cliente Frecuente</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="numfrecuente" class="form-control" placeholder="No. frecuente persona/empresa">
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="text-input">Pasaporte</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="pasaporte" class="form-control" placeholder="No. Pasaporte persona">
                                </div>
                                <label class="col-md-2 form-control-label" for="text-input">Usuario</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="nomusuario" class="form-control" placeholder="usuario">
                                </div>
                            </div>     
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="text-input">Fecha Nac/Fund</label>
                                <div class="col-md-4">
                                    <input type="date" v-model="fechanaci" class="form-control" >
                                </div>
                                <label class="col-md-2 form-control-label" for="text-input">Password</label>
                                <div class="col-md-4">
                                    <input type="password" v-model="password" class="form-control" placeholder="password">
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="text-input">Direccion</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="direccion" class="form-control" placeholder="Direccion persona/empresa">
                                </div>
                                <label class="col-md-2 form-control-label" for="text-input">Rol</label>
                                <div class="col-md-4">
                                    <select class="form-control" v-model="idrol">
                                        <option value="0" disabled>--Seleccione--</option>
                                        <option v-for="rol in arrayRol" :key="rol.idrol"  :value="rol.idrol" v-text="rol.nomrol" ></option>
                                    </select>
                                </div>
                            </div> 
                             <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="text-input">Email</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="email" class="form-control" placeholder="email persona/empresa">
                                </div>
                            </div>                     
                            <div v-show="errorCliente" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjCliente" :key=error v-text="error">
                                    </div>
                                </div>        
                            </div>
                        </form>
                    </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarCliente">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarCliente">Actualizar</button>
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

                persona_id : 0,               
                pnombre : '',                
                snombre : '',                
                papellido : '',                
                sapellido : '',                
                dui : '',                
                nit : '',
                pasaporte:'',
                fechanaci:'',
                direccion:'',
                telefono : '',                
                movil : '',  
                //variables para cliente
                cliente_id : 0,
                estadocivil : '',                
                genero : '',                
                nomcontacto : '',                
                numfrecuente : '',
                //variables para usuario
                idrol: 0,
                nomusuario:'',
                password:'',
                email:'',
                arrayCliente : [],
                modal : 0,
                tituloModal : '', 
                tipoAccion : 0,
                errorCliente : 0,
                errorMostrarMsjCliente: [],
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
            listarCliente(page,buscar,criterio){
                let me=this;
                var url = '/cliente?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio; 
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayCliente = respuesta.clientes.data;
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

            cambiarPagina(page,buscar,criterio){
                let me = this;
                //actualizar pagina actual 
                me.pagination.current_page = page;
                //enviar peticion para visualizar la data  de esa pagina
                me.listarCliente(page,buscar,criterio); 
            },

           registrarCliente()
           {
                if (this.validarCliente())   //evalua si el metodo validar categoria retorna 1
                {                              // y no realiza nada
                    return;
                }
                // en caso que validar cliente retorne diferente de 1 realizar lo siguiente
                let me=this;
                axios.post('/cliente/registrar', {

                    'pnombre': this.pnombre,
                    'snombre': this.snombre,
                    'papellido': this.papellido,
                    'sapellido': this.sapellido,
                    'dui': this.dui,
                    'nit': this.nit,
                    'pasaporte': this.pasaporte,
                    'fechanaci': this.fechanaci,
                    'direccion': this.direccion,
                    'telefono': this.telefono,
                    'movil': this.movil,

                    'puesto': this.estadocivil,
                    'salario': this.genero,
                    'nomcontacto': this.nomcontacto,
                    'numfrecuente': this.numfrecuente,

                    'nomusuario': this.nomusuario,
                    'password': this.password,
                    'email': this.email,
                    'idrol': this.idrol
                    

                }).then(function (response) {
                    me.cerrarModal();
                    me.listarCliente(1,'','estadocivil');
                }).catch(function (error) {
                    console.log(error);
                });

           },

            actualizarCliente()
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

            validarCliente()
            {
                this.errorCliente=0;
                this.errorMostrarMsjCliente=[];

                if (this.idrol==0) this.errorMostrarMsjCliente.push("Seleccione un roll");
                if (!this.pnombre) this.errorMostrarMsjCliente.push("El primer nombre no puede estar vacio");

            

                if (this.errorMostrarMsjCliente.length) this.errorCliente = 1;

                return this.errorCliente;
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
                   case "cliente":
                   {
                       switch(accion)
                       {
                           case 'registrar':
                           {
                               this.modal = 1;
                               this.tituloModal = 'Registrar Cliente';
                               
                                this.pnombre = '';
                                this.snombre = '';
                                this.papellido = '';
                                this.sapellido = '';
                                this.dui = '';
                                this.nit = '';
                                this.pasaporte = '';
                                this.fechanaci = '';
                                this.direccion = '';
                                this.telefono = '';
                                this.movil = '';

                                this.estadocivil = '';
                                this.genero = '';
                                this.nomcontacto = '';
                                this.numfrecuente = '';

                                this.nomusuario = '';
                                this.cantidad = '';
                                this.email = '';
                                this.idrol = '';
                                this.tipoAccion = 1;
                               break;
                           } 
                           case 'actualizar':
                           {
                               this.modal = 1;
                               this.tituloModal = 'Actualizar Cliente';
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
                this.selectRol();
           }
        },
        mounted() {
            this.listarCliente(1,this.buscar,this.criterio);
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