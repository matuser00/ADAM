<!--
To change this template, choose Tools | Templates
and open the template in the editor.
Tomás Martinez Arenas
Vista del catálogo de servicios y productos, y vista de producto o servició en específico.
-->
<?php 
    //Diseño de la pagina:
    include 'header.php';
    //Archivos necesarios:
     include('../Configuracion/config.php');    
     include('../Modelo/FuncionesComunes.php');    
     include('../Modelo/AdministradorServiciosYProductos.php');  
     
?>
<!-- Sript para que cargue los servicios y productos -->
<script>$(document).ready(serviciosyproductos_ini);</script>

<?php     
    $sop=null;//Servicio o producto secundario seleccionado
    if (isset($_GET['sop']))        
        $sop=$_GET['sop'];
?>
<?php if($sop==null){ ?>
    <!-- Contenido principal de la seccion <Vista de catálogo> -->
    <div id="Contenido">			
            <div id="ListaYFotos">
                    <div id="Lista" class="Contenido_ListaYFotos">
                            <p>Lista</p>
                            <?php
                                /*$datos=array("opcion"=>"consultaTodos");
                                $respuesta=FuncionesComunes::enviarPost("../Controlador/C_AdministradorServicioYProductos.php", $datos);
                                print_r($respuesta);*/
                            ?>
                            <!-- La lista de los servicios y productos -->
                            <ul id='tagLista'>                               
                                  
                            </ul>
                    </div>
                    <div id="Fotos" class="Contenido_ListaYFotos">
                            <p>Fotos</p>
                    </div>
            </div>			
    </div>
<?php } ?>
