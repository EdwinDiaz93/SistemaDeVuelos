<template>
        <!-- Contenido Principal -->
    <main class="main">
        <!-- Breadcrumb -->

        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Vuelo
                    <button type="button" @click="abrirModal('vuelo', 'registrar')" class="btn btn-secondary">
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
                                  <option selected value="aerolinea_cod">Codigo Aerolinea</option>                                  
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarVuelos(1,buscar,criterio)"  class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarVuelos(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Aerolinea</th>
                                <th>Millas reales</th>
                                <th>Millas otorgadas</th>
                                <th>aeropuerto origen</th>
                                <th>aeropuerto destino</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="vuelo in arrayVuelos" :key="vuelo.idvuelo">
                                <td>
                                    <button type="button" @click="abrirModal('vuelo', 'actualizar', vuelo)" class="btn btn-warning btn-sm">
                                      <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <template v-if="vuelo.estado=='1'">
                                        <button type="button" class="btn btn-danger btn-sm" @click="desactivarVuelo(vuelo.idvuelo)">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </template>
                                    <template v-else>
                                        <button type="button" class="btn btn-info btn-sm" @click="activarVuelo(vuelo.idvuelo)">
                                            <i class="icon-check"></i>
                                        </button>
                                    </template>
                                </td>
                                <td v-text="vuelo.aerolinea.nombreaerolinea"></td>
                                <td v-text="vuelo.millasreales"></td>
                                <td v-text="vuelo.millasotorgadas"></td>
                                <td v-text="vuelo.aeropuertoreg.nomaeropuerto"></td>
                                <td v-text="vuelo.aeropuertoida.nomaeropuerto"></td>
                                <td>
                                    <div v-if="vuelo.estado == '1'">
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
            <div class="modal-dialog modal-dialog-scrollable modal-primary modal-lg" role="document">
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
                                <label class="col-md-2 form-control-label" for="text-input">Nombre de Aerolinea</label>
                                <div class="col-md-4">
                                   <select class="form-control" v-model="aerolinea_cod">
                                        <option value="" disabled>Seleccione o agregue  una aerolinea</option>
                                        <option v-for="aeroLinea in arrayAerolineas" :key="aeroLinea.codaerolinea" :value="aeroLinea.codaerolinea" 
                                        v-text="aeroLinea.nombreaerolinea"></option>
                                    </select>
                                </div>
                                <label class="col-md-2 form-control-label" for="text-input">Precio</label>
                                <div class="col-md-4">
                                    <select class="form-control" v-model="idprecio">
                                        <option value="0" disabled>Seleccione o agregue  un precio</option>
                                        <option v-for="precio in arrayPrecios" :key="precio.idprecio" :value="precio.idprecio" 
                                        v-text="precio.cantidadprecio"></option>
                                    </select>
                                </div>
                            </div>                            
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="text-input">Pais de origen</label>
                                <div class="col-md-4">
                                    <select class="form-control" v-model="idciudadorigen">
                                        <option value="0" disabled>Seleccione un origen</option>
                                        <option v-for="ciudad in arrayCiudades" :key="ciudad.idciudad" :value="ciudad.idciudad" 
                                        >{{ciudad.pais.nompais}} - {{ciudad.nomciudad}}</option>
                                    </select>
                                </div>
                                <label class="col-md-2 form-control-label" for="text-input">Pais Destino</label>
                                <div class="col-md-4">
                                    <select class="form-control" v-model="idciudaddestino">
                                        <option value="0" disabled>Seleccione  un destino</option>
                                        <option v-for="ciudad in arrayCiudades" :key="ciudad.idciudad" :value="ciudad.idciudad" 
                                        > {{ciudad.pais.nompais}} - {{ciudad.nomciudad}}</option>
                                    </select>
                                </div>
                            </div>                            
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="text-input">Horario de salida</label>
                                <div class="col-md-4">
                                    <select class="form-control" v-model="idhorariosalida">
                                        <option value="0" disabled>Seleccione o agregue  un horario</option>
                                        <option v-for="horario in arrayHorarios" :key="horario.idhorario" :value="horario.idhorario" 
                                        >Fecha: {{horario.fecha}} Hora:{{horario.hora}}</option>
                                    </select>
                                </div>
                                <label class="col-md-2 form-control-label" for="text-input">Horario Regreso</label>
                                <div class="col-md-4">
                                    <select class="form-control" v-model="idhorarioregreso">
                                        <option value="0" disabled>Seleccione o agregue  un horario</option>
                                        <option v-for="horario in arrayHorarios" :key="horario.idhorario" :value="horario.idhorario" 
                                        > Fecha: {{horario.fecha}} Hora:{{horario.hora}}</option>
                                    </select>
                                </div>
                            </div>                            
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="text-input">Aeropuerto Destino</label>
                                <div class="col-md-4">
                                    <select class="form-control" v-model="idaeropuertoida">
                                        <option value="0" disabled>Seleccione o agregue  un aeropuerto</option>
                                        <option v-for="aeropuerto in arrayAeropuertos" :key="aeropuerto.id" :value="aeropuerto.id" 
                                        v-text="aeropuerto.nomaeropuerto"></option>
                                    </select>
                                </div>
                                <label class="col-md-2 form-control-label" for="text-input">Aeropuerto Origen</label>
                                <div class="col-md-4">
                                    <select class="form-control" v-model="idaeropuertoregreso">
                                        <option value="0" disabled>Seleccione o agregue  un aeropuerto</option>
                                        <option v-for="aeropuerto in arrayAeropuertos" :key="aeropuerto.id" :value="aeropuerto.id" 
                                        v-text="aeropuerto.nomaeropuerto"></option>
                                    </select>
                                </div>
                            </div>                           

                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="text-input">Clase de vuelo</label>
                                <div class="col-md-4">
                                    <select class="form-control" v-model="idclasevuelo">
                                        <option value="0" disabled>Seleccione o agregue  una clase de vuelo</option>
                                        <option v-for="clasevuelo in arrayClaseVuelo" :key="clasevuelo.idclasevuelo" :value="clasevuelo.idclasevuelo" 
                                        v-text="clasevuelo.nomclasevuelo"></option>
                                    </select>
                                </div>
                                 <label class="col-md-2 form-control-label" for="text-input">Costo adicional</label>
                                <div class="col-md-4">
                                    <select class="form-control" v-model="costo_id">
                                        <option value="0" disabled>Seleccione o agregue  un costo</option>
                                        <option v-for="costo in arrayCostos" :key="costo.idcosto" :value="costo.idcosto" 
                                        v-text="costo.cantidad"></option>
                                    </select>
                                </div>
                                
                            </div>                            
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="text-input">Millas Otorgadas</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="millasotorgadas" class="form-control" >
                                </div>
                                <label class="col-md-2 form-control-label" for="text-input">Millas reales</label>
                                <div class="col-md-4">
                                    <input type="text" v-model="millasreales" class="form-control" >
                                </div>
                            </div>
                                                        
                            <div v-show="errorVuelo" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjVuelo" :key=error v-text="error">

                                    </div>
                                </div>        
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarVuelo">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarVuelo">Actualizar</button>
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
                idvuelo:0, 
                aerolinea_cod : '',                
                idprecio :0,
                idhorariosalida :0,
                idhorarioregreso :0,
                idaeropuertoida : 0,
                idaeropuertoregreso : 0,
                idclasevuelo:0,
                millasreales:0,
                millasotorgadas:0,
                idciudadorigen:0,
                idciudaddestino:0,
                costo_id:0,
                arrayVuelos : [],
                arrayAerolineas : [],
                arrayHorarios : [],
                arrayAeropuertos : [],
                arrayPrecios : [],
                arrayClaseVuelo : [],
                arrayCiudades : [],
                arrayCostos : [],
                modal : 0,
                tituloModal : '', 
                tipoAccion : 0,
                errorVuelo : 0,
                errorMostrarMsjVuelo: [],
                pagination : {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
                },
                offset : 3,
                criterio : 'aerolinea_cod', 
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

            
            listarVuelos(page,buscar,criterio){
                let me=this;
                var url = '/vuelo?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio; 
                axios.get(url).then(function (response) {                    
                    var respuesta = response.data;    
                    console.log(respuesta);                                    
                    me.arrayVuelos = respuesta.vuelos.data;
                    me.arrayAerolineas = respuesta.aerolineas.data;
                    me.arrayPrecios = respuesta.precios.data;
                    me.arrayHorarios = respuesta.horarios.data;
                    me.arrayAeropuertos = respuesta.aeropuertos.data;
                    me.arrayClaseVuelo = respuesta.clasevuelos.data;
                    me.arrayCiudades = respuesta.ciudades.data;
                    me.arrayCostos = respuesta.costos.data;
                    me.pagination = respuesta.pagination;
                    
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {
                });
            },
            cargarPdf(){
                window.open('http://127.0.0.1:8000/vuelo/listarPdf','_blank');
            },

            cambiarPagina(page,buscar,criterio){
                let me = this;
                //actualizar pagina actual 
                me.pagination.current_page = page;
                //enviar peticion para visualizar la data  de esa pagina
                me.listarVuelos(page,buscar,criterio); 
            },
           
           registrarVuelo()
           {
                if (this.validarVuelo())   //evalua si el metodo validar categoria retorna 1
                {                              // y no realiza nada
                    return;
                }
                // en caso que validar categoria retorne diferente de 1 realizar lo siguiente
                let me=this;
                axios.post('/vuelo/registrar', {
                    'aerolinea_cod': this.aerolinea_cod,
                    "idprecio":this.idprecio,
                    "idhorariosalida":this.idhorariosalida,
                    "idhorarioregreso":this.idhorarioregreso,
                    "idaeropuertoida":this.idaeropuertoida,
                    "idaeropuertoregreso":this.idaeropuertoregreso,
                    "idciudadorigen":this.idciudadorigen,
                    "idciudaddestino":this.idciudaddestino,
                    "idclasevuelo":this.idclasevuelo,
                    "costo_id":this.costo_id,
                    "millasreales":this.millasreales,
                    "millasotorgadas":this.millasotorgadas,                    
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarVuelos(1,'','codaerolinea');
                }).catch(function (error) {
                    console.log(error);
                });

           },

            actualizarVuelo()
           {
               if (this.validarVuelo())   //evalua si el metodo validar categoria retorna 1
                {                              // y no realiza nada
                    return;
                }
                // en caso que validar categoria retorne diferente de 1 realizar lo siguiente
                let me=this;
                axios.put('/vuelo/actualizar', {
                    "idvuelo":this.idvuelo,
                    'aerolinea_cod': this.aerolinea_cod,
                    "idprecio":this.idprecio,
                    "idhorariosalida":this.idhorariosalida,
                    "idhorarioregreso":this.idhorarioregreso,
                    "idaeropuertoida":this.idaeropuertoida,
                    "idaeropuertoregreso":this.idaeropuertoregreso,
                    "idciudadorigen":this.idciudadorigen,
                    "idciudaddestino":this.idciudaddestino,
                    "costo_id":this.costo_id,
                    "idclasevuelo":this.idclasevuelo,
                    "millasreales":this.millasreales,
                    "millasotorgadas":this.millasotorgadas,                    
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarVuelos(1,'','idvuelo');
                }).catch(function (error) {
                    console.log(error);
                });
           },

            desactivarVuelo(id)
            {

                swal({
                title: '¿Estas seguro de desactivar este Vuelo?',
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
                    axios.put('/vuelo/desactivar', {
                        'id': id    
                    }).then(function (response) {
                        me.listarVuelos(1,'','idvuelo');
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

            activarVuelo(id)
            {

                swal({
                title: '¿Estas seguro de activar este vuelo?',
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
                    axios.put('/vuelo/activar', {
                        'id': id    
                    }).then(function (response) {
                        me.listarAerolineas(1,'','idvuelo');
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

            validarVuelo()
            {
                this.errorVuelo=0;
                this.errorMostrarMsjVuelo=[];

                if (!this.aerolinea_cod) this.errorMostrarMsjVuelo.push("El codigo de la aerolina es obligatorio");
                if (!this.idprecio || this.precio<0) this.errorMostrarMsjVuelo.push("El precio es obligatorio y no puede ser negativo");
                if (!this.idhorariosalida) this.errorMostrarMsjVuelo.push("El horario de salida es obligatorio");
                if (!this.idhorarioregreso) this.errorMostrarMsjVuelo.push("El horario de regreso es obligatorio");
                if (this.idhorariosalida===this.idhorarioregreso) this.errorMostrarMsjVuelo.push("Los horarios no pueden ser los mismos");
                if (!this.idaeropuertoida) this.errorMostrarMsjVuelo.push("El  aeropuerto de ida es obligatorio");
                if (!this.idaeropuertoregreso) this.errorMostrarMsjVuelo.push("El  aeropuerto de llegada es obligatorio");
                if (!this.idciudadorigen) this.errorMostrarMsjVuelo.push("La ciudad de origen es obligatoria");
                if (!this.idciudaddestino) this.errorMostrarMsjVuelo.push("La ciudad de destino es obligatoria");
                if (this.idciudaddestino===this.idciudadorigen) this.errorMostrarMsjVuelo.push("Las ciudades de origen y destino no pueden ser iguales");
                if (this.idaeropuertoregreso===this.idaeropuertoida) this.errorMostrarMsjVuelo.push(" Los aeropuerto no pueden ser iguales");
                if (!this.idclasevuelo) this.errorMostrarMsjVuelo.push("La clase de vuelo es obligatoria");
                if (!this.costo_id) this.errorMostrarMsjVuelo.push("El costo es obligatorio");
                if (!this.millasreales || this.millasreales<0) this.errorMostrarMsjVuelo.push("Las millas reales son obligatorios y no pueden ser menor que cero");
                if (!this.millasotorgadas || this.millasotorgadas<0) this.errorMostrarMsjVuelo.push("Las millas otorgadas son obligatorios y no pueden ser menor que cero");

                if (this.errorMostrarMsjVuelo.length) this.errorVuelo = 1;

                return this.errorVuelo;
            },

           cerrarModal()
           {
                this.modal=0;
                this.tituloModal='';
                this.aerolinea_cod = '',                
                this.idprecio =0,
                this.idhorariosalida =0,
                this.idhorarioregreso =0,
                this.idaeropuertoida = 0,
                this.idaeropuertoregreso = 0,
                this.idciudadorigen=0,
                this.idciudaddestino=0,
                this.idclasevuelo=0,
                this.costo_id=0,
                this.millasreales=0,
                this.millasotorgadas=0
           },

           abrirModal(modelo, accion, data = [])
           {
               switch(modelo)
               {
                   case "vuelo":
                   {
                       switch(accion)
                       {
                           case 'registrar':
                           {
                                this.modal = 1;
                                this.tipoAccion = 1;
                                this.tituloModal = 'Registrar Vuelo';
                                this.aerolinea_cod = '',                
                                this.idprecio =0,
                                this.idhorariosalida =0,
                                this.idhorarioregreso =0,
                                this.idaeropuertoida = 0,
                                this.idaeropuertoregreso = 0,
                                this.idciudadorigen=0,
                                this.idciudaddestino=0,
                                this.idclasevuelo=0,
                                this.costo_id=0,
                                this.millasreales=0,
                                this.millasotorgadas=0
                               break;
                           } 
                           case 'actualizar':
                           {
                                this.modal = 1;
                                this.tipoAccion = 2;
                                this.tituloModal = 'Actualizar Vuelo';
                                this.idvuelo=data['idvuelo'];
                                this.aerolinea_cod=data['aerolinea_cod'];
                                this.idprecio=data['idprecio'];
                                this.idhorariosalida=data['idhorariosalida'];
                                this.idhorarioregreso=data['idhorarioregreso'];
                                this.idaeropuertoida=data["idaeropuertoida"];
                                this.idaeropuertoregreso=data["idaeropuertoregreso"];
                                this.idciudadorigen=data["idciudadorigen"],
                                this.idciudaddestino=data["idciudaddestino"],
                                this.idclasevuelo=data["idclasevuelo"];
                                this.costo_id=data["costo_id"];
                                this.millasreales=data['millasreales'];
                                this.millasotorgadas=data['millasotorgadas'];
                               break;
                           }    
                        }
                   }    
                }

           }
        },
        mounted() {
            this.listarVuelos(1,this.buscar,this.criterio);
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