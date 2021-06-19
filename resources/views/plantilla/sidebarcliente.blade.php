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
           
            
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
