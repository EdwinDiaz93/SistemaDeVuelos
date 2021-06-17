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
                    <i class="fa fa-align-justify"></i> Reserva
                    <button type="button" @click="abrirModal('reserva', 'registrar')" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                    <option value="cliente_id">Cliente</option>                                    
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarReserva(1,buscar,criterio)"  class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarReserva(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>                                
                                <th>Cliente</th>
                                <th>Aerolinea</th>                                
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="reserva in arrayReserva" :key="reserva.idreserva">
                                <td>
                                    
                                    <template v-if="reserva.estado=='0'">                                        
                                    <button type="button" @click="abrirModal('reserva', 'pagar', reserva)" class="btn btn-success ">
                                      <span >$$</span>
                                    </button> &nbsp;
                                    </template>
                                    <template v-else>                                        
                                           <button class="btn btn-success icon-check"></button>                                   
                                    </template>
                                </td>
                                <td v-text="reserva.cliente.nomcontacto"></td>
                                <td v-text="reserva.vuelo.aerolinea_cod"></td>                                 
                                <td>
                                    <div v-if="reserva.estado=='1'">
                                        <span class="badge badge-success">Pagado</span>
                                    </div>
                                    <div v-else>
                                        <span class="badge badge-danger">Pendiente</span>
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
            <template v-if="tipoAccion==1">
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
                                <label class="col-12 form-control-label" for="text-input">Cliente</label>
                                <div class="col-12">
                                    <select class="form-control " v-model="cliente_id">
                                        <option value="0" disabled>Seleccione o agregue  cliente</option>
                                        <option v-for="cliente in arrayCliente" :key="cliente.idcliente" :value="cliente.idcliente" 
                                        v-text="cliente.nomcontacto"></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 form-control-label" for="text-input">Seleccione paquete de vuelo</label>
                                <div class="col-12">
                                    <select class="form-control" v-model="vuelo_id">
                                        <option value="0" disabled>Fecha Ida/Fecha Reg/Aeropuerto ida/ Aeropuerto Reg</option>
                                        <option  v-for="vuelo in arrayVuelo" :key="vuelo.idvuelo" :value="vuelo.idvuelo" 
                                        >{{vuelo.horarioida.fecha}}/{{vuelo.horarioreg.fecha}}/{{vuelo.aeropuertoida.nomaeropuerto}}/{{vuelo.aeropuertoreg.nomaeropuerto}}</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div v-show="errorReserva" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjReserva" :key=error v-text="error">
                                    </div>
                                </div>        
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal">Cerrar</button>
                        <button type="button"  class="btn btn-primary" @click="registrarReserva">Guardar</button>
                       
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
            </template>
            <template v-if="tipoAccion==2">
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
                                <label class="col-md-2 form-control-label" for="text-input">Id Reserva</label>
                                <div class="col-md-4">
                                    <input  disabled type="text" v-model="idreserva" class="form-control" placeholder="nombre oficial" >
                                </div>                                
                            </div>                            
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="text-input">Numero Tarjeta</label>
                                <div class="col-md-4">
                                    <input  type="text" v-model="numerotarjeta" class="form-control" placeholder="numero tarjeta " >
                                </div>                                
                            </div>                            
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="text-input">Codigo  Seguridad</label>
                                <div class="col-md-4">
                                    <input   type="text" v-model="codigoseguridad" class="form-control" placeholder="codigo seguridad" >
                                </div>                                
                            </div>                            
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="text-input">Fecha Vencimiento</label>
                                <div class="col-md-4">
                                    <input  type="date" v-model="fechavencimiento" class="form-control" placeholder="codigo seguridad" >
                                </div>                                
                            </div>                            
                            
                            <div v-show="errorReserva" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjReserva" :key=error v-text="error">
                                    </div>
                                </div>        
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal">Cerrar</button>                        
                        <button type="button" class="btn btn-primary" @click="Pagar">Pagar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
            </template>
            
        </div>
        <!--Fin del modal-->
        
    </main>
    <!-- /Fin del contenido principal -->
</template>

<script>
    export default {
        data(){
            return{                
                idreserva : 0,                
                cliente_id : 0,                
                vuelo_id:0,
                numerotarjeta:'',
                codigoseguridad:'',
                fechavencimiento:'',
                arrayCliente : [],
                arrayVuelo : [],
                arrayReserva : [],
                modal : 0,
                tituloModal : '', 
                tipoAccion : 0,
                errorReserva : 0,
                errorMostrarMsjReserva: [],
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
            listarReserva(page,buscar,criterio){
                let me=this;
                var url ='/reserva?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio; 
                axios.get(url).then(function (response) {
                    var respuesta = response.data;       
                    console.log(respuesta);             
                    me.arrayReserva = respuesta.reservas.data;
                    me.arrayVuelo=respuesta.vuelos;
                    me.pagination = respuesta.pagination;
                    me.arrayCliente=respuesta.clientes.data;
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
                me.listarReserva(page,buscar,criterio); 
            },

           registrarReserva()
           {
                if (this.validarReserva())   //evalua si el metodo validar categoria retorna 1
                {                              // y no realiza nada
                    return;
                }
                // en caso que validar categoria retorne diferente de 1 realizar lo siguiente
                let me=this;
                axios.post('/reserva/registrar', {                    
                    'cliente_id': this.cliente_id,
                    'vuelo_id': this.vuelo_id,                                                         
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarReserva(1,'','cliente_id');
                }).catch(function (error) {
                    console.log(error);
                });

           },

            Pagar()
           {
               if (this.validarPago())   
                {                              
                    return;
                }

                let me=this;
                axios.put('/reserva/pagar', {                    
                    'idreserva':this.idreserva,
                    'numerotarjeta':this.numerotarjeta,
                    'codigoseguridad':this.codigoseguridad,
                    'fechavencimiento':this.fechavencimiento,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarReserva(1,'','cliente_id');
                }).catch(function (error) {
                    console.log(error);
                });
           },
           

            validarReserva()
            {
                this.errorReserva=0;
                this.errorMostrarMsjReserva=[];

                if (!this.cliente_id) this.errorMostrarMsjReserva.push("Debe seleccionar un cliente");
                if (!this.vuelo_id ) this.errorMostrarMsjReserva.push("Debe seleccionar un vuelo");
                if (this.errorMostrarMsjReserva.length) this.errorReserva = 1;

                return this.errorReserva;
            },

            validarPago()
            {
                this.errorReserva=0;
                this.errorMostrarMsjReserva=[];

                if (!this.numerotarjeta || this.numerotarjeta.length<8) this.errorMostrarMsjReserva.push("El numero de tarjeta es obligatorio y debe tener minimo 8 caracteres");
                if (!this.codigoseguridad || this.codigoseguridad.length>3) this.errorMostrarMsjReserva.push("El codigo de seguridad es obligatorio y a lo sumo 3 caracteres");
                if (!this.fechavencimiento ) this.errorMostrarMsjReserva.push("Debe seleccionar una fecha");
                if (this.errorMostrarMsjReserva.length) this.errorReserva = 1;

                return this.errorReserva;
            },

           cerrarModal()
           {
              this.modal = 0;
              this.tituloModal = '';              
              this.cliente_id=0;
              this.vuelo_id=0;
              this.errorReserva = 0;
           },

           abrirModal(modelo, accion, data = [])
           {
               switch(modelo)
               {
                   case "reserva":
                   {
                       switch(accion)
                       {
                           case 'registrar':
                           {
                               this.modal = 1;
                               this.tituloModal = 'Registrar Reserva';
                               this.cliente_id= 0;
                               this.vuelo_id= 0;
                               this.tipoAccion = 1;
                               break;
                           } 
                           case 'pagar':
                           {
                               this.modal = 1;
                               this.tituloModal = 'Realizar Pago';
                               this.tipoAccion = 2;
                               this.idreserva = data['idreserva'];                               
                               break;
                           }    
                        }
                   }    
                }                
           }
        },
        mounted() {
            this.listarReserva(1,this.buscar,this.criterio);
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