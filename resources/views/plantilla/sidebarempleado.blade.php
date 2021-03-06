<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">            
            <li class="nav-title">
                Mantenimiento
            </li>
       
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-bag"></i> Vuelos</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=1" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i> Clase Vuelo</a>
                    </li>
                    
                    <li @click="menu=2" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-bag"></i> Horarios</a>
                    </li>
                    <li @click="menu=9" class="nav-item">                        
                        <a class="nav-link" href="#"><i class="icon-bag"></i> Precios</a>
                    </li>
                    <li @click="menu=17" class="nav-item">                        
                        <a class="nav-link" href="#"><i class="icon-bag"></i> Registrar vuelo</a>
                    </li>
                    <li @click="menu=14" class="nav-item">                        
                        <a class="nav-link" href="#"><i class="icon-bag"></i> Reserva</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-wallet"></i> Costos</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=3" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-wallet"></i> Costos</a>
                    </li>
                    <li @click="menu=4" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-notebook"></i> Tipo de costos</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-wallet"></i> Persona</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=5" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-wallet"></i> Tipo Documento</a>
                    </li>                    
                </ul>
            </li>
           
            
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-plane"></i> Aerolineas</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=8" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-plane"></i> Aerolinea</a>
                    </li>
                    

                    <li @click="menu=10" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-plane"></i> Avion</a>
                    </li>

                    <li @click="menu=11" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-plane"></i> Tipo Avion</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-plane"></i> Aeropuertos </a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=13" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-plane"></i> Aeropuerto</a>
                    </li>   
                </ul>
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-plane"></i> Clientes </a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=20" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-plane"></i> Listado de clietes</a>
                    </li>   
                </ul>
            </li>

           

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-plane"></i> Empleados </a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=21" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-plane"></i> Listado de Empleados</a>
                    </li>   
                </ul>
            </li>
            
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>


